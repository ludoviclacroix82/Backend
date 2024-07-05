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
        $postController = new Postcontroller($db);

       $posts = $postController->getPosts();
       echo $posts;
       exit;
    });    
    $router->get('/post/:id', function ($id) {
        $db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
        $postController = new Postcontroller($db);

       $post = $postController->getPost($id);
       echo $post;
       exit;
    }); 

    $router->run();
} catch (Exception $e) {
    echo "{$e->getCode()} - {$e->getMessage()}";
}
