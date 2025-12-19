<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="settings-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Clé</th>
                <th class="text-sm">Valeur</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($settings as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light border border-primary btn-sm">{{$item->name}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->slug == 'deadline_absence' ? $item->value . \Carbon\Carbon::now()->format('/m/Y') : $item->value}}</span>
                        </td>

                        <td  style="width: 120px">
                            <div x-data="{
                                show($item, $route) {
                                    $('#update-settings-modal').modal('show');
                                    $('.modal-title').text($item.name);
                                    $('.settings-form-action').attr('action', $route);
                                    $('.id-input-field').val($item.id);
                                    $('.year-field').addClass('d-none');

                                    if($item.id == 2) $('.id-title').text('Marge');
                                    else if($item.id == 1) {
                                        $('.id-title').text('Heure');
                                        $('.value-input-field').attr('type', 'time');
                                    }
                                    else if($item.id == 4) {
                                        $('.id-title').text('Deadline');
                                        $('.value-input-field').attr('type', 'number');
                                        $('.value-input-field').attr('min', '1');
                                        $('.value-input-field').attr('max', '30');
                                        $('.value-input-field').attr('placeholder', 'Ex: 31 pour un deadline chaque 31 du mois');
                                    }
                                    else {
                                        $('.year-field').removeClass('d-none');
                                        $('.year-input-field').val($item.year);
                                    }
                                    {{-- $('.value-input-field').attr('type', 'number'); --}}
                                    $('.value-input-field').val($item.value);
                                },
                            }" class='btn-group'>
                                @can(App\Models\Permission::SETTING['UPDATE'])
                                    <a x-on:click="show({{$item}}, '{{getGuardedRoute('settings.update', $item->id)}}')" href="javascript:;" class='btn btn-info btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::SETTING['DELETE'])
                                    @if($item->id != 1 && $item->id != 2 && $item->id != 4)
                                        {!! Form::open(['route' => [$guard . 'settings.destroy', $item->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $settings])
        </div>
    </div>
</div>

@include('settings.modals.update')
