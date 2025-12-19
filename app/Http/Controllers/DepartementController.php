<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Departement;
use App\Repositories\DepartementRepository;
use Illuminate\Http\Request;
use Flash;

class DepartementController extends AppBaseController
{
    /** @var DepartementRepository $departementRepository*/
    private $departementRepository;

    public function __construct(DepartementRepository $departementRepo)
    {
        $this->departementRepository = $departementRepo;
    }

    /**
     * Display a listing of the Departement.
     */
    public function index(Request $request)
    {
        $departements = $this->departementRepository->latest()->paginate(10);

        return view('departements.index')
            ->with('departements', $departements);
    }

    /**
     * Show the form for creating a new Departement.
     */
    public function create()
    {
        return view('departements.create');
    }

    /**
     * Store a newly created Departement in storage.
     */
    public function store(CreateDepartementRequest $request)
    {
        $input = $request->all();

        $departement = $this->departementRepository->create($input);

        Flash::success('Departement saved successfully.');

        return redirect(getGuardedRoute('departements.index'));
    }

    /**
     * Display the specified Departement.
     */
    public function show($id)
    {
        $departement = $this->departementRepository->find($id);

        if (empty($departement)) {
            Flash::error('Departement not found');

            return redirect(getGuardedRoute('departements.index'));
        }

        return view('signatories.index')->with('departement', $departement);
    }

    /**
     * Show the form for editing the specified Departement.
     */
    public function edit($id)
    {
        $departement = $this->departementRepository->find($id);

        if (empty($departement)) {
            Flash::error('Departement not found');

            return redirect(getGuardedRoute('departements.index'));
        }

        return view('departements.edit')->with('departement', $departement);
    }

    /**
     * Update the specified Departement in storage.
     */
    public function update($id, UpdateDepartementRequest $request)
    {
        $departement = $this->departementRepository->find($id);

        if (empty($departement)) {
            Flash::error('Departement not found');

            return redirect(getGuardedRoute('departements.index'));
        }

        $departement = $this->departementRepository->update($request->all(), $id);

        Flash::success('Departement updated successfully.');

        return redirect(getGuardedRoute('departements.index'));
    }

    /**
     * Remove the specified Departement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $departement = $this->departementRepository->find($id);

        if (empty($departement)) {
            Flash::error('Departement not found');

            return redirect(getGuardedRoute('departements.index'));
        }

        $this->departementRepository->delete($id);

        Flash::success('Departement deleted successfully.');

        return redirect(getGuardedRoute('departements.index'));
    }

    public function search(Request $request)
    {
        $departements = Departement::where('name', 'like', '%'.$request->search.'%')
                ->latest()
                ->paginate($request->paginator)
                ->appends($request->all());

        return view('departements.index')
            ->with('departements', $departements);
    }
}
