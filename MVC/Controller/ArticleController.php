<?php

declare(strict_types=1);

class ArticleController
{

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // TODO: prepare the database connection
        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        // TODO: fetch all articles as $rawArticles (as a simple array)
        $rawArticles = getAllArticles();

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article(
                $rawArticle['id'],
                $rawArticle['title'],
                $rawArticle['description'],
                $rawArticle['publish_date'],
                $rawArticle['Image']
            );
        }
        return $articles;
    }

    public function show( int $id)
    {
        // Load all required data
        $article = $this->getArticle($id);

        // Load the view
        require 'View/articles/show.php';
    }

    private function getArticle(int $id)
    {
        $articleData = getArticlesID($id);

        if ($articleData) {
            $article = new Article(
                intval($articleData[0]['id']),
                $articleData[0]['title'],
                $articleData[0]['description'],
                $articleData[0]['publish_date'],
                $articleData[0]['Image']
            );

            return $article;
        }
    }
}
