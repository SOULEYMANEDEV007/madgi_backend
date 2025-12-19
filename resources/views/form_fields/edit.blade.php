@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Modifier le formulaire</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($formField, ['route' => [$guard . 'form-fields.update', $formField->id], 'method' => 'patch']) !!}

            <div x-data="{ fields: [{ label: '{{$formField->label}}', type: '{{$formField->type}}', value: '{{$formField->value}}' }], field : '', fieldOptions: [
                { value: 'text', label: 'Un champs de saisir de text', selected: '{{$formField->type == 'text' ? true : false}}' },
                { value: 'number', label: 'Un champs de saisir numérique', selected: '{{$formField->type == 'number' ? true : false}}' },
                { value: 'textarea', label: 'Un champs de saisir multiple', selected: '{{$formField->type == 'textarea' ? true : false}}' },
                {{-- { value: 'select', label: 'Un champs de selection' } --}}
            ], selectOptions: [{ value: '', label: '' }] }" class="card-body">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6">
                        <label for="name">Titre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fa fa-pen"></i>
                                </span>
                            </div>
                            <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" value="{{$formField->formassessment->name}}" placeholder="Ex: Respect des horaires de travail">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if (auth()->guard(\App\Models\Admin::$guard)->check() && auth()->guard(\App\Models\Admin::$guard)->user()->role->id == 1)
                        <div class="col-md-6">
                            <label for="post_phone">Département</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-text-height"></i>
                                    </span>
                                </div>
                                <select name="department_id" id="departement" class="custom-select custom-select-sm form-control @error('department_id') is-invalid @enderror departement-input-field">
                                    <option selected disabled>Sélectionnez le département</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $formField->formassessment->department_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('post_phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>

                <template x-for="(field, i) in fields" :key="i">
                    <div class="row justify-content-center mb-4">
                        @include('form_fields.fields')
                    </div>
                </template>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="{{ getGuardedRoute('form-fields.index') }}" class="btn btn-default btn-sm"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
