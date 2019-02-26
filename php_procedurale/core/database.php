<?php
function db() : object
{
    $db = new PDO("mysql:host=localhost;dbname=OCPHP;character-set=utf-8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
}