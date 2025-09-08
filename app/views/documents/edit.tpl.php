<?php
require VIEWS . '/incs/header.php';

$type_input = [
    'type' => 'text',
    'mode' => 'select',
    'street' => 'text',
    'apartment' => 'text',
    'fileName' => 'file',
    'title' => 'text',
    'category' => 'text',
    'price' => 'text',
    'end_date' => 'date',
    'project_des' => 'text',
    'project_url' => 'text',
];

$description_keys = [
    'title' => 'Заголовок:',
    'category' => 'Категория:',
    'price' => 'Бюджет:',
    'end_date' => 'Дата завершения: ',
    'project_des' => 'Описание URL: ',
    'project_url' => 'Проект URL: ',
];

$nav_tabs = [
    "general" => [
        "isActive" => false,
        "active" => "",
        "showActive" => "",
        "caption" => "Основные"
    ],
    "description" => [
        "isActive" => false,
        "active" => "",
        "showActive" => "",
        "caption" => "Описание для сайта"
    ],
    "works" => [
        "isActive" => false,
        "active" => "",
        "showActive" => "",
        "caption" => "Произведенные работы"
    ],
    "photo" => [
        "isActive" => false,
        "active" => "",
        "showActive" => "",
        "caption" => "Фото"
    ],
];

$active_tab = $_SESSION['activeTab'] ?? 'general';
$nav_tabs[$active_tab]["isActive"] = true;
$nav_tabs[$active_tab]["active"] = 'active';
$nav_tabs[$active_tab]["showActive"] = 'show active';

?>
<style>
    .avatar {
        width: 20px;
    }

    .nav-link {
        color: var(--accent-color);
    }

    .form-pic {
        margin-right: 10px;
        min-width: 400px;
    }

    div.input-group-text {
        min-width: 170px;
        position: relative;
    }

    .input-group.required .input-group-text:after {
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: calc(100% - 22px);
        top: 0;
    }
