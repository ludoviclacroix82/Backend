<?php

use Api\Models\Status;

function createJson($data)
{

    try {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        header('Content-Type: application/json');

        return $json;
    } catch (\Throwable $th) {
        return (new Status(500, 'Internal Server Error'))->status(500, 'Internal Server Error');
    }
}

function dates($format){

    $timezone = date_default_timezone_get();
    date_default_timezone_set($timezone);

    $date = date($format);
    return $date;
}

function securityInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
