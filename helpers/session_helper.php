<?php

if (!isset($_SESSION)) {
    session_start();
}

function flash($name = '', $message = '', $class = 'flash')
{
    $FLASHES_NAME = "flashes";
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$FLASHES_NAME][$name])) {
            $_SESSION[$FLASHES_NAME][$name] = $message;
            $_SESSION[$FLASHES_NAME][$name . '_class'] = $class;
        } else if (empty($message) && !empty($_SESSION[$FLASHES_NAME][$name])) {
            $class = !empty($_SESSION[$FLASHES_NAME][$name . '_class']) ?
                $_SESSION[$FLASHES_NAME][$name . '_class'] : $class;
            echo '<div class="' . $class . '" >' . $_SESSION[$FLASHES_NAME][$name] . '</div>';
            unset($_SESSION[$FLASHES_NAME][$name]);
            unset($_SESSION[$FLASHES_NAME][$name . '_class']);
            unset($_SESSION[$name . '_value']);
        }
    }
}

function redirect($location)
{
    header('Location:' . $location);
    die();
}
