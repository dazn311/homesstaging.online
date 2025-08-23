<?php require VIEWS . '/incs/header.php' ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1><?= h($document['fileName']) ?></h1>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="name">
                                Buyer:
                                <img src="<?= h($document['avatar']) ?>" class="avatar" alt="avatar">
                                <?= h($document['name']) ?></div>
                        </h5>
                        <p class="card-text">createDate: <?= h($document['createDate']) ?></p>
                        <form action="/documents" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="<?= $document['id'] ?>">
                            <button type="submit" class="btn btn-link">Delete document</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php require VIEWS . '/incs/footer.php' ?>
