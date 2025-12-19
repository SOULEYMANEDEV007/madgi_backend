<?php

namespace App\Http\Controllers\V2;

use App\Http\Requests\CreateAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Assessment;
use App\Models\FormAssessment;
use App\Models\FormField;
use App\Models\User;
use App\Repositories\AssessmentRepository;
use App\Repositories\FactorRepository;
use App\Repositories\FormFieldRepository;
use Illuminate\Http\Request;
use Flash;

class AssessmentController extends AppBaseController
{
    /** @var AssessmentRepository $assessmentRepository*/
    private $assessmentRepository;

    /** @var FactorRepository $factorRepository*/
    private $factorRepository;

    /** @var FormFieldRepository $formFieldRepository*/
    private $formFieldRepository;

    private $user;

    public function __construct(AssessmentRepository $assessmentRepo, FactorRepository $factorRepo, FormFieldRepository $formFieldRepo)
    {
        $this->assessmentRepository = $assessmentRepo;
        $this->factorRepository = $factorRepo;
        $this->formFieldRepository = $formFieldRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Assessment.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) {
                $factors = $this->factorRepository->where('type', 1)->latest()->paginate(10);
                $total = $this->factorRepository->where('type', 1)->count();
            }
            else {
                $factors = $this->factorRepository->where('type', 1)->where('departement', $this->user->user()->depart->id)->latest()->paginate(10);
                $total = $this->factorRepository->where('type', 1)->where('departement', $this->user->user()->depart->id)->count();
            }
        }

        return view('assessments.index', compact('factors', 'total'));
    }

    /**
     * Show the form for creating a new Assessment.
     */
    public function create()
    {
        $fields = $this->formFieldRepository->all();

        return view('assessments.create')
            ->with('fields', $fields);
    }

    /**
     * Store a newly created Assessment in storage.
     */
    public function store(CreateAssessmentRequest $request)
    {
        $input = $request->all();

        $assessment = $this->assessmentRepository->create($input);

        Flash::success('Assessment enregistré avec succès.');

        return redirect(getGuardedRoute('assessments.index'));
    }

    /**
     * Display the specified Assessment.
     */
    public function show($id)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor not found');

            return redirect(getGuardedRoute('assessments.index'));
        }

        return view('assessments.show')->with('factor', $factor);
    }

    /**
     * Show the form for editing the specified Assessment.
     */
    public function edit($id)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor introuvable');

            return redirect(getGuardedRoute('assessments.index'));
        }

        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $formAssessments = FormAssessment::groupBy('name')->get();
            else $formAssessments = FormAssessment::where('department_id', $this->user->user()->depart->id)->groupBy('name')->get();
        }

        return view('assessments.edit')->with([
            'formAssessments' => $formAssessments,
            'factor' => $factor,
        ]);
    }

    /**
     * Update the specified Assessment in storage.
     */
    public function update($id, UpdateAssessmentRequest $request)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Utilisateur introuvable');

            return redirect(getGuardedRoute('assessments.index'));
        }
        
        $input = $request->all();

        $assessment = $this->assessmentRepository->where('user_id', $id)->latest()->first();
        $save = !empty($assessment) ? $assessment->save + 1 : 1;

        $total = [];
        for ($i = 0; $i < count($input['note']); $i++) {
            $total[] = $input['note'][$i] * $input['coefficient'][$i];
            
            $jsonData = [
                'note' => (int) $input['note'][$i],
                'coefficient' => (int) $input['coefficient'][$i],
                'total' => $total[$i],
                'observation' => $input['observation'][$i],
            ];
            $this->assessmentRepository->create([
                'user_id' => $id,
                'form_assessment_id' => $input['formassessment'][$i],
                'data' => json_encode($jsonData),
                'save' => $save
            ]);
        }

        Flash::success('Assessment mise à jour avec succés.');

        return redirect(getGuardedRoute('assessments.index'));
    }

    /**
     * Remove the specified Assessment from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $assessment = $this->assessmentRepository->find($id);

        if (empty($assessment)) {
            Flash::error('Assessment introuvable');

            return redirect(getGuardedRoute('assessments.index'));
        }

        $this->assessmentRepository->delete($id);

        Flash::success('Assessment supprimé avec succès.');

        return redirect(getGuardedRoute('assessments.index'));
    }

    public function histories(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $factors = User::whereHas('assessments', function($q) {
                                                            $q->whereNotNull('user_id');
                                                        })
                                                        ->where('type', 1)
                                                        ->latest()->paginate(10);
            else $factors = User::whereHas('assessments', function($q) {
                            $q->whereNotNull('user_id');
                        })
                        ->where('type', 1)
                        ->where('departement', $this->user->user()->depart->id)
                        ->latest()->paginate(10);
        }
        else $factors = User::whereHas('assessments', function($q) {
                $q->whereNotNull('user_id');
            })
            ->where('type', 1)
            ->where('user_id', auth()->user()->id)
            ->latest()->paginate(10);

        return view('assessments.history')
            ->with('factors', $factors);
    }

    public function recapitulation($id)
    {
        $factor = $this->factorRepository->find($id);

        if (empty($factor)) {
            Flash::error('Factor introuvable');

            return redirect(getGuardedRoute('assessments.index'));
        }

        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $formAssessments = FormAssessment::groupBy('name')->latest()->get();
            else $formAssessments = FormAssessment::where('departement', $this->user->user()->depart->id)->groupBy('name')->latest()->get();
        }
        else $formAssessments = FormAssessment::where('user_id', auth()->user()->id)->groupBy('name')->latest()->get();

        return view('assessments.recap')->with([
            'formAssessments' => $formAssessments,
            'factor' => $factor,
        ]);
    }
}
