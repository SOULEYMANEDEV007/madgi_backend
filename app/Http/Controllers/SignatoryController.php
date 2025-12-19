<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSignatoryRequest;
use App\Http\Requests\UpdateSignatoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Repositories\SignatoryRepository;
use Illuminate\Http\Request;
use Flash;

class SignatoryController extends AppBaseController
{
    /** @var SignatoryRepository $signatoryRepository*/
    private $signatoryRepository;

    private $user;

    public function __construct(SignatoryRepository $signatoryRepo)
    {
        $this->signatoryRepository = $signatoryRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Signatory.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $signatories = $this->signatoryRepository->paginate(10);
            else $signatories = $this->signatoryRepository->where('department_id', $this->user->user()->depart->id)->paginate(10);
        }

        return view('signatories.index')
            ->with('signatories', $signatories);
    }

    /**
     * Show the form for creating a new Signatory.
     */
    public function create()
    {
        return view('signatories.create');
    }

    /**
     * Store a newly created Signatory in storage.
     */
    public function store(CreateSignatoryRequest $request)
    {
        $input = $request->all();

        $input['department_id'] = $request->department_id;

        $signatory = $this->signatoryRepository->updateOrCreate(['name' => $input['name'], 'department_id' => $input['department_id']]);

        Flash::success('Signatory saved successfully.');

        return redirect(getGuardedRoute('departements.show', [$input['department_id']]));
    }

    /**
     * Display the specified Signatory.
     */
    public function show($id)
    {
        $signatory = $this->signatoryRepository->find($id);

        if (empty($signatory)) {
            Flash::error('Signatory not found');

            return redirect(getGuardedRoute('signatories.index'));
        }

        return view('signatories.show')->with('signatory', $signatory);
    }

    /**
     * Show the form for editing the specified Signatory.
     */
    public function edit($id)
    {
        $signatory = $this->signatoryRepository->find($id);

        if (empty($signatory)) {
            Flash::error('Signatory not found');

            return redirect(getGuardedRoute('signatories.index'));
        }

        return view('signatories.edit')->with('signatory', $signatory);
    }

    /**
     * Update the specified Signatory in storage.
     */
    public function update($id, UpdateSignatoryRequest $request)
    {
        $signatory = $this->signatoryRepository->find($id);

        if (empty($signatory)) {
            Flash::error('Signatory not found');

            return redirect(getGuardedRoute('signatories.index'));
        }

        $signatory = $this->signatoryRepository->update($request->all(), $id);

        Flash::success('Signatory updated successfully.');

        return redirect(getGuardedRoute('departements.show', [$signatory->depart->id]));
    }

    /**
     * Remove the specified Signatory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $signatory = $this->signatoryRepository->find($id);

        if (empty($signatory)) {
            Flash::error('Signatory not found');

            return redirect(getGuardedRoute('signatories.index'));
        }

        $this->signatoryRepository->delete($id);

        Flash::success('Signatory deleted successfully.');

        return redirect(getGuardedRoute('departements.show', [$signatory->depart->id]));
    }
}
