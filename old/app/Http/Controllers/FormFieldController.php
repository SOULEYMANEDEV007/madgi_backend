<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormFieldRequest;
use App\Http\Requests\UpdateFormFieldRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Departement;
use App\Models\FormField;
use App\Repositories\FormAssessmentRepository;
use App\Repositories\FormFieldRepository;
use Illuminate\Http\Request;
use Flash;

class FormFieldController extends AppBaseController
{
    /** @var FormFieldRepository $formFieldRepository*/
    private $formFieldRepository;

    /** @var FormAssessmentRepository $assessmentRepository*/
    private $formAssessmentRepository;

    private $user;

    public function __construct(FormFieldRepository $formFieldRepo, FormAssessmentRepository $formAssessmentRepo)
    {
        $this->formFieldRepository = $formFieldRepo;
        $this->formAssessmentRepository = $formAssessmentRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the FormField.
     */
    public function index(Request $request)
    {
        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $formFields = FormField::with('formassessment')->paginate(10);
            else $formFields = FormField::whereRelation('formassessment', 'department_id', $this->user->user()->depart->id)->paginate(10);
        }
        else $formFields = FormField::whereRelation('formassessment', 'department_id', auth()->user()->depart->id)->paginate(10);

        $formFields = FormField::with('formassessment')->paginate(10);
        $groupedFields = $formFields->groupBy(function($item) {
            return $item->formassessment->name;
        });

        return view('form_fields.index')
            ->with([
                'formFields' => $formFields,
                'groupedFields' => $groupedFields,
            ]);
    }

    /**
     * Show the form for creating a new FormField.
     */
    public function create()
    {
        $formFields = $this->formFieldRepository->all();
        $departments = Departement::orderBy('name','ASC')->get();

        return view('form_fields.create')->with([
            'formFields' => $formFields,
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created FormField in storage.
     */
    public function store(CreateFormFieldRequest $request)
    {
        $input = $request->all();

        if($this->user->check()) {
            if($this->user->user()->role->id == 1) $input['department_id'] = $input['department_id'];
            else $input['department_id'] = $this->user->user()->depart->id;
        }
        else $input['department_id'] = auth()->user()->depart->id;
        
        $assessment = $this->formAssessmentRepository->create($input);

        foreach ($input['fields'] as $field) {
            $field['form_assessment_id'] = $assessment->id;
            $field['label'] = ucfirst($field['label']);
            $this->formFieldRepository->create($field);
        }

        Flash::success('Form Field enregistré avec succès.');

        return redirect(getGuardedRoute('form-fields.index'));
    }

    /**
     * Display the specified FormField.
     */
    public function show($id)
    {
        $formField = $this->formFieldRepository->find($id);

        if (empty($formField)) {
            Flash::error('Form Field introuvable');

            return redirect(getGuardedRoute('form-fields.index'));
        }

        return view('form_fields.show')->with('formField', $formField);
    }

    /**
     * Show the form for editing the specified FormField.
     */
    public function edit($id)
    {
        $formField = $this->formFieldRepository->find($id);

        if (empty($formField)) {
            Flash::error('Form Field introuvable');

            return redirect(getGuardedRoute('form-fields.index'));
        }

        $departments = Departement::orderBy('name','ASC')->get();

        return view('form_fields.edit')->with([
            'formField' => $formField,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified FormField in storage.
     */
    public function update($id, UpdateFormFieldRequest $request)
    {
        $formField = $this->formFieldRepository->find($id);

        $input = $request->all();

        if (empty($formField)) {
            Flash::error('Form Field introuvable');

            return redirect(getGuardedRoute('form-fields.index'));
        }

        foreach ($input['fields'] as $field) {
            $field['label'] = ucfirst($field['label']);
            $this->formFieldRepository->update($field, $id);
        }

        Flash::success('Form Field mise à jour avec succés.');

        return redirect(getGuardedRoute('form-fields.index'));
    }

    /**
     * Remove the specified FormField from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $formField = $this->formFieldRepository->find($id);

        if (empty($formField)) {
            Flash::error('Form Field introuvable');

            return redirect(getGuardedRoute('form-fields.index'));
        }

        $this->formFieldRepository->delete($id);

        Flash::success('Form Field supprimé avec succès.');

        return redirect(getGuardedRoute('form-fields.index'));
    }
}
