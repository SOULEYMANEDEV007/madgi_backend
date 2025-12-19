<?php
namespace App\Exports;

use App\Models\User;
use App\Models\UserLeave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatsLeaveExport implements FromCollection, WithHeadings
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
        $collections = collect([]);
        $users = User::where('nom', '!=', 'Admin Tablette')->orderBy('nom', 'asc')->get();

        $years = UserLeave::whereIn('user_id', $users->pluck('id'))
                          ->distinct('year')
                          ->pluck('year')
                          ->sort()
                          ->toArray();

        foreach ($users as $user) {
            $total = UserLeave::whereUserId($user->id)->get();

            $data = [
                $user->nom,
                $total->sum('value') ?? 0,
                $total->sum('nb_use') ?? 0,
                $total->sum('value') - $total->sum('nb_use'),
            ];

            foreach ($years as $year) {
                $userLeaveForYear = $total->where('year', $year)->first();
                $data[] = $userLeaveForYear ? $userLeaveForYear->value : 0;
            }

            $collections->push($data);
        }

        return $collections;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $heads = [
            'Nom & prénoms',
            'Nb(jours). total',
            'Nb. utilisé',
            'Nb. restant',
        ];

        $years = UserLeave::distinct('year')->pluck('year')->sort()->toArray();

        return array_merge($heads, $years);
    }
}
