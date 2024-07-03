<?php

declare(strict_types=1);

class Article
{

    public int $id;
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    public ?string $image;

    public function __construct(int $id, string $title, ?string $description, ?string $publishDate , ?string $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->image = $image;
    }

    public function formatPublishDate($format = 'D M Y')
    {
        $date = date_create($this->publishDate);
        return date_format($date, $format);
    }

    public function getPrevious()
    {

        $previousArticle = articlePagination($this->id,'prevous');
        return $previousArticle  ?$previousArticle  : null;
    }
    public function getNext()
    {

        $previousArticle = articlePagination($this->id,'next');
        return $previousArticle  ?$previousArticle  : null;
    }

    public function getAuthor(){
        $author = getAuthorArticleLink($this->id);
        return $author ? $author : null;
    }

}
