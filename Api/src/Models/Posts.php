<?php

namespace Api\Models;

class Posts
{
    public int $id;
    public string $title;
    public string $body;
    public string $author;
    public $createdAt;
    public $updated_at;

    public function __construct(int $id, string $title, string $body, string $author, $createdAt, $updated_at)
    {

        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->updated_at = $updated_at;
    }

    public static function loadData($postsData)
    {
        $datas = [];

        foreach ($postsData as $post) {
            $datas[] = new self(
                $post['id'],
                $post['title'],
                $post['body'],
                $post['author'],
                $post['created_at'],
                $post['updated_at']
            );
        }
        return $datas ;
    }

    public static function dataBodyInsert()
    {

            $bodydata = [];
            $bodydata = file_get_contents('php://input');
            $bodyDatas = json_decode($bodydata, true);

            $params = [
                ':title' => securityInput($bodyDatas['title']),
                ':body' => securityInput($bodyDatas['body']),
                ':author' => securityInput($bodyDatas['author']),
                ':created_at' => dates('Y-m-d h:i:s'),
                ':updated_at' => dates('Y-m-d h:i:s')
            ];

            return $params;
    }

    public static function dataBodyUpdate( int $id)
    {

        $bodydata = [];
        $params = [];
        $paramsBody = [];
        $bodydata = file_get_contents('php://input');
        $bodyDatas = json_decode($bodydata, true);

        foreach ($bodyDatas as $key => $value) {
            $paramsBody[":{$key}"] = securityInput($value);
        }

        $updateParams = ''; // recuperation pour le SET de sql via les params en body ex: title = : title     

        foreach ($paramsBody as $key => $value) {
            $field = str_replace(':','',$key);
            $updateParams .= "{$field} = {$key}, ";                
        }

        $updateParams .= 'updated_at = :updated_at '; // ajout updated a data pour le SET SQL

        $paramsNoBody =  [
            ':id' => securityInput(intval($id)),
            ':updated_at' => dates('Y-m-d h:i:s')
        ];

        $params = array_merge($paramsBody,$paramsNoBody);

        return [
            'params' => $params ,
            'updateParams' => $updateParams,
        ];          
    }
}
