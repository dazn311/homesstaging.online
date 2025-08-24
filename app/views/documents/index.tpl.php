<?php

    require VIEWS . '/incs/header.php';
?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($documents as $document) : ?>
                    <div class="card mb-3">
                        <div class="card-header  d-flex gap-1">
                            <h5><?= h($document['fileName']) ?></h5>
                            <a href="/document/<?= $document['id'] ?>">Go</a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <div class="name">
                                    Buyer:
                                    <img src="<?= h($document['avatar']) ?>" class="avatar" style="width: 30px;height: 30px;" alt="">
                                    <?= h($document['name']) ?></div>
                            </h6>
                            <p class="card-text">createDate: <?= h($document['createDate']) ?></p>
                            <div class="wrap d-flex gap-1" >
                                <div class="card-text">idDoc: <?= $document['idDoc'] ?>;</div>
                                <div class="card-text">mode: <?= $document['mode'] ?>;</div>
                                <div class="card-text">name: <?= $document['name'] ?>;</div>
                            </div>
                            <p class="card-text">fileName: <?= $document['fileName'] ?></p>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php require VIEWS . '/incs/sidebar.php' ?>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>