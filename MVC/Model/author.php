<?php

declare(strict_types=1);

class Author
{

    public int $id;
    public string $name;
    public ?string $lastName;

    public function __construct(int $id, string $name, string $lastName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getArticles()
    {
        $rawArticles = getArticleAuthorLink($this->id);       

        return $rawArticles;
    }
}
