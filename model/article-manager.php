<?php

define('ARTICLE_TABLE','article');

try
{
    $pdo = new PDO('mysql:host=localhost;dbname=mvc-blog','root','', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
catch(PDOException $pe)
{
    die("Error : " . $pe->getMessage());
}

/**
 * Permet de récuperer tous les articles
 * @return [type]
 */
function getAllArticles()
{
    $sql = "SELECT * FROM " . ARTICLE_TABLE;
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getArticleById(int $id)
{
    $sql = "SELECT * FROM " . ARTICLE_TABLE . " WHERE id = :id";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute([
        'id' => $id,
    ]);
    return $query->fetch();
}

function insert(array $data)
{
    $sql = "INSERT INTO " . ARTICLE_TABLE . 
    " (title, content, created_at) 
    VALUES (:title, :content, NOW())";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute($data);
    return $GLOBALS['pdo']->lastInsertId();
}

function update(array $data)
{
    $sql = "UPDATE " . ARTICLE_TABLE .
    " SET title = :title, content = :content
     WHERE id = :id";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute($data);
    return $GLOBALS['pdo']->rowCount();
}

function delete(int $id)
{
    $article = getArticleById($id);
    $article['is_archived'] = 1;
    return update($article);
}

