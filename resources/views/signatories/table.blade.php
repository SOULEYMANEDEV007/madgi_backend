<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="signatories-table">
            <thead>
            <tr>
                <th class="text-sm">Ordre de signature</th>
                <th class="text-sm">Service de signature</th>
                <th class="text-sm" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($departement->signatories()->paginate(10) as $key => $item)
                    <tr>
                        <td>N°{{$key + 1}}</td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$item->name}}</span>
                        </td>

                        <td  style="width: 120px">
                            <div x-data="{
                                show($item, $route) {
                                    $('#update-signatories-modal').modal('show');
                                    $('.signatories-form-action').attr('action', $route);
                                    $('.name-input-field').val($item.name);
                                },
                            }" class='btn-group'>
                                @can(App\Models\Permission::GRADE['UPDATE'])
                                    <a x-on:click="show({{$item}}, '{{getGuardedRoute('signatories.update', $item->id)}}')" href="javascript:;" class='btn btn-info btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan

                                @can(App\Models\Permission::GRADE['DELETE'])
                                    {!! Form::open(['route' => [$guard . 'signatories.destroy', $item->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $departement->signatories()->paginate(10)])
        </div>
    </div>
</div>

@include('signatories.modals.update')
