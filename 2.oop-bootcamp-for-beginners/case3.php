<?php

declare(strict_types=1);

class Element
{

    private string $types;

    public function __construct(string $types)
    {
        $this->types = $types;
    }

    public function getTypes() :string
    {
        return $this->types;
    }
}

class Content extends Element
{

    private string $title;
    private string $text;

    public function __construct(string $title, string $text, string $types)
    {
        parent::__construct($types);
        $this->title = $title;
        $this->text = $text;
    }

    private function getArticles() :array
    {
        return [
            'title' => $this->title,
            'text' => $this->text
        ];
    }
    private function getAds() :array
    {
        return [
            'title' => strtoupper($this->title),
            'text' => $this->text
        ];
    }
    private function getVacancies() : array
    {
        return [
            'title' => $this->title,
            'text' => "{$this->text} - apply now!"
        ];
    }

    public function getElement() :array
    {
        // replce un switch

        $typeMethods = [
            'Ads' => 'getAds',
            'Vacancies' => 'getVacancies',
            'Articles' => 'getArticles'
        ];

        $type = $this->getTypes();

        if (array_key_exists($type, $typeMethods)) {
            $method = $typeMethods[$type];
            return $this->$method();
        }
    }
}

$elements = [
    ['types' => 'Articles', 'title' => 'Article 1', 'text' => 'Text Article 1'],
    ['types' => 'Articles', 'title' => 'Article 2', 'text' => 'Text Article 2'],
    ['types' => 'Ads', 'title' => 'Ads 1', 'text' => 'Text Ads 1'],
    ['types' => 'Vacancies', 'title' => 'Vacancies 1', 'text' => 'Text Vacancies 1'],
];

// Filtrer les index des éléments ayant 'types' égal à 'Articles'
$articleIndexes = array_keys(array_filter($elements, function($element) {
    return $element['types'] === 'Articles';
}));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas 3</title>
    <style>
        article {
            width: 300px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <main>
        <section>
            <?php
            $cpt = 0;
            foreach ($elements as $element) :
                $elementClass = new Content($element['title'], $element['text'], $element['types']);
                $showElementClass = $elementClass->getElement();
            ?>
                <article>
                    <?php $brekingNews = ($cpt === min($articleIndexes))?'BREAKING : ':''; ?>
                    <h2><?= $brekingNews.$showElementClass['title'] ?></h2>
                    <p><?= $showElementClass['text'] ?></p>
                </article>
            <?php 
                $cpt++;
                endforeach; 
            ?>
        </section>
    </main>
</body>

</html>