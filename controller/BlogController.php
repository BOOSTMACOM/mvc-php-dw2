<?php

require BASE_PATH . 'model/ArticleManager.php';
require BASE_PATH . 'model/CommentManager.php';

class BlogController
{

    public function index()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAll();
        include BASE_PATH . 'view/blog/index.html.php';
    }

    public function article()
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getById($_GET['id']);
        $createdAt = new DateTime($article['created_at']);
        $article['created_at'] = $createdAt->format('d/m/Y à h:i');

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllByArticleId($_GET['id']);

        include BASE_PATH . 'view/blog/article.html.php';
    }

    /**
     * Affiche le formulaire et le traite s'il est envoyé
     * @return [type]
     */
    public function add()
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

                $articleManager = new ArticleManager();

                $newArticleId = $articleManager->insert($_POST['article']);

                header('Location: /?controller=blog'); exit;
            }
            catch(Exception $e)
            {
                $messages[] = $e->getMessage();
            }
        }

        include BASE_PATH . 'view/blog/add.html.php';
    }

    public function comment()
    {
        if(!empty($_POST['submit']))
        {
            $commentManager = new CommentManager();
            $newComment = $commentManager->insert($_POST['comment']);

            if($newComment)
            {
                header('Location: /?controller=blog&action=article&id=' . $_POST['comment']['article_id']);
                exit;
            }
            
        }
    }

}