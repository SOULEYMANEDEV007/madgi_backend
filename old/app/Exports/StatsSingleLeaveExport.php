<?php

namespace App\Exports;

use App\Models\Leave;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserLeave;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatsSingleLeaveExport implements FromCollection, WithHeadings
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = new Collection([]);
        $total = UserLeave::whereUserId($this->id)->orderBy('year', 'asc')->get();

        foreach ($total as $item) {
            $data = [
                $item->year,
                // $item->user->nom,
                $item->value,
                $item->nb_use,
                $item->value - $item->nb_use,
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
            'Années',
            // 'Nom & prénoms',
            'Nb(jours). total',
            'Nb. utilisé',
            'Nb. restant',
        ];
    }
}
