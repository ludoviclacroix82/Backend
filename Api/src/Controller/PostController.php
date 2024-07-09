<?php

namespace Api\Controller;

use Api\config\Database;
use Api\Models\Posts;
use Api\Models\Status;
use Api\Models\ApiKeys;

class Postcontroller
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getPosts($key)
    {
        $response = [];
        $datas = [];

        try {
            $apiKeyExist = (new ApiKeys($key, $this->database))->isExist($key);

            if ($apiKeyExist) {
                $postsData = $this->database->query('SELECT * FROM posts');
                $datas = Posts::loadData($postsData);
                //demande a Pierre si pas d'autre solution qu'une method static
                // probleme :: (new Posts( "demande les 6 params ???))->loadData($postsData);

                if ($datas) {
                    return (new Status(200, 'OK', $datas))->status(200, 'OK', $datas);
                } else {
                    return (new Status(404, 'no posts found', null))->status(404, 'no posts found', null);
                }
            } else {
                return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
            }
        } catch (\Throwable $th) {
            return (new Status(404, 'no found'))->status(404, 'no found');


            print_r($th);
        }
    }

    public function getPost($id, $key)
    {

        $response = [];
        $params = [];
        try {

            $apiKeyExist = (new ApiKeys($key, $this->database))->isExist($key);

            if ($apiKeyExist) {

                $params = [
                    ':id' => securityInput($id),
                ];

                $postsData = $this->database->query('SELECT * FROM posts WHERE id = :id', $params);
                $datas = Posts::loadData($postsData); //demande a Pierre si pas d'autre solution que static

                if ($datas) {
                    return (new Status(200, 'OK', $datas))->status(200, 'OK', $datas);
                } else {
                    return (new Status(404, 'no posts found'))->status(404, 'no posts found');
                }
            } else {
                return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
            }
        } catch (\Throwable $th) {
            return (new Status(404, 'no posts found'))->status(404, 'no posts found');
        }
    }

    public function postPost($key)
    {
        try {
            $apiKeyExist = (new ApiKeys($key, $this->database))->isExist($key);

            if ($apiKeyExist) {
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

                return (new Status(201, 'Created', $params))->status(201, 'Created', $params);
            } else {
                return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
            }
        } catch (\Throwable $th) {
            return (new Status(400, 'Bad Request'))->status(400, 'Bad Request');
        }
    }

    public function putPost($id, $key)
    {

        try {

            $apiKeyExist = (new ApiKeys($key, $this->database))->isExist($key);

            if ($apiKeyExist) {

                $id = securityInput($id);

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
                        return (new Status(201, 'Update', $params['params']))->status(201, 'Update', $params['params']);
                    } catch (\Throwable $th) {
                        return (new Status(400, 'Bad request'))->status(400, 'Bad request');
                    }
                } else {
                    return (new Status(404, 'Post no found'))->status(404, 'Post no found');
                }
            } else {
                return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
            }
        } catch (\Throwable $th) {
            return (new Status(400, 'Bad request'))->status(400, 'Bad request');
        }
    }

    public function deletePost($id, $key)
    {
        try {

            $apiKeyExist = (new ApiKeys($key, $this->database))->isExist($key);

            if ($apiKeyExist) {
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
                    return (new Status(201, 'Delete', $params))->status(201, 'Delete', $params);
                } else {
                    return (new Status(404, 'Post no found'))->status(404, 'Post no found');
                }
            } else {
                return (new Status(400, 'Bad APi Keys'))->status(400, 'Bad APi Keys');
            }
        } catch (\Throwable $th) {
            return (new Status(400, 'Bad request'))->status(400, 'Bad request');
        }
    }

    public function postExist($id)
    {
        //Check si le post exist
        $paramsCheck = [
            ':id' => securityInput($id),
        ];
        $postExist =  $postsData = $this->database->query('SELECT * FROM posts WHERE id = :id', $paramsCheck);

        return $postExist;
    }
}
