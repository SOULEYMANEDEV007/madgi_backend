<?php

namespace App\Http\Controllers;

use App\Exports\AvailableExport;
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

class AvailableController extends AppBaseController
{
    /** @var OfficialRepository $availableRepository*/
    private $availableRepository;

    private $user;

    public function __construct(OfficialRepository $availableRepo)
    {
        $this->availableRepository = $availableRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the official.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $availables = $this->availableRepository->where('is_salarie', 5)->where('statut', 1)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->availableRepository->where('is_salarie', 5)->where('statut', 1)->count();
                $totalLock = $this->availableRepository->where('is_salarie', 5)->where('statut', 0)->count();
            }
            else {
                $availables = $this->availableRepository->where('is_salarie', 5)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->availableRepository->where('is_salarie', 5)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->availableRepository->where('is_salarie', 5)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('availables.index', compact('availables', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $availables = $this->availableRepository->where('is_salarie', 5)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->availableRepository->where('is_salarie', 5)->where('statut', 1)->count();
                $totalLock = $this->availableRepository->where('is_salarie', 5)->where('statut', 0)->count();
            }
            else {
                $availables = $this->availableRepository->where('is_salarie', 5)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->availableRepository->where('is_salarie', 5)->where('department_id', $this->user->user()->depart->id)->where('statut', 1)->count();
                $totalLock = $this->availableRepository->where('is_salarie', 5)->where('department_id', $this->user->user()->depart->id)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('availables.index', compact('availables', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
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

        return view('availables.create', compact('sites', 'departments', 'grades', 'services'));
    }

    /**
     * Store a newly created official in storage.
     */
    public function store(CreateOfficialRequest $request)
    {
        $input = $request->all();

        $input['is_salarie'] = 5;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $available = $this->availableRepository->create($input);

        Flash::success('available saved successfully.');

        return redirect(getGuardedRoute('availables.index'));
    }

    /**
     * Display the specified official.
     */
    public function show($id)
    {
        $available = $this->availableRepository->find($id);

        if (empty($available)) {
            Flash::error('available not found');

            return redirect(getGuardedRoute('availables.index'));
        }

        return view('availables.show')->with('available', $available);
    }

    /**
     * Show the form for editing the specified official.
     */
    public function edit($id)
    {
        $available = $this->availableRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();

        if (empty($available)) {
            Flash::error('available not found');

            return redirect(getGuardedRoute('availables.index'));
        }

        return view('availables.edit', compact('available', 'sites', 'departments', 'services', 'grades'));
    }

    /**
     * Update the specified official in storage.
     */
    public function update($id, UpdateOfficialRequest $request)
    {
        $available = $this->availableRepository->find($id);

        if (empty($available)) {
            Flash::error('available not found');

            return redirect(getGuardedRoute('availables.index'));
        }

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $available = $this->availableRepository->update($request->all(), $id);

        Flash::success('available updated successfully.');

        return redirect(getGuardedRoute('availables.index'));
    }

    /**
     * Remove the specified official from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $available = $this->availableRepository->find($id);

        if (empty($available)) {
            Flash::error('available not found');

            return redirect(getGuardedRoute('availables.index'));
        }

        $this->availableRepository->delete($id);

        Flash::success('available deleted successfully.');

        return redirect(getGuardedRoute('availables.index'));
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
        $availables = $query->where('is_salarie', 5)
                            ->where('statut', $type == 'disable' ? 0 : 1)
                            ->orderBy('nom', 'asc')
                            ->paginate($request->paginator)
                            ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('is_salarie', 5)->where('statut', 1)->count();
        $totalLock = $query->where('is_salarie', 5)->where('statut', 0)->count();

        return view('availables.index', compact('availables', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $available = $this->availableRepository->find($id);

        if (empty($available)) {
            Flash::error('available not found');

            return redirect(getGuardedRoute('availables.index'));
        }

        $available = $this->availableRepository->update(['statut' => !$available->statut], $id);

        Flash::success('available modifié avec succès.');

        return redirect(getGuardedRoute('availables.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new AvailableExport($request), 'Mise en disponibilite.xlsx');
    }
}
