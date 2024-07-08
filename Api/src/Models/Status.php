<?php

namespace Api\Models;

class Status
{

    private int $status;
    private string $message;
    private ?array $params;


    public function __construct(int $status, string $message, ?array $params = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->params = $params;
    }

    public function status(int $status, string $message, ?array $params = null){

        if($this->params != null){
            $responce = [
                'status' => $this->status,
                'message' => $this->message,
                'params' => $this->params
            ];
        }else{
            $responce = [
                'status' => $this->status,
                'message' => $this->message,
            ];
        }

        $jsonType = createJson($responce);
        return $jsonType;
    }
}
