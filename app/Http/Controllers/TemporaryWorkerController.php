<?php

namespace App\Http\Controllers;

use App\Exports\TemporaryWorkerExport;
use App\Http\Requests\CreateTemporaryWorkerRequest;
use App\Http\Requests\UpdateTemporaryWorkerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Emargement;
use App\Models\Grade;
use App\Models\Parametre;
use App\Models\Service;
use App\Models\Site;
use App\Models\User;
use App\Repositories\TemporaryWorkerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class TemporaryWorkerController extends AppBaseController
{
    /** @var TemporaryWorkerRepository $temporaryWorkerRepository*/
    private $temporaryWorkerRepository;

    private $user;

    public function __construct(TemporaryWorkerRepository $temporaryWorkerRepo)
    {
        $this->temporaryWorkerRepository = $temporaryWorkerRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the TemporaryWorker.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $temporaryWorkers = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 1)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 1)->count();
                $totalLock = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 0)->count();
            }
            else {
                $temporaryWorkers = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->temporaryWorkerRepository->where('type', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->temporaryWorkerRepository->where('type', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('temporary_workers.index', compact('temporaryWorkers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $temporaryWorkers = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 1)->count();
                $totalLock = $this->temporaryWorkerRepository->where('type', 3)->where('statut', 0)->count();
            }
            else {
                $temporaryWorkers = $this->temporaryWorkerRepository->where('type', 3)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->temporaryWorkerRepository->where('type', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->temporaryWorkerRepository->where('type', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('temporary_workers.index', compact('temporaryWorkers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    /**
     * Show the form for creating a new TemporaryWorker.
     */
    public function create()
    {
        return view('temporary_workers.create');
    }

    /**
     * Store a newly created TemporaryWorker in storage.
     */
    public function store(CreateTemporaryWorkerRequest $request)
    {
        $input = $request->all();

        $input['type'] = 3;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $temporaryWorker = $this->temporaryWorkerRepository->create($input);

        Flash::success('Temporary Worker saved successfully.');

        return redirect(getGuardedRoute('temporary-workers.index'));
    }

    /**
     * Display the specified TemporaryWorker.
     */
    public function show($id, Request $request)
    {
        $temporaryWorker = $this->temporaryWorkerRepository->find($id);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            $startOfWeek = $start_date->copy()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = $end_date->copy()->endOfWeek(Carbon::MONDAY);
        }
        else {
            $start_date = $end_date = Carbon::now();
            $startOfWeek = $start_date->copy()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = $end_date->copy()->endOfWeek(Carbon::MONDAY);
        }
        $clause = [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')];
        $register = Emargement::whereUserId($id)->whereBetween('date', $clause)->count();
        $parametre = Parametre::whereSlug('heure_arrive')->first();
        $later = Emargement::whereUserId($id)->whereBetween('date', $clause)->where('heure_arrive', '>', $parametre->value)->count();

        $absences = 0;
        for ($day = $start_date->copy(); $day->lte($end_date); $day->addDay()) {
            $registration = Emargement::whereUserId($id)->where('date', $day->format('Y-m-d'))->first();
            if (!$registration) $absences++;
        }

        if (empty($temporaryWorker)) {
            Flash::error('Temporary Worker not found');

            return redirect(getGuardedRoute('temporary-workers.index'));
        }

        return view('temporary_workers.show', compact('temporaryWorker', 'register', 'later', 'start_date', 'end_date', 'absences'));
    }

    /**
     * Show the form for editing the specified TemporaryWorker.
     */
    public function edit($id)
    {
        $temporaryWorker = $this->temporaryWorkerRepository->find($id);

        if (empty($temporaryWorker)) {
            Flash::error('Temporary Worker not found');

            return redirect(getGuardedRoute('temporary-workers.index'));
        }

        return view('temporary_workers.edit')->with('temporaryWorker', $temporaryWorker);
    }

    /**
     * Update the specified TemporaryWorker in storage.
     */
    public function update($id, UpdateTemporaryWorkerRequest $request)
    {
        $temporaryWorker = $this->temporaryWorkerRepository->find($id);

        if (empty($temporaryWorker)) {
            Flash::error('Temporary Worker not found');

            return redirect(getGuardedRoute('temporary-workers.index'));
        }

        $input = $request->all();

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $temporaryWorker = $this->temporaryWorkerRepository->update($input, $id);

        Flash::success('Temporary Worker updated successfully.');

        return redirect(getGuardedRoute('temporary-workers.index'));
    }

    /**
     * Remove the specified TemporaryWorker from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $temporaryWorker = $this->temporaryWorkerRepository->find($id);

        if (empty($temporaryWorker)) {
            Flash::error('Temporary Worker not found');

            return redirect(getGuardedRoute('temporary-workers.index'));
        }

        $this->temporaryWorkerRepository->delete($id);

        Flash::success('Temporary Worker deleted successfully.');

        return redirect(getGuardedRoute('temporary-workers.index'));
    }

    public function search(Request $request)
    {
        $date = Carbon::now();
        $ageDate = $request->age ? $date->subYears($request->age)->format('Y') : null;
        $ancienneteDate = $request->anciennete ? $date->subYears($request->anciennete)->startOfYear()->format('Y-m-d') : null;
        $ancienneteDate1 = $request->anciennete1 ? $date->subYears($request->anciennete1)->format('Y') : null;

        $query = User::query();
        if ($request->has('nom') && $request->nom != '') $query->where('nom', 'like', '%' . $request->nom . '%');
        if ($request->has('statut') && $request->statut != '') $query->where('statut_mad', $request->statut);
        if ($request->has('contact') && $request->contact != '') $query->where('tel', 'like', '%' . $request->contact . '%');
        if ($request->has('matricule') && $request->matricule != '') $query->where('matricule', $request->matricule);
        if ($request->has('service') && $request->service != '') $query->where('service', 'like', '%' . $request->service . '%');
        if ($request->has('age') && $request->age != '') $query->orWhereYear('date_naissance', $ageDate);
        if ($request->has('grade') && $request->grade != '') foreach ($request->grade as $value) $query->where('grade', $value)->orWhere('grade', $value);
        // if ($request->has('date_entre_m') && $request->date_entre_m != '') $query->whereDate('date_entre_mad', $request->date_entre_m);
        if ($request->has('anciennete') && $request->anciennete != '') $query->where('date_entre_mad', '<=', $ancienneteDate);
        if ($request->has('anciennete1') && $request->anciennete1 != '') $query->whereYear('date_entre_mad', $ancienneteDate1);
        if ($request->has('genre') && $request->genre != '') $query->where('genre', $request->genre);
        if ($request->has('fonction') && $request->fonction != '') $query->where('fonction', 'like', '%' . $request->fonction . '%');
        if ($request->has('site') && $request->site != '') $query->where('site', 'like', '%' . $request->site . '%');
        if ($request->has('departement') && $request->departement != '') $query->where('departement', 'like', '%' . $request->departement . '%');
        $type = $request->type;
        $temporaryWorkers = $query->where('type', 3)
                                ->where('statut', $type == 'disable' ? 0 : 1)
                                ->orderBy('nom', 'asc')
                                ->paginate($request->paginator)
                                ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('type', 3)->where('statut', 1)->count();
        $totalLock = $query->where('type', 3)->where('statut', 0)->count();

        return view('temporary_workers.index', compact('temporaryWorkers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $intern = $this->temporaryWorkerRepository->find($id);

        if (empty($intern)) {
            Flash::error('Intern not found');

            return redirect(getGuardedRoute('temporary-workers.index'));
        }

        $intern = $this->temporaryWorkerRepository->update(['statut' => !$intern->statut], $id);

        Flash::success('Intern modifié avec succès.');

        return redirect(getGuardedRoute('temporary-workers.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new TemporaryWorkerExport($request), 'vacataire.xlsx');
    }
}
