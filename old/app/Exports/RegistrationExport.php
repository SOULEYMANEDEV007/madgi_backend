<?php

namespace App\Exports;

use App\Models\Emargement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationExport implements FromCollection, WithHeadings
{
    public $date;

    public function __construct($date)
    {
        $this->date = $date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->date != 'null') {
            $date = Carbon::parse($this->date);
            return Emargement::where('date', $date->format('Y/m/d'))->get(['matricule', 'heure_arrive', 'date', 'type_device', 'statut', 'observation', /*'observation_depart',*/ 'device_depart']);
        }
        else
            return Emargement::all(['matricule', 'heure_arrive', 'date', 'type_device', 'statut', 'observation', /*'observation_depart',*/ 'device_depart']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Matricule',
            'Heure d\'arrive',
            'Date',
            'Type de device',
            'Statut',
            'Observation',
            // 'Observation de depart',
            'Device depart',
        ];
    }
}
