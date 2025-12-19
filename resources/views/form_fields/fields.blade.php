@if (Route::is('admin.form-fields.create') || Route::is('user.form-fields.create'))
    <div class="col-md-3">
        <label for="field">Type de champs</label>
        <select x-model="field.type" :name="'fields['+ i +'][type]'" id="field" class="form-control form-control-sm">
            <option value="" disabled selected>Choisir le type de champs</option>
            <template x-for="option in fieldOptions" :key="option.value">
                <option :value="option.value" x-text="option.label"></option>
            </template>
        </select>
    </div>

    @include('form_fields.result')

    <div class="col-md-2">
        <label>Actions</label> <br>
        <button @click="fields.length > 1 ? fields.splice(i, 1) : null;" type="button" class="btn btn-danger btn-sm">-</button>
        <button @click="fields.push({ type: '', label: '', value: '' })" type="button" class="btn btn-primary btn-sm">+</button>
    </div>
@else
    <div class="col-md-3">
        <label for="field">Type de champs</label>
        <select x-model="field.type" :name="'fields['+ i +'][type]'" id="field" class="form-control form-control-sm">
            <option value="" disabled selected>Choisir le type de champs</option>
            <template x-for="option in fieldOptions" :key="option.value">
                <option :value="option.value" :selected="option.selected" x-text="option.label"></option>
            </template>
        </select>
    </div>

    @include('form_fields.result')
@endif
