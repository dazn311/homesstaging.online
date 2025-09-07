<?php
//var_dump($_SESSION);
require VIEWS . '/incs/header.php';
?>

<main class="main py-3">
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Ошибка!</strong> <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Авторизация</h3>
                <form action="/?login=user" novalidate method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                                name="email"
                                type="email"
                                class="form-control"
                                placeholder="Email"
                                value="<?=$_SESSION['oldData']['email']?>"
                                required>
                        <?= isset($validation) ? $validation->listErrors('email') : ''  ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password" >
                        <?= isset($validation) ? $validation->listErrors('password') : ''  ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>

            </div>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>