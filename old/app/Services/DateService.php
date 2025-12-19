<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
    public function generateFormattedDates($start, $end)
    {
        $dates = [];
        $currentDate = $start->copy();

        while ($currentDate->lte($end)) {
            $dates[] = $currentDate->translatedFormat('l d');
            $currentDate->addDay();
        }

        if (count($dates) > 2) {
            $formattedDates = implode(', ', array_slice($dates, 1, -1));
            $formattedDates = "le " . $dates[0] . ', ' . $formattedDates . " et le " . end($dates) . ' ' . $end->translatedFormat('F Y');
        } elseif (count($dates) == 2) {
            $formattedDates = "le " . $dates[0] . " et le " . end($dates) . ' ' . $end->translatedFormat('F Y');
        } else {
            $formattedDates = "le " . $dates[0] . ' ' . $end->translatedFormat('F Y');
        }

        return $formattedDates;
    }

    public function generateFormattedDate($date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $formattedDate = $date->translatedFormat('l j F Y');
        return $formattedDate;
    }

    public function generateFormattedDate1($date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $formattedDate = $date->translatedFormat('j F Y');
        return $formattedDate;
    }
}
