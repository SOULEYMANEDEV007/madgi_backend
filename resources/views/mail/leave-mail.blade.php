<?php
    use Carbon\Carbon;

    $leave = App\Models\Leave::whereUserId($user->id)->latest()->first();
    Carbon::setLocale('fr');
    $date = Carbon::now();
    $formattedDate = $date->translatedFormat('d F Y');
    $date1 = Carbon::parse($leave->new_start_date)->format('d/m/Y');
    $date2 = Carbon::parse($leave->new_end_date)->format('d/m/Y');
    $differenceInDays = $leave->number_absence;
    $transmissions = App\Models\Transmission::whereLeaveId($leave->id)->get();
    $instance = new App\Services\DateService();
    $formattedDates = $instance->generateFormattedDate1($leave->resumption);
?>

<div class="container mt-5">
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
            <p>est autorisé à s'absenter de son poste pour une durée de <strong>dix ({{$differenceInDays}}) jours</strong>, déductibles de son congé {{$date->translatedFormat('Y')}}, le <strong>{{$formattedDates}}</strong> pour le motif suivant : <br> <strong>Congé</strong></p>
            <p>Pendant cette période d'absence, l'intérim sera assuré par <strong>{{$leave->interim}}, Chef de Département RHMG</strong>.</p>
            <p>La présente décision prend effet à partir de sa date de signature pour servir et valoir ce que de droit.</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-6">
            <p><strong>AMPLIATIONS :</strong></p>
            <ul>
                @foreach ($transmissions as $item)
                    <li>{{$item->user->nom}}...01</li>
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
