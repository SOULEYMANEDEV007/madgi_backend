<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300&display=swap" rel="stylesheet">
        <title>Statistique</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
            }

            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            td {
                font-size: 14px;
                font-family: 'Source Sans 3', sans-serif;
            }

            th {
                background-color: #0000000d !important;
                color: #000;
                font-size: 12px;
            }

            .text-center {
                text-align: center;
            }

            .text-primary {
                color: #007bff !important;
            }

            .text-danger {
                color: #dc3545 !important;
            }
        </style>
    </head>
    <body>
        <h3 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">Point du personnel de la {{env('APP_TITLE')}} au mois {{$monthName}} {{$year}}</h3>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Répartition par statue et par genre
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">Genre</th>
                            <th class="text-sm text-uppercase">Fonctionnaire</th>
                            <th class="text-sm text-uppercase">Privé</th>
                            <th class="text-sm text-uppercase">Collaborateur extérieure</th>
                            <th class="text-sm text-uppercase">Effectif total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-primary">
                                <td>
                                    <span class="text-sm text-uppercase">Homme</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['mens']['official']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['mens']['employee']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['mens']['extern']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['mens']['total']}}</span>
                                </td>
                            </tr>
                            <tr class="text-danger">
                                <td>
                                    <span class="text-sm text-uppercase">Femme</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['womens']['official']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['womens']['employee']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['womens']['extern']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$status['womens']['total']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span class="text-sm text-uppercase">
                                        <strong style="font-size: 20px;">Total</strong>
                                    </span>
                                </td>
                                <td>
                                    <strong style="font-size: 20px;">{{$status['global']}}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Répartition par site et par genre
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">Site</th>
                            <th class="text-sm text-uppercase">Club House</th>
                            <th class="text-sm text-uppercase">HMI-KF</th>
                            <th class="text-sm text-uppercase">Effectif total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-primary">
                                <td>
                                    <span class="text-sm text-uppercase">Homme</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['mens']['house']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['mens']['hmi']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['mens']['total']}}</span>
                                </td>
                            </tr>
                            <tr class="text-danger">
                                <td>
                                    <span class="text-sm text-uppercase">Femme</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['womens']['house']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['womens']['hmi']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['womens']['total']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-sm text-uppercase">Fonctionnaire</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['officials']['house']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['officials']['hmi']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['officials']['total']}}</span>
                                </td>
                            </tr>
                            <tr class="text-danger">
                                <td>
                                    <span class="text-sm text-uppercase">Privé</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['employees']['house']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['employees']['hmi']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['employees']['total']}}</span>
                                </td>
                            </tr>
                            <tr class="text-danger">
                                <td>
                                    <span class="text-sm text-uppercase">Collaborateur extérieure</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['externs']['house']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['externs']['hmi']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{$sites['externs']['total']}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Répartition par département et service
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">N°</th>
                            <th class="text-sm text-uppercase">Département / Service</th>
                            <th class="text-sm text-uppercase">Effectif</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>
                                        <span class="text-primary text-sm">{{$item['name']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-danger text-sm">{{$item['total']}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-danger">
                                <td colspan="2">
                                    <span class="text-sm text-uppercase">
                                        <strong style="font-size: 20px;">Total</strong>
                                    </span>
                                </td>
                                <td>
                                    <strong style="font-size: 20px;">{{$departments->sum('total')}}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Moyenne d'age collaborateur externe
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">Année</th>
                            <th class="text-sm text-uppercase">Effectif Total</th>
                            <th class="text-sm text-uppercase">Moyenne d'age</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-danger">
                                <td> {{ $year }} </td>
                                <td>
                                    <span class="text-sm">{{$externs['total']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{intval($externs['avg'])}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Moyenne d'age fonctionnaire
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">Année</th>
                            <th class="text-sm text-uppercase">Effectif Total</th>
                            <th class="text-sm text-uppercase">Moyenne d'age</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-danger">
                                <td> {{ $year }} </td>
                                <td>
                                    <span class="text-sm">{{$officials['total']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{intval($officials['avg'])}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-primary text-uppercase mb-3" style="text-decoration: underline">
                    <i class="fa fa-angle-right"></i> Moyenne d'age salarié de la {{env('APP_TITLE')}}
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center" id="workers-table">
                        <thead>
                        <tr>
                            <th class="text-sm text-uppercase">Année</th>
                            <th class="text-sm text-uppercase">Effectif Total</th>
                            <th class="text-sm text-uppercase">Moyenne d'age</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-danger">
                                <td> {{ $year }} </td>
                                <td>
                                    <span class="text-sm">{{$employees['total']}}</span>
                                </td>
                                <td>
                                    <span class="text-sm">{{intval($employees['avg'])}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
