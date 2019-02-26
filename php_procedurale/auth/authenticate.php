<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_connected() : bool
{
    return !empty($_SESSION['connected']['id']);
}

function is_not_connected() : void
{
    if (!is_connected()) {
        redirect_to("/login.php");
    }
}