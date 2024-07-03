<?php require 'View/includes/header.php' ?>

<?php // Use any data loaded in the controller here 
if ($author) {
    $name = $author->name;
    $lastName = $author->lastName;
    $articles = $author->getArticles();
}
?>
<?php if ($author) : ?>
    <h3><?= "{$name}  {$lastName}" ?></h3>
    <h4>Les Articles:</h4>
    <?php if ($articles) : ?>
        <ul>
            <?php foreach ($articles as $key => $value) : ?>
                <?php foreach ($value as  $data) : ?>
                    <li>
                        <a href="articles/show?id=<?= $data['id'] ?>">
                            <?= $data['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        Aucun article publié.
    <?php endif; ?>
<?php else : ?>
    Aucun Auteur trouvé.
<?php endif; ?>
<?php require 'View/includes/footer.php' ?>