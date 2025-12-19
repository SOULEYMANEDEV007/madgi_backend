<?php

namespace App\Http\Controllers;

use App\Exports\WorkerExport;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateFileRequest;
use App\Models\Activity;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Emargement;
use App\Models\File;
use App\Models\Grade;
use App\Models\Media;
use App\Models\Parametre;
use App\Models\Service;
use App\Models\Site;
use App\Models\User;
use App\Repositories\WorkerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Hash;

class WorkerController extends AppBaseController
{
    /** @var WorkerRepository $workerRepository*/
    private $workerRepository;

    private $user;

    public function __construct(WorkerRepository $workerRepo)
    {
        $this->workerRepository = $workerRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Worker.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $workers = $this->workerRepository->where('type', 1)->where('statut', 1)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->workerRepository->where('type', 1)->where('statut', 1)->count();
                $totalLock = $this->workerRepository->where('type', 1)->where('statut', 0)->count();
            }
            else {
                $workers = $this->workerRepository->where('type', 1)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->workerRepository->where('type', 1)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->workerRepository->where('type', 1)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('workers.index', compact('workers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $workers = $this->workerRepository->where('type', 1)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->workerRepository->where('type', 1)->where('statut', 1)->count();
                $totalLock = $this->workerRepository->where('type', 1)->where('statut', 0)->count();
            }
            else {
                $workers = $this->workerRepository->where('type', 1)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->workerRepository->where('type', 1)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->count();
                $totalLock = $this->workerRepository->where('type', 1)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('workers.index', compact('workers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    /**
     * Show the form for creating a new Worker.
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created Worker in storage.
     */
    public function store(CreateWorkerRequest $request)
    {
        $input = $request->all();

        $input['type'] = 1;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        $worker = $this->workerRepository->create($input);

        Flash::success('Worker saved successfully.');

        return redirect(getGuardedRoute('workers.index'));
    }

    /**
     * Display the specified Worker.
     */
    public function show($id, Request $request)
    {
        $worker = $this->workerRepository->find($id);

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

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        return view('workers.show', compact('worker', 'register', 'later', 'start_date', 'end_date', 'absences'));
    }

    /**
     * Show the form for editing the specified Worker.
     */
    public function edit($id)
    {
        $worker = $this->workerRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();
        $activities = Activity::orderBy('name','ASC')->get();

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        return view('workers.edit', compact('worker', 'sites', 'grades', 'departments', 'services', 'activities'));
    }

    /**
     * Update the specified Worker in storage.
     */
    public function update($id, UpdateWorkerRequest $request)
    {
        $worker = $this->workerRepository->find($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        $input = $request->all();

        $input['is_register'] = isset($input['is_register']) && $input['is_register'] == 'on' ? 1 : 0;
        $input['is_medical'] = isset($input['is_medical']) && $input['is_medical'] == 'on' ? 1 : 0;

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $worker = $this->workerRepository->update($input, $id);

        Flash::success('Worker updated successfully.');

        return redirect(getGuardedRoute('workers.index'));
    }

    /**
     * Remove the specified Worker from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $worker = $this->workerRepository->find($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        $this->workerRepository->delete($id);

        Flash::success('Worker deleted successfully.');

        return redirect(getGuardedRoute('workers.index'));
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
        if ($request->has('anciennete') && $request->anciennete != '') $query->where('date_entre_mad', '<=', $ancienneteDate);
        if ($request->has('anciennete1') && $request->anciennete1 != '') $query->whereYear('date_entre_mad', $ancienneteDate1);
        if ($request->has('genre') && $request->genre != '') $query->where('genre', $request->genre);
        if ($request->has('fonction') && $request->fonction != '') $query->where('fonction', 'like', '%' . $request->fonction . '%');
        if ($request->has('site') && $request->site != '') $query->where('site', 'like', '%' . $request->site . '%');
        if ($request->has('departement') && $request->departement != '') $query->where('departement', 'like', '%' . $request->departement . '%');
        if ($request->has('is_medical') && $request->is_medical != '') $query->where('is_medical', $request->is_medical);
        $type = $request->type;
        $workers = $query->where('type', 1)
                        ->where('statut', $type == 'disable' ? 0 : 1)
                        ->orderBy('nom', 'asc')
                        ->paginate($request->paginator)
                        ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('type', 1)->where('statut', 1)->count();
        $totalLock = $query->where('type', 1)->where('statut', 0)->count();

        return view('workers.index', compact('workers', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $worker = $this->workerRepository->find($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        $worker = $this->workerRepository->update(['statut' => !$worker->statut], $id);

        Flash::success('Worker modifié avec succès.');

        return redirect(getGuardedRoute('workers.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new WorkerExport($request), 'Personnels.xlsx');
    }

    public function stats()
    {
        $year = date('Y');
        Carbon::setLocale('fr');
        $monthName = Carbon::now()->translatedFormat('F');
        // $month = now()->month;

        $officialTotal = [
            'men' => User::whereIsSalarie(2)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(2)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $employeeTotal = [
            'men' => User::whereIsSalarie(1)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(1)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $externTotal = [
            'men' => User::whereIsSalarie(3)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(3)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $status = [
            'mens' => [
                'official' => $officialTotal['men'],
                'employee' => $employeeTotal['men'],
                'extern' => $externTotal['men'],
                'total' => $officialTotal['men'] + $employeeTotal['men'] + $externTotal['men'],
            ],
            'womens' => [
                'official' => $officialTotal['women'],
                'employee' => $employeeTotal['women'],
                'extern' => $externTotal['women'],
                'total' => $officialTotal['women'] + $employeeTotal['women'] + $externTotal['women'],
            ],
            'global' => $officialTotal['men'] + $employeeTotal['men'] + $externTotal['men'] + $officialTotal['women'] + $employeeTotal['women'] + $externTotal['women']
        ];


        $menTotal = [
            'house' => User::whereSite(1)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $womenTotal = [
            'house' => User::whereSite(1)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $officialTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $employeeTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $externTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $sites = [
            'mens' => [
                'house' => $menTotal['house'],
                'hmi' => $menTotal['hmi'],
                'total' => $menTotal['house'] + $menTotal['hmi'],
            ],
            'womens' => [
                'house' => $womenTotal['house'],
                'hmi' => $womenTotal['hmi'],
                'total' => $womenTotal['house'] + $womenTotal['hmi'],
            ],
            'officials' => [
                'house' => $officialTotal['house'],
                'hmi' => $officialTotal['hmi'],
                'total' => $officialTotal['house'] + $officialTotal['hmi'],
            ],
            'employees' => [
                'house' => $employeeTotal['house'],
                'hmi' => $employeeTotal['hmi'],
                'total' => $employeeTotal['house'] + $employeeTotal['hmi'],
            ],
            'externs' => [
                'house' => $externTotal['house'],
                'hmi' => $externTotal['hmi'],
                'total' => $externTotal['house'] + $externTotal['hmi'],
            ],
        ];

        $departments = new Collection([]);
        foreach (Departement::orderBy('name','ASC')->get() as $value) {
            $data = [
                'name' => $value->name,
                'total' => User::whereDepartement($value->id)/*->whereMonth('created_at', $month)*/->count(),
            ];
            $departments->push($data);
        }

        $externs = [
            'total' => User::whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        $officials = [
            'total' => User::whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        $employees = [
            'total' => User::whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        return view('workers.stats', compact('status', 'sites', 'departments', 'year', 'monthName', 'externs', 'officials', 'employees'));
    }

    public function pdf()
    {
        $year = date('Y');
        Carbon::setLocale('fr');
        $monthName = Carbon::now()->translatedFormat('F');
        // $month = now()->month;

        $officialTotal = [
            'men' => User::whereIsSalarie(2)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(2)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $employeeTotal = [
            'men' => User::whereIsSalarie(1)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(1)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $externTotal = [
            'men' => User::whereIsSalarie(3)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'women' => User::whereIsSalarie(3)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $status = [
            'mens' => [
                'official' => $officialTotal['men'],
                'employee' => $employeeTotal['men'],
                'extern' => $externTotal['men'],
                'total' => $officialTotal['men'] + $employeeTotal['men'] + $externTotal['men'],
            ],
            'womens' => [
                'official' => $officialTotal['women'],
                'employee' => $employeeTotal['women'],
                'extern' => $externTotal['women'],
                'total' => $officialTotal['women'] + $employeeTotal['women'] + $externTotal['women'],
            ],
            'global' => $officialTotal['men'] + $employeeTotal['men'] + $externTotal['men'] + $officialTotal['women'] + $employeeTotal['women'] + $externTotal['women']
        ];


        $menTotal = [
            'house' => User::whereSite(1)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereGenre('M')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $womenTotal = [
            'house' => User::whereSite(1)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereGenre('F')/*->whereMonth('created_at', $month)*/->count(),
        ];
        $officialTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $employeeTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $externTotal = [
            'house' => User::whereSite(1)->whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
            'hmi' => User::whereSite(6)->whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
        ];
        $sites = [
            'mens' => [
                'house' => $menTotal['house'],
                'hmi' => $menTotal['hmi'],
                'total' => $menTotal['house'] + $menTotal['hmi'],
            ],
            'womens' => [
                'house' => $womenTotal['house'],
                'hmi' => $womenTotal['hmi'],
                'total' => $womenTotal['house'] + $womenTotal['hmi'],
            ],
            'officials' => [
                'house' => $officialTotal['house'],
                'hmi' => $officialTotal['hmi'],
                'total' => $officialTotal['house'] + $officialTotal['hmi'],
            ],
            'employees' => [
                'house' => $employeeTotal['house'],
                'hmi' => $employeeTotal['hmi'],
                'total' => $employeeTotal['house'] + $employeeTotal['hmi'],
            ],
            'externs' => [
                'house' => $externTotal['house'],
                'hmi' => $externTotal['hmi'],
                'total' => $externTotal['house'] + $externTotal['hmi'],
            ],
        ];

        $departments = new Collection([]);
        foreach (Departement::orderBy('name','ASC')->get() as $value) {
            $data = [
                'name' => $value->name,
                'total' => User::whereDepartement($value->id)/*->whereMonth('created_at', $month)*/->count(),
            ];
            $departments->push($data);
        }

        $externs = [
            'total' => User::whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(3)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        $officials = [
            'total' => User::whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(2)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        $employees = [
            'total' => User::whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->count(),
            'avg' => User::whereIsSalarie(1)/*->whereMonth('created_at', $month)*/->selectRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) as age')
                        ->having('age', '>=', 60)
                        ->pluck('age')
                        ->avg(),
        ];

        $pdf = PDF::loadView('workers.pdf', compact('status', 'sites', 'departments', 'year', 'monthName', 'externs', 'officials', 'employees'));

        return $pdf->download('Point du personnel de la ' . env('APP_TITLE')  . ' ' . $year . '.pdf');
    }

    public function uploadFile(CreateFileRequest $request)
    {
        $input = $request->all();

        $worker = $this->workerRepository->find($input['user_id']);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        $file = File::create($input);

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $files = $request->file('file');
            $destinationPath = public_path('documents/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Media::updateOrCreate([
                'src' => "/documents/$profileImage",
                'source' => 'file',
                'source_id' => $file->id
            ]);
        }

        Flash::success('File saved successfully.');

        return redirect()->back();
    }

    public function deleteFile($id)
    {
        $file = File::find($id);

        if (empty($file)) {
            Flash::error('File not found');

            return redirect(getGuardedRoute('workers.index'));
        }

        $media = Media::find($file->doc?->id);
        $media?->delete($media->id);

        $file->delete($id);

        Flash::success('File deleted successfully.');

        return redirect(getGuardedRoute('workers.index'));
    }
}
