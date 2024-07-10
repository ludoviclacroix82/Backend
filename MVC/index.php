<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//include all your model files here
require 'Model/Article.php';
require 'Model/author.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/ArticleController.php';
require 'Controller/AuthorController.php';
// include Helpers 
require 'helpers/request.php';
require 'helpers/dbConnect.php';
require_once 'helpers/_Router.php';

try {

    $router = new Router;

    $router->get('/', function () {
        (new HomepageController())->index();
        exit;
    });

    $router->get('/articles', function () {
        (new ArticleController())->index();
        exit;
    });

    $router->get('/articles/show/:id', function ($id) {
        (new ArticleController())->show(intval($id));
        exit;
    });

    $router->get('/author/:id', function ($id) {
        (new AuthorController())->index(intval($id));
        exit;
    });

    $router->run();
    
} catch (Exception $e) {
    echo "{$e->getCode()} - {$e->getMessage()}";
}
