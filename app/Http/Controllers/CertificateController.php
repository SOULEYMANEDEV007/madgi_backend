<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Http\Controllers\AppBaseController;
use App\Mail\CertificatMail;
use App\Models\Admin;
use App\Models\Flow;
use App\Models\Certificate;
use App\Models\Departement;
use App\Models\Media;
use App\Models\Signatory;
use App\Models\Transmission;
use App\Models\User;
use App\Repositories\CertificateRepository;
use App\Services\DateService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;

class CertificateController extends AppBaseController
{
    /** @var CertificateRepository $certificateRepository*/
    private $certificateRepository;

    private $user;

    public function __construct(CertificateRepository $certificateRepo)
    {
        $this->certificateRepository = $certificateRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Certificate.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $certificates = $this->certificateRepository->latest()->paginate(10);
                $total = $this->certificateRepository->count();
            }
            else {
                $certificates = $this->certificateRepository->where('department_id', $this->user->user()->depart->id)->latest()->paginate(10);
                $total = $this->certificateRepository->where('department_id', $this->user->user()->depart->id)->count();
            }
        }
        else {
            $certificates = $this->certificateRepository->where('user_id', auth()->user()->id)->latest()->paginate(10);
            $total = $this->certificateRepository->where('user_id', auth()->user()->id)->count();
        }

        $departments = Departement::all();

        return view('certificates.index', compact('certificates', 'departments', 'total'));
    }

    /**
     * Show the form for creating a new Certificate.
     */
    public function create()
    {
        return view('certificates.create');
    }

    /**
     * Store a newly created Certificate in storage.
     */
    public function store(CreateCertificateRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = $this->user->check() ? $input['user_id'] : auth()->user()->id;
        $input['fullname'] = $this->user->check() ? $input['fullname'] : auth()->user()->nom;
        $input['matricule'] = $this->user->check() ? $input['matricule'] : auth()->user()->matricule;
        $input['department_id'] = $this->user->check() ? $input['department_id'] : auth()->user()->departement;

        if(!empty($input['user_id'])) {
            $certificate = $this->certificateRepository->create($input);
            Flash::success('Certificate saved successfully.');
            return redirect(getGuardedRoute('certificates.index'));
        }
        else {
            Flash::error('Matricule inexistant');
            return back()->withInput();
        }
    }

    /**
     * Display the specified Certificate.
     */
    public function show($id)
    {
        $certificate = $this->certificateRepository->find($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        return view('certificates.show')->with('certificate', $certificate);
    }

    /**
     * Show the form for editing the specified Certificate.
     */
    public function edit($id)
    {
        $certificate = $this->certificateRepository->find($id);
        $users = User::all();

        if (empty($certificate) ) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        return view('certificates.edit')->with([
            'certificate' => $certificate,
            'users' => $users
        ]);
    }

    public function docEdit($id)
    {
        $certificate = $this->certificateRepository->find($id);
        $users = User::all();

        if (empty($certificate) ) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        return view('certificates.update-fields', compact('certificate'));
    }

    public function docUpdate($id, Request $request)
    {
        $certificate = $this->certificateRepository->find($id);

        $input = $request->all();

        if (empty($certificate) ) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        $certificate = $this->certificateRepository->update($input, $id);

        Flash::success('Certificate updated successfully.');
        return redirect(getGuardedRoute('certificates.index'));
    }

    /**
     * Update the specified Certificate in storage.
     */
    public function update($id, UpdateCertificateRequest $request)
    {
        $certificate = $this->certificateRepository->find($id);

        $input = $request->all();

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        $input['certificate_id'] = $certificate->id;
        $input['end_date'] = Carbon::now()->format('d/m/Y');

        $certificate = $this->certificateRepository->update($input, $id);

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $files = $request->file('file');
            $destinationPath = public_path('certificats/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Media::updateOrCreate([
                'src' => "/certificats/$profileImage",
                'source' => 'certificat',
                'source_id' => $certificate->id
            ]);
        }

        if(isset($input['peoples'])) {
            foreach ($input['peoples'] as $value) {
                Transmission::create(['user_id' => $value, 'certificate_id' => $certificate->id]);
                $user = User::find($value);
                if(!empty($user->email)) Mail::to($user->email)->send(new CertificatMail($certificate->type, $certificate->user->nom, getGuardedRoute('certificates.download', $certificate->id), $user->nom));
            }
        }

        if(!empty($certificate->user->email)) Mail::to($certificate->user->email)->send(new CertificatMail($certificate->type, $certificate->user->nom, getGuardedRoute('certificates.download', $certificate->id), $certificate->user->nom));

        Flash::success('Certificate updated successfully.');

        return redirect(getGuardedRoute('certificates.index'));
    }

    /**
     * Remove the specified Certificate from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $certificate = $this->certificateRepository->find($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        $this->certificateRepository->delete($id);

        Flash::success('Certificate deleted successfully.');

        return redirect(getGuardedRoute('certificates.index'));
    }

    public function search(Request $request)
    {
        $bool = strpos($request->search, 'ac') !== false ? 1 : 0;

        $query = Certificate::where('fullname', 'like', '%'.$request->search.'%')
                ->orWhere(function($q) use ($request, $bool) {
                    $q->orWhere('matricule', 'like', '%'.$request->search.'%')
                        ->orWhere('start_date', 'like', '%'.$request->search.'%')
                        ->orWhere('end_date', 'like', '%'.$request->search.'%')
                        ->orWhere('type', 'like', '%'.$request->search.'%')
                        ->orWhere('status', 'like', '%'.$request->search.'%');
                })
                ->whereRelation('department', 'name', 'like', '%'.$request->search.'%')
                ->latest();

        $certificates = $query->paginate($request->paginator)->appends($request->all());
        $total = $query->count();

        return view('certificates.index', compact('certificates', 'total'));
    }

    /**
     * Display the specified Certificate.
     */
    public function result($id)
    {
        $certificate = $this->certificateRepository->find($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        if(!empty($certificate->signatory_id)) return redirect(getGuardedRoute('certificates.index'));

        $user = $certificate->user;
        Carbon::setLocale('fr');
        $date = Carbon::now();
        $formattedDate = Carbon::parse($certificate->flows()->latest()->first()->created_at)->translatedFormat('d F Y');
        $date1 = Carbon::createFromFormat('d/m/Y', $certificate->new_start_date);
        $date2 = Carbon::createFromFormat('d/m/Y', $certificate->new_end_date);
        $differenceInDays = $date1->diffInDays($date2);
        $transmissions = Transmission::whereCertificateId($certificate->id)->get();
        $instance = new DateService();
        $formattedDates = $instance->generateFormattedDates($date1, $date2);

        return view('certificates.result')->with([
            'certificate' => $certificate,
            'user' => $user,
            'date' => $date,
            'formattedDate' => $formattedDate,
            'differenceInDays' => $differenceInDays,
            'transmissions' => $transmissions,
            'formattedDates' => $formattedDates,
        ]);
    }

    /**
     * Display the specified Certificate.
     */
    public function download($id)
    {
        $certificate = $this->certificateRepository->find($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(getGuardedRoute('certificates.index'));
        }

        $user = $certificate->user;

        $instance = new DateService();
        $date1 = !empty($certificate->start_date) ? Carbon::parse($certificate->start_date)->format('d/m/Y')  : null;
        $date2 = !empty($certificate->end_date) ? Carbon::parse($certificate->end_date)->format('d/m/Y')  : null;
        $workDate = !empty($certificate->work_date) ? Carbon::parse($certificate->work_date)->format('d/m/Y') : null;
        $resumption = !empty($certificate->resumption) ? $instance->generateFormattedDate1($certificate->resumption) : '';

        $data = [
            'name' => $user->nom,
            'function' => $user->fonction,
            'matricule' => $user->matricule,
            'department' => $user->depart->name ?? '',
            'service' => $user->serv->name ?? '',
            'cnps' => $user->cnps ?? '',
            'start_date' => $date1,
            'end_date' => $date2,
            'duration' => !empty($certificate->duration) ? numberToWords($certificate->duration) . "($certificate->duration)" : '',
            'return_service' => $resumption,
            'work_date' => $workDate,
            'motif' => $certificate->motif ?? '',
            'site' => $certificate->site?->name,

        ];

        if($certificate->type == "Attestation allaitement") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/attestation allaitement.docx'));
        elseif($certificate->type == "Attestation de reprise de service maternité") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/attestation de reprise de service maternité.docx'));
        elseif($certificate->type == "Attestation travail") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/ATTESTATION TRAVAIL.docx'));
        elseif($certificate->type == "Certificat de travail") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/CERTIFICAT DE TRAVAIL.docx'));
        elseif($certificate->type == "Décision autorisation d'absence") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/DECISION AUTORISATION ABSENCE.docx'));
        elseif($certificate->type == "Décision de congé") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/DECISION DE CONGE.docx'));
        elseif($certificate->type == "Modèle demande d'autorisation d'absence codifiée") $templateProcessor = new TemplateProcessor(storage_path("app/public/certificats/MODELE-DEMANDE-DAUTORISATION-DABSENCE-codifiee.docx"));
        elseif($certificate->type == "Modèle demande de congé codifiée") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/MODELE-DEMANDE-DE-CONGE-codifiee.docx'));
        elseif($certificate->type == "Prise de service") $templateProcessor = new TemplateProcessor(storage_path('app/public/certificats/PRISE DE SERVICE.docx'));
        else {
            Flash::error('Document introuvable');
            return redirect(getGuardedRoute('certificates.index'));
        }

        $templateProcessor->setValue('name', $data['name']);
        $templateProcessor->setValue('function', $data['function']);
        $templateProcessor->setValue('matricule', $data['matricule']);
        $templateProcessor->setValue('department', $data['department']);
        $templateProcessor->setValue('service', $data['service']);
        $templateProcessor->setValue('cnps', $data['cnps']);
        $templateProcessor->setValue('start_date', $data['start_date']);
        $templateProcessor->setValue('end_date', $data['end_date']);
        $templateProcessor->setValue('duration', $data['duration']);
        $templateProcessor->setValue('return_service', $data['return_service']);
        $templateProcessor->setValue('work_date', $data['work_date']);
        $templateProcessor->setValue('motif', $data['motif']);
        $templateProcessor->setValue('site', $data['site']);
        $tempFile = tempnam(sys_get_temp_dir(), 'Word');
        $templateProcessor->saveAs($tempFile);

        if($certificate->type == "Attestation allaitement") $name = "attestation allaitement $user->nom.docx";
        elseif($certificate->type == "Attestation de reprise de service maternité") $name = "attestation de reprise de service maternité $user->nom.docx";
        elseif($certificate->type == "Attestation travail") $name = "ATTESTATION TRAVAIL $user->nom.docx";
        elseif($certificate->type == "Certificat de travail") $name = "CERTIFICAT DE TRAVAIL $user->nom.docx";
        elseif($certificate->type == "Décision autorisation d'absence") $name = "DECISION AUTORISATION ABSENCE $user->nom.docx";
        elseif($certificate->type == "Décision de congé") $name = "DECISION DE CONGE $user->nom.docx";
        elseif($certificate->type == "Modèle demande d'autorisation d'absence codifiée") $name = "MODELE DEMANDE DAUTORISATION DABSENCE codifiee $user->nom.docx";
        elseif($certificate->type == "Modèle demande de congé codifiée") $name = "MODELE DEMANDE DE CONGE codifiee $user->nom.docx";
        elseif($certificate->type == "Prise de service") $name = "PRISE DE SERVICE $user->nom.docx";

        return response()->download($tempFile, $name)->deleteFileAfterSend(true);
    }
}
