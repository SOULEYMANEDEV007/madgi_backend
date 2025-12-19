<div>
    @php
        use App\Models\Assessment;

        $assessments = Assessment::whereUserId($factor->id)->orderBy('save', 'desc')->orderBy('id', 'desc')->get()->groupBy('save');
    @endphp
    @if (Request::is('recaps-assessment*'))
        @foreach ($assessments as $key => $field)
            @php
                $total = $field->sum(function ($assessment) {
                    return json_decode($assessment->data)->note * json_decode($assessment->data)->coefficient;
                });

                $coefficientSum = $field->sum(function ($assessment) {
                    return json_decode($assessment->data)->coefficient;
                });

                $average = $coefficientSum > 0 ? ($total / $coefficientSum) : 0;

                $formattedDate = \Carbon\Carbon::parse($field[0]->created_at)->format('d/m/Y à h:m');
            @endphp

            <h5 class="text-right mt-5"><span class="bg-warning px-1">Date d'évaluation:</span> {{$formattedDate}}</h5>
            <div class="my-2" style="border: 2px solid #FF9F47 !important; border-radius: 15px;">
                @foreach ($field as $index => $value)
                    <div class="row justify-content-center px-3 pt-3">
                        <h4 class="col-md-12 text-center">{{ $value->formassessment['name'] }}</h4>
                        @foreach ($value->formassessment->formfields as $item)
                            @php
                                $note = $item['name'];
                            @endphp
                            <div class="{{ $item['type'] === 'textarea' ? 'col-md-12 mb-3' : 'col-md-4 mb-3' }}">
                                <label for="{{$item->name}}{{$key}}">{{ $item['label'] }}</label>
                                @if ($item['type'] === 'text' || $item['type'] === 'number')
                                    <input
                                        type="{{ $item['type'] }}"
                                        id="{{$item->name}}{{$key}}"
                                        placeholder="{{ $note == 'total' ? '' : 'Saisir une valeur' }}"
                                        class="form-control form-control-sm"
                                        min="0"
                                        max="20"
                                        value="{{json_decode($value->data)->$note}}"
                                        @if($note == 'coefficient' || $note == 'total' || Request::is('recaps-assessment*')) readonly @endif
                                        style="border: 1px solid #FF9F47 !important; border-radius: 5px;"
                                    >
                                @elseif ($item['type'] === 'textarea')
                                    <textarea
                                        type="text"
                                        id="{{$item->name}}{{$key}}"
                                        cols="30"
                                        rows="5"
                                        placeholder="{{ $note == 'total' ? '' : 'Saisir une valeur' }}"
                                        class="form-control form-control-sm"
                                        readonly
                                        style="border: 1px solid #FF9F47 !important; border-radius: 5px;"
                                    >{{json_decode($value->data)->$note}}</textarea>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="row d-flex justify-content-center p-1 m-2" style="background-color:#FF9F47 !important; border-radius: 15px; color: #fff;">
                    <h5 class="col text-center"><b>Total</b>: {{ $total }} / {{$coefficientSum * 20}}</h5>
                    <h5 class="col text-center"><b>Moyenne</b>: {{number_format($average, 2)}} / 20</h5>
                </div>
                <div class="row justify-content-end mr-2">
                    @livewire('action', ['factor' => $factor, 'assessment' => $field, 'formAssessments' => $formAssessments])
                </div>
            </div>
        @endforeach

        {{-- <div class="card-footer clearfix">
            <div class="float-right">
                @include('adminlte-templates::common.paginate', ['records' => $assessments->links()])
            </div>
        </div> --}}
    @else
        @foreach ($formAssessments as $key => $field)
            <div class="row justify-content-center p-3 mt-2" style="border: 2px solid #FF9F47 !important; border-radius: 15px;">
                <h4 class="col-md-12 text-center mb-4">{{ $field['name'] }}</h4>
                <input type="hidden" name="formassessment[]" value="{{$field->id}}">
                @foreach ($field['formfields'] as $index => $item)
                    <div class="{{ $item['type'] === 'textarea' ? 'col-md-12 mb-3' : 'col-md-4 mb-3' }}">
                        <label for="{{$item->name}}{{$key}}">{{ $item['label'] }}</label>
                        @if ($item['type'] === 'text' || $item['type'] === 'number')
                            <input
                                wire:model="fields.{{$item->name}}{{$key}}"
                                type="{{ $item['type'] }}"
                                id="{{$item->name}}{{$key}}"
                                placeholder="{{ $item['name'] == 'total' ? $fields[$item->name.$key] : 'Saisir une valeur' }}"
                                class="form-control form-control-sm"
                                min="0"
                                max="20"
                                wire:input="recalculateTotal({{ $key }}, {{ $index }})"
                                name="{{$item['name']}}[]"
                                @if($item['name'] == 'coefficient' || $item['name'] == 'total') readonly @endif
                                required
                                style="border: 1px solid #FF9F47 !important; border-radius: 5px;"
                            >
                        @elseif ($item['type'] === 'textarea')
                            <textarea
                                wire:model="fields.{{$item->name}}{{$key}}"
                                type="text"
                                id="{{$item->name}}{{$key}}"
                                cols="30"
                                rows="5"
                                placeholder="{{ $item['name'] == 'total' ? $fields[$item->name.$key] : 'Saisir une valeur' }}"
                                class="form-control form-control-sm"
                                name="{{$item['name']}}[]"
                                required
                                style="border: 1px solid #FF9F47 !important; border-radius: 5px;"
                            >{{ $item['value'] }}</textarea>
                        @elseif ($item['type'] === 'select')
                            <select
                                wire:model="fields.{{$item->name}}{{$key}}"
                                id="{{$item->name}}{{$key}}"
                                class="form-control form-control-sm"
                                name="{{$item['name']}}[]"
                            >
                                @foreach (json_decode($item['options']) as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="row d-flex justify-content-center p-3 mt-2" style="background-color:#FF9F47 !important; border-radius: 15px; color: #fff;">
            <h5 class="col text-center"><b>Total</b>: {{$total}} / {{$coefficient * 20}}</h5>
            <h5 class="col text-center"><b>Moyenne</b>: {{number_format(($total / $coefficient), 2)}} / 20</h5>
        </div>
    @endif
</div>
