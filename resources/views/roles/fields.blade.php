@if (Route::is('admin.roles.create') || Route::is('user.roles.create'))
    <div class="col-md-4 mb-3">
        <label for="name" class="font-weight-bold">Rôle</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-text-height"></i>
                </span>
            </div>
            <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" placeholder="Saisir le rôle">
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="container-fluid">
        <h3 class="mt-3">Permissions</h3>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3 mb-3">
                    <div style="border: 2px solid #48d6a8; border-radius: 10px;">
                        <div class="card-body">
                            <h6 class="mb-2 p-1 text-bold" style="background-color: #48d6a8; color: #fff;">{{$permission->title}}</h6>
                            @if ($permission->title == \App\Models\User::$import)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="IMPORT {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Importer du {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Unlock::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Lire {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Modifier {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Emargement::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="DISABLE {{$permission->title}}">
                                        <label for="{{$permission->title}}3" class="custom-control-label">Désactiver un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="EXPORT {{$permission->title}}">
                                        <label for="{{$permission->title}}4" class="custom-control-label">Exporter un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}5" class="custom-control-label">Laisser une observation</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\Media::$permission || $permission->title == \App\Models\Infos::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\Assessment::$permission || $permission->title == \App\Models\FormField::$permission || $permission->title == \App\Models\Holiday::$permission || $permission->title == \App\Models\Setting::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}">
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                @if ($permission->title == \App\Models\Assessment::$permission)
                                    <div class="">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="ACCESS Historique">
                                            <label for="{{$permission->title}}5" class="custom-control-label">Accès aux historiques</label>
                                        </div>
                                    </div>
                                @endif
                            @elseif ($permission->title == \App\Models\Leave::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}">
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="SIGNER {{$permission->title}}">
                                        <label for="{{$permission->title}}5" class="custom-control-label">Signer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Certificate::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier un {{strtolower($permission->title)}} (RH)</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}">
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @else
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="READ {{$permission->title}}">
                                        <label for="{{$permission->title}}1" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="UPDATE {{$permission->title}}">
                                        <label for="{{$permission->title}}2" class="custom-control-label">Modifier un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="DISABLE {{$permission->title}}">
                                        <label for="{{$permission->title}}3" class="custom-control-label">Désactiver un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}">
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="EXPORT {{$permission->title}}">
                                        <label for="{{$permission->title}}5" class="custom-control-label">Exporter un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="col-md-4 mb-3">
        <label for="name" class="font-weight-bold">Rôle</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="fa fa-text-height"></i>
                </span>
            </div>
            <input type="hidden" name="id" class="form-control form-control-sm" id="id" value="{{$role->id}}">
            <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" value="{{$role->name}}" placeholder="Saisir le rôle">
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="container-fluid">
        <h3 class="mt-3">Permissions</h3>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3 mb-3">
                    <div style="border: 2px solid #48d6a8; border-radius: 10px;">
                        <div class="card-body">
                            <h6 class="mb-2 p-1 text-bold" style="background-color: #48d6a8; color: #fff;">{{$permission->title}}</h6>
                            @if ($permission->title == \App\Models\User::$import)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="IMPORT {{$permission->title}}" @if($role->hasPermissionTo("IMPORT $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Importer du {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Unlock::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Lire {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Modifier {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Emargement::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}" @if($role->hasPermissionTo("CREATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Désactiver un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="DISABLE {{$permission->title}}" @if($role->hasPermissionTo("DISABLE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}3" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="EXPORT {{$permission->title}}" @if($role->hasPermissionTo("EXPORT $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}4" class="custom-control-label">Exporter un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}5" class="custom-control-label">Laisser une observation</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\Media::$permission || $permission->title == \App\Models\Infos::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\Assessment::$permission || $permission->title == \App\Models\FormField::$permission || $permission->title == \App\Models\Holiday::$permission || $permission->title == \App\Models\Setting::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}" @if($role->hasPermissionTo("CREATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}" @if($role->hasPermissionTo("DELETE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer @if($permission->title == \App\Models\Role::$permission || $permission->title == \App\Models\Admin::$permission || $permission->title == \App\Models\User::$agent || $permission->title == \App\Models\Departement::$permission || $permission->title == \App\Models\Grade::$permission || $permission->title == \App\Models\Service::$permission || $permission->title == \App\Models\Site::$permission || $permission->title == \App\Models\FormField::$permission) un @else une @endif {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                @if ($permission->title == \App\Models\Assessment::$permission)
                                    <div class="">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="Historique5" name="permissions[]" value="ACCESS Historique" @if($role->hasPermissionTo("ACCESS Historique")) checked @endif>
                                            <label for="Historique5" class="custom-control-label">Accès aux historiques</label>
                                        </div>
                                    </div>
                                @endif
                            @elseif ($permission->title == \App\Models\Leave::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}" @if($role->hasPermissionTo("CREATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}" @if($role->hasPermissionTo("DELETE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="SIGNER {{$permission->title}}" @if($role->hasPermissionTo("SIGNER $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}5" class="custom-control-label">Signer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @elseif ($permission->title == \App\Models\Certificate::$permission)
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="CREATE {{$permission->title}}" @if($role->hasPermissionTo("CREATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Créer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}3" class="custom-control-label">Modifier un {{strtolower($permission->title)}} (RH)</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}" @if($role->hasPermissionTo("DELETE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @else
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}1" name="permissions[]" value="READ {{$permission->title}}" @if($role->hasPermissionTo("READ $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}1" class="custom-control-label">Lire un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}2" name="permissions[]" value="UPDATE {{$permission->title}}" @if($role->hasPermissionTo("UPDATE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}2" class="custom-control-label">Modifier un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}3" name="permissions[]" value="DISABLE {{$permission->title}}" @if($role->hasPermissionTo("DISABLE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}3" class="custom-control-label">Désactiver un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}4" name="permissions[]" value="DELETE {{$permission->title}}" @if($role->hasPermissionTo("DELETE $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}4" class="custom-control-label">Supprimer un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->title}}5" name="permissions[]" value="EXPORT {{$permission->title}}" @if($role->hasPermissionTo("EXPORT $permission->title")) checked @endif>
                                        <label for="{{$permission->title}}5" class="custom-control-label">Exporter un {{strtolower($permission->title)}}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@push('page_css')
    <style>
        label {
            font-weight: 100 !important;
            font-size: 15px;
        }

        .none {
            margin-bottom: 0 !important;
        }
    </style>
@endpush