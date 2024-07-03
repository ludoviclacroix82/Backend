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

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;

$router = routing();

// Load the controller
// It will *control* the rest of the work to load the page
switch ($router) {
    case 'articles':
        // This is shorthand for:
        // $articleController = new ArticleController;
        // $articleController->index();
        (new ArticleController())->index();
        break;

    case 'articles/show':
        $id = $_GET['id'];
        (new ArticleController())->show(intval($id));
        break;

    case 'author':
        $id = $_GET['id'];
        (new AuthorController())->index(intval($id));
        break;

    case 'home':
    default:
        (new HomepageController())->index();
        break;
}
