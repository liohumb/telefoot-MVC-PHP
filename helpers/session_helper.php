<?php
if (!isset($_SESSION)) {
    session_start();
}

function flash($name = '', $message = '', $class = 'form__instruction'): void
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : $class;

            echo '<span class="'.$class.'">'.$_SESSION[$name].'</span>';

            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}

function redirect($location): void
{
    header('location: '.$location);
    exit();
}