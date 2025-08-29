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
                            <h5>
                                <?= h($document['project_title']) ?>
                                <a href="/?documents=<?= $document['doc_id'] ?>"><i class="bi bi-view-list"></i></a>
                            </h5>

                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <div class="name">
                                    <span class="fw-semibold">Проект:</span>
<!--                                    <img src="--><?php //= h($document['avatar']) ?><!--" class="avatar" style="width: 30px;height: 30px;" alt="">-->
                                    <?= h($document['project_key']) ?></div>
                            </h6>
                            <p class="card-text"><span class="fw-semibold">Дата создания:</span> <?php
                                $date = new DateTimeImmutable($document['createDate'], new DateTimeZone('Europe/Moscow'));
                                echo $date->format('d.m.y (H:i)');
                                ?></p>
                            <div class="d-grid" >
                                <div class="card-text p-1 bg-body-secondary"><span class="fw-semibold">номер документа:</span><?= $document['doc_id'] ?>;</div>
                                <div class="card-text p-1 bg-body-tertiary"><span class="fw-semibold">статус:</span> <?= $document['mode'] ?>;</div>
                                <div class="card-text p-1 bg-body-secondary"><span class="fw-semibold">тип:</span> <?= $document['type'] ?>;</div>
                            </div>
                            <p class="card-text"><span class="fw-semibold">документ:</span> <?= $document['fileName'] ?></p>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php require VIEWS . '/incs/sidebar.php' ?>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>