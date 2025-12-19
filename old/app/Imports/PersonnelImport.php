<?php

namespace App\Imports;

use App\Models\Departement;
use App\Models\Grade;
use App\Models\Service;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonnelImport implements ToModel, WithHeadingRow
{
    /**
     *
    * @param Collection $collection
    */
    public function model(array $row)
    {
        set_time_limit(120);

        if (isset($row['site'])) {
            $site = Site::where('name', $row['site'])->first();
            if(empty($site)) $site = Site::create(['name' => $row['site']]);
        }
        if (isset($row['grade_fp_categorie'])) {
            $grade = Grade::where('name', $row['grade_fp_categorie'])->first();
            if(empty($grade)) $grade = Grade::create(['name' => $row['grade_fp_categorie']]);
        }
        if (isset($row['departement'])) {
            $departement = Departement::where('name', $row['departement'])->first();
            if(empty($departement)) $departement = Departement::create(['name' => $row['departement']]);
        }
        if (isset($row['service'])) {
            $service = Service::where('name', $row['service'])->first();
            if(empty($service)) $service = Service::create(['name' => $row['service']]);
        }

        $row['nom'] = $row['nom_et_prenoms'] ?? null;
        $row['matricule'] = $row['mat_madgi_fp'] ?? null;

        if(isset($row['date_fonction_publique']) && $row['date_fonction_publique'] != 'NA' && strpos($row['date_fonction_publique'], "'") === 0)
            $row['date_fonction'] = Carbon::parse(ltrim($row['date_fonction_publique'], "'"))->format('Y-m-d');
        else if(isset($row['date_fonction_publique']) && $row['date_fonction_publique'] != 'NA' && !strpos($row['date_fonction_publique'], "'") === 0)
            $row['date_fonction'] = Carbon::parse($row['date_fonction_publique'])->format('Y-m-d');
        else $row['date_fonction'] =  null;

        if(isset($row['date_entree_madgi']) && $row['date_entree_madgi'] != 'NA' && strpos($row['date_entree_madgi'], "'") === 0)
            $row['date_entre_mad'] = Carbon::parse(ltrim($row['date_entree_madgi'], "'"))->format('Y-m-d');
        else if(isset($row['date_entree_madgi']) && $row['date_entree_madgi'] != 'NA' && !strpos($row['date_entree_madgi'], "'") === 0)
            $row['date_entre_mad'] = Carbon::parse($row['date_entree_madgi'])->format('Y-m-d');
        else $row['date_entre_mad'] =  null;

        if(isset($row['date_doccupation_poste']) && $row['date_doccupation_poste'] != 'NA' && strpos($row['date_doccupation_poste'], "'") === 0)
            $row['date_occupation_p'] = Carbon::parse(ltrim($row['date_doccupation_poste'], "'"))->format('Y-m-d');
        else if(isset($row['date_doccupation_poste']) && $row['date_doccupation_poste'] != 'NA' && !strpos($row['date_doccupation_poste'], "'") === 0)
            $row['date_occupation_p'] = Carbon::parse($row['date_doccupation_poste'])->format('Y-m-d');
        else $row['date_occupation_p'] =  null;

        if(isset($row['date_naissance']) && $row['date_naissance'] != 'NA' && strpos($row['date_naissance'], "'") === 0)
            $row['date_naissance'] = Carbon::parse(ltrim($row['date_naissance'], "'"))->format('Y-m-d');
        else if(isset($row['date_naissance']) && $row['date_naissance'] != 'NA' && !strpos($row['date_naissance'], "'") === 0)
            $row['date_naissance'] = Carbon::parse($row['date_naissance'])->format('Y-m-d');
        else $row['date_naissance'] =  null;

        $row['grade'] = isset($grade) ? $grade->id : null;
        $row['site'] = isset($site) ? $site->id : null;
        $row['situation_matrim'] = $row['situation_matrimoniale'] ?? null;
        $row['nombre_enfant'] = $row['nombre_enfant'] ?? null;
        $row['tel'] = $row['n_cel'] ?? null;
        $row['statut_mad'] = $row['statut'] ?? null;
        $row['situation_convention'] = $row['situationconvention'] ?? null; //
        $row['date_validations'] = $row['datedevalidite'] ?? null; //
        $row['date_signature'] = $row['datedesignature'] ?? null; //
        $row['slug'] = uniqid();
        $row['type_stage'] = $row['typedestage'] ?? null; //
        $row['situation_stage'] = $row['situationstage'] ?? null; //
        $row['departement'] = isset($departement) ? $departement->id : null;
        $row['service'] = isset($service) ? $service->id : null;
        $row['diplome'] = $row['diplome'] ?? null;
        $row['fonction'] = $row['fonction'] ?? null;
        $row['genre'] = $row['genre'] ?? null;
        $row['etat'] = $row['etat'] ?? null;
        $row['confession_relg'] = $row['confession_religieuse'] ?? null;
        $row['password'] = Hash::make('password');
        $row['type'] = 1;
        $row['statut'] = 1;

        return User::create($row);
    }
}
