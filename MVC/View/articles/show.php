<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here 
    $title = $article->title;
    $publishDate = $article->formatPublishDate();
    $description = $article->description;

    $idArticlePrevious = $article->getPrevious();
    $idArticleNext = $article->getNext();
?>

<section>
    <h1><?= $title ?></h1>
    <p><?= $publishDate?></p>
    <p><?= $description ?></p>

    <?php // TODO: links to next and previous 
    ?>
    <?php if ($idArticlePrevious != null) : ?>
        <a href="./show?id=<?= $idArticlePrevious ?>">Previous article</a>
    <?php endif; ?>
    <?php if ($idArticleNext != null) : ?>
        <a href="./show?id=<?= $idArticleNext ?>">Next article</a>
    <?php endif; ?>
    
</section>

<?php require 'View/includes/footer.php' ?>