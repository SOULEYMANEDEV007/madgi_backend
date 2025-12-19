<?php

function numberToWords($num)
{
    $ones = array(
        0 => "zéro", 1 => "un", 2 => "deux", 3 => "trois", 4 => "quatre",
        5 => "cinq", 6 => "six", 7 => "sept", 8 => "huit", 9 => "neuf",
        10 => "dix", 11 => "onze", 12 => "douze", 13 => "treize",
        14 => "quatorze", 15 => "quinze", 16 => "seize", 17 => "dix-sept",
        18 => "dix-huit", 19 => "dix-neuf"
    );

    $tens = array(
        2 => "vingt", 3 => "trente", 4 => "quarante",
        5 => "cinquante", 6 => "soixante", 7 => "soixante-dix",
        8 => "quatre-vingt", 9 => "quatre-vingt-dix"
    );

    if ($num < 20) {
        return $ones[$num];
    } elseif ($num < 100) {
        if ($num % 10 == 0) {
            return $tens[intval($num / 10)];
        } elseif ($num < 70 || ($num >= 80 && $num < 100)) {
            return $tens[intval($num / 10)] . ($num % 10 == 1 ? "-et-" : "-") . $ones[$num % 10];
        } else {
            return "soixante-" . $ones[$num % 20];
        }
    } else {
        return $num;
    }
}
