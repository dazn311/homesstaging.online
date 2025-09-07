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
    .nav-link {
        color: var(--accent-color);
    }
</style>
<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex gap-1">
                        <h1>Проект: <?= h($document['project_key']) ?></h1>
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
                                <p class="card-text px-2">
                                    <span class="fw-semibold pe-1">Доступ:</span>
                                    <img src="<?= h($document['avatar']) ?>" class="avatar" alt="avatar">
                                    <?= h($document['name']) ?>
                                </p>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Дата создания:</th>
                                            <td>
                                                <?php
                                                $date = new DateTimeImmutable($document['createDate'], new DateTimeZone('Europe/Moscow'));
                                                echo $date->format('d.m.y (H:i)');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Тип объекта:</th>
                                            <td><?=$document['type'];?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Статус проекта:</th>
                                            <td colspan="2"><?=$document['mode'];?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Улица:</th>
                                            <td colspan="2"><?=$document['street'];?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Дом:</th>
                                            <td colspan="2"><?=$document['apartment'];?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Смета:</th>
                                            <td colspan="2"><?=$document['fileName'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!--body for "Описание для сайта"-->
                            <div class="tab-pane fade p-2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <?php if (is_array($descriptionArr) && count($descriptionArr) > 0): ?>
                                    <table class="table">
                                        <tbody>
                                            <?php foreach ($description_keys as $key=>$value ): ?>
                                                <tr>
                                                    <th scope="row"><?=$value;?></th>
                                                    <td><?=$descriptionArr[$key];?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                            <div class="tab-pane fade p-2" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab">
                                <div class="row row-cols-1 row-cols-md-3 g-1">
                                    <?php if (count($imagesArr) > 0): ?>
                                        <?php foreach ($imagesArr as $image ): ?>
                                            <div class="card" >
                                                <img src="<?=$image['image_url']?>" class="card-img-top" alt="...">
                                                <div class="card-footer text-muted">
                                                    <p class="card-text"><?=$image['image_description']?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div style="width: 100%" >
                                            Еще нет добавленных картинок.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (check_auth()): ?>
                            <form action="/?documents=<?=$document['doc_id'] ?>" method="POST">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="id" value="<?=$document['doc_id'] ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-pencil-square"></i><span class="ms-2">Редактировать документ</span>
                                </button>
                            </form>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" disabled>
                                <i class="bi bi-pencil-square"></i><span class="ms-2">Редактировать документ</span>
                            </button>
                        <?php endif; ?>

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