<?php include 'view/partials/_top.html.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <form action="/?controller=blog&action=add" method="POST">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" class="form-control" name="article[title]" />
                </div>
                <div class="form-group">
                    <label>Contenu</label>
                    <textarea name="article[content]" class="form-control"></textarea>
                </div>
                <input type="submit" name="submitted" value="Enregistrer" class="btn btn-primary mt-4" />
            </form>
            <?php if(count($messages) > 0): ?>
                <div class="mt-4">
                <?php foreach($messages as $message): ?>
                    <div class="alert alert-warning mb-4">
                        <?= $message ?>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'view/partials/_bottom.html.php'; ?>