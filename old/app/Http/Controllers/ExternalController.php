<?php

namespace App\Http\Controllers;

use App\Exports\ExternalExport;
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

class ExternalController extends AppBaseController
{
    /** @var OfficialRepository $externalRepository*/
    private $externalRepository;

    private $user;

    public function __construct(OfficialRepository $externalRepo)
    {
        $this->externalRepository = $externalRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the official.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $externals = $this->externalRepository->where('is_salarie', 3)->where('statut', 1)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->externalRepository->where('is_salarie', 3)->where('statut', 1)->count();
                $totalLock = $this->externalRepository->where('is_salarie', 3)->where('statut', 0)->count();
            }
            else {
                $externals = $this->externalRepository->where('is_salarie', 3)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->externalRepository->where('is_salarie', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->externalRepository->where('is_salarie', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('externals.index', compact('externals', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $externals = $this->externalRepository->where('is_salarie', 3)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->externalRepository->where('is_salarie', 3)->where('statut', 1)->count();
                $totalLock = $this->externalRepository->where('is_salarie', 3)->where('statut', 0)->count();
            }
            else {
                $externals = $this->externalRepository->where('is_salarie', 3)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->externalRepository->where('is_salarie', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->externalRepository->where('is_salarie', 3)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('externals.index', compact('externals', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
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

        return view('externals.create', compact('sites', 'departments', 'grades', 'services'));
    }

    /**
     * Store a newly created official in storage.
     */
    public function store(CreateOfficialRequest $request)
    {
        $input = $request->all();

        $input['is_salarie'] = 3;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $external = $this->externalRepository->create($input);

        Flash::success('external saved successfully.');

        return redirect(getGuardedRoute('externals.index'));
    }

    /**
     * Display the specified official.
     */
    public function show($id)
    {
        $external = $this->externalRepository->find($id);

        if (empty($external)) {
            Flash::error('external not found');

            return redirect(getGuardedRoute('externals.index'));
        }

        return view('externals.show')->with('external', $external);
    }

    /**
     * Show the form for editing the specified official.
     */
    public function edit($id)
    {
        $external = $this->externalRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();

        if (empty($external)) {
            Flash::error('external not found');

            return redirect(getGuardedRoute('externals.index'));
        }

        return view('externals.edit', compact('external', 'sites', 'departments', 'grades', 'services'));
    }

    /**
     * Update the specified official in storage.
     */
    public function update($id, UpdateOfficialRequest $request)
    {
        $external = $this->externalRepository->find($id);

        if (empty($external)) {
            Flash::error('external not found');

            return redirect(getGuardedRoute('externals.index'));
        }

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $external = $this->externalRepository->update($request->all(), $id);

        Flash::success('external updated successfully.');

        return redirect(getGuardedRoute('externals.index'));
    }

    /**
     * Remove the specified official from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $external = $this->externalRepository->find($id);

        if (empty($external)) {
            Flash::error('external not found');

            return redirect(getGuardedRoute('externals.index'));
        }

        $this->externalRepository->delete($id);

        Flash::success('external deleted successfully.');

        return redirect(getGuardedRoute('externals.index'));
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
        $externals = $query->where('is_salarie', 3)
                            ->where('statut', $type == 'disable' ? 0 : 1)
                            ->orderBy('nom', 'asc')
                            ->paginate($request->paginator)
                            ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('is_salarie', 3)->where('statut', 1)->count();
        $totalLock = $query->where('is_salarie', 3)->where('statut', 0)->count();

        return view('externals.index', compact('externals', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $external = $this->externalRepository->find($id);

        if (empty($external)) {
            Flash::error('external not found');

            return redirect(getGuardedRoute('externals.index'));
        }

        $external = $this->externalRepository->update(['statut' => !$external->statut], $id);

        Flash::success('external modifié avec succès.');

        return redirect(getGuardedRoute('externals.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new ExternalExport($request), 'Collaborateur-externes.xlsx');
    }
}
