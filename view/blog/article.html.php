<?php include BASE_PATH . 'view/partials/_top.html.php'; ?>
<article class="container">
    <div class="row">
        <div class="col-12 col-md-7">
            <h1><?= $article['title'] ?></h1>
            <p><small><?= $article['created_at'] ?></small></p>
            <div class="Article-content">
                <?= $article['content'] ?>
            </div>
        </div>
    </div>
</article>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/?controller=blog&action=comment" method="post">

                <input type="hidden" name="comment[article_id]" value="<?= $article['id'] ?>"/>

                <div class="form-group">
                    <label>Auteur.e
                        <input type="text" class="form-control" name="comment[author]"/>
                    </label>
                </div>

                <div class="form-group">
                    <label>Commentaire 
                        <textarea name="comment[content]" class="form-control"></textarea>
                    </label>
                </div>
                
                <input type="submit" class="btn btn-primary" name="submit" value="Envoyer" />

            </form>
        </div>
    </div>

    <div class="row">
        <?php foreach($comments as $comment): ?>
        <div class="col-12">
            <div><small><?= $comment['created_at'] ?></small></div>
            <strong><?= $comment['author'] ?></strong>
            <p><?= $comment['content'] ?></p>
        </div>
        <?php endforeach; ?>
    </div>

</div>
<?php include BASE_PATH . 'view/partials/_bottom.html.php'; ?>