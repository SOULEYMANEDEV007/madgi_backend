<div class="col-12 col-sm-5 text-center">
    @if (!empty($infos->media))
        @if (pathinfo($infos->media->src, PATHINFO_EXTENSION) == 'pdf')
            <a href="{{$infos->media->src}}" target="_blank">
                <i class="fa fa-file fa-10x text-primary text-center"></i> <br>
                <small>Cliquez pour ouvrir</small>
            </a>
        @else
            <img src="{{!empty($infos->media) ? $infos->media->src : asset('/images/user.png')}}" class="product-file" alt="Product File" width="200" height="200">
        @endif
    @else <p>Aucun fichier chargé</p>
    @endif
</div>
<div class="col-12 col-sm-7">
    <div class="d-flex my-5">
        <div class="col-3 p-3 mx-3" style="border: 2px dashed #007bff; border-radius: 10px;">
            <h6 class="mb-2 bg-primary p-1 text-bold">Emetteur</h6>
            <strong>{{$infos->post_name}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed yellow; border-radius: 10px;">
            <h6 class="mb-2 bg-warning p-1 text-bold">Contact</h6>
            <strong>{{$infos->post_phone}}</strong>
        </div>

        <div class="col-3 p-3 mx-3" style="border: 2px dashed red; border-radius: 10px;">
            <h6 class="mb-2 bg-red p-1 text-bold">Poste</h6>
            <strong>{{$infos->department->name ?? ''}}</strong>
        </div>
    </div>
    <div class="bg-info px-3">
        <p>{{$infos->content}}</p>
    </div>
</div>