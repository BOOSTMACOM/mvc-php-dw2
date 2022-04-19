<?php

class Manager
{
    protected PDO $pdo;

    public function __construct()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=mvc-blog','root','', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        catch(PDOException $pe)
        {
            die("Error : " . $pe->getMessage());
        }
    }

}