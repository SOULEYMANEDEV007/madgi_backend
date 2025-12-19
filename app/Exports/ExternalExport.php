<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExternalExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $date = Carbon::now();
        $ageDate = $this->request->age ? $date->subYears($this->request->age)->format('Y') : null;
        $ancienneteDate = $this->request->anciennete ? $date->subYears($this->request->anciennete)->startOfYear()->format('Y-m-d') : null;
        $ancienneteDate1 = $this->request->anciennete1 ? $date->subYears($this->request->anciennete1)->format('Y') : null;

        $query = (new User)->newQuery();
        if ($this->request->has('nom') && $this->request->nom != '') $query->where('nom', 'like', '%' . $this->request->nom . '%');
        if ($this->request->has('statut') && $this->request->statut != '') $query->where('statut_mad', $this->request->statut);
        if ($this->request->has('contact') && $this->request->contact != '') $query->where('tel', 'like', '%' . $this->request->contact . '%');
        if ($this->request->has('matricule') && $this->request->matricule != '') $query->where('matricule', $this->request->matricule);
        if ($this->request->has('service') && $this->request->service != '') $query->where('service', 'like', '%' . $this->request->service . '%');
        if ($this->request->has('age') && $this->request->age != '') $query->orWhereYear('date_naissance', $ageDate);
        // if ($this->request->has('grade') && $this->request->grade != '') foreach ($this->request->grade as $value) $query->where('grade', $value)->orWhere('grade', $value);
        if ($this->request->has('anciennete') && $this->request->anciennete != '') $query->where('date_entre_mad', '<=', $ancienneteDate);
        if ($this->request->has('anciennete1') && $this->request->anciennete1 != '') $query->whereYear('date_entre_mad', $ancienneteDate1);
        if ($this->request->has('genre') && $this->request->genre != '') $query->where('genre', $this->request->genre);
        if ($this->request->has('fonction') && $this->request->fonction != '') $query->where('fonction', 'like', '%' . $this->request->fonction . '%');
        if ($this->request->has('site') && $this->request->site != '') $query->where('site', 'like', '%' . $this->request->site . '%');
        if ($this->request->has('departement') && $this->request->departement != '') $query->where('departement', 'like', '%' . $this->request->departement . '%');
        $type = $this->request->type;
        $data = $query->where('is_salarie', 3)
                        ->where('statut', $type == 'disable' ? 0 : 1)
                        ->orderBy('nom', 'asc');

        return $data;
    }

    public function map($user): array
    {
        $now = date('Y-m-d');
        $dat1 = new DateTime($now);
        $dat2 = new DateTime($user->date_naissance);
        $dif = $dat1->diff($dat2);

        $dat3 = new DateTime($now);
        $dat4 = new DateTime($user->date_entre_mad);
        $dif1 = $dat3->diff($dat4);

        return [
            $user->nom,
            $user->matricule,
            $user->tel,
            $user->Sit ? $user->Sit?->name : '',
            $user->fonction,
            $user->serv ? $user->serv?->name : '',
            $dif->y,
            $user->date_entre_mad,
            $dif1->y,
            $user->grad ? $user->grad?->name : '',
            $user->genre,
            $user->statut_mad,
            $user->date_occupation_p,
            $user->situation_matrim,
            $user->date_naissance,
            $user->depart->name ?? '',
            $user->diplome,
            $user->nombre_enfant,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            "Nom complet",
            "Matricule",
            "Téléphone",
            "Site",
            "Fonction",
            "Service",
            "AGE",
            "Date d'entrée",
            "Ancienneté",
            "Grade",
            "Genre",
            "Statut",
            "Date d occupations",
            "Situation matrimoniale",
            "Date de naissance",
            "Département",
            "Diplôme",
            "NBR enfants"
        ];
    }
}
