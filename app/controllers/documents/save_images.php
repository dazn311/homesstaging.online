<?php
/**
for save image;
 */

use Utils\{App, Db, Validator};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

$db = App::get(Db::class);

$validator = new Validator();

// create new manager instance with desired driver
$manager = new ImageManager(new Driver());

$fill_able = [
    'filePhoto','imageDescription'
    ];

$worksPerformed = [];

$data = load($fill_able, true);

$idDoc = route_param('documents','all');// '1248303'

$title = 'doc_store=>save.tpl';

switch (true) {
    case isset($_FILES['filePhoto']):
        if ($_FILES['filePhoto']['error'] === 0) {
            $data['filePhoto'] = $_FILES['filePhoto']['name'];
            $data['docFile'] = $_FILES['filePhoto'];
            unset($_SESSION['error']);
        } else if (empty($_FILES['filePhoto']['name'])) {
            $_SESSION['error'] = 'Выбирите файл для загрузки.';
            unset($_SESSION['success']);
            return;
        } else {
            $_SESSION['error'] = 'Не верный формат файла или размер привышает допустимого.';
            unset($_SESSION['success']);
            return;
        }
        break;
    default:
        unset($_SESSION['success']);
        unset($_SESSION['error']);
}

$validation = $validator->validate($data, [
    'docFile' => [
        'required' => true,
        'ext' => 'png|jpeg|jpg',
        'size' => 10_048_576,
    ],
]);

if (!$validation->hasErrors()) {
    //запись документа;
    $id_doc = $_POST['id'];
    $querySt = "SELECT D.project_key AS projectKey, A.apartment FROM document D
        LEFT JOIN addressBook A
            ON D.id = A.document_id
            WHERE D.id = ?;";

    $document = $db->query($querySt,[$id_doc]);
    $document = $document->find();

     if ($document) {
         if (!empty($data['docFile']['tmp_name'])) {
             $file_ext = get_file_ext($data['docFile']['name']);
             $dir = '/' . $document['projectKey'] . '/' . $document['apartment'];// /mitino2/32k1;

             if (!is_dir('uploads' . $dir)) {
                 mkdir('uploads' . $dir, 0755, true);
             }
             $now = date("Ymd_H_i_s");
             $filePath = 'uploads' . "{$dir}/{$now}.{$file_ext}";
             $image = $manager->read($data['docFile']['tmp_name']);

             $width = $image->width();//929
             $height = $image->height();//1280
             // Natusia Minsk sdfsdf (929×1280) -> 599×799
             //  988×1280
             //  988/1280 = 0.771875
             //  988/753 = 1.31208499336
//             $heightImage = $height;
             $widthImage = $width;
             if ($height != 800) {
                 // 800 / 1280 = 0.625;
                 $aspect = 800 / $height;
                 $widthImage = $width * $aspect;
             }

             $widthImage = (int) $widthImage;

             $image -> scaleDown($widthImage)
                    -> save($filePath);

             if ($image) {
                 $imageUrl = $filePath;
                 $imageDescription = $data['imageDescription'];

                 $res = $db->query("INSERT INTO image (image_url, image_description, document_id) VALUES (?,?,?);", [$imageUrl, $imageDescription, $id_doc]);
                 $_SESSION['success'] = 'Изображение загружено';
                 if ($res) {
                     $_SESSION['filePath'] = $filePath;
                     $_SESSION['success'] = 'Изображение сохранено в бд.';
                     return;
                 } else {
                     $_SESSION['error'] = 'insert to image Error';
                 }
             } else {
                 $_SESSION['error'] = "[" . date('Y-m-d H:i') . "] Ошибка загрузки изображения" . PHP_EOL;
                 error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
             }
         } else {
             $_SESSION['error'] = 'tmp_name Error';
         }

     } else {
         $_SESSION['error'] = '[120 save image] DB Error';
     }

} else {
    $_SESSION['error'] = '[124 save image] DB Error';
}


