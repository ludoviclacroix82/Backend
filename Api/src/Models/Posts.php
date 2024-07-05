<?php

namespace Api\Models;

class Posts
{
    public int $id;
    public string $title;
    public string $body;
    public string $author;
    public $createdAt;
    public $updated_at;

    public function __construct(int $id, string $title, string $body, string $author, $createdAt, $updated_at)
    {

        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->updated_at = $updated_at;
    }

    public static function loadData($postsData){
        $datas = [];

        foreach ($postsData as $post) {
            $datas[] = new self(
                $post['id'],
                $post['title'],
                $post['body'],
                $post['author'],
                $post['created_at'],
                $post['updated_at']
            );
        }
        return $datas ;
    }
}
