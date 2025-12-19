<?php

namespace App\Http\Controllers;

use App\Exports\StatsLeaveExport;
use App\Exports\StatsSingleLeaveExport;
use App\Http\Requests\CreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Controllers\AppBaseController;
use App\Mail\LeaveMail;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Flow;
use App\Models\Leave;
use App\Models\LeaveYear;
use App\Models\Media;
use App\Models\Parametre;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Signatory;
use App\Models\Transmission;
use App\Models\TypeLeave;
use App\Models\User;
use App\Models\UserLeave;
use App\Repositories\LeaveRepository;
use App\Services\DateService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class LeaveController extends AppBaseController
{
    /** @var LeaveRepository $leaveRepository*/
    private $leaveRepository;

    private $user;

    public function __construct(LeaveRepository $leaveRepo)
    {
        $this->leaveRepository = $leaveRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Leave.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                if($request->type == 'absence') {
                    $leaves = $this->leaveRepository->where('type_id', 2)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('type_id', 2)->count();
                }
                else if($request->type == 'annuel') {
                    $leaves = $this->leaveRepository->where('type_id', 1)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('type_id', 1)->count();
                }
                else {
                    $leaves = $this->leaveRepository->where('type_id', 3)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('type_id', 3)->count();
                }
            }
            else {
                if($request->type == 'absence') {
                    $leaves = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 2)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 2)->count();
                }
                else if($request->type == 'annuel') {
                    $leaves = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 1)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 1)->count();
                }
                else {
                    $leaves = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 3)->latest()->paginate(10);
                    $total = $this->leaveRepository->where('department_id', $this->user->user()->depart->id)->where('type_id', 3)->count();
                }
            }
        }
        else {
            if($request->type == 'absence') {
                $leaves = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 2)->latest()->paginate(10);
                $total = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 2)->count();
            }
            else if($request->type == 'annuel') {
                $leaves = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 1)->latest()->paginate(10);
                $total = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 1)->count();
            }
            else {
                $leaves = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 3)->latest()->paginate(10);
                $total = $this->leaveRepository->where('user_id', auth()->user()->id)->where('type_id', 3)->count();
            }
        }

        return view('leaves.index', compact('leaves', 'total'));
    }

    /**
     * Show the form for creating a new Leave.
     */
    public function create()
    {
        $types = TypeLeave::all();
        $departments = Departement::all();
        $services = Service::all();
        return view('leaves.create', compact('types', 'departments', 'services'));
    }

    /**
     * Store a newly created Leave in storage.
     */
    public function store(CreateLeaveRequest $request)
    {
        $input = $request->all();

        $user = Admin::where('department_id', $input['department_id'])->first();
        $input['signatory_id'] = ($this->user->check()) ? 1 : (!empty($user) ? $user->id : 2);
        $input['user_id'] = $this->user->check() ? $input['user_id'] : auth()->user()->id;
        $input['fullname'] = $this->user->check() ? $input['fullname'] : auth()->user()->nom;
        $input['matricule'] = $this->user->check() ? $input['matricule'] : auth()->user()->matricule;
        $input['department_id'] = $this->user->check() ? $input['department_id'] : auth()->user()->departement;
        $input['service_id'] = $this->user->check() ? $input['service_id'] : auth()->user()->service;
        $input['w_admin'] = $this->user->check() ? 1 : 0;

        foreach($input['leaveYear'] as $key => $value) {
            $userLeave = UserLeave::where('year', $key)->whereUserId($input['user_id'])->first();
            if(($userLeave->value - $userLeave->nb_use) < $value) {
                Flash::error('Veuillez saisir les bonnes valeur (Nb à retrancher) pour chaque année');
                return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
            }
        }

        if(!empty($input['user_id'])) {
            $input['number_absence'] = array_sum($input['leaveYear']);
            $leave = $this->leaveRepository->create($input);
            foreach ($input['leaveYear'] as $key => $value) {
                LeaveYear::create([
                    'year' => $key,
                    'nb' => $value,
                    'leave_id' => $leave->id,
                ]);
            }
            Flash::success('Leave saved successfully.');
            return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
        }
        else {
            Flash::error('Matricule inexistant');
            return back()->withInput();
        }
    }

    /**
     * Display the specified Leave.
     */
    public function show($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }

        return view('leaves.show')->with('leave', $leave);
    }

    /**
     * Show the form for editing the specified Leave.
     */
    public function edit($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave) ) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }

        return view('leaves.edit', compact('leave'));
    }

    public function appreciation($id)
    {
        $leave = $this->leaveRepository->find($id);
        $users = User::all();

        if (empty($leave) ) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }

        if(empty($leave->signatory_id) && $leave->signatory_id != 0) {
            Flash::error('Cette demande a déjà été traité');

            return redirect(getGuardedRoute('leaves.index'));
        }

        return view('leaves.appreciation')->with([
            'leave' => $leave,
            'users' => $users
        ]);
    }

    /**
     * Update the specified Leave in storage.
     */
    public function update(CreateLeaveRequest $request, $id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }


        $input = $request->all();

        $user = Admin::where('department_id', $input['department_id'])->first();
        $input['signatory_id'] = ($this->user->check()) ? 1 : (!empty($user) ? $user->id : 2);
        $input['user_id'] = $this->user->check() ? $input['user_id'] : auth()->user()->id;
        $input['fullname'] = $this->user->check() ? $input['fullname'] : auth()->user()->nom;
        $input['matricule'] = $this->user->check() ? $input['matricule'] : auth()->user()->matricule;
        $input['department_id'] = $this->user->check() ? $input['department_id'] : auth()->user()->departement;
        $input['service_id'] = $this->user->check() ? $input['service_id'] : auth()->user()->service;
        $input['w_admin'] = $this->user->check() ? 1 : 0;

        foreach($input['leaveYear'] as $key => $value) {
            $userLeave = UserLeave::where('year', $key)->whereUserId($input['user_id'])->first();
            if(($userLeave->value - $userLeave->nb_use) < $value) {
                Flash::error('Veuillez saisir les bonnes valeur (Nb à retrancher) pour chaque année');
                return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
            }
        }

        $input['number_absence'] = array_sum($input['leaveYear']);
        $this->leaveRepository->update($input, $id);

        foreach ($input['leaveYear'] as $key => $value) {
            $leaveYear = LeaveYear::whereLeaveId($id)->where('year', $key)->first();
            $leaveYear->update([
                'year' => $key,
                'nb' => $value,
                'leave_id' => $leave->id,
            ]);
        }
        Flash::success('Leave updated successfully.');
        return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
    }

    public function updateAppreciation($id, UpdateLeaveRequest $request)
    {
        $leave = $this->leaveRepository->find($id);

        $input = $request->all();

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
        }

        $input['leave_id'] = $leave->id;
        $input['signatory_id'] = $leave->signatory_id;
        $signator = Admin::where('department_id', $leave->department_id)->where('id', '>', $leave->signatory_id)->first();
        $admin = Admin::where('role_id', Admin::$admin)
                    ->orWhere('role_id', Admin::$agencechief)
                    ->first();

        $flow = Flow::create($input);
        if($leave->w_admin === 1 && $this->user->user()->role->id == 1) {
            $input['signatory_id'] = null;
            $input['resumption'] = $input['resumption'] ?? '';
            $leave = $this->leaveRepository->update($input, $id);

            $leaveYear = LeaveYear::where('leave_id', $leave->id)
                            ->orderBy('year', 'asc')
                            ->get();

            foreach($leaveYear as $element) {
                $userLeave = UserLeave::where('year', $element->year)->first();
                if ($userLeave && $input['status'] == 'SUCCESS') {
                    $userLeave->nb_use += $element->nb;
                    $userLeave->save();
                }
            }

            if(isset($input['peoples'])) {
                foreach ($input['peoples'] as $value) {
                    Transmission::create(['user_id' => $value, 'leave_id' => $leave->id]);
                    $user = User::find($value);
                    if(!empty($user->email) && $leave->status == "SUCCESS") Mail::to($user->email)->send(new LeaveMail($leave->type?->name, $leave->user, $leave->user));
                }
            }
            if(!empty($leave->user->email) && $leave->status == "SUCCESS") Mail::to($leave->user->email)->send(new LeaveMail($leave->type?->name, $leave->user, $leave->user));
        }
        else {
            if($leave->signatory_id == $admin->id) {
                $input['signatory_id'] = null;
                $input['resumption'] = $input['resumption'] ?? '';
                $leave = $this->leaveRepository->update($input, $id);

                $leaveYear = LeaveYear::where('leave_id', $leave->id)
                            ->orderBy('year', 'asc')
                            ->get();

                foreach($leaveYear as $element) {
                    $userLeave = UserLeave::where('year', $element->year)->first();
                    if ($userLeave && $input['status'] == 'SUCCESS') {
                        $userLeave->nb_use += $element->nb;
                        $userLeave->save();
                    }
                }

                if(isset($input['peoples'])) {
                    foreach ($input['peoples'] as $value) {
                        Transmission::create(['user_id' => $value, 'leave_id' => $leave->id]);
                        $user = User::find($value);
                        if(!empty($user->email) && $leave->status == "SUCCESS") Mail::to($user->email)->send(new LeaveMail($leave->type?->name, $leave->user, $leave->user));
                    }
                }
                if(!empty($leave->user->email) && $leave->status == "SUCCESS") Mail::to($leave->user->email)->send(new LeaveMail($leave->type?->name, $leave->user, $leave->user));
            }
            else $leave = $leave->update(['signatory_id' => !empty($signator) ? $signator->id : $admin->id]);
        }

        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != '') {
            $files = $request->file('picture');
            $destinationPath = public_path('flows/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Media::updateOrCreate([
                'src' => "/flows/$profileImage",
                'source' => 'flow',
                'source_id' => $flow->id
            ]);
        }

        Flash::success('Leave updated successfully.');

        return redirect(getGuardedRoute('leaves.index', ['type' => $input['path']]));
    }

    /**
     * Remove the specified Leave from storage.
     *
     * @throws \Exception
     */
    public function destroy($id, Request $request)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index', ['type' => $request->type]));
        }

        $this->leaveRepository->delete($id);

        Flash::success('Leave deleted successfully.');

        return redirect(getGuardedRoute('leaves.index', ['type' => $request->type]));
    }

    public function search(Request $request)
    {
        $typeId = $request->type == 'absence' ? 2 : ($request->type == 'annuel' ? 1 : 3);
        $search = '%' . $request->search . '%';

        $query = Leave::where('type_id', $typeId)
                ->where('fullname', 'like', $search)
                ->orWhere(function($q) use ($search) {
                    $q->orWhere('matricule', 'like', $search)
                        ->orWhere('start_date', 'like', $search)
                        ->orWhere('end_date', 'like', $search)
                        ->orWhere('place_enjoyment', 'like', $search)
                        ->orWhere('call_user_name', 'like', $search)
                        ->orWhere('call_phone', 'like', $search)
                        ->orWhere('interim', 'like', $search)
                        ->orWhere('status', 'like', $search);
                })
                ->whereRelation('department', 'name', 'like', $search)
                ->whereRelation('service', 'name', 'like', $search)
                ->whereRelation('type', 'name', 'like', $search)
                ->latest();

        $leaves = $query->where('type_id', $typeId)->paginate($request->paginator)->appends($request->all());
        $total = $query->where('type_id', $typeId)->count();

        return view('leaves.index', compact('leaves', 'total'));
    }

    /**
     * Display the specified Leave.
     */
    public function result($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }

        if(!empty($leave->signatory_id)) return redirect(getGuardedRoute('leaves.index'));

        $user = $leave->user;
        Carbon::setLocale('fr');
        $date = Carbon::now();
        $formattedDate = Carbon::parse($leave->flows()->latest()->first()->created_at)->translatedFormat('d F Y');
        $date1 = Carbon::createFromFormat('d/m/Y', $leave->new_start_date);
        $date2 = Carbon::createFromFormat('d/m/Y', $leave->new_end_date);
        $differenceInDays = $date1->diffInDays($date2);
        $transmissions = Transmission::whereLeaveId($leave->id)->get();
        $instance = new DateService();
        $formattedDates = $instance->generateFormattedDates($date1, $date2);

        return view('leaves.result')->with([
            'leave' => $leave,
            'user' => $user,
            'date' => $date,
            'formattedDate' => $formattedDate,
            'differenceInDays' => $differenceInDays,
            'transmissions' => $transmissions,
            'formattedDates' => $formattedDates,
        ]);
    }

    /**
     * Display the specified Leave.
     */
    public function download($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.index'));
        }

        $user = $leave->user;
        Carbon::setLocale('fr');
        $date = Carbon::now();
        $year = $date->format('Y');


        if(!empty($leave->signatory_id)) {
            $formattedDate = $date->translatedFormat('d F Y');
            $instance = new DateService();
            $date1 = !empty($leave->start_date) ? Carbon::parse($leave->start_date)->format('d/m/Y')  : null;
            $date2 = !empty($leave->end_date) ? Carbon::parse($leave->end_date)->format('d/m/Y')  : null;
            $resumption = !empty($leave->resumption) ? $instance->generateFormattedDate1($leave->resumption) : '';

            $data = [
                'date' => $formattedDate,
                'name' => $user->nom,
                'function' => $user->fonction,
                'matricule' => $user->matricule,
                'cnps' => $user->cnps ?? '',
                'service' => $user->serv->name ?? null,
                'department' => $user->depart->name ?? null,
                'absence_duration' => $leave->number_absence,
                'absence_duration_letter' => $leave->number_absence != null ? numberToWords($leave->number_absence) : null,
                'duration' => !empty($leave->duration) ? numberToWords($leave->duration) . "($leave->duration)" : '',
                'absence_date' => $date->translatedFormat('Y'),
                'return_date' => null,
                'return_service' => $resumption,
                'reason' => $leave->motif,
                'place_enjoyment' => $leave->place_enjoyment,
                'interim' => $leave->interim,
                'call_user_name' => $leave->call_user_name,
                'call_phone' => $leave->call_phone,
                'new_start_date' => $date1,
                'new_end_date' => $date2,
                'year' => $year,
                'transmissions' => null
            ];
        }
        else {
            $formattedDate = $date->translatedFormat('d F Y');
            $date1 = Carbon::parse($leave->new_start_date)->format('d/m/Y');
            $date2 = Carbon::parse($leave->new_end_date)->format('d/m/Y');
            $differenceInDays = $leave->number_absence; // $date1->diffInDays($date2);
            $transmissions = Transmission::whereLeaveId($leave->id)->get();
            $instance = new DateService();
            $formattedDates = !empty($leave->resumption) ? $instance->generateFormattedDate1($leave->resumption) : ''; // $instance->generateFormattedDates($date1, $date2);
            $resumption = !empty($leave->resumption) ? $instance->generateFormattedDate1($leave->resumption) : '';
            $transmission = [];

            foreach ($transmissions as $item) {
                if(!empty($item->user)) $transmission[] = $item->user->nom;
            }

            $data = [
                'date' => $formattedDate,
                'name' => $user->nom,
                'function' => $user->fonction,
                'matricule' => $user->matricule,
                'service' => $user->serv->name ?? '',
                'cnps' => $user->cnps ?? '',
                'department' => $user->depart->name ?? '',
                'absence_duration' => $leave->number_absence ?? $differenceInDays,
                'absence_duration_letter' => numberToWords($leave->number_absence ?? $differenceInDays),
                'duration' => !empty($leave->duration) ? numberToWords($leave->duration) . "($leave->duration)" : '',
                'absence_date' => $date->translatedFormat('Y'),
                'return_date' => $formattedDates,
                'return_service' => $resumption,
                'reason' => $leave->motif,
                'place_enjoyment' => $leave->place_enjoyment,
                'interim' => $leave->interim,
                'call_user_name' => $leave->call_user_name,
                'call_phone' => $leave->call_phone,
                'new_start_date' => $date1,
                'new_end_date' => $date2,
                'year' => $year,
                'transmissions' => $transmission
            ];
        }

        if($leave->type_id == 2) {
            switch ($user->activity?->name) {
                case 'AG':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE AG.docx'));
                    break;
                case 'Sécrétaire Géneral':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE SG.docx'));
                    break;
                case 'Conseiller Technique':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE CT.docx'));
                    break;
                case 'Chef de departement':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE CHEF DE DEPARTEMENT.docx'));
                    break;
                case 'Chef de service':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE CHEF DE SERVICE.docx'));
                    break;
                case "Chef d'unité":
                    $templateProcessor = new TemplateProcessor(storage_path("app/public/leaves/absence/EXEMPLAIRE ABSENCE CHEF D'UNITE.docx"));
                    break;
                case 'Chef de cabinet':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE Chef CAB.docx'));
                    break;
                case 'Chef de sous departement':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE CHEF DE SOUS DEPARTEMENT.docx'));
                    break;
                default:
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/absence/EXEMPLAIRE ABSENCE AGENT.docx'));
                    break;
            }
        }
        else if($leave->type_id == 1) {
            switch ($user->activity?->name) {
                case 'AG':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE AG.docx'));
                    break;
                case 'Sécrétaire Géneral':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Secrétaire général.docx'));
                    break;
                case 'Conseiller Technique':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE CT.docx'));
                    break;
                case 'Chef de departement':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Chef de Departement.docx'));
                    break;
                case 'Chef de service':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Chef de Service.docx'));
                    break;
                case "Chef d'unité":
                    $templateProcessor = new TemplateProcessor(storage_path("app/public/leaves/leave/CONGE Chef d'unité.docx"));
                    break;
                case 'Chef de cabinet':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Chef CAB.docx'));
                    break;
                case 'Chef de sous departement':
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Chef de Sous-Departement.docx'));
                    break;
                default:
                    $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/leave/CONGE Agent.docx'));
                    break;
            }
        }
        else $templateProcessor = new TemplateProcessor(storage_path('app/public/leaves/CONGE MATERNITE.docx'));

        $letterNumber = $data['absence_duration_letter'] !== null
                        ? $data['absence_duration_letter'] . ' (' . $data['absence_duration'] . ')'
                        : $data['absence_duration'];

        $templateProcessor->setValue('date', $data['date']);
        $templateProcessor->setValue('name', $data['name']);
        $templateProcessor->setValue('function', $data['function']);
        $templateProcessor->setValue('matricule', $data['matricule']);
        $templateProcessor->setValue('service', $data['service']);
        $templateProcessor->setValue('cnps', $data['cnps']);
        $templateProcessor->setValue('department', $data['department']);
        $templateProcessor->setValue('absence_duration', $letterNumber);
        $templateProcessor->setValue('absence_duration_letter', $data['absence_duration_letter']);
        $templateProcessor->setValue('duration', $data['duration']);
        $templateProcessor->setValue('absence_date', $data['absence_date']);
        $templateProcessor->setValue('return_date', $data['return_date']);
        $templateProcessor->setValue('return_service', $data['return_service']);
        $templateProcessor->setValue('reason', $data['reason']);
        $templateProcessor->setValue('place_enjoyment', $data['place_enjoyment']);
        $templateProcessor->setValue('interim', $data['interim']);
        $templateProcessor->setValue('call_user_name', $data['call_user_name']);
        $templateProcessor->setValue('call_phone', $data['call_phone']);
        $templateProcessor->setValue('new_start_date', $data['new_start_date']);
        $templateProcessor->setValue('new_end_date', $data['new_end_date']);
        $templateProcessor->setValue('year', $data['year']);
        $templateProcessor->cloneBlock('transmissions_block', 0, true, false);
        $tempFile = tempnam(sys_get_temp_dir(), 'Word');
        $templateProcessor->saveAs($tempFile);
        if($leave->type_id == 2) return response()->download($tempFile, "autorisation-absence-$user->nom.docx")->deleteFileAfterSend(true);
        else if($leave->type_id == 1) return response()->download($tempFile, "autorisation-conge-$user->nom.docx")->deleteFileAfterSend(true);
        else return response()->download($tempFile, "conge-maternite-$user->nom.docx")->deleteFileAfterSend(true);
    }

    public function stats(Request $request)
    {
        $collections = new Collection([]);
        if($this->user->check()) {
            $all = User::count();
            foreach (User::where('nom', '!=', 'Admin Tablette')->orderBy('nom', 'asc')->get() as $key => $value) {
                if ($request->start_date && $request->end_date) {
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                }
                else $startDate = $endDate = Carbon::now()->format('Y');
                $clause = [$startDate, $endDate];
                // $leaves = Leave::whereUserId($value->id)->whereBetween(DB::raw('YEAR(created_at)'), $clause)->whereStatus('SUCCESS')->count();

                // $year = Carbon::now()->format('Y');
                $total = UserLeave::whereUserId($value->id)/*->where('year', $year)*/->get();
                $data = [
                    'user' => $value,
                    'total' => $total->sum('value') ?? 0,
                    'leaves' => $total->sum('nb_use') ?? 0,
                    'rest' => $total->sum('value') - $total->sum('nb_use'),
                ];
                $collections->push($data);
            }
        }
        else {
            $all = 1;
            if ($request->start_date && $request->end_date) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;
            }
            else $startDate = $endDate = Carbon::now()->format('Y');
            $clause = [$startDate, $endDate];
            // $leaves = Leave::whereUserId(auth()->user()->id)->whereBetween(DB::raw('YEAR(created_at)'), $clause)->whereStatus('SUCCESS')->count();

            // $year = Carbon::now()->format('Y');
            $total = UserLeave::whereUserId(auth()->user()->id)/*->where('year', $year)*/->get();
            $data = [
                'user' => auth()->user(),
                'total' => $total->sum('value') ?? 0,
                'leaves' => $total->sum('nb_use') ?? 0,
                'rest' => $total->sum('value') - $total->sum('nb_use'),
            ];
            $collections->push($data);
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $collections->slice(($page - 1) * $perPage, $perPage)->values();
        $collections = new LengthAwarePaginator(
            $paginatedItems,
            $collections->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // $total = Leave::whereBetween(DB::raw('YEAR(created_at)'), $clause)->count();

        return view('leaves.stats', compact('collections', 'startDate', 'endDate', 'total', 'all'));
    }

    public function searchStats(Request $request)
    {
        $users = User::where('nom', 'like', '%' . $request->search . '%')->paginate(10);
        $all = User::where('nom', 'like', '%' . $request->search . '%')->count();
        $collections = new Collection([]);
        $startDate = $endDate = Carbon::now()->format('Y');
        $clause = [$startDate, $endDate];
        foreach ($users as $key => $value) {
            if ($request->start_date && $request->end_date) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;
            }
            $clause = [$startDate, $endDate];
            // $leaves = Leave::whereUserId($value->id)->whereBetween(DB::raw('YEAR(created_at)'), $clause)->whereStatus('SUCCESS')->count();

            // $year = Carbon::now()->format('Y');
            $total = UserLeave::whereUserId($value->id)/*->where('year', $year)*/->get();
            $data = [
                'user' => $value,
                'total' => $total->sum('value') ?? 0,
                'leaves' => $total->sum('nb_use') ?? 0,
                'rest' => $total->sum('value') - $total->sum('nb_use'),
            ];
            $collections->push($data);
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $collections->slice(($page - 1) * $perPage, $perPage)->values();
        $collections = new LengthAwarePaginator(
            $paginatedItems,
            $collections->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $total = Leave::whereBetween(DB::raw('YEAR(created_at)'), $clause)->count();

        return view('leaves.stats', compact('collections', 'startDate', 'endDate', 'total', 'all'));
    }

    public function statSingle($id, Request $request)
    {
        $collections = new Collection([]);
        $total = UserLeave::whereUserId($id)->orderBy('year', 'asc')->get();

        foreach ($total as $item) {
            // $leave = Leave::whereUserId($id)->where(DB::raw('YEAR(created_at)'), $item->year)->whereStatus('SUCCESS')->count();
            $data = [
                'year' => $item->year,
                'total' => $item->value,
                'leaves' => $item->nb_use,
                'rest' => $item->value - $item->nb_use,
                'user_leave' => $item
            ];
            $collections->push($data);
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $collections->slice(($page - 1) * $perPage, $perPage)->values();
        $collections = new LengthAwarePaginator(
            $paginatedItems,
            $collections->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $user = User::find($id);

        return view('leaves.single-stats', compact('collections', 'user'));
    }

    public function exportStats($start, $end)
    {
        return Excel::download(new StatsLeaveExport($start, $end), 'statistiques-conge.xlsx');
    }

    public function exportSingleStats($id)
    {
        $user = User::find($id);
        return Excel::download(new StatsSingleLeaveExport($id), "statistiques-conge-$user->nom.xlsx");
    }

    public function createAssignLeave(Request $request)
    {
        $input = $request->all();

        UserLeave::updateOrCreate([
            'year' => $input['year'],
            'user_id' => $input['user_id'],
        ], $input);

        Flash::success('Leave created successfully.');

        return redirect(getGuardedRoute('leaves.single', $input['user_id']));
    }

    public function updateAssignLeave(Request $request)
    {
        $input = $request->all();

        $leave = UserLeave::find($input['leave-id']);

        $leave->update($input);

        Flash::success('Leave updated successfully.');

        return redirect(getGuardedRoute('leaves.single', $input['user_id']));
    }

    public function deleteAssignLeave($id)
    {
        $leave = UserLeave::find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(getGuardedRoute('leaves.single', $leave->user_id));
        }

        $leave->delete($id);

        Flash::success('Leave deleted successfully.');

        return redirect(getGuardedRoute('leaves.single', $leave->user_id));
    }
}
