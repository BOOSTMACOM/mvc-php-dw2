<?php include 'view/partials/_top.html.php'; ?>
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
<?php include 'view/partials/_bottom.html.php'; ?>