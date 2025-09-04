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

if (isset($_FILES['filePhoto']) && $_FILES['filePhoto']['error'] === 0) {
    $data['filePhoto'] = $_FILES['filePhoto']['name'];
    $data['docFile'] = $_FILES['filePhoto'];
} else {
    $data['docFile'] = null;
}

$validation = $validator->validate($data, [
    'docFile' => [
        'required' => true,
        'ext' => 'png|jpeg|jpg',
        'size' => 1_048_576,
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

     if (count($document) > 0) {
         if (!empty($data['docFile']['tmp_name'])) {
             $file_ext = get_file_ext($data['docFile']['name']);
             $dir = '/' . $document['projectKey'] . '/' . $document['apartment'];// /mitino2/32k1;

             if (!is_dir('uploads' . $dir)) {
                 mkdir('uploads' . $dir, 0755, true);
             }
             $now = date("Ymd_H_i_s");
             $filePath = 'uploads' . "{$dir}/{$now}.{$file_ext}";
             $image = $manager->read($data['docFile']['tmp_name']);

             $width = $image->width();
             $height = $image->height();

             $heightImage = 800;
             if ($width < $height) {
                 $heightImage = $heightImage * ($height / $width);
             } else {
                 $heightImage = $heightImage * ($width / $height);
             }
             $heightImage = (int) $heightImage;

             $image->resize(800,$heightImage)
                    ->save($filePath);

             if ($image) {
                 //INSERT INTO image (image_id, image_url, document_id) VALUES (3,  'assets/img/flats/Mitinskii-les/38/5.jpg',2);
                 $imageUrl = $filePath;
                 $imageDescription = $data['imageDescription'];
                 $res = $db->query("INSERT INTO image (image_url, image_description, document_id) VALUES (?,?,?);", [$imageUrl, $imageDescription, $id_doc]);
                 if ($res) {
                     $_SESSION['filePath'] = $filePath;
                 } else {
                     $_SESSION['error'] =  $_SESSION['error'] ?? 'insert to image Error';
                 }
             } else {
                 error_log("[" . date('Y-m-d H:i') . "] Error upload avatar" . PHP_EOL, 3);
             }

             $_SESSION['success'] = 'OK';
         } else {
             $_SESSION['error'] =  $_SESSION['error'] ?? 'tmp_name Error';
         }

     } else {
         $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
     }

} else {
    $_SESSION['error'] =  $_SESSION['error'] ?? 'DB Error';
}


