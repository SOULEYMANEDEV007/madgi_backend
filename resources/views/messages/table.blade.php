<div class="card-body">
    <form id="paginationForm" action="{{ getGuardedRoute('messages.search') }}" method="GET">
        @csrf
        <select name="paginator" class="form-control-sm mb-2" onchange="submitForm()">
            <option value="10" {{ request('paginator') == 10 ? 'selected' : '' }}>Affichage: 10</option>
            <option value="25" {{ request('paginator') == 25 ? 'selected' : '' }}>Affichage: 25</option>
            <option value="100" {{ request('paginator') == 100 ? 'selected' : '' }}>Affichage: 100</option>
        </select>

        <div class="search-date float-right">
            <form action="{{ getGuardedRoute('messages.search') }}" method="GET">
                <button type="submit" class="btn btn-primary btn-sm float-right">Valider</button>
                <input type="date" name="date" class="bg-gradient-default btn-sm" />
            </form>
        </div>
    </form>

    <h6 class="text-primary text-bold mb-2">Total: {{$total}}</h6>
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex">
                <h6 class="text-primary text-bold">
                    <a href="{{getGuardedRoute('messages.delivered')}}" class="text-success">Total (message). délivré: {{$delivered}}</a>
                </h6>
                <h6 class="text-primary text-bold mx-5">
                    <a href="{{getGuardedRoute('messages.sent')}}" class="text-primary">Total (message). en cours: {{$inprogress}}</a>
                </h6>
                <h6 class="text-bold">
                    <a href="{{getGuardedRoute('messages.error')}}" class="text-danger">Total (message). échoué: {{$error}} </a>
                </h6>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="messages-table">
            <thead>
            <tr>
                <th class="text-sm">#</th>
                <th class="text-sm">Image</th>
                <th class="text-sm">Contact</th>
                <th class="text-sm">Message</th>
                <th class="text-sm">Statut</th>
                <th class="text-sm">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($messages as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            @if ($item->media != null)
                                <img src="{{$item->media}}" width="30" height="30" data-toggle="modal" data-target="#model-{{ $key }}">

                                <div class="modal fade" id="model-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{$item->media != null ? $item->media : asset('/images/user.png')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <i class="fa fa-ban" style="color: red;"></i>
                            @endif
                        </td>
                        <td>
                            <span class="btn btn-light btn-sm">{{$item->phone_number}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{$item->message}}</span>
                        </td>
                        <td>
                            <span class="text-sm btn-{{$item->status == 'delivered' ? 'success' : ($item->status == 'sent' ? 'info' : 'danger')}} btn-sm">{{$item->status == 'delivered' ? 'Délivré' : ($item->status == 'sent' ? 'En attente' : 'Echoué')}}</span>
                        </td>
                        <td>
                            @if ($item->status == 'failed')
                                {!! Form::open(['route' => [$guard . 'messages.single', $item->id], 'method' => 'post']) !!}
                                    {!! Form::button('<i class="fas fa-share"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'onclick' => "return confirm('Envoyer le message pour ce utilisateur')"]) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $messages])
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById('paginationForm').submit();
    }
</script>
