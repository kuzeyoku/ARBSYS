<?php

use Illuminate\Support\Facades\Session;

class GlobalFunction
{

    public static function getPersonTypeId($person)
    {
        switch ($person->getTable()) {
            case "people":
                return 1;
                break;
            case "lawyers":
                return 2;
                break;
            case "companies":
                return 3;
                break;
            default:
                return 0;
                break;
        }
    }

    public static function format($number)
    {
        return "&#8378;" . number_format((float)$number, 2, ',', '.');
        // Tl olarak gozuksun istenirse ustteki kod basina // getirilsin alttaki koddaki // kaldirilsin.
        // return number_format((float)$number, 2, ',', '.') . " TL";
    }

    public static function encrypt($data)
    {
        return openssl_encrypt($data, "AES-128-ECB", config("app.key"));
    }

    public static function decrypt($data)
    {
        return openssl_decrypt($data, "AES-128-ECB", config("app.key"));
    }

    public static function checkControl($key, $array)
    {
        if (!is_null($array)) {
            $array = json_decode($array, true);
            return in_array($key, $array);
        } else {
            return false;
        }
    }

    public static function sessionFlash($type, $action)
    {
        switch ($type) {
            case "success":
                Session::flash("message.status", "success");
                switch ($action) {
                    case "store":
                        $store = Session::flash("message.content", "Kayıt ekleme işlemi başarıyla gerçekleşmiştir.");
                        return $store;
                        break;
                    case "update":
                        $update = Session::flash("message.content", "Kayıt güncelleme işlemi başarıyla gerçekleşmiştir.");
                        return $update;
                        break;
                    case "destroy":
                        $destroy = Session::flash("message.content", "Kayıt silme işlemi başarıyla gerçekleşmiştir.");
                        return $destroy;
                        break;
                }
                break;
            case "error":
                Session::flash("message.status", "error");
                switch ($action) {
                    case "store":
                        $store = Session::flash("message.content", "Kayıt ekleme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $store;
                        break;
                    case "update":
                        $update = Session::flash("message.content", "Kayıt güncelleme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $update;
                        break;
                    case "destroy":
                        $destroy = Session::flash("message.content", "Kayıt silme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $destroy;
                        break;
                }
                break;
            case "info":
                Session::flash("message.status", "info");
                switch ($action) {
                    case "not_active":
                        $store = Session::flash("message.content", "Bilgileriniz inceleniyor. Yönetici tarafından onaylandığında hesabınız aktif edilecektir.");
                        return $store;
                        break;
                }
                break;
            default:
                return false;
                break;
        }
    }

    public static function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    public static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        rmdir($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    // public static function convertToLowerCase($e)
    // {
    //     $r = $e;
    //     $r = str_replace("A", "a", $r);
    //     $r = str_replace("B", "b", $r);
    //     $r = str_replace("C", "c", $r);
    //     $r = str_replace("Ç", "ç", $r);
    //     $r = str_replace("D", "d", $r);
    //     $r = str_replace("E", "e", $r);
    //     $r = str_replace("F", "f", $r);
    //     $r = str_replace("G", "g", $r);
    //     $r = str_replace("Ğ", "ğ", $r);
    //     $r = str_replace("H", "h", $r);
    //     $r = str_replace("İ", "i", $r);
    //     $r = str_replace("I", "ı", $r);
    //     $r = str_replace("J", "j", $r);
    //     $r = str_replace("K", "k", $r);
    //     $r = str_replace("L", "l", $r);
    //     $r = str_replace("M", "m", $r);
    //     $r = str_replace("N", "n", $r);
    //     $r = str_replace("O", "o", $r);
    //     $r = str_replace("Ö", "ö", $r);
    //     $r = str_replace("P", "p", $r);
    //     $r = str_replace("R", "r", $r);
    //     $r = str_replace("S", "s", $r);
    //     $r = str_replace("Ş", "ş", $r);
    //     $r = str_replace("T", "t", $r);
    //     $r = str_replace("U", "u", $r);
    //     $r = str_replace("Ü", "ü", $r);
    //     $r = str_replace("V", "v", $r);
    //     $r = str_replace("Y", "y", $r);
    //     $r = str_replace("Z", "z", $r);
    //     return $r;
    // }

    // public static function convertToUpperCase($e)
    // {
    //     $r = $e;
    //     $r = str_replace("a", "A", $r);
    //     $r = str_replace("b", "B", $r);
    //     $r = str_replace("c", "C", $r);
    //     $r = str_replace("ç", "Ç", $r);
    //     $r = str_replace("d", "D", $r);
    //     $r = str_replace("e", "E", $r);
    //     $r = str_replace("f", "F", $r);
    //     $r = str_replace("g", "G", $r);
    //     $r = str_replace("ğ", "Ğ", $r);
    //     $r = str_replace("h", "H", $r);
    //     $r = str_replace("i", "İ", $r);
    //     $r = str_replace("ı", "I", $r);
    //     $r = str_replace("j", "J", $r);
    //     $r = str_replace("k", "K", $r);
    //     $r = str_replace("l", "L", $r);
    //     $r = str_replace("m", "M", $r);
    //     $r = str_replace("n", "N", $r);
    //     $r = str_replace("o", "O", $r);
    //     $r = str_replace("ö", "Ö", $r);
    //     $r = str_replace("p", "P", $r);
    //     $r = str_replace("r", "R", $r);
    //     $r = str_replace("s", "S", $r);
    //     $r = str_replace("ş", "Ş", $r);
    //     $r = str_replace("t", "T", $r);
    //     $r = str_replace("u", "U", $r);
    //     $r = str_replace("ü", "Ü", $r);
    //     $r = str_replace("v", "V", $r);
    //     $r = str_replace("y", "Y", $r);
    //     $r = str_replace("z", "Z", $r);
    //     return $r;
    // }

    // public static function convertToTitleCase($e)
    // {
    //     $keywords = explode(' ', $e);
    //     $value = "";
    //     foreach ($keywords as $keyword) {
    //         $secondKeywords = explode('/', $keyword);
    //         if (is_array($secondKeywords) && count($secondKeywords) > 1) {
    //             foreach ($secondKeywords as $key => $secondKeyword) {
    //                 $value .= self::convertToUpperCase(mb_substr($secondKeyword, 0, 1, "UTF-8")) . self::convertToLowerCase(mb_substr($secondKeyword, 1, strlen($secondKeyword), "UTF-8"));
    //                 if ((count($secondKeywords) - 1) != $key) {
    //                     $value .= "/";
    //                 }
    //             }
    //             $value .= " ";
    //         } else {
    //             $value .= self::convertToUpperCase(mb_substr($keyword, 0, 1, "UTF-8")) . self::convertToLowerCase(mb_substr($keyword, 1, strlen($keyword), "UTF-8")) . " ";
    //         }
    //     }
    //     return $value;
    // }
}
