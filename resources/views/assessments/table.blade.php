<div class="card">
    {{-- En-tête de la carte avec titre et bouton --}}
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h3 class="card-title">Liste des Évaluations</h3>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ getGuardedRoute('assessments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nouvelle Évaluation
                </a>
            </div>
        </div>
    </div>

    {{-- Barre de recherche et filtres --}}
    <div class="card-body border-bottom">
        <form action="{{ getGuardedRoute('assessments.index') }}" method="GET" class="row g-3 align-items-end">
            {{-- 🔤 Recherche texte --}}
            <div class="col-md-3">
                <label for="search" class="form-label">Recherche</label>
                <input type="text" 
                    class="form-control" 
                    id="search" 
                    name="search" 
                    placeholder="Nom, matricule, fonction..." 
                    value="{{ request('search') }}">
            </div>

            {{-- 🏢 Filtre par département --}}
            <div class="col-md-2">
                <label for="departement" class="form-label">Département</label>
                <select class="form-select" id="departement" name="departement">
                    <option value="">Tous</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" 
                            {{ request('departement') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 👤 Filtre par évaluateur --}}
            <div class="col-md-2">
                <label for="evaluator" class="form-label">Évaluateur</label>
                <select class="form-select" id="evaluator" name="evaluator">
                    <option value="">Tous</option>
                    @foreach($evaluators as $id => $name)
                        <option value="{{ $id }}" 
                            {{ request('evaluator') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ⭐ Filtre par statut --}}
            <div class="col-md-2">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Tous</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Actif</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>

            {{-- 📅 Date de début --}}
            <div class="col-md-2">
                <label for="date_from" class="form-label">Date début</label>
                <input type="date" 
                    class="form-control" 
                    id="date_from" 
                    name="date_from" 
                    value="{{ request('date_from') }}">
            </div>

            {{-- 📅 Date de fin --}}
            <div class="col-md-2">
                <label for="date_to" class="form-label">Date fin</label>
                <input type="date" 
                    class="form-control" 
                    id="date_to" 
                    name="date_to" 
                    value="{{ request('date_to') }}">
            </div>

            {{-- Boutons d'action --}}
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Filtrer
                    </button>
                    <a href="{{ getGuardedRoute('assessments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Réinitialiser
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Résultats de la recherche --}}
    @if(request()->hasAny(['search', 'departement', 'evaluator', 'status', 'date_from', 'date_to']))
    <div class="card-body bg-light border-bottom">
        <div class="alert alert-info mb-0 py-2">
            <i class="fas fa-info-circle me-2"></i>
            <strong>{{ $factors->total() }}</strong> résultat(s) trouvé(s) pour votre recherche
            @if(request('search'))
                - Mot-clé: "{{ request('search') }}"
            @endif
        </div>
    </div>
    @endif

    {{-- Contenu principal --}}
    <div class="card-body">
        <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="assessments-table">
                <thead>
                    <tr>
                        <th class="text-sm">#</th>
                        <th class="text-sm">Photo</th>
                        <th class="text-sm">Nom et Prénom(s)</th>
                        <th class="text-sm">Matricule</th>
                        <th class="text-sm">Fonction</th>
                        <th class="text-sm">CNPS</th>
                        <th class="text-sm">Grade</th>
                        <th class="text-sm">Situation matrimoniale</th>
                        <th class="text-sm">Statut</th>
                        <th class="text-sm" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($factors as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" 
                                     width="30" 
                                     height="30" 
                                     style="cursor: pointer" 
                                     data-toggle="modal" 
                                     data-target="#model-{{ $key }}"
                                     alt="Photo de {{ $item->nom }}">

                                {{-- Modal pour agrandir la photo --}}
                                <div class="modal fade" id="model-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modelTitle-{{ $key }}">Photo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{$item->photo != null ? $item->photo : asset('/images/user.png')}}" 
                                                     width="200" 
                                                     height="200" 
                                                     class="img-fluid rounded"
                                                     alt="Photo de {{ $item->nom }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->nom}}</span>
                            </td>
                            <td>
                                <span class="btn btn-light btn-sm">{{$item->matricule}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->fonction}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->cnps}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->grade}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->situation_matrim}}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{$item->statut_mad}}</span>
                            </td>
                            <td style="width: 120px">
                                <div class='btn-group'>
                                    @can(App\Models\Permission::ASSESSMENT['READ'])
                                        <a href="{{ getGuardedRoute('assessments.show', [$item->id]) }}"
                                        class='btn btn-primary btn-sm'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can(App\Models\Permission::ASSESSMENT['UPDATE'])
                                        <a href="{{ getGuardedRoute('assessments.edit', [$item->id]) }}"  
                                           class='btn btn-warning btn-sm'>
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer clearfix">
            <div class="float-right">
                @include('adminlte-templates::common.paginate', ['records' => $factors])
            </div>
        </div>
    </div>
</div>