</style>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Ошибка!</strong> <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php elseif (isset($_SESSION['success'])): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill"/>
        </svg>
        <div>
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php endif; ?>
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
                                <?php foreach ($nav_tabs as $tKey => $tabs): ?>
                                    <button class="nav-link <?=$tabs['active'];?>" id="nav-<?=$tKey;?>-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-<?=$tKey;?>" type="button" role="tab"
                                            aria-controls="nav-<?=$tKey;?>"
                                            aria-selected="<?=$tabs['isActive'];?>">
                                        <?=$tabs['caption'];?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!--body for "Основные"-->
                            <div class="tab-pane fade p-2 <?=$nav_tabs['general']["showActive"]?>" id="nav-general" role="tabpanel"
                                 aria-labelledby="nav-general-tab">
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
                                      novalidate method="POST" enctype="multipart/form-data">
                                    <!--input type-->
                                    <div class="input-group <?php echo isset(RULES_PROJECT['type']) ? 'required' : '' ?>">
                                        <div class="input-group-text">Тип объекта:</div>
                                        <input
                                                type="text"
                                                class="form-control form-control-sm"
                                                id="type"
                                                name="type"
                                                aria-describedby="type"
                                                value="<?= $document['type']; ?>"
                                                required
                                        >
                                    </div>
                                    <?= isset($validation) ? $validation->listErrors('type') : ''  ?>
                                    <!--end  input type-->

                                    <!--select mode-->
                                    <div class="input-group <?php echo isset(RULES_PROJECT['mode']) ? 'required' : '' ?>">
                                        <div class="input-group-text"><?= $captionsArr['mode']['caption_ru']; ?></div>
                                        <select
                                                class="form-control form-control-sm"
                                                id="mode"
                                                name="mode"
                                                aria-describedby="mode"
                                                value="<?= $document['mode']; ?>"
                                                required
                                        >
                                            <?php foreach ($statusModeArr as $modeId => $statusMode): ?>
                                                <option value="<?= (string)$modeId; ?>" <?= $document['mode'] == $modeId ? 'selected' : ''; ?> >
                                                    <?= $statusMode; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= isset($validation) ? $validation->listErrors('mode') : ''  ?>
                                    </div>
                                    <!--end select mode-->

                                    <!--input street-->
                                    <div class="input-group <?php echo isset(RULES_PROJECT['street']) ? 'required' : '' ?>">
                                        <div class="input-group-text"><?= $captionsArr['street']['caption_ru']; ?></div>
                                        <input
                                                type="<?= $captionsArr['street']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="street"
                                                name="street"
                                                aria-describedby="street"
                                                value="<?= $document['street']; ?>"
                                                required
                                        >
                                        <?= isset($validation) ? $validation->listErrors('street') : ''  ?>
                                    </div>
                                    <!--end  input street-->

                                    <!--input apartment-->
                                    <div class="input-group <?php echo isset(RULES_PROJECT['apartment']) ? 'required' : '' ?>">
                                        <div class="input-group-text"><?=$captionsArr['apartment']['caption_ru']; ?></div>
                                        <input
                                                type="<?= $captionsArr['apartment']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="apartment"
                                                name="apartment"
                                                aria-describedby="apartment"
                                                value="<?= $document['apartment']; ?>"
                                                required
                                        >
                                        <?= isset($validation) ? $validation->listErrors('apartment') : ''  ?>
                                    </div>
                                    <!--end  input apartment-->

                                    <!--input fileName-->
                                    <div class="input-group <?php echo isset(RULES_PROJECT['fileName']) ? 'required' : '' ?>">
                                        <div class="input-group-text">
                                            <?php
                                            echo $captionsArr['fileName']['caption_ru'];
                                            $fileName = $document['fileName'] ?? '';
                                            echo '<span class="text-warning bg-secondary px-2"> ' . $fileName . '</span>';
                                            ?>
                                        </div>
                                        <input
                                                type="<?= $captionsArr['fileName']['input_type']; ?>"
                                                class="form-control form-control-sm"
                                                id="fileName"
                                                name="fileName"
                                                aria-describedby="fileName"
                                                value="<?= $document['fileName']; ?>"
                                                required
                                        >
                                        <?= isset($validation) ? $validation->listErrors('fileName') : ''  ?>
                                    </div>
                                    <!--                             end  input fileName-->

                                    <div class="form-group mt-3">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_action" value="save_project">
                                        <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                        <div class="input-group">
                                            <i class="bi bi-save input-group-text text-success"></i>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <span class="ms-2">Сохранить документ</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!--end body for "Основные"-->

                            <!--body for "Описание для сайта"-->
                            <div class="tab-pane fade p-2 <?=$nav_tabs['description']["showActive"]?>" id="nav-description" role="tabpanel"
                                 aria-labelledby="nav-description-tab">
                                <form action="/?documents=<?= $document['doc_id'] ?>" class="needs-validation"
                                      novalidate
                                      method="POST">
                                    <?php foreach ($description_keys as $key => $value): ?>
                                        <div class="input-group <?php echo isset(RULES_DESCRIPTION[$key]) ? 'required' : '' ?>">
                                            <div class="input-group-text"> <?= $value; ?></div>
                                            <input
                                                    type="<?= $type_input[$key]; ?>"
                                                    class="form-control form-control-sm datepicker"
                                                    id="<?=$key; ?>"
                                                    name="<?=$key; ?>"
                                                    aria-describedby="<?= $key; ?>"
                                                    value="<?= $descriptionArr[$key] ?? ''; ?>"
                                                    placeholder=""
                                                    required
                                            >
                                            <?= isset($validation) ? $validation->listErrors($key) : '' ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="form-group mt-3">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_action" value="save_description">
                                        <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                        <div class="input-group">
                                            <i class="bi bi-save input-group-text text-success"></i>
                                            <button type="submit" class="btn btn-success">Сохранить Описание</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end body for "Описание для сайта"-->

                            <!--body for "Произведенные работы"-->
                            <div class="tab-pane fade p-2 <?=$nav_tabs['works']["showActive"]?>" id="nav-works" role="tabpanel"
                                 aria-labelledby="nav-works-tab">
                                <form action="/?documents=<?= $document['doc_id'] ?>" class="needs-validation"
                                      novalidate
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
                                                            placeholder=""
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
                                            <i class="bi bi-save input-group-text text-success"></i>
                                            <button type="submit" class="btn btn-success">Сохранить произведенные
                                                работы
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end body for "Произведенные работы"-->

                            <!--body for "Фото"-->
                            <div class="tab-pane fade p-2 <?=$nav_tabs['photo']["showActive"]?>" id="nav-photo" role="tabpanel"
                                 aria-labelledby="nav-photo-tab">
                                <div class="d-flex justify-content-between gap-1">
                                    <div class="form-pic">
                                        <form
                                                action="/?documents=<?= $document['doc_id']; ?>"
                                                class="needs-validation"
                                                novalidate
                                                method="POST"
                                                enctype="multipart/form-data">

                                            <!--input imageDescription-->
                                            <div class="input-group">
                                                <div class="input-group-text">Описание картинки</div>
                                                <input
                                                        type="text"
                                                        class="form-control form-control-sm"
                                                        id="imageDescription"
                                                        name="imageDescription"
                                                        aria-describedby="imageDescription"
                                                        value=""
                                                        placeholder=""
                                                >
                                            </div>
                                            <!--end input imageDescription-->
                                            <!--input fileName-->
                                            <div class="input-group">
                                                <div class="input-group-text">Добавить
                                                    фото:
                                                </div>
                                                <input
                                                        type="file"
                                                        class="form-control form-control-sm"
                                                        id="filePhoto"
                                                        accept="image/png, image/jpeg, image/jpg"
                                                        name="filePhoto"
                                                        aria-describedby="filePhoto"
                                                        multiple
                                                >
                                            </div>
                                            <!--end input fileName-->

                                            <div class="form-group mt-3">
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" name="_action" value="save_images">
                                                <input type="hidden" name="id" value="<?= $document['doc_id'] ?>">
                                                <div class="input-group">
                                                    <i class="bi bi-save input-group-text text-success"></i>
                                                    <button type="submit" class="btn btn-success">Сохранить картинки
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-3 g-1">
                                        <?php if (isset($imagesArr) && is_array($imagesArr) && count($imagesArr) > 0): ?>
                                            <?php foreach ($imagesArr as $image): ?>
                                                <div class="card">
                                                    <img src="<?= $image['image_url'] ?>" class="card-img-top"
                                                         alt="...">
                                                    <div class="card-footer text-muted d-flex justify-content-between">
                                                        <div class="card-text"><?= $image['image_description']; ?></div>
                                                        <form
                                                                action="/?documents=<?= $document['doc_id']; ?>"
                                                                class="needs-validation"
                                                                novalidate
                                                                method="POST"
                                                                enctype="multipart/form-data">
                                                            <input type="hidden" name="_action" value="delete_images">
                                                            <input type="hidden" name="image_id"
                                                                   value="<?= $image['image_id']; ?>">
                                                            <button type="submit" class="btn-close"
                                                                    aria-label="Close"></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <!--end body for "Фото"-->
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