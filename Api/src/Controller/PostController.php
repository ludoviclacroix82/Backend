<?php

namespace Api\Controller;

use Api\config\Database;
use Api\Models\Posts;
use Api\Models\Status;

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
                $responce = (new Status(200, 'OK', $datas))->status(200, 'OK', $datas);
                return $responce;
                exit;
            } else {
                $responce = (new Status(404, 'no posts found', null))->status(404, 'no posts found', null);
                return $responce;
                exit;
            }
        } catch (\Throwable $th) {
            $responce = (new Status(404, 'no found'))->status(404, 'no found');
            return $responce;
            exit;
        }
    }

    public function getPost($id)
    {

        $responce = [];
        $params = [];
        try {

            $params = [
                ':id' => securityInput($id),
            ];

            $postsData = $this->database->query('SELECT * FROM posts WHERE id = :id', $params);
            $datas = Posts::loadData($postsData); //demande a Pierre si pas d'autre solution que static

            if ($datas) {
                $responce = (new Status(200, 'OK', $datas))->status(200, 'OK', $datas);
                return $responce;
                exit;
            } else {
                $responce = (new Status(404, 'no posts found'))->status(404, 'no posts found');
                return $responce;
                exit;
            }
        } catch (\Throwable $th) {
            $responce = (new Status(404, 'no posts found'))->status(404, 'no posts found');
            return $responce;
            exit;
        }
    }

    public function postPost()
    {
        try {

            $params = Posts::dataBodyInsert();
            $postInsert = $this->database->query(
                'INSERT INTO posts(
                    title, 
                    body, 
                    author, 
                    created_at, 
                    updated_at) 
                VALUES (
                    :title, 
                    :body, 
                    :author, 
                    :created_at, 
                    :updated_at)',
                $params
            );

            $responce = (new Status(201, 'Created', $params))->status(201, 'Created', $params);
            return $responce;
            exit;
        } catch (\Throwable $th) {
            $responce = (new Status(400, 'Bad Request'))->status(201, 'Created');
            return $responce;
            exit;
        }
    }

    public function putPost($id)
    {
        $id = securityInput($id);
        try {

            $postExist = $this->postExist($id);

            $params = Posts::dataBodyUpdate($id);

            if ($postExist) {

                try {

                    $postUpdate = $this->database->query(
                        'UPDATE posts 
                        SET ' .  $params['updateParams'] . '
                        WHERE id = :id',
                        $params['params']
                    );
                    $responce = (new Status(201, 'Update', $params['params']))->status(201, 'Update', $params['params']);
                    return $responce;
                    exit;
                } catch (\Throwable $th) {
                    $responce = (new Status(400, 'Bad request'))->status(400, 'Bad request');
                    return $responce;
                    exit;
                }
            } else {
                $responce = (new Status(404, 'Post no found'))->status(404, 'Post no found');
                return $responce;
                exit;
            }
        } catch (\Throwable $th) {
            $responce = (new Status(400, 'Bad request'))->status(400, 'Bad request');
            return $responce;
            exit;
        }
    }

    public function deletePost($id)
    {
        try {
            $postExist = $this->postExist($id);
            if ($postExist) {

                $params = [
                    ':id' => securityInput($id),
                ];

                $postDelete  = $this->database->query(
                    'DELETE 
                    FROM posts
                    WHERE id=:id',
                    $params
                );
                $responce = (new Status(201, 'Delete', $params))->status(201, 'Delete', $params);
                return $responce;

            } else {
                $responce = (new Status(404, 'Post no found'))->status(404, 'Post no found');
                return $responce;
                exit;
            }
        } catch (\Throwable $th) {
            $responce = (new Status(400, 'Bad request'))->status(400, 'Bad request');
            return $responce;
            exit;
        }
    }

    public function postExist($id)
    {
        //Ckeck si le post exist
        $paramsCheck = [
            ':id' => securityInput($id),
        ];
        $postExist =  $postsData = $this->database->query('SELECT * FROM posts WHERE id = :id', $paramsCheck);

        return $postExist;
    }
}
