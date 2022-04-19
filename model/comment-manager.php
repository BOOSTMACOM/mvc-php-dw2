<?php

define('COMMENT_TABLE','comment');

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
function getAllComments()
{
    $sql = "SELECT * FROM " . COMMENT_TABLE;
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getAllCommentsByArticleId(int $id)
{
    $sql = "SELECT * FROM " . COMMENT_TABLE . " WHERE article_id = :article_id LIMIT 10";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute([
        'article_id' => $id
    ]);
    return $query->fetchAll();
}

function insertComment(array $data)
{
    $sql = "INSERT INTO " . COMMENT_TABLE . 
    " (content, author, created_at, article_id) 
    VALUES (:content, :author, NOW(), :article_id)";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute($data);
    return $GLOBALS['pdo']->lastInsertId();
}
