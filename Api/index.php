<?php
require_once 'vendor/autoload.php';

// Utilisation du Router
use Api\Routes\Router;
use Api\Controller\PostController;
use Api\config\Database;

require_once 'src/config/config.php';
require_once 'src/helpers/request.php';

try {    

    $router = new Router;
    $router->get('/posts', function () {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $posts = (new Postcontroller($db))->getPosts();
        print_r($posts);
        exit;
    });
    $router->get('/post/:id', function ($id) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->getPost($id);
        print_r($post);
        exit;
    });
    $router->post('/post', function () {

        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->postPost();
        print_r($post);
        exit;
    });

    $router->put('/post/:id', function ($id) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->putPost($id);
        print_r($post);
        exit;
    });

    $router->delete('/post/:id', function ($id) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $post = (new Postcontroller($db))->deletePost($id);
        print_r($post);
        exit;
    });

    $router->run();
} catch (Exception $e) {
    echo "{$e->getCode()} - {$e->getMessage()}";
}
