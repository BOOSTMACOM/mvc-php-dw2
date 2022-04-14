<?php

require 'model/article-manager.php';

function index()
{
    $articles = getAll();
    include 'view/blog/index.html.php';
}

function article()
{
    $article = getById($_GET['id']);
    $createdAt = new DateTime($article['created_at']);
    $article['created_at'] = $createdAt->format('d/m/Y à h:i');
    include 'view/blog/article.html.php';
}

/**
 * Affiche le formulaire et le traite s'il est envoyé
 * @return [type]
 */
function add()
{
    $messages = [];
    // On test si le formulaire à bien été envoyé
    if(isset($_POST['submitted']))
    {
        try
        {
            if(empty($_POST['article']['title']))
                $messages[] = "Le titre est vide bro";

            if(empty($_POST['article']['content']))
                $messages[] = "Le contenu est vide bro";

            if(count($messages) > 0)
                throw new Exception("Des champs sont manquants");

            $newArticleId = insert($_POST['article']);

            header('Location: /?controller=blog'); exit;
        }
        catch(Exception $e)
        {
            $messages[] = $e->getMessage();
        }
    }

    include 'view/blog/add.html.php';
}
