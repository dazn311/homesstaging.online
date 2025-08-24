<?php

use Utils\Validator;

require VIEWS . '/incs/header.php';

/**
 * @var Validator $validation
 */

?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>New document</h1>

                <form action="/documents" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileName" class="form-label">Document name</label>
                        <input id="fileName" name="fileName" type="text" class="form-control" placeholder="invrpt-new-edit-Krampsup-250807" value='<?= old('fileName') ?>'>
                        <?= isset($validation) ? $validation->listErrors('fileName') : ''  ?>
                    </div>

                    <div class="mb-3">
                        <label for="idDoc" class="form-label">Id</label>
                        <input id="idDoc" name="idDoc" type="text" class="form-control" placeholder="1250807" value='<?= old('idDoc') ?>'>
                        <?= isset($validation) ? $validation->listErrors('idDoc') : ''  ?>
                    </div>

                    <div class="mb-3">
                        <label for="typeDoc" class="form-label">Тип документ</label>
                        <input id="typeDoc" name="typeDoc" type="text"  class="form-control"  placeholder="invrpt|desadv" value="<?= old('typeDoc') ?>" ><?= old('typeDoc') ?>
                        <?= isset($validation) ? $validation->listErrors('typeDoc') : ''  ?>
                    </div>

                    <div class="mb-3">
                        <label for="userName" class="form-label">Имя заказчика</label>
                        <select name="userName" id="userName"  class="form-control" >
                            <option value="">--Please choose an option--</option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user['name'] ?>"  selected="<?= $user['name'] == old('userName') ? 'selected' : ''  ?>"><?= $user['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= isset($validation) ? $validation->listErrors('userName') : ''  ?>
                    </div>
                    <div class="mb-3">
                        <label for="docFile" class="form-label">Файл</label>
                        <input name="docFile" class="form-control" type="file" id="docFile" accept=".json, application/json" >
                        <?= isset($validation) ? $validation->listErrors('docFile') : ''  ?>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input  id="readMode" name="readMode" class="form-check-input" type="checkbox" checked <?=oldCheck('readMode') ?> >
                            <label class="form-check-label" for="readMode">
                                файл для редактирования : <?=oldCheck('readMode') ?>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create Document</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</main>
<script type="text/javascript" >
    document.addEventListener('DOMContentLoaded', function() {
        // Your JavaScript code to manipulate the DOM goes here
        console.log('DOM is fully loaded and parsed!');
        // let placeholder="invrpt-new-edit-Krampsup-250807";
        function getNow() {
            const date = new Date(Date.now());
            const y = String(date.getFullYear());
            const m = String(date.getMonth() + 1);
            const mm = m.length === 1 ? `0${m}` : m;
            const d = String(date.getDate());
            const dd = d.length === 1 ? `0${d}` : d;
            return `${y.slice(2)}${mm}${dd}`;
        }
        function getValue(type,id,mode,userName,date) {
            const dateValue = !!date ? date : getNow();
            return `${type}${id}-${mode}-${userName}-${dateValue}`;
        }

        const $fileName = document.getElementById('fileName');
        const $idDoc = document.getElementById('idDoc');
        const $typeDoc = document.getElementById('typeDoc');
        const $userName = document.getElementById('userName');
        const $readMode = document.getElementById('readMode');
        const $docFile = document.getElementById('docFile');

        $docFile?.addEventListener('change', (event) => {
            console.log('98 event',event);
            const filesArr = event.target.files;
            console.log('98 filesArr',filesArr[0]);
            if (!!filesArr[0]) {
                const type = filesArr[0].type;//application/json
                const name = filesArr[0].name;//desadv1252660-read-Kramp-250813_0324.json
                if (/json$/i.test(type)) {
                    console.log('98 name',name);
                    console.log('98 type',type);
                    if (/^\w{6}\d{7}-(read|edit)-\w+-\d{6}/i.test(name)) {
                        //'desadv1252660-read-Kramp-250813_0324.json'
                        const res = /^(\w{6})(\d{7})-(read|edit)-(\w+)-(\d{6})/i.exec(name);//Array|null
                        if (Array.isArray(res)) {
                            const [name,type,id,mode,buyer,date] = res;
                            $fileName.value = name;//getValue(type,id,mode,buyer,date);
                            $idDoc.value = id;
                            $typeDoc.value = type;
                            $userName.value = buyer;
                            // overall.checked = true;
                            $readMode.checked = /(edit|new)/.test(mode);

                        }
                        //[
                        //    "desadv1252660-read-Kramp-250813",
                        //    "desadv",
                        //    "1252660",
                        //    "read",
                        //    "Kramp",
                        //    "250813"
                        //]
                    }
                }
            }

        });
        $readMode?.addEventListener('change', (event) => {
            console.log('137 event',event);
            const checked = event.target.checked;
            const fileName = $fileName.value;
            console.log('140 checked',JSON.stringify(checked));

            if (/^\w{6}\d{7}-(read|edit)-\w+-\d{6}/i.test(fileName)) {
                //'desadv1252660-read-Kramp-250813_0324.json'
                const res = /^(\w{6})(\d{7})-(read|edit)-(\w+)-(\d{6})/i.exec(fileName);//Array|null
                if (Array.isArray(res)) {
                    const [name,type,id,mode,buyer,date] = res;
                    const replaceValue = checked ? 'edit':'read';
                    $fileName.value = (name ?? '').replace(/(edit|read)/, replaceValue);//getValue(type,id,mode,buyer,date);
                    // $idDoc.value = id;
                    $typeDoc.value = replaceValue;
                    $userName.value = buyer;
                    $readMode.value = /(edit|new)/.test(mode);

                }
            }
        });
        $typeDoc?.addEventListener('change', (event) => {
            console.log('event:',event);
            const newDoc = $idDoc.value === 'new' ? '-new' : $idDoc.value;
            const mode = !$readMode.checked || $idDoc.value === 'new' ? 'edit' : 'read';
            $fileName.value = getValue(event.target.value,newDoc,mode,$userName?.value);
        });

    });

</script>
<?php require VIEWS . '/incs/footer.php' ?>