<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUnlockRequest;
use App\Http\Requests\UpdateUnlockRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UnlockRepository;
use Illuminate\Http\Request;
use Flash;

class UnlockController extends AppBaseController
{
    /** @var UnlockRepository $unlockRepository*/
    private $unlockRepository;

    public function __construct(UnlockRepository $unlockRepo)
    {
        $this->unlockRepository = $unlockRepo;
    }

    /**
     * Display a listing of the Unlock.
     */
    public function index(Request $request)
    {
        $unlocks = $this->unlockRepository->where('statut', 0)->latest()->paginate(10);

        return view('unlocks.index')
            ->with('unlocks', $unlocks);
    }

    /**
     * Show the form for creating a new Unlock.
     */
    public function create()
    {
        return view('unlocks.create');
    }

    /**
     * Store a newly created Unlock in storage.
     */
    public function store(CreateUnlockRequest $request)
    {
        $input = $request->all();

        $unlock = $this->unlockRepository->create($input);

        Flash::success('Unlock saved successfully.');

        return redirect(getGuardedRoute('unlocks.index'));
    }

    /**
     * Display the specified Unlock.
     */
    public function show($id)
    {
        $unlock = $this->unlockRepository->find($id);

        if (empty($unlock)) {
            Flash::error('Unlock not found');

            return redirect(getGuardedRoute('unlocks.index'));
        }

        return view('unlocks.show')->with('unlock', $unlock);
    }

    /**
     * Show the form for editing the specified Unlock.
     */
    public function edit($id)
    {
        $unlock = $this->unlockRepository->find($id);

        if (empty($unlock)) {
            Flash::error('Unlock not found');

            return redirect(getGuardedRoute('unlocks.index'));
        }

        return view('unlocks.edit')->with('unlock', $unlock);
    }

    /**
     * Update the specified Unlock in storage.
     */
    public function update($id, UpdateUnlockRequest $request)
    {
        $input = $request->all();

        $unlock = $this->unlockRepository->find($id);

        if (empty($unlock)) {
            Flash::error('Unlock not found');

            return redirect(getGuardedRoute('unlocks.index'));
        }

        if($input['unlocks'] == "DEBLOQUE") {
            $input['statut'] = 1;
            $input['lock_date'] = null;
            $input['type_device'] = null;
        }
        else $input['statut'] = 0;

        $unlock = $this->unlockRepository->update($input, $id);

        Flash::success('Unlock updated successfully.');

        return redirect(getGuardedRoute('unlocks.index'));
    }

    /**
     * Remove the specified Unlock from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unlock = $this->unlockRepository->find($id);

        if (empty($unlock)) {
            Flash::error('Unlock not found');

            return redirect(getGuardedRoute('unlocks.index'));
        }

        $this->unlockRepository->delete($id);

        Flash::success('Unlock deleted successfully.');

        return redirect(getGuardedRoute('unlocks.index'));
    }
}
