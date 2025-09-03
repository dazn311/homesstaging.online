<?php
require VIEWS . '/incs/header.php';

$type_input = [
    'type' => 'string',
    'mode' => 'select',
    'street' => 'string',
    'apartment' => 'string',
    'fileName' => 'file',
    'title' => 'string',
    'category' => 'string',
    'price' => 'string',
    'end_date' => 'date',
    'project_des' => 'string',
    'project_url' => 'string',
];

$document_keys = [
    'type' => 'Тип объекта:',
    'mode' => 'Статус проекта:',
    'street' => 'Улица:',
    'apartment' => 'Дом:',
    'fileName' => 'Смета:'
];

$description_keys = [
    'title' => 'Заголовок',
    'category' => 'Категория',
    'price' => 'Бюджет:',
    'end_date' => 'Дата завершения: ',
    'project_des' => 'Описание URL: ',
    'project_url' => 'Проект URL: ',
];

$options_mode = ['end', 'edit', 'new'];

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
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Основные
                                </button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Описание для сайта
                                </button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Произведенные работы
                                </button>
                                <button class="nav-link" id="nav-photo-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-photo" type="button" role="tab" aria-controls="nav-photo"
                                        aria-selected="false">Фото
                                </button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!--body for "Основные"-->
                            <div class="tab-pane fade show active p-2" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">
                                <p class="card-text">
                                    <span class="fw-semibold pe-1">Автор:</span>
                                    <img src="<?= h($document['avatar']) ?>" class="avatar" alt="avatar">
                                    <?= h($document['name']) ?>
                                </p>
                                <p class="card-text"><span class="fw-semibold pe-1">Дата создания:</span><?php
                                    $date = new DateTimeImmutable($document['createDate'], new DateTimeZone('Europe/Moscow'));
                                    echo $date->format('d.m.y (H:i)');
                                    ?>
                                </p>

                                <form action="/?documents=<?= $document['doc_id'] ?>" class="needs-validation"
                                      novalidate method="POST">
<!--                                    input type-->
                                    <div class="input-group">
                                        <div class=" input-group-text"
                                             style="min-width: 150px;">Тип объекта:</div>
                                        <input
                                                type="text"
                                                class="form-control form-control-sm"
                                                id="type"
                                                name="type"
                                                aria-describedby="type"
                                                value="<?= $document['type']; ?>"
                                                placeholder="type"
                                                required
                                        >
                                    </div>
<!--                               end  input type-->

<!--                               select mode-->
                                    <div class="input-group">
                                        <div class=" input-group-text"
                                             style="min-width: 150px;"><?=$captionsArr['type']['caption_ru']; ?></div>
                                        <select
                                                class="form-control form-control-sm"
                                                id="type"
                                                name="type"
                                                aria-describedby="type"
                                                value="<?= $document['type']; ?>"
                                                required
                                        >
                                        <?php foreach ($statusModeArr as $modeId => $statusMode): ?>
                                            <option value="<?= (string)$modeId; ?>" <?= $document['type'] == $modeId ? 'selected' : ''; ?> >
                                                <?= $statusMode; ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
<!--                                    end select mode-->

<!--                                    input street-->
                                    <div class="input-group">
                                        <div class=" input-group-text"
                                             style="min-width: 150px;"><?=$captionsArr['street']['caption_ru']; ?></div>
                                        <input
                                                type="<?=$captionsArr['street']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="street"
                                                name="street"
                                                aria-describedby="street"
                                                value="<?= $document['street']; ?>"
                                                placeholder="street"
                                                required
                                        >
                                    </div>
<!--                               end  input street-->

<!--                                    input apartment-->
                                    <div class="input-group">
                                        <div class=" input-group-text"
                                             style="min-width: 150px;"><?=$captionsArr['apartment']['caption_ru']; ?></div>
                                        <input
                                                type="<?=$captionsArr['apartment']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="apartment"
                                                name="apartment"
                                                aria-describedby="apartment"
                                                value="<?= $document['apartment']; ?>"
                                                placeholder="apartment"
                                                required
                                        >
                                    </div>
<!--                               end  input apartment-->

<!--                                    input fileName-->
                                    <div class="input-group">
                                        <div class=" input-group-text"
                                             style="min-width: 150px;"><?=$captionsArr['fileName']['caption_ru']; ?></div>
                                        <input
                                                type="<?=$captionsArr['fileName']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="fileName"
                                                name="fileName"
                                                aria-describedby="fileName"
                                                value="<?= $document['fileName']; ?>"
                                                placeholder="fileName"
                                                required
                                        >
                                    </div>
<!--                               end  input fileName-->

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
                            <!--end body for "Основные"-->


                            <!--body for "Описание для сайта"-->
                            <div class="tab-pane fade p-2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="/?documents=<?= $document['doc_id'] ?>" class="needs-validation" novalidate
                                      method="POST">
                                    <?php foreach ($description_keys as $key => $value): ?>
                                        <div class="input-group">
                                            <div class=" input-group-text" style="min-width: 170px;"> <?= $value; ?></div>
                                            <input
                                                    type="<?= $type_input[$key]; ?>"
                                                    class="form-control form-control-sm datepicker"
                                                    id="<?= $key; ?>"
                                                    name="<?= $key; ?>"
                                                    aria-describedby="<?= $key; ?>"
                                                    value="<?= $descriptionArr[$key] ?? ''; ?>"
                                                    placeholder="<?= $key; ?>"
                                                    required
                                            >
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="form-group mt-3">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_action" value="save_profile">
                                        <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                        <div class="input-group">
                                            <i class="bi bi-save input-group-text"></i>
                                            <button type="submit" class="btn btn-success">Сохранить Описание</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end body for "Описание для сайта"-->

                            <!--body for "Произведенные работы"-->
                            <div class="tab-pane fade p-2" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <form action="/?documents=<?= $document['doc_id'] ?>" class="needs-validation" novalidate
                                      method="POST">
                                    <?php if (count($worksArr) > 0): ?>
                                        <div class="portfolio-description">
                                            <span class="fw-semibold pe-1">Произведенные работы:</span>
                                            <?php foreach ($worksArr as $key => $work): ?>
                                                <div class="input-group">
                                                    <i class="bi bi-pencil-square input-group-text"></i>
                                                    <input
                                                            type="text"
                                                            class="form-control form-control-sm"
                                                            id="worksPerformed_<?= $key; ?>"
                                                            name="worksPerformed_<?= $key; ?>"
                                                            aria-describedby="worksPerformed_<?= $key; ?>"
                                                            value="<?= $work['title_work'] ?>"
                                                            placeholder="заполните выполненные работы"
                                                            required
                                                    >
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group mt-3">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_action" value="save_works">
                                        <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                        <div class="input-group">
                                            <i class="bi bi-save input-group-text"></i>
                                            <button type="submit" class="btn btn-success">Сохранить произведенные работы</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end body for "Произведенные работы"-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require VIEWS . '/incs/footer.php' ?>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
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