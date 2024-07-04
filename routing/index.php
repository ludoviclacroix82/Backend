<?php
//include all your model files here
require 'Model/Article.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/ArticleController.php';
// include Helpers 
require_once 'helpers/Router.php';

$router = new Router;

$router->request('/', function () {
   (new HomepageController())->index();
});

$router->request('/articles', function () {
    (new ArticleController())->index();
});

$router->request('/articles/show', function () {
   (new ArticleController())->show();
});

$router->run($_SERVER['REQUEST_URI']);
echo $_SERVER['REQUEST_URI'];