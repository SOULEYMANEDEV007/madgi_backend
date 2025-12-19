<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Grade;
use App\Models\Service;
use App\Models\Site;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends AppBaseController
{
    /** @var EmployeeRepository $employeeRepository*/
    private $employeeRepository;

    private $user;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Employee.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $employees = $this->employeeRepository->where('is_salarie', 1)->orderBy('nom', 'asc')->where('statut', 1)->paginate(10);
                $total = $this->employeeRepository->where('is_salarie', 1)->where('statut', 1)->count();
                $totalLock = $this->employeeRepository->where('is_salarie', 1)->where('statut', 0)->count();
            }
            else {
                $employees = $this->employeeRepository->where('is_salarie', 1)->where('statut', 1)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->employeeRepository->where('is_salarie', 1)->where('statut', 1)->count();
                $totalLock = $this->employeeRepository->where('is_salarie', 0)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'enable';

        return view('employees.index', compact('employees', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function userDisable(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $employees = $this->employeeRepository->where('is_salarie', 1)->where('statut', 0)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->employeeRepository->where('is_salarie', 1)->where('statut', 1)->count();
                $totalLock = $this->employeeRepository->where('is_salarie', 1)->where('statut', 0)->count();
            }
            else {
                $employees = $this->employeeRepository->where('is_salarie', 1)->where('statut', 0)->where('department_id', $this->user->user()->depart->id)->orderBy('nom', 'asc')->paginate(10);
                $total = $this->employeeRepository->where('is_salarie', 1)->where('statut', 1)->count();
                $totalLock = $this->employeeRepository->where('is_salarie', 0)->where('statut', 0)->count();
            }
        }

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $type = 'disable';

        return view('employees.index', compact('employees', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    /**
     * Show the form for creating a new Employee.
     */
    public function create()
    {
        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();

        return view('employees.create', compact('sites', 'departments', 'grades', 'services'));
    }

    /**
     * Store a newly created Employee in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();

        $input['is_salarie'] = 1;
        $input['mat_without_space'] = str_replace(' ', '', $input['matricule']);
        $input['password'] = Hash::make('password');

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $employee = $this->employeeRepository->create($input);

        Flash::success('Employee saved successfully.');

        return redirect(getGuardedRoute('employees.index'));
    }

    /**
     * Display the specified Employee.
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(getGuardedRoute('employees.index'));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();
        $departments = Departement::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $services = Service::orderBy('name','ASC')->get();

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(getGuardedRoute('employees.index'));
        }

        return view('employees.edit', compact('employee', 'sites', 'departments', 'grades', 'services'));
    }

    /**
     * Update the specified Employee in storage.
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(getGuardedRoute('employees.index'));
        }

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $employee = $this->employeeRepository->update($request->all(), $id);

        Flash::success('Employee updated successfully.');

        return redirect(getGuardedRoute('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(getGuardedRoute('employees.index'));
        }

        $this->employeeRepository->delete($id);

        Flash::success('Employee deleted successfully.');

        return redirect(getGuardedRoute('employees.index'));
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
        if ($request->has('retraite') && $retraite != '') $query->whereRaw('( ? - YEAR(date_naissance)) >= ?', [$retraite, 60]);
        $type = $request->type;
        $employees = $query->where('is_salarie', 1)
                        ->where('statut', $type == 'disable' ? 0 : 1)
                        ->orderBy('nom', 'asc')
                        ->paginate($request->paginator)
                        ->appends($request->all());

        $services = Service::orderBy('name','ASC')->get();
        $grades = Grade::orderBy('name','ASC')->get();
        $sites = Site::orderBy('name','ASC')->get();
        $departements = Departement::orderBy('name','ASC')->get();
        $total = $query->where('is_salarie', 1)->where('statut', 1)->count();
        $totalLock = $query->where('is_salarie', 1)->where('statut', 0)->count();

        return view('employees.index', compact('employees', 'sites','services','departements','grades', 'total', 'totalLock', 'type'));
    }

    public function toogle($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('employee not found');

            return redirect(getGuardedRoute('employees.index'));
        }

        $employee = $this->employeeRepository->update(['statut' => !$employee->statut], $id);

        Flash::success('employee modifié avec succès.');

        return redirect(getGuardedRoute('employees.index'));
    }

    public function export(Request $request)
    {
        return Excel::download(new EmployeeExport($request), 'Employes.xlsx');
    }
}
