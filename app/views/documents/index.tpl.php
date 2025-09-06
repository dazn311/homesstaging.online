<?php
/**
view documents index
 */
    require VIEWS . '/incs/header.php';
?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($documents as $document) : ?>
                    <div class="card mb-3">
                        <div class="card-header d-flex gap-1">
                            <h5>
                                <?= h($document['project_title']) ?>
                                <a href="/?documents=<?= $document['doc_id'] ?>"><i class="bi bi-view-list"></i></a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid" >
                                <div class="card-text p-1 bg-body-tertiary">
                                    <span class="fw-semibold">Проект:</span>
                                    <?= h($document['project_key']) ?>
                                </div>
                                <div class="card-text p-1 bg-body-secondary">
                                    <span class="fw-semibold">Дата создания:</span> <?php
                                    $date = new DateTimeImmutable($document['createDate'], new DateTimeZone('Europe/Moscow'));
                                    echo $date->format('d.m.y (H:i)');
                                    ?>
                                </div>
                                <div class="card-text p-1 bg-body-tertiary"><span class="fw-semibold">статус:</span> <?= $document['mode']; ?></div>
                                <div class="card-text p-1 bg-body-secondary"><span class="fw-semibold">тип:</span> <?= $document['type']; ?></div>
                                <div class="card-text p-1 bg-body-tertiary"><span class="fw-semibold">документ:</span> <?= $document['fileName']; ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php require VIEWS . '/incs/sidebar.php' ?>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>