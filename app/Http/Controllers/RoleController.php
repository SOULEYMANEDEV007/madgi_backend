<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Permission;
use Spatie\Permission\Models\Role as SpatieModelsRole;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Flash;

class RoleController extends AppBaseController
{
    /** @var RoleRepository $roleRepository*/
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     */
    public function index(Request $request)
    {
        $roles = SpatieModelsRole::latest()->paginate(10);

        return view('roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     */
    public function create()
    {
        $permissions = Permission::groupBy('title')->orderBy('id', 'asc')->get();

        return view('roles.create')
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created Role in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = SpatieModelsRole::create(['name' => $input['name']]);
        $role->syncPermissions($input['permissions']);

        Flash::success('Permission ajouté à ce rôle !');

        return redirect(getGuardedRoute('roles.index'));
    }

    /**
     * Display the specified Role.
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(getGuardedRoute('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     */
    public function edit($id)
    {
        $role = SpatieModelsRole::find($id);

        $permissions = Permission::groupBy('title')->orderBy('id', 'asc')->get();

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(getGuardedRoute('roles.index'));
        }

        return view('roles.edit')->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified Role in storage.
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $input = $request->all();

        $role = SpatieModelsRole::find($input['id']);
        $role->update(['name' => $input['name']]);
        $role->syncPermissions($input['permissions']);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(getGuardedRoute('roles.index'));
        }

        Flash::success('Permission modifié !');

        return redirect(getGuardedRoute('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(getGuardedRoute('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role supprimé avec succès.');

        return redirect(getGuardedRoute('roles.index'));
    }
}
