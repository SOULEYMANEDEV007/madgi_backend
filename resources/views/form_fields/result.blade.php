@if (Route::is('admin.form-fields.create') || Route::is('user.form-fields.create'))
    <div x-show="field.type != '' && field.type != 'select'" class="col-md-2">
        <label for="label" x-text="field.label ? field.label : 'Label'" style="text-transform: capitalize;"></label>
        <input type="text" x-model="field.label" :name="'fields['+ i +'][label]'" class="form-control form-control-sm" placeholder="Saisir le label">
    </div>

    <div x-show="field.type == 'select'" class="col-md-2">
        <label for="label" x-text="'Valeur' + i+1" style="text-transform: capitalize;"></label>
        <input type="text" x-model="field.label" :name="'selectOptions['+ i +'][label]'" class="form-control form-control-sm" placeholder="Saisir le label">
    </div>
    <div x-show="field.type == 'select'" class="col-md-2">
        <label for="type">Actions</label> <br>
        <button type="button" @click="selectOptions.splice(i, 1);" class="btn btn-secondary btn-sm">-</button>
        <button type="button" @click="selectOptions.push({ value: '', label: '' })" class="btn btn-warning btn-sm">+</button>
    </div>

    <div x-show="field.type != '' && field.type != 'select'" class="col-md-2">
        <label for="value">valeur (Facultatif)</label>
        <input type="text" x-model="field.value" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" placeholder="Saisir la valeur">
    </div>

    <div x-show="field.type != ''" class="col-md-3">
        <label for="type">Résultat</label>
        <input type="hidden" :name="'fields['+ i +'][name]'" class="form-control form-control-sm" :value="field.label.toLowerCase()">
        <template x-if="field.type == 'text'">
            <input type="text" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled>
        </template>
        <template x-if="field.type == 'number'">
            <input type="number" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled>
        </template>
        <template x-if="field.type == 'textarea'">
            <textarea :name="'fields['+ i +'][value]'" cols="30" rows="5" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled></textarea>
        </template>
        <template x-if="field.type == 'select'">
            <select :name="'fields['+ i +'][value]'" class="form-control form-control-sm">
                <option value="" disabled selected>Sélectionnez la valeur</option>
                <template x-for="option in selectOptions" :key="option.value">
                    <option :value="option.value" x-text="option.label"></option>
                </template>
            </select>
        </template>
    </div>
@else
    <div x-show="field.type != '' && field.type != 'select'" class="col-md-2">
        <label for="label" x-text="field.label ? field.label : 'Label'" style="text-transform: capitalize;"></label>
        <input type="text" x-model="field.label" :name="'fields['+ i +'][label]'" class="form-control form-control-sm" placeholder="Saisir le label">
    </div>

    <div x-show="field.type == 'select'" class="col-md-2">
        <label for="label" x-text="'Valeur' + i+1" style="text-transform: capitalize;"></label>
        <input type="text" x-model="field.label" :name="'selectOptions['+ i +'][label]'" class="form-control form-control-sm" placeholder="Saisir le label">
    </div>
    <div x-show="field.type == 'select'" class="col-md-2">
        <label for="type">Actions</label> <br>
        <button type="button" @click="selectOptions.splice(i, 1);" class="btn btn-secondary btn-sm">-</button>
        <button type="button" @click="selectOptions.push({ value: '', label: '' })" class="btn btn-warning btn-sm">+</button>
    </div>

    <div x-show="field.type != '' && field.type != 'select'" class="col-md-2">
        <label for="value">valeur (Facultatif)</label>
        <input type="text" x-model="field.value" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" placeholder="Saisir la valeur">
    </div>

    <div x-show="field.type != ''" class="col-md-3">
        <label for="type">Résultat</label>
        <input type="hidden" :name="'fields['+ i +'][name]'" class="form-control form-control-sm" :value="field.label.toLowerCase()">
        <template x-if="field.type == 'text'">
            <input type="text" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled>
        </template>
        <template x-if="field.type == 'number'">
            <input type="number" :name="'fields['+ i +'][value]'" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled>
        </template>
        <template x-if="field.type == 'textarea'">
            <textarea :name="'fields['+ i +'][value]'" cols="30" rows="5" class="form-control form-control-sm" :placeholder="'Saisir le ' + (field.label ? field.label.toLowerCase() : '')" disabled></textarea>
        </template>
        <template x-if="field.type == 'select'">
            <select :name="'fields['+ i +'][value]'" class="form-control form-control-sm">
                <option value="" disabled selected>Sélectionnez la valeur</option>
                <template x-for="option in selectOptions" :key="option.value">
                    <option :value="option.value" x-text="option.label"></option>
                </template>
            </select>
        </template>
    </div>
@endif
