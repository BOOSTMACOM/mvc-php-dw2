<?php

require_once BASE_PATH . 'model/Manager.php';

class CommentManager extends Manager
{
    public CONST TABLE = "comment";

    /**
     * Permet de récuperer tous les articles
     * @return [type]
     */
    function getAll()
    {
        $sql = "SELECT * FROM " . self::TABLE;
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    function getAllByArticleId(int $id)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE article_id = :article_id LIMIT 10";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'article_id' => $id
        ]);
        return $query->fetchAll();
    }

    function insert(array $data)
    {
        $sql = "INSERT INTO " . self::TABLE . 
        " (content, author, created_at, article_id) 
        VALUES (:content, :author, NOW(), :article_id)";
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        return $this->pdo->lastInsertId();
    }

}
