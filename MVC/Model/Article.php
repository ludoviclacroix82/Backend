<?php

declare(strict_types=1);

class Article
{

    public int $id;
    public string $title;
    public ?string $description;
    public ?string $publishDate;

    public function __construct(int $id, string $title, ?string $description, ?string $publishDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
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
}
