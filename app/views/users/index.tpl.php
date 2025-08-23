<?php require VIEWS . '/incs/header.php' ?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>User page</h3>
                <?=$_SESSION['user']['name'] ?>
            </div>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>