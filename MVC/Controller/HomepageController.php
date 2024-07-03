<?php
declare(strict_types = 1);

class HomepageController
{
    private static $limit = 2 ;

    public function index()
    {

        // Usually, any required data is prepared here
        // For the home, we don't need to load anything
        $articles = $this->getArticles();
        // Load the view
        require 'View/home.php';
    }
    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // TODO: prepare the database connection
        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        // TODO: fetch all articles as $rawArticles (as a simple array)
        $rawArticles = getAllArticlesLimited(self::$limit);

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
        }
        return $articles;
    }
}