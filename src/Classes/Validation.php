<?php


namespace App\Classes;

class Validation
{
    public static function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}