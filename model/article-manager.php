<?php

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

$table = 'article';

/**
 * Permet de récuperer tous les articles
 * @return [type]
 */
function getAll()
{
    $sql = "SELECT * FROM " . $GLOBALS['table'];
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getById(int $id)
{
    $sql = "SELECT * FROM " . $GLOBALS['table'] . " WHERE id = :id";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute([
        'id' => $id,
    ]);
    return $query->fetch();
}

function insert(array $data)
{
    $sql = "INSERT INTO " . $GLOBALS['table'] . 
    " (title, content, created_at) 
    VALUES (:title, :content, NOW())";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute($data);
    return $GLOBALS['pdo']->lastInsertId();
}

function update(array $data)
{
    $sql = "UPDATE " . $GLOBALS['table'] .
    " SET title = :title, content = :content
     WHERE id = :id";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute($data);
    return $GLOBALS['pdo']->rowCount();
}

function delete(int $id)
{
    $article = getById($id);
    $article['is_archived'] = 1;
    return update($article);
}

