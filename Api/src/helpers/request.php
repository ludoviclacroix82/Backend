<?php

function createJson($data)
{

    try {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        header('Content-Type: application/json');

        return $json;
    } catch (\Throwable $th) {
        $reponse = [
            'status' => '500',
            'message' => 'Internal Server Error',
        ];
        return $reponse;
    }
}
