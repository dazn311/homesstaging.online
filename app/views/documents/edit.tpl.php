<?php
require VIEWS . '/incs/header.php';

$document_keys = [
        'type'=>'Тип объекта:',
        'mode'=>'Статус проекта:',
        'street'=>'Улица:',
        'apartment'=>'Дом:',
        'fileName'=>'Смета:'
];

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
                    <div class="card-header d-flex gap-1">
                        <h1><?= h($document['project_key']) ?></h1>
                        <span class="line-block text-opacity-50">(edit mode)</span>
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

                        <form action="/?documents=<?= $document['doc_id'] ?>" method="POST">
                            <?php foreach ($document_keys as $key => $value ): ?>
                                <div class="form-group">
                                    <label for="<?=$key;?>"><?=$value;?></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <i class="bi bi-pencil-square input-group-text"></i>
                                            <input
                                                    type="text"
                                                    class="form-control"
                                                    id="<?=$key;?>"
                                                    aria-describedby="<?=$key;?>"
                                                    value="<?=$document[$key];?>"
                                                    placeholder="Евродвушка">
                                        </div>
                                    </div>
                                    <small id="<?=$key;?>" class="form-text text-muted"></small>
                                </div>
                            <?php endforeach; ?>
                            <?php if (count($worksArr) > 0): ?>
                                <div class="portfolio-description" >
                                    <span class="fw-semibold pe-1">Произведенные работы:</span>
                                    <ul>
                                        <?php foreach ($worksArr as $key=>$work ): ?>
                                            <li class="col-md-12">
                                                <div class="input-group">
                                                    <i class="bi bi-pencil-square input-group-text"></i>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            id="worksPerformed_<?=$key;?>"
                                                            aria-describedby="worksPerformed_<?=$key;?>"
                                                            value="<?=$work['title_work']?>"
                                                            placeholder="выполненные работы">
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                <div class="input-group">
                                    <i class="bi bi-save input-group-text"></i>
                                    <button type="submit" class="btn btn-success">Сохранить документ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require VIEWS . '/incs/footer.php' ?>
