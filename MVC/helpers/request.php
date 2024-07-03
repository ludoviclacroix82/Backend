<?php

function routing()
{
    $requestUri = $_SERVER['REQUEST_URI'];
    $baseUri = '/MVC/';
    $relativeUri = str_replace($baseUri, '', $requestUri);

    // Optionnel : si vous souhaitez retirer les paramètres de la requête
    $relativeUri = strtok($relativeUri, '?');

    return htmlspecialchars($relativeUri);
}

function getAllArticles()
{
    global $dbh;

    try {
        $query = $dbh->prepare("SELECT * FROM articles WHERE 1 ORDER BY publish_date DESC");
        $query->execute();
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $articles ? $articles : null;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

function getAllArticlesLimited(int $limit)
{
    global $dbh;

    try {
        $query = $dbh->prepare("SELECT * FROM articles ORDER BY publish_date DESC LIMIT :limit");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $articles ? $articles : [];
    } catch (PDOException $e) {
        error_log("Erreur de connexion : " . $e->getMessage());
        return [];
    }
}

function getArticlesID($id)
{
    global $dbh;

    try {
        $query = $dbh->prepare("SELECT * FROM articles WHERE id = :id");
        $query->execute(['id' => $id]);
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $articles ? $articles : null;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

function articlePagination(int $id, string $types)
{
    global $dbh;
    try {
        if ($types === 'next') {
            $query = $dbh->prepare("SELECT id FROM articles WHERE id > :id ORDER BY id ASC LIMIT 1");
        } else {
            $query = $dbh->prepare("SELECT id FROM articles WHERE id < :id ORDER BY id DESC LIMIT 1");
        }

        $query->execute(['id' => $id]);
        $article = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $article ? $article['id'] : null;
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        return null;
    }
}

function getAuthor($id)
{
    global $dbh;
    try {

        $query = $dbh->prepare("SELECT * FROM author WHERE id = :id");
        $query->execute(['id' => $id]);
        $author = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $author ? $author : null;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

function getAuthorArticleLink($id_articles)
{
    global $dbh;
    try {
        $query = $dbh->prepare("SELECT id_author FROM articlesAuthorLink WHERE id_articles = :id_articles");
        $query->execute(['id_articles' => $id_articles]);
        $idAuthor = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        $query = $dbh->prepare("SELECT * FROM author WHERE id = :id");
        $query->execute(['id' => $idAuthor[0]['id_author']]);
        $author = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $author ? $author : null;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

function getArticleAuthorLink($id_author)
{
    global $dbh;
    try {
        $query = $dbh->prepare("SELECT id_articles FROM articlesAuthorLink WHERE id_author = :id_author");
        $query->execute(['id_author' => $id_author]);
        $articleAuthor = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        $listingArticles = [];

        foreach ($articleAuthor as $article) {
            $listingArticles []= getArticlesID($article['id_articles']);
        }       

        return ($listingArticles) ? $listingArticles : null;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
