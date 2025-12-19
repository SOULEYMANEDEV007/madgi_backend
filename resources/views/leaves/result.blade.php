@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <h4 class="bg-warning px-2">Ceci est une previsualisaion, veuillez Téléchargé le format original</h4>
                <form action="{{ getGuardedRoute('leaves.download', $leave->id) }}" method="GET">
                    <button type="submit" class="btn btn-primary btn-sm float-right ml-5">
                        <i class="fa fa-download"></i> Télécharger
                    </button>
                </form>
            </div>
            <div class="card" style="border: 1px solid transparent !important;">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>Mutuelle des Agents de la Direction Générale des Impôts</h4>
                            <h5>ADMINISTRATION GENERALE</h5>
                            <h6>L'Administrateur général</h6>
                            <p class="text-right">Abidjan, le {{$formattedDate}}</p>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h4><strong>AUTORISATION D'ABSENCE</strong></h4>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <p>L'Administrateur général de la <strong>Mutuelle des Agents de la Direction Générale des Impôts (MADGI)</strong> soussigné, certifie que :</p>
                            <p><strong>NOM & PRENOMS:</strong> {{$user->nom}}<br>
                                <strong>MATRICULE:</strong> {{$user->matricule}}<br>
                                <strong>FONCTION:</strong> {{$user->fonction}}<br>
                                <strong>DEPARTEMENT:</strong> {{$user->depart->name}}
                            </p>
                            <p>est autorisé à s'absenter de son poste pour une durée de <strong>dix ({{$differenceInDays}}) jours</strong>, déductibles de son congé {{$date->translatedFormat('Y')}}, <strong>{{$formattedDates}}</strong> pour le motif suivant : <br> <strong>Congé</strong></p>
                            <p>Pendant cette période d'absence, l'intérim sera assuré par <strong>{{$leave->interim}}, Chef de Département RHMG</strong>.</p>
                            <p>La présente décision prend effet à partir de sa date de signature pour servir et valoir ce que de droit.</p>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-6">
                            <p><strong>AMPLIATIONS :</strong></p>
                            <ul>
                                @foreach ($transmissions as $item)
                                    @if (!empty($item->user))
                                        <li>{{$item->user->nom}}...01</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6 text-right">
                            <p><strong>L'Administrateur Général</strong></p>
                            <p>KOUADIO K. Uberson</p>
                            <img src="signature.png" alt="Signature" style="height: 100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection