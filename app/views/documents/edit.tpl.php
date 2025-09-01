<?php
require VIEWS . '/incs/header.php';

$type_input = [
        'type'=>'string',
        'mode'=>'select',
        'street'=>'string',
        'apartment'=>'string',
        'fileName'=>'file',
        'title'=>'string',
        'category'=>'string',
        'price'=>'string',
        'end_date'=>'date',
        'project_des'=>'string',
        'project_url'=>'string',
];

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
    'project_des'=>'Описание URL: ',
    'project_url'=>'Проект URL: ',
];

$options_mode = ['end','edit','new'];

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

                        <form action="/?documents=<?=$document['doc_id'] ?>" class="needs-validation" novalidate method="POST">
                            <?php foreach ($document_keys as $key => $value ): ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class=" input-group-text" style="min-width: 150px;"> <?=$value;?></div>
                                            <?php if ($type_input[$key] == 'select'): ?>
                                                <select
                                                        name="<?=$key;?>"
                                                        aria-describedby="<?=$key;?>"
                                                        value="<?=$document[$key];?>"
                                                        class="form-select form-control form-control-sm"
                                                        required
                                                        aria-label="Default select example">
                                                    <?php foreach ($options_mode as $option ): ?>
                                                        <option value="<?=$option;?>" <?=$document[$key] == $option ? 'selected' : '';?> ><?=$option;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <input
                                                        type="<?=$type_input[$key];?>"
                                                        class="form-control form-control-sm"
                                                        id="<?=$key;?>"
                                                        name="<?=$key;?>"
                                                        aria-describedby="<?=$key;?>"
                                                        value="<?=$document[$key];?>"
                                                        placeholder="<?=$key;?>"
                                                        required
                                                >
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?= isset($validation) ? $validation->listErrors($key) : ''  ?>
                                    <small id="<?=$key;?>" class="form-text text-muted"></small>
                                </div>
                            <?php endforeach; ?>

                            <div class="card-text">------------------------------------------------</div>
                            <h6 class="fw-semibold p-2 text-bg-light">Описание для сайта:</h6>
                            <?php foreach ($description_keys as $key=>$value ): ?>
                                <div class="input-group">
                                    <div class=" input-group-text" style="min-width: 170px;"> <?=$value;?></div>
                                    <input
                                            type="<?=$type_input[$key];?>"
                                            class="form-control form-control-sm datepicker"
                                            id="<?=$key;?>"
                                            name="<?=$key;?>"
                                            aria-describedby="<?=$key;?>"
                                            value="<?=$descriptionArr[$key] ?? '';?>"
                                            placeholder="<?=$key;?>"
                                            required
                                    >
                                </div>
                            <?php endforeach; ?>

                            <?php if (count($worksArr) > 0): ?>
                                <div class="portfolio-description" >
                                    <span class="fw-semibold pe-1">Произведенные работы:</span>
                                    <?php foreach ($worksArr as $key=>$work ): ?>
                                        <div class="input-group">
                                            <i class="bi bi-pencil-square input-group-text"></i>
                                            <input
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    id="worksPerformed_<?=$key;?>"
                                                    name="worksPerformed_<?=$key;?>"
                                                    aria-describedby="worksPerformed_<?=$key;?>"
                                                    value="<?=$work['title_work']?>"
                                                    placeholder="выполненные работы"
                                                    required
                                            >
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group mt-3">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_action" value="save">
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

<script type="text/javascript" >
    document.addEventListener('DOMContentLoaded', function() {
        // Your JavaScript code to manipulate the DOM goes here
        console.log('DOM is fully loaded and parsed!');

        // const $fileName = document.getElementById('fileName');
        // const $idDoc = document.getElementById('idDoc');
        // const $typeDoc = document.getElementById('typeDoc');
        // const $userName = document.getElementById('userName');
        // const $readMode = document.getElementById('readMode');
        // const $docFile = document.getElementById('docFile');
        // var d = new Date();
        // document.getElementById("end_date").value = "12.12.2033";
        // const datePicker = document.getElementById("end_date");
        // datePicker.dataset.date = '2025-03-04';
        // document.getElementById("end_date").datetimepicker("12.12.2033");
        //document.getElementById("end_date").value = "<?php //=$descriptionArr['end_date'] ?? '';?>//";
    });
</script>