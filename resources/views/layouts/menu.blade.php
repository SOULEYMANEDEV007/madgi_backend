<li class="nav-item">
    <a href="{{ getGuardedRoute('home') }}" class="nav-link {{ Route::is('admin.home') || Route::is('user.home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tableau de bord</p>
    </a>
</li>

@php
    $user = Auth::guard(\App\Models\Admin::$guard);
@endphp

@if ($user->check())
    @if(auth()->user()->can(\App\Models\Permission::WORKER['READ']) || auth()->user()->can(\App\Models\Permission::INTERN['READ']) || auth()->user()->can(\App\Models\Permission::TEMPORARYWORKER['READ']) || auth()->user()->can(\App\Models\Permission::EMPLOYEE['READ']) || auth()->user()->can(\App\Models\Permission::OFFICIAL['READ']) || auth()->user()->can(\App\Models\Permission::EXTERNAL['READ']) || auth()->user()->can(\App\Models\Permission::FIXED['READ']) || auth()->user()->can(\App\Models\Permission::AVAILABLE['READ']))
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('admin.workers*') || Route::is('admin.interns*') || Route::is('admin.temporary-workers*') || Route::is('admin.employees*') || Route::is('admin.officials*') || Route::is('admin.externals*') || Route::is('admin.fixed*') || Route::is('admin.availables*') || Route::is('admin.retirements*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Personnels
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can(App\Models\Permission::WORKER['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('workers.index') }}" class="nav-link {{ Route::is('admin.workers*') && !Route::is('admin.workers.stats*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Personnel MADGI</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::EMPLOYEE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('employees.index') }}" class="nav-link {{ Route::is('admin.employees*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Salariés</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::OFFICIAL['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('officials.index') }}" class="nav-link {{ Route::is('admin.officials*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fonctionnaires</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::EXTERNAL['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('externals.index') }}" class="nav-link {{ Route::is('admin.externals*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Collabo. extérieur</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::FIXED['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('fixed.index') }}" class="nav-link {{ Route::is('admin.fixed*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>CDD</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::AVAILABLE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('availables.index') }}" class="nav-link {{ Route::is('admin.availables*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mise en disponibilité</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::AVAILABLE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('retirements.index') }}" class="nav-link {{ Route::is('admin.retirements*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Retraités</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::INTERN['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('interns.index') }}" class="nav-link {{ Route::is('admin.interns*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stagiaires</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::TEMPORARYWORKER['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('temporary-workers.index') }}" class="nav-link {{ Route::is('admin.temporary-workers*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vacataires</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('workers.stats') }}" class="nav-link {{ Route::is('admin.workers.stats*') ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Statistiques</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @if(auth()->user()->can(\App\Models\Permission::REGISTER['READ']))
        <li class="nav-item">
            <a href="#" class="nav-link {{Route::is('admin.registrations*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-signature"></i>
                <p>
                    Emargements
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('registrations.index', ['type' => 'personal']) }}" class="nav-link {{Route::is('admin.registrations*') && request()->query('type') == 'personal' ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Personnel du club house</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('registrations.index', ['type' => 'hmi']) }}" class="nav-link {{Route::is('admin.registrations*') && request()->query('type') == 'hmi' ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hmi-kf</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('registrations.stats') }}" class="nav-link {{Route::is('admin.registrations.stats*') ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Statistiques</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @can(App\Models\Permission::INFO['READ'])
        <li class="nav-item">
            <a href="{{ getGuardedRoute('infos.index') }}" class="nav-link {{ Route::is('admin.infos*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>Note de service</p>
            </a>
        </li>
    @endcan

    @if(auth()->user()->can(\App\Models\Permission::ASSESSMENT['READ']) || auth()->user()->can(\App\Models\Permission::ASSESSMENT['ACCESS']))
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('admin.assessments*') || Route::is('admin.histories-assessment*') || Route::is('admin.recaps-assessment*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                    Evaluations
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can(App\Models\Permission::ASSESSMENT['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('assessments.index') }}" class="nav-link {{Route::is('admin.assessments*') && !Route::is('admin.assessments.history*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Notations</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::ASSESSMENT['ACCESS'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('assessments.history') }}" class="nav-link {{Route::is('admin.assessments.history*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Historiques</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif

    @can(App\Models\Permission::CERTIFICAT['READ'])
        <li class="nav-item">
            <a href="{{getGuardedRoute('certificates.index')}}" class="nav-link {{ Route::is('admin.certificates*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>Doc. administratifs</p>
            </a>
        </li>
    @endcan

    @can(App\Models\Permission::LEAVE['READ'])
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('admin.leaves*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Congés
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('leaves.index', ['type' => 'absence']) }}" class="nav-link {{Route::is('admin.leaves*') && request()->query('type') == 'absence' ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Autorisation d'absence</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('leaves.index', ['type' => 'annuel']) }}" class="nav-link {{Route::is('admin.leaves*') && request()->query('type') == 'annuel' ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Congé annuel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('leaves.index', ['type' => 'maternite']) }}" class="nav-link {{Route::is('admin.leaves*') && request()->query('type') == 'maternite' ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Congé de marternité</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('leaves.stats') }}" class="nav-link {{Route::is('admin.leaves.stats*') || Route::is('admin.leaves.single*') ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Statistiques</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @if(auth()->user()->can(\App\Models\Permission::ROLE['READ']) || auth()->user()->can(\App\Models\Permission::ADMIN['READ']))
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('admin.roles*') || Route::is('admin.admins*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-lock"></i>
                <p>
                    Management
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can(App\Models\Permission::ROLE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('roles.index') }}" class="nav-link {{Route::is('admin.roles*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Gestion des roles</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::ADMIN['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('admins.index') }}" class="nav-link {{Route::is('admin.admins*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Gestions des admins</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif

    <li class="nav-item">
        <a href="{{ getGuardedRoute('messages.index') }}" class="nav-link {{ Route::is('admin.messages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-share"></i>
            <p>Message groupé</p>
        </a>
    </li>

    @if(auth()->user()->can(\App\Models\Permission::PERSONAL['IMPORT']) || auth()->user()->can(\App\Models\Permission::FACTOR['READ']) || auth()->user()->can(\App\Models\Permission::BANNER['READ']) || auth()->user()->can(\App\Models\Permission::DEPARTMENT['READ']) || auth()->user()->can(\App\Models\Permission::GRADE['READ']) || auth()->user()->can(\App\Models\Permission::SERVICE['READ']) || auth()->user()->can(\App\Models\Permission::SITE['READ']) || auth()->user()->can(\App\Models\Permission::SETTING['READ']) || auth()->user()->can(\App\Models\Permission::WORKER['READ']) || auth()->user()->can(\App\Models\Permission::INTERN['READ']) || auth()->user()->can(\App\Models\Permission::TEMPORARYWORKER['READ']))
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('admin.import-personals*') || Route::is('admin.factors*') || Route::is('admin.unlocks*') || Route::is('admin.setting-temporary-workers*') || Route::is('admin.setting-interns*') || Route::is('admin.banners*') || Route::is('admin.departements*') || Route::is('admin.grades*') || Route::is('admin.services*') || Route::is('admin.sites*') || Route::is('admin.settings*') || Route::is('admin.form-fields*') || Route::is('admin.activities*') || Route::is('admin.holidays*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Paramètres
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can(App\Models\Permission::PERSONAL['IMPORT'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('import-personals.index') }}" class="nav-link {{Route::is('admin.import-personals*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Importer du personnel</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::FACTOR['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('factors.index') }}" class="nav-link {{Route::is('admin.factors*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Agents</p>
                        </a>
                    </li>
                @endcan
                @if(App\Models\Permission::WORKER['READ'] || App\Models\Permission::INTERN['READ'] || App\Models\Permission::TEMPORARYWORKER['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('unlocks.index') }}" class="nav-link {{Route::is('admin.unlocks*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blacklists</p>
                        </a>
                    </li>
                @endif
                @can(App\Models\Permission::DEPARTMENT['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('departements.index') }}" class="nav-link {{Route::is('admin.departements*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Departements</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::GRADE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('grades.index') }}" class="nav-link {{Route::is('admin.grades*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Grades</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::SERVICE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('services.index') }}" class="nav-link {{Route::is('admin.services*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Services</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::SERVICE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('activities.index') }}" class="nav-link {{Route::is('admin.activities*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fonctions</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::SITE['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('sites.index') }}" class="nav-link {{Route::is('admin.sites*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sites</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::SETTING['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('settings.index') }}" class="nav-link {{Route::is('admin.settings*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Heure / Marge / Congé</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::HOLIDAY['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('holidays.index') }}" class="nav-link {{Route::is('admin.holidays*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fériés</p>
                        </a>
                    </li>
                @endcan
                @can(App\Models\Permission::BANNER['READ'])
                    <li class="nav-item">
                        <a href="{{ getGuardedRoute('banners') }}" class="nav-link {{Route::is('admin.banners*') ? 'active1' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bannière</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ getGuardedRoute('form-fields.index') }}" class="nav-link {{Route::is('admin.form-fields*') ? 'active1' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Formulaire d'évaluation</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif
@else
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::is('user.registrations*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-signature"></i>
            <p>
                Emargements
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ getGuardedRoute('registrations.index') }}" class="nav-link {{Route::is('user.registrations*') ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Emarger</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ getGuardedRoute('registrations.stats') }}" class="nav-link {{Route::is('user.registrations*') ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Statistiques</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ getGuardedRoute('infos.index') }}" class="nav-link {{ Route::is('user.infos*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>Note de service</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{getGuardedRoute('certificates.index')}}" class="nav-link {{ Route::is('user.certificates*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>Doc. administratifs</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link {{ Route::is('user.leaves*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-circle"></i>
            <p>
                Congés
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ getGuardedRoute('leaves.index', ['type' => 'absence']) }}" class="nav-link {{Route::is('user.leaves*') && request()->query('type') == 'absence' ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Autorisation d'absense</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ getGuardedRoute('leaves.index', ['type' => 'annuel']) }}" class="nav-link {{Route::is('user.leaves*') && request()->query('type') == 'annuel' ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Congé annuel</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ getGuardedRoute('leaves.index', ['type' => 'maternite']) }}" class="nav-link {{Route::is('user.leaves*') && request()->query('type') == 'maternite' ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Congé de marternité</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ getGuardedRoute('leaves.stats') }}" class="nav-link {{Route::is('user.form-fields*') ? 'active1' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Statistiques</p>
                </a>
            </li>
        </ul>
    </li>
@endif
