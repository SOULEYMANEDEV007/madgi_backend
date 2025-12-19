<?php

namespace App\Http\Controllers;

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
    // Construction de la requête de base
    $query = $this->factorRepository->where('type', 1);
    
    // Application des permissions par département
    if($this->user->check() && $this->user->user()->depart) {
        if($this->user->user()->role->id != 1) {
            $query->where('departement', $this->user->user()->depart->id);
        }
    }

    // 🔤 RECHERCHE TEXTE - Adaptée à vos colonnes
    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('nom', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('matricule', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('fonction', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('cnps', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('grade', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('situation_matrim', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('statut', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    // 🏢 FILTRE DÉPARTEMENT
    if ($request->has('departement') && !empty($request->departement)) {
        $query->where('departement', $request->departement);
    }

    // 📅 FILTRES DATE
    if ($request->has('date_from') && !empty($request->date_from)) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }
    if ($request->has('date_to') && !empty($request->date_to)) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    // ⭐ FILTRE STATUT - Utilisez le bon champ
    if ($request->has('status') && $request->status !== '') {
        // Utilisez 'statut' si c'est le champ dans votre table
        $query->where('statut', $request->status);
    }

    $factors = $query->latest()->paginate(10);
    $total = $query->count();

    // Récupération des données pour les filtres
    $departments = $this->getDepartmentsForFilter();
    $evaluators = $this->getEvaluatorsForFilter();

    return view('assessments.index', compact('factors', 'total', 'departments', 'evaluators'));
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
        // Construction de la requête pour l'historique
        $query = User::whereHas('assessments', function($q) {
            $q->whereNotNull('user_id');
        })->where('type', 1);

        // Application des permissions
        if($this->user->check()) {
            if($this->user->user()->role->id != 1) {
                $query->where('departement', $this->user->user()->depart->id);
            }
        } else {
            $query->where('user_id', auth()->user()->id);
        }

        // 🔤 Recherche texte dans l'historique
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // 🏢 Filtre par département dans l'historique
        if ($request->has('departement') && !empty($request->departement)) {
            $query->where('departement', $request->departement);
        }

        // 📅 Filtre par date dans l'historique
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereHas('assessments', function($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->date_from);
            });
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereHas('assessments', function($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->date_to);
            });
        }

        $factors = $query->latest()->paginate(10);

        // Récupération des données pour les filtres
        $departments = $this->getDepartmentsForFilter();

        return view('assessments.history')
            ->with('factors', $factors)
            ->with('departments', $departments);
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

    /**
 * Méthodes utilitaires pour les filtres
 */

private function getDepartmentsForFilter()
{
    // Vérification si l'utilisateur est connecté et a un département
    if ($this->user->check() && $this->user->user()->depart) {
        // Si l'utilisateur n'est pas admin, retourne seulement son département
        if ($this->user->user()->role->id != 1) {
            return \App\Models\Departement::where('id', $this->user->user()->depart->id)->get();
        }
    }
    
    // Si admin ou pas de département spécifique, retourne tous les départements
    return \App\Models\Departement::all();
}

private function getEvaluatorsForFilter()
{
    // Récupère les utilisateurs qui ont créé des évaluations
    // Supposons que vous avez une relation 'assessmentsCreated' ou similaire
    $query = User::whereHas('assessments', function($query) {
        $query->whereNotNull('id');
    });

    // Filtrage par département si l'utilisateur n'est pas admin
    if ($this->user->check() && $this->user->user()->role->id != 1 && $this->user->user()->depart) {
        $query->where('departement', $this->user->user()->depart->id);
    }

    return $query->get()->pluck('name', 'id');
}

/**
 * Méthode de recherche avancée
 */
public function search(Request $request)
{
    // Redirige vers index avec les paramètres de recherche
    return $this->index($request);
}
}