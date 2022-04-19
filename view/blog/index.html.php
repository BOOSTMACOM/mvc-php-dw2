<?php include BASE_PATH . 'view/partials/_top.html.php'; ?>
<div class="container">
    <h1>Hello, blog!</h1>
    <div class="row">
        <?php foreach($articles as $article): ?>
        <div class="col-12 col-md-3 mb-4">
            <article class="card">
                <div class="card-body">
                    <small><?= $article['created_at'] ?></small>
                    <h3><?= $article['title'] ?></h3>
                    <p><?= substr($article['content'], 0, 200) ?>...</p>
                    <a href="/?controller=blog&action=article&id=<?= $article['id'] ?>">Lire plus</a>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include BASE_PATH . 'view/partials/_bottom.html.php'; ?>