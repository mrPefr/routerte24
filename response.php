<?php

class Res
{

    public static function debug($var)
    {

        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    public static function json($var)
    {
        header("Content-Type:application/json");
        echo json_encode($var);
    }

    public static function redirect_error($path, $error=""){

        header("Location:$path?error=$error");

    }
    public static function redirect($path, $mes=""){

        header("Location:$path?message=$mes");

    }



}
