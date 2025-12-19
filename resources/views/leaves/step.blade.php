<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="leaves-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Service / Chef de département</th>
                <th class="text-sm">Statut</th>
                <th class="text-sm">Date de traitement</th>
                <th class="text-sm">Commentaire</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leave->flows()->latest()->paginate(10) as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <span class="text-sm">{{$item->signatory->name}}</span>
                    </td>
                    <td>
                        <span class="text-sm btn-{{$item->status == "PENDING" ? 'warning' : ($item->status == "SUCCESS" ? 'success' : 'danger')}} btn-sm">{{$item->status == 'PENDING' ? 'En attente' : ($item->status == 'SUCCESS' ? 'Accepté' : 'Réfusé')}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->signatory->created_at->format('d/m/Y')}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$item->content}}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $leave->flows()->latest()->paginate(10)])
        </div>
    </div>
</div>

@include('leaves.modals.update')
