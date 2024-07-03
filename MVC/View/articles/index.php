<?php require 'View/includes/header.php' ?>

<?php 
    $articlesList = [];
    foreach ($articles as $article) {

        $articleData = [
            'id' => $article->id,
            'title' => $article->title,
            'publishDate' => $article->formatPublishDate(),
        ];
        array_push($articlesList, $articleData);
    }
?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articlesList as $article) : ?>
            <li>
                <a href="articles/show?id=<?= $article['id'] ?>">
                    <?= $article['title'] ?> (<?= $article['publishDate']?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php' ?>