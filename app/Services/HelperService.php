<?php

namespace App\Services;

class HelperService
{
    public static function numberToText($number)
    {
        $list = array(
            "sıfır",
            "bir",
            "iki",
            "üç",
            "dört",
            "beş",
            "altı",
            "yedi",
            "sekiz",
            "dokuz",
            "on",
            "onbir",
            "oniki",
            "onüç",
            "ondört",
            "onbeş",
            "onaltı",
            "onyedi",
            "onsekiz",
            "ondokuz",
            "yirmi",
        );

        return $list[$number];
    }

    public static function clear($keyword)
    {
        return trim(preg_replace('/\s+/', ' ', $keyword));
    }

    public static function nameFormat($name)
    {
        return ucwords(mb_strtolower($name));
    }

    public static function addressFormat($address)
    {
        $address = ucwords(mb_strtolower($address));
        $address = explode("/", $address);
        $end = count($address) - 1;
        $address[$end] = strtoupper($address[$end]);
        return implode("/", $address) ?? null;
    }

    public static function numberToOrdinal($number)
    {
        $number = (int) $number;

        if ($number % 100 >= 10 && $number % 100 <= 20) {
            $ordinal = '.nci';
        } else {
            switch ($number % 10) {
                case 1:
                    $ordinal = '.inci';
                    break;
                case 2:
                    $ordinal = '.nci';
                    break;
                case 3:
                    $ordinal = '.üncü';
                    break;
                default:
                    $ordinal = '.nci';
                    break;
            }
        }

        return $number . $ordinal;
    }
}
