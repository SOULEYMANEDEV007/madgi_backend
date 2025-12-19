<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="form-fields-table">
            <thead>
                <tr>
                    <th class="text-sm">Type</th>
                    <th class="text-sm">Label</th>
                    <th class="text-sm">Type</th>
                    <th class="text-sm">Resultat</th>
                    <th class="text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedFields as $formassessmentName => $fields)
                    @foreach($fields as $index => $field)
                        <tr>
                            @if ($index == 0)
                                <td rowspan="{{ count($fields) }}">{{ $formassessmentName }}</td>
                            @endif
                            <td>
                                <span class="btn btn-light btn-sm">{{ $field->label }}</span>
                            </td>
                            <td>
                                <span class="btn btn-light btn-sm">{{ $field->type }}</span>
                            </td>
                            <td>
                                @if ($field->type === 'text' || $field->type === 'number')
                                    <input type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $field->value }}" class="form-control form-control-sm">
                                @elseif ($field->type === 'textarea')
                                    <textarea name="text" id="{{ $field->name }}" cols="10" rows="2" class="form-control form-control-sm">{{ $field->value }}</textarea>
                                @elseif ($field->type === 'select')
                                    <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control form-control-sm">
                                        @foreach (json_decode($field->options) as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                            <td style="width: 120px">
                                <div class='btn-group'>
                                    <a href="{{ getGuardedRoute('form-fields.edit', [$field->id]) }}" class='btn btn-info btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => [$guard . 'form-fields.destroy', $field->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {{ $formFields->links() }}
        </div>
    </div>
</div>
