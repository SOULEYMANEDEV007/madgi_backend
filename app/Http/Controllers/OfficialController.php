<?php

namespace App\Http\Controllers;

use App\Exports\OfficialExport;
use App\Http\Requests\CreateOfficialRequest;
use App\Http\Requests\UpdateOfficialRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Grade;
use App\Models\Service;
use App\Models\Site;
use App\Models\User;
use App\Repositories\OfficialRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class OfficialController extends AppBaseController
{
    /** @var OfficialRepository $officialRepository*/
    private $officialRepository;

    private $user;

    public function __construct(OfficialRepository $officialRepo)
    {
        $this->officialRepository = $officialRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the official.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $officials = $this->officialRepository->where('is_salarie', 2)->where('statut', 1)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->officialRepository->where('is_salarie', 2)->where('statut', 1)->count();
                $totalLock = $this->officialRepository->where('is_salarie', 2)->where('statut', 0)->count();
            }
            else {
                $officials = $this->officialRepository->where('is_salarie', 2)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->officialRepository->where('is_salarie', 2)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->officialRepository->where('is_salarie', 2)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('officials.index', compact('officials', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $officials = $this->officialRepository->where('is_salarie', 2)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->officialRepository->where('is_salarie', 2)->where('statut', 1)->count();
                $totalLock = $this->officialRepository->where('is_salarie', 2)->where('statut', 0)->count();
            }
            else {
                $officials = $this->officialRepository->where('is_salarie', 2)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->officialRepository->where('is_salarie', 2)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->officialRepository->where('is_salarie', 2)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('officials.index', compact('officials', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    /**
     * Show the form for creating a new official.
     */
    public function create()
    {
        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();

        return view('officials.create', compact('sites', 'departments', 'grades', 'services'));
    }

    /**
     * Store a newly created official in storage.
     */
    public function store(CreateOfficialRequest $request)
    {
        $input = $request->all();

        $input['is_salarie'] = 2;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $official = $this->officialRepository->create($input);

        Flash::success('official saved successfully.');

        return redirect(getGuardedRoute('officials.index'));
    }

    /**
     * Display the specified official.
     */
    public function show($id)
    {
        $official = $this->officialRepository->find($id);

        if (empty($official)) {
            Flash::error('official not found');

            return redirect(getGuardedRoute('officials.index'));
        }

        return view('officials.show')->with('official', $official);
    }

    /**
     * Show the form for editing the specified official.
     */
    public function edit($id)
    {
        $official = $this->officialRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();

        if (empty($official)) {
            Flash::error('official not found');

            return redirect(getGuardedRoute('officials.index'));
        }

        return view('officials.edit', compact('official', 'sites', 'departments', 'grades', 'services'));
    }

    /**
     * Update the specified official in storage.
     */
    public function update($id, UpdateOfficialRequest $request)
    {
        $official = $this->officialRepository->find($id);

        if (empty($official)) {
            Flash::error('official not found');

            return redirect(getGuardedRoute('officials.index'));
        }

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $official = $this->officialRepository->update($request->all(), $id);

        Flash::success('official updated successfully.');

        return redirect(getGuardedRoute('officials.index'));
    }

    /**
     * Remove the specified official from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $official = $this->officialRepository->find($id);

        if (empty($official)) {
            Flash::error('official not found');

            return redirect(getGuardedRoute('officials.index'));
        }

        $this->officialRepository->delete($id);

        Flash::success('official deleted successfully.');

        return redirect(getGuardedRoute('officials.index'));
    }

    public function search(Request $request)
    {
        $date = Carbon::now();
        $ageDate = $request->age ? $date->subYears($request->age)->format('Y') : null;
        $ancienneteDate = $request->anciennete ? $date->subYears($request->anciennete)->startOfYear()->format('Y-m-d') : null;
        $ancienneteDate1 = $request->anciennete1 ? $date->subYears($request->anciennete1)->format('Y') : null;
        $retraite = $request->retraite;

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
        if ($request->has('retraite') && !empty($retraite)) {
            $query->where(function ($q) use ($retraite) {
                $q->where(function ($subQ) use ($retraite) {
                    // $subQ->whereIn('grade', ['D', '31', 'B', 'A1', 'A2', 'A3'])
                    $subQ->whereIn('grade', ['43', '31', '46', '44', '45', '33'])
                         ->whereRaw('? - YEAR(date_naissance) >= 60', [$retraite]);
                })
                ->orWhere(function ($subQ) use ($retraite) {
                    // $subQ->whereIn('grade', ['A4', 'A5', 'A6', 'A7'])
                    $subQ->whereIn('grade', ['1', '30', '40', '42'])
                         ->whereRaw('? - YEAR(date_naissance) >= 65', [$retraite]);
                });
            });
        }

        $type = $request->type;
        $officials = $query->where('is_salarie', 2)
                            ->where('statut', $type == 'disable' ? 0 : 1)
                            ->orderBy('nom', 'asc')
                            ->paginate($request->paginator)
                            ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('is_salarie', 2)->where('statut', 1)->count();
        $totalLock = $query->where('is_salarie', 2)->where('statut', 0)->count();

        return view('officials.index', compact('officials', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $official = $this->officialRepository->find($id);

        if (empty($official)) {
            Flash::error('official not found');

            return redirect(getGuardedRoute('officials.index'));
        }

        $official = $this->officialRepository->update(['statut' => !$official->statut], $id);

        Flash::success('official modifié avec succès.');

        return redirect(getGuardedRoute('officials.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new OfficialExport($request), 'Fonctionnaires.xlsx');
    }
}
