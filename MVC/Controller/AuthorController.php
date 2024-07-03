<?php

declare(strict_types=1);

class AuthorController
{

    public function index(int $id)
    {
        $author = $this->getAuthor($id);
        // Load the view
        require 'View/author/index.php';
    }

    private function getAuthor(int $id)
    {
        $Author = getAuthor($id);

        if($Author){
            $author = new Author($Author[0]['id'],$Author[0]['name'],$Author[0]['lastname']);
            return $author;
        }
    }
}
