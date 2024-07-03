<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here 

if ($article) {

    $title = $article->title;
    $publishDate = $article->formatPublishDate();
    $description = $article->description;

    $idArticlePrevious = $article->getPrevious();
    $idArticleNext = $article->getNext();
    $author = $article->getAuthor();
}

?>

<section>
    <?php if ($article) : ?>
        <h1><?= $title ?>
            <a href="../author?id=<?= $author[0]['id'] ?>">
                <?= " - By {$author[0]['name']} - {$author[0]['lastname']}" ?>
            </a>
        </h1>
        <p><?= $publishDate ?></p>
        <p><?= $description ?></p>

        <?php // TODO: links to next and previous 
        ?>
        <?php if ($idArticlePrevious != null) : ?>
            <a href="./show?id=<?= $idArticlePrevious ?>">Previous article</a>
        <?php endif; ?>
        <?php if ($idArticleNext != null) : ?>
            <a href="./show?id=<?= $idArticleNext ?>">Next article</a>
        <?php endif; ?>
    <?php else : ?>
        <h3>No Found</h3>
    <?php endif; ?>

</section>

<?php require 'View/includes/footer.php' ?>