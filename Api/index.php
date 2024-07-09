<?php
require_once 'vendor/autoload.php';

// Utilisation du Router
use Api\Routes\Router;
use Api\Controller\PostController;
use Api\config\Database;

require_once 'src/config/config.php';
require_once 'src/helpers/request.php';

    $router = new Router;
    $router->get('/posts/:key', function ($key) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $posts = (new Postcontroller($db))->getPosts($key);
        print_r($posts);
        exit;
    });
    $router->get('/post/:id/:key', function ($id,$key) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->getPost($id,$key);
        print_r($post);
        exit;
    });
    $router->post('/post/:key', function ($key) {

        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->postPost($key);
        print_r($post);
        exit;
    });

    $router->put('/post/:id/:key', function ($id,$key) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->putPost($id,$key);
        print_r($post);
        exit;
    });

    $router->delete('/post/:id/:key', function ($id,$key) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->deletePost($id,$key);
        print_r($post);
        exit;
    });

    $router->run();

