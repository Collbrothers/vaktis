<?php


if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'lifetime' => 0,
        'path' => '/',
        'secure' => false, // Will change depending on if we use HTTPS on prod.
        'samesite' => 'Strict'
    ]);

    session_start();
}