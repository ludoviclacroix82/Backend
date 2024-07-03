<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here 
?>

<section>
    <p><a href="articles">To articles page</a></p>

    <?php foreach ($articles as $article) : ?>
        <li>
            <a href="articles/show?id=<?= $article->id ?>">
                <?= $article->title ?> (<?= $article->formatPublishDate() ?>)
            </a>
        </li>
    <?php endforeach; ?>
</section>

<?php require 'View/includes/footer.php' ?>