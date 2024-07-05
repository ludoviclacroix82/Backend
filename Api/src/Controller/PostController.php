<?php

namespace Api\Controller;

use Api\config\Database;
use Api\Models\Posts;

class Postcontroller
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getPosts()
    {
        $responce = [];
        $datas = [];
        try {
            $postsData = $this->database->query('SELECT * FROM posts');
            $datas = Posts::loadData($postsData); //demande a Pierre si pas d'autre solution qu'une method static

            if ($datas) {

               $responce = [
                    'status' => '200',
                    'message' => 'OK',
                    'data' => $datas
                ];

                $jsonType = createJson($responce);
                return $jsonType;
            } else {
               $responce = [
                    'status' => '404',
                    'message' => 'no posts found',
                ];

                $jsonType = createJson($responce);
                return $jsonType;
            }
        } catch (\Throwable $th) {
            $reponse = [
                'status' => '404',
                'message' => 'No found',
            ];

            return $reponse;
        }
    }

    public function getPost($id)
    {

        $responce = [];
        $params = [];
        try {

            $params = [
                ':id' => $id,
            ];

            $postsData = $this->database->query('SELECT * FROM posts WHERE id = :id', $params);
            $datas = Posts::loadData($postsData); //demande a Pierre si pas d'autre solution que static

            if ($datas) {

               $responce = [
                    'status' => '200',
                    'message' => 'OK',
                    'data' => $datas
                ];

                $jsonType = createJson($responce);
                return $jsonType;
            } else {
               $responce = [
                    'status' => '404',
                    'message' => 'Post no found',
                ];

                $jsonType = createJson($responce);
                return $jsonType;
            }
        } catch (\Throwable $th) {
           $responce = [
                'status' => '404',
                'message' => 'No found',
            ];

            $jsonType = createJson($responce);
            return $jsonType;
        }
    }
}
