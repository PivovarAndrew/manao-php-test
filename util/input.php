<?php

class Input
{
    public static function validateData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function rememberFields($post)
    {
        foreach ($post as $key => $value) {
            $_SESSION[$key . "_value"] = $value;
        }
    }
}
