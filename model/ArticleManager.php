<?php
require_once BASE_PATH . 'model/Manager.php';

class ArticleManager extends Manager
{
    public CONST TABLE = 'article';

    /**
     * Permet de récuperer tous les articles
     * @return [type]
     */
    public function getAll()
    {
        $sql = "SELECT * FROM " . self::TABLE;
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
        return $query->fetch();
    }

    public function insert(array $data)
    {
        $sql = "INSERT INTO " . self::TABLE . 
        " (title, content, created_at) 
        VALUES (:title, :content, NOW())";
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function update(array $data)
    {
        $sql = "UPDATE " . self::TABLE .
        " SET title = :title, content = :content
        WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        //return $this->pdo->rowCount();
    }

    public function delete(int $id)
    {
        $article = $this->getById($id);
        $article['is_archived'] = 1;
        return $this->update($article);
    }

}