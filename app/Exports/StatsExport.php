<?php

namespace App\Exports;

use App\Models\Emargement;
use App\Models\Parametre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatsExport implements FromCollection, WithHeadings
{
    public $start;
    public $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = new Collection([]);
        foreach (User::orderBy('nom', 'asc')->get() as $key => $value) {
            $startOfWeek = Carbon::parse($this->start);
            $endOfWeek = Carbon::parse($this->end);
            $clause = [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')];
            $register = 0;
            $emargements = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->get();
            foreach ($emargements as $emargement) {
                if($emargement->heure_arrive && $emargement->heure_depart) {
                    $heure_arrive = Carbon::parse($emargement->heure_arrive);
                    $heure_depart = Carbon::parse($emargement->heure_depart);
                    $register += $heure_depart->diffInHours($heure_arrive);
                }
            }
            $parametre = Parametre::whereSlug('heure_arrive')->first();
            $later = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->where('heure_arrive', '>', $parametre->value)->count();
            $absences = 0;
            for ($day = $startOfWeek->copy(); $day->lte($endOfWeek); $day->addDay()) {
                $check = Emargement::whereDate('date', $day->format('Y-m-d'))->exists();
                $registration = Emargement::whereUserId($value->id)->whereDate('date', $day->format('Y-m-d'))->exists();
                if ($check && !$registration) $absences++;
            }

            $data = [
                $value->nom,
                $register,
                $later,
                $absences,
                $startOfWeek->format('d-m-Y') . ' au ' . $endOfWeek->format('d-m-Y'),
            ];
            $collections->push($data);
        }

        return $collections;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nom & prénoms',
            'Nb(heure). travail',
            'Nb. retard',
            'Nb. absence',
            'Semaine du',
        ];
    }
}
