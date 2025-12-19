<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInfosRequest;
use App\Http\Requests\UpdateInfosRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\Infos;
use App\Models\Media;
use App\Repositories\InfosRepository;
use Illuminate\Http\Request;
use Flash;

class InfosController extends AppBaseController
{
    /** @var InfosRepository $infosRepository*/
    private $infosRepository;

    private $user;

    public function __construct(InfosRepository $infosRepo)
    {
        $this->infosRepository = $infosRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Infos.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $infos = $this->infosRepository->latest()->paginate(10);
                $total = $this->infosRepository->count();
            }
            else {
                $infos = $this->infosRepository->where('department_id', $this->user->user()->depart->id)->latest()->paginate(10);
                $total = $this->infosRepository->where('department_id', $this->user->user()->depart->id)->count();
            }
        }
        else {
            $infos = $this->infosRepository->where('department_id', auth()->user()->depart->id)
                                    ->orWhere('department_id', null)
                                    ->latest()->paginate(10);
            $total = $this->infosRepository->where('department_id', auth()->user()->depart->id)
                                    ->orWhere('department_id', null)
                                    ->count();
        }

        $departments = Departement::orderBy('name','ASC')->get();

        return view('infos.index', compact('infos', 'departments', 'total'));
    }

    /**
     * Show the form for creating a new Infos.
     */
    public function create()
    {
        return view('infos.create');
    }

    /**
     * Store a newly created Infos in storage.
     */
    public function store(CreateInfosRequest $request)
    {
        $input = $request->all();

        if(isset($input['department_id']) && $input['department_id'] != 0) {
            if($this->user->check()) {
                if($this->user->user()->role->id == 1) $input['department_id'] = $input['department_id'];
                else $input['department_id'] = $this->user->user()->depart->id;
            }
            else $input['department_id'] = auth()->user()->depart->id;
        }
        else $input['department_id'] = null;

        $infos = $this->infosRepository->create($input);

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $files = $request->file('file');
            $destinationPath = public_path('informations/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Media::updateOrCreate([
                'src' => "/informations/$profileImage",
                'source' => 'info',
                'source_id' => $infos->id
            ]);
        }

        Flash::success('Infos saved successfully.');

        return redirect(getGuardedRoute('infos.index'));
    }

    /**
     * Display the specified Infos.
     */
    public function show($id)
    {
        $infos = $this->infosRepository->find($id);

        if (empty($infos)) {
            Flash::error('Infos not found');

            return redirect(getGuardedRoute('infos.index'));
        }

        return view('infos.show')->with('infos', $infos);
    }

    /**
     * Show the form for editing the specified Infos.
     */
    public function edit($id)
    {
        $infos = $this->infosRepository->find($id);

        if (empty($infos)) {
            Flash::error('Infos not found');

            return redirect(getGuardedRoute('infos.index'));
        }

        return view('infos.edit')->with('infos', $infos);
    }

    /**
     * Update the specified Infos in storage.
     */
    public function update($id, UpdateInfosRequest $request)
    {
        $infos = $this->infosRepository->find($id);

        $input = $request->all();

        if (empty($infos)) {
            Flash::error('Infos not found');

            return redirect(getGuardedRoute('infos.index'));
        }

        if(isset($input['department_id']) && $input['department_id'] != 0) {
            if($this->user->check()) {
                if($this->user->user()->role->id == 1) $input['department_id'] = $input['department_id'];
                else $input['department_id'] = $this->user->user()->depart->id;
            }
            else $input['department_id'] = auth()->user()->depart->id;
        }
        else $input['department_id'] = null;

        $infos = $this->infosRepository->update($input, $id);

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $files = $request->file('file');
            $destinationPath = public_path('informations/');
            $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Media::updateOrCreate([
                'source' => 'info',
                'source_id' => $infos->id
            ],[
                'src' => "/informations/$profileImage",
                'source' => 'info',
                'source_id' => $infos->id
            ]);
        }

        Flash::success('Infos updated successfully.');

        return redirect(getGuardedRoute('infos.index'));
    }

    /**
     * Remove the specified Infos from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $infos = $this->infosRepository->find($id);

        if (empty($infos)) {
            Flash::error('Infos not found');

            return redirect(getGuardedRoute('infos.index'));
        }

        $this->infosRepository->delete($id);

        Flash::success('Infos deleted successfully.');

        return redirect(getGuardedRoute('infos.index'));
    }

    public function toogle($id)
    {
        $info = $this->infosRepository->find($id);

        if (empty($info)) {
            Flash::error('Info not found');

            return redirect(getGuardedRoute('infos.index'));
        }

        $info = $this->infosRepository->update(['status' => !$info->status], $id);

        Flash::success('Info modifié avec succès.');

        return redirect(getGuardedRoute('infos.index'));
    }

    public function search(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $query = Infos::where('post_name', 'like', '%'.$request->search.'%')
                    ->orWhere(function($q) use ($request) {
                        $q->orWhere('post_phone', 'like', '%'.$request->search.'%')
                        ->orWhere('content', 'like', '%'.$request->search.'%');
                    })
                    ->whereRelation('department', 'name', 'like', '%'.$request->search.'%')
                    ->latest();
                $infos = $query->paginate($request->paginator)->appends($request->all());
                $total = $query->count();
            }
            else {
                $query = Infos::where('department_id', $this->user->user()->depart->id)
                        ->where('post_name', 'like', '%'.$request->search.'%')
                        ->orWhere(function($q) use ($request) {
                            $q->orWhere('post_phone', 'like', '%'.$request->search.'%')
                            ->orWhere('content', 'like', '%'.$request->search.'%');
                        })
                        ->whereRelation('department', 'name', 'like', '%'.$request->search.'%')
                        ->latest();
                $infos = $query->paginate($request->paginator)->appends($request->all());
                $total = $query->count();
            }
        }
        else {
            $query = Infos::where('department_id', auth()->user()->depart->id)
                        ->orWhere('department_id', null)
                        ->where('post_name', 'like', '%'.$request->search.'%')
                        ->orWhere(function($q) use ($request) {
                            $q->orWhere('post_phone', 'like', '%'.$request->search.'%')
                            ->orWhere('content', 'like', '%'.$request->search.'%');
                        })
                        ->whereRelation('department', 'name', 'like', '%'.$request->search.'%')
                        ->latest();
                $infos = $query->paginate($request->paginator)->appends($request->all());
                $total = $query->count();
        }

        $departments = Departement::orderBy('name','ASC')->get();

        return view('infos.index')
            ->with([
                'infos' => $infos,
                'departments' => $departments,
                'total' => $total
            ]);
    }
}
