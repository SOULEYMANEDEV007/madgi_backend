<div class="card-body">
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped text-center" id="registrations-table">
            <thead>
                <tr>
                    <th class="text-sm">Nb(pers). ayant émargé</th>
                    <th class="text-sm">Nb(pers). ayant pas émarger</th>
                    <th class="text-sm">Nb(pers). retard</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="text-sm">{{$register}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$unregister}}</span>
                    </td>
                    <td>
                        <span class="text-sm">{{$later}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
