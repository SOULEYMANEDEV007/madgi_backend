<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFactorRequest;
use App\Http\Requests\UpdateFactorRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Site;
use App\Models\User;
use App\Repositories\FactorRepository;
use Illuminate\Http\Request;
use Flash;

class FactorController extends AppBaseController
{
    /** @var FactorRepository $factorRepository*/
    private $factorRepository;

    private $user;

    public function __construct(FactorRepository $factorRepo)
    {
        $this->factorRepository = $factorRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Factor.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $factors = $this->factorRepository/*->where('type', null)*/->latest()->paginate(10);
            else $factors = $this->factorRepository/*->where('type', null)*/->where('department_id', $this->user->user()->depart->id)->latest()->paginate(10);
        }

        return view('factors.index')
            ->with('factors', $factors);
    }

    /**
     * Show the form for creating a new Factor.
     */
    public function create()
    {
        $sites = Site::orderBy('name','ASC')->get();

        return view('factors.create', compact('sites'));
    }

    /**
     * Store a newly created Factor in storage.
     */
    public function store(CreateFactorRequest $request)
    {
        $input = $request->all();

        $input['slug'] = uniqid();

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $factor = $this->factorRepository->create($input);

        Flash::success('Factor saved successfully.');

        return redirect(getGuardedRoute('factors.index'));
    }

    /**
     * Display the specified Factor.
     */
    public function show($id)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor not found');

            return redirect(getGuardedRoute('factors.index'));
        }

        return view('factors.show')->with('factor', $factor);
    }

    /**
     * Show the form for editing the specified Factor.
     */
    public function edit($id)
    {
        $factor = $this->factorRepository->find($id);

        $sites = Site::orderBy('name','ASC')->get();

        if (empty($factor)) {
            Flash::error('Factor not found');

            return redirect(getGuardedRoute('factors.index'));
        }

        return view('factors.edit', compact('factor', 'sites'));
    }

    /**
     * Update the specified Factor in storage.
     */
    public function update($id, UpdateFactorRequest $request)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor not found');

            return redirect(getGuardedRoute('factors.index'));
        }

        $input = $request->all();

        if(isset($_FILES['pictures']['name']) && $_FILES['pictures']['name'] != '') {
            $files = $request->file('pictures');
            $destinationPath = public_path('images/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['photo'] = "/images/$profileImage";
        }

        $factor = $this->factorRepository->update($input, $id);

        Flash::success('Factor updated successfully.');

        return redirect(getGuardedRoute('factors.index'));
    }

    /**
     * Remove the specified Factor from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor not found');

            return redirect(getGuardedRoute('factors.index'));
        }

        $this->factorRepository->delete($id);

        Flash::success('Factor deleted successfully.');

        return redirect(getGuardedRoute('factors.index'));
    }

    public function search(Request $request)
    {
        $factors = User::where('nom', 'like', '%'.$request->search.'%')
                ->orWhere(function($q) use ($request) {
                    $q->orWhere('matricule', 'like', '%'.$request->search.'%')
                    ->orWhere('fonction', 'like', '%'.$request->search.'%')
                    ->orWhere('cnps', 'like', '%'.$request->search.'%')
                    ->orWhere('situation_matrim', 'like', '%'.$request->search.'%');
                })
                ->whereRelation('grad', 'name', 'like', '%'.$request->search.'%')
                ->latest()
                ->paginate($request->paginator)
                ->appends($request->all());

        return view('factors.index')
            ->with('factors', $factors);
    }
}
