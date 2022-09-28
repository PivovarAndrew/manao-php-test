<?php

if (!isset($_SESSION)) {
    session_start();
}

function flash($type = 'common', $name = '', $message = '', $class = 'flash')
{
    $FLASHES_NAME = "flashes";
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$FLASHES_NAME][$type][$name])) {
            $_SESSION[$FLASHES_NAME][$type][$name] = $message;
            $_SESSION[$FLASHES_NAME][$type][$name . '_class'] = $class;
        } else if (empty($message) && !empty($_SESSION[$FLASHES_NAME][$type][$name])) {
            $class = !empty($_SESSION[$FLASHES_NAME][$type][$name . '_class']) ?
                $_SESSION[$FLASHES_NAME][$type][$name . '_class'] : $class;
            echo '<div class="' . $class . '" >' . $_SESSION[$FLASHES_NAME][$type][$name] . '</div>';
            unset($_SESSION[$FLASHES_NAME][$type][$name]);
            unset($_SESSION[$FLASHES_NAME][$type][$name . '_class']);
            unset($_SESSION[$type . "_" . $name . '_value']);
        }
    }
}

function redirect($location)
{
    header('Location:' . $location);
}
