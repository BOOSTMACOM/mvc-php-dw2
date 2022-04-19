<?php

require BASE_PATH . 'model/article-manager.php';
require BASE_PATH . 'model/comment-manager.php';

function index()
{
    $articles = getAllArticles();
    include BASE_PATH . 'view/blog/index.html.php';
}

function article()
{
    $article = getArticleById($_GET['id']);
    $createdAt = new DateTime($article['created_at']);
    $article['created_at'] = $createdAt->format('d/m/Y à h:i');

    $comments = getAllCommentsByArticleId($_GET['id']);

    include BASE_PATH . 'view/blog/article.html.php';
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

    include BASE_PATH . 'view/blog/add.html.php';
}

function comment()
{
    if(!empty($_POST['submit']))
    {
        $newComment = insertComment($_POST['comment']);

        if($newComment)
        {
            header('Location: /?controller=blog&action=article&id=' . $_POST['comment']['article_id']);
            exit;
        }
        
    }
}