<?php

namespace Api\Models;

use Api\config\Database;
use Api\Models\Status;

class ApiKeys
{

    private Database $database;

    public string $key;

    public function __construct(string $key,Database $database)
    {
        $this->key = $key;
        $this->database = $database;
    }

    public function isExist()
    {

        try {

            $params = [
                ':apikey' => securityInput($this->key),
            ];
           $apiKey = $this->database->query('SELECT * FROM api_keys WHERE api_key = :apikey',$params);
            return $apiKey;

        } catch (\Throwable $th) {
            return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
        }
    }
}
