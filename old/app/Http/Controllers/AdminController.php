<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Role;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;

class AdminController extends AppBaseController
{
    /** @var AdminRepository $adminRepository*/
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the Admin.
     */
    public function index(Request $request)
    {
        $admins = $this->adminRepository->latest()->paginate(10);
        $roles = Role::all();
        $departments = Departement::all();

        return view('admins.index')
            ->with([
                'admins' => $admins,
                'roles' => $roles,
                'departments' => $departments,
            ]);
    }

    /**
     * Show the form for creating a new Admin.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created Admin in storage.
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();

        $role = Role::find($input['role_id']);
        $input['password'] = Hash::make($input['password']);
        $admin = $this->adminRepository->create($input);
        $admin->assignRole($role->id);

        Flash::success('Admin crée avec succès.');

        return redirect(getGuardedRoute('admins.index'));
    }

    /**
     * Display the specified Admin.
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(getGuardedRoute('admins.index'));
        }

        return view('admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified Admin.
     */
    public function edit($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(getGuardedRoute('admins.index'));
        }

        return view('admins.edit')->with('admin', $admin);
    }

    /**
     * Update the specified Admin in storage.
     */
    public function update($id, UpdateAdminRequest $request)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(getGuardedRoute('admins.index'));
        }

        $input = $request->all();
        $role = Role::find($input['role_id']);
        if(!empty($input['password'])) $input['password'] = Hash::make($input['password']);
        else $input['password'] = $admin->password;
        $admin = $this->adminRepository->update($input, $id);
        $admin->assignRole($role->id);

        Flash::success('Admin modifié avec succès.');

        return redirect(getGuardedRoute('admins.index'));
    }

    /**
     * Remove the specified Admin from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(getGuardedRoute('admins.index'));
        }

        $this->adminRepository->delete($id);

        Flash::success('Admin supprimé avec succès.');

        return redirect(getGuardedRoute('admins.index'));
    }

    public function search(Request $request)
    {
        $admins = Admin::where('name', 'like', '%'.$request->search.'%')
                    ->orWhere(function($q) use ($request) {
                        $q->orWhere('email', 'like', '%'.$request->search.'%');
                    })
                    ->whereRelation('role', 'name', 'like', '%'.$request->search.'%')
                    ->latest()
                    ->paginate($request->paginator)
                    ->appends($request->all());

        $roles = Role::all();
        $departments = Departement::all();

        return view('admins.index')
            ->with([
                'admins' => $admins,
                'roles' => $roles,
                'departments' => $departments,
            ]);
    }
}
