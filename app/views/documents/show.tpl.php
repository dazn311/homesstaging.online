<?php

require VIEWS . '/incs/header.php';

$description_keys = [
     'title'=>'Заголовок',
     'category'=>'Категория',
     'price'=>'Бюджет:',
     'end_date'=>'Дата завершения: ',
     'project_des'=>'Описание URL для проекта: ',
     'project_url'=>'Проект URL: ',
];

?>
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
                        <h1><?= h($document['project_key']) ?> (read mode)</h1>
                    </div>
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Основные</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Описание для сайта</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Произведенные работы</button>
                                <button class="nav-link" id="nav-photo-tab" data-bs-toggle="tab" data-bs-target="#nav-photo" type="button" role="tab" aria-controls="nav-photo" aria-selected="false">Фото</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!--body for "Основные"-->
                            <div class="tab-pane fade show active p-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                            </div>

                            <!--body for "Описание для сайта"-->
                            <div class="tab-pane fade p-2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <?php if (count($descriptionArr) > 0): ?>
                                    <?php foreach ($description_keys as $key=>$value ): ?>
                                        <div class="card-text">
                                            <span class="fw-semibold pe-1"><?=$value;?></span>
                                            <span class="desc"> <?=$descriptionArr[$key];?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!--body for "Произведенные работы"-->
                            <div class="tab-pane fade p-2" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <?php if (count($worksArr) > 0): ?>
                                    <div class="portfolio-description" >
                                        <ul>
                                            <?php foreach ($worksArr as $work ): ?>
                                                <li><?=$work['title_work']?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div class="portfolio-description" >
                                        <ul>
                                            <li>блок пустой, нужно добавить работы</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!--body for "Фото"-->
                            <div class="tab-pane fade p-2" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab">tab-content 3...</div>
                        </div>

                        <form action="/?documents=<?= $document['doc_id'] ?>" method="POST">
                            <input type="hidden" name="_method" value="POST">
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