<?php require VIEWS . '/incs/header.php' ?>
<style>
    .avatar {
        width: 20px;
    }
</style>
<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1><?= h($document['project_key']) ?></h1>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <span class="fw-semibold pe-1">Автор:</span>
                            <img src="<?= h($document['avatar']) ?>" class="avatar" alt="avatar">
                            <?= h($document['name']) ?>
                        </p>
                        <p class="card-text"><span class="fw-semibold pe-1">Дата создания:</span><?php
                            $date = new DateTimeImmutable($document['createDate'], new DateTimeZone('Europe/Moscow'));
                            echo $date->format('d.m.y (H:i)');
                            ?></p>
                        <p class="card-text"><span class="fw-semibold pe-1">Тип объекта:</span><?=$document['type'];?></p>
                        <p class="card-text"><span class="fw-semibold pe-1">Статус проекта:</span><?=$document['mode'];?></p>
                        <p class="card-text"><span class="fw-semibold pe-1">Улица:</span><?=$document['street'];?></p>
                        <p class="card-text"><span class="fw-semibold pe-1">Дом:</span><?=$document['apartment'];?></p>
                        <p class="card-text"><span class="fw-semibold pe-1">Смета:</span> <?=$document['fileName'];?></p>
                        <?php if (count($worksArr) > 0): ?>
                            <div class="portfolio-description" >
                                <span class="fw-semibold pe-1">Произведенные работы:</span>
                                <ul>
                                    <?php foreach ($worksArr as $work ): ?>
                                        <li><?=$work['title_work']?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="/?document=<?= $document['doc_id'] ?>" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i>Редактировать документ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require VIEWS . '/incs/footer.php' ?>

<!--<form action="/?document=--><?php //= $document['doc_id'] ?><!--" method="post">-->
<!--    <input type="hidden" name="_method" value="delete">-->
<!--    <input type="hidden" name="id" value="--><?php //= $document['doc_id'] ?><!--">-->
<!--    <button type="submit" class="btn text-danger"><i class="bi bi-trash"></i> Delete document</button>-->
<!--</form>-->