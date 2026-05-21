<?php

if (!isset($_SESSION["user"]["name"])) {
    header('Location: /login');
    exit;
}