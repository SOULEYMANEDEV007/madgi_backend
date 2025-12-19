<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImportPersonalRequest;
use App\Http\Requests\UpdateImportPersonalRequest;
use App\Http\Controllers\AppBaseController;
use App\Imports\PersonnelImport;
use App\Models\User;
use App\Repositories\ImportPersonalRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Flash;

class ImportPersonalController extends AppBaseController
{
    /** @var ImportPersonalRepository $importPersonalRepository*/
    private $importPersonalRepository;

    public function __construct(ImportPersonalRepository $importPersonalRepo)
    {
        $this->importPersonalRepository = $importPersonalRepo;
    }

    /**
     * Display a listing of the ImportPersonal.
     */
    public function index(Request $request)
    {
        $importPersonals = $this->importPersonalRepository->latest()->paginate(10);

        return view('import_personals.index')
            ->with('importPersonals', $importPersonals);
    }

    /**
     * Show the form for creating a new ImportPersonal.
     */
    public function create()
    {
        return view('import_personals.create');
    }

    /**
     * Store a newly created ImportPersonal in storage.
     */
    public function store(CreateImportPersonalRequest $request)
    {
        $input = $request->all();

        User::truncate();

        Excel::import(new PersonnelImport, $input['file']);

        Flash::success('Import Personal saved successfully.');

        return redirect(getGuardedRoute('import-personals.index'));
    }

    /**
     * Display the specified ImportPersonal.
     */
    public function show($id)
    {
        $importPersonal = $this->importPersonalRepository->find($id);

        if (empty($importPersonal)) {
            Flash::error('Import Personal not found');

            return redirect(getGuardedRoute('import-personals.index'));
        }

        return view('import_personals.show')->with('importPersonal', $importPersonal);
    }

    /**
     * Show the form for editing the specified ImportPersonal.
     */
    public function edit($id)
    {
        $importPersonal = $this->importPersonalRepository->find($id);

        if (empty($importPersonal)) {
            Flash::error('Import Personal not found');

            return redirect(getGuardedRoute('import-personals.index'));
        }

        return view('import_personals.edit')->with('importPersonal', $importPersonal);
    }

    /**
     * Update the specified ImportPersonal in storage.
     */
    public function update($id, UpdateImportPersonalRequest $request)
    {
        $importPersonal = $this->importPersonalRepository->find($id);

        if (empty($importPersonal)) {
            Flash::error('Import Personal not found');

            return redirect(getGuardedRoute('import-personals.index'));
        }

        $importPersonal = $this->importPersonalRepository->update($request->all(), $id);

        Flash::success('Import Personal updated successfully.');

        return redirect(getGuardedRoute('import-personals.index'));
    }

    /**
     * Remove the specified ImportPersonal from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $importPersonal = $this->importPersonalRepository->find($id);

        if (empty($importPersonal)) {
            Flash::error('Import Personal not found');

            return redirect(getGuardedRoute('import-personals.index'));
        }

        $this->importPersonalRepository->delete($id);

        Flash::success('Import Personal deleted successfully.');

        return redirect(getGuardedRoute('import-personals.index'));
    }
}
