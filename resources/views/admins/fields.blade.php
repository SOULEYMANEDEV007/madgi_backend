<div class="row">
    <div class="col-md-6">
        <label for="name">Nom</label>
        <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror admin-input-field" id="name" :value="{{old('name')}}" placeholder="Saisir le nom">
        @error('name')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="col-md-6">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror admin-input-email-field" id="email" :value="{{old('email')}}" placeholder="Saisir l'email">
        @error('email')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="department_id">Département (Facultatif)</label>
        <select name="department_id" id="department_id" class="custom-select custom-select-sm form-control @error('department_id') is-invalid @enderror admin-input-role-field">
            <option selected disabled>Sélectionnez le département</option>
            @foreach ($departments as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        @error('department_id')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="col-md-6">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" :value="{{old('password')}}" placeholder="Saisir le mot de passe">
        @error('password')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label for="role_id">Rôle</label>
        <select name="role_id" id="role_id" class="custom-select custom-select-sm form-control @error('role_id') is-invalid @enderror admin-input-role-field">
            <option selected disabled>Sélectionnez le rôle</option>
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
        @error('role_id')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>