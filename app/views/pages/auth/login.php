<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>
<body class="bg-gradient-light">

<div class="row vh-100 g-0">

    <div class="col-lg-6 position-relative d-none d-lg-block">
        <div class="bg-holder"></div>
    </div>

    <div class="col-lg-6">
        <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-6">
                <a href="<?php echo RUTA_URL; ?>/AuthController/backIndex/" class="logo_reg d-flex justify-content-center mb-4">
                    <img src="<?php echo RUTA_URL; ?>/img/logo-login.png" alt="" width="60">
                </a>

                <div class="text-center mb-5">
                    <h3 class="fw-bold">Login</h3>
                    <p class="text-secondary">Acceso a tu cuenta</p>

                </div>

                <div class="position-relative">
                    <hr class="text-secondary divider">
                    <div class="divider-content-center">Ingreso</div>

                </div>

                <form class="user" action="<?php echo RUTA_URL; ?>/AuthController/loginUsuario/" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-user'></i>
                        </span>
                        <input name="dni" type="dni" class="form-control form-control-lg fs-6" placeholder="DNI">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-lock-alt'></i>
                        </span>
                        <input name="password" type="password" class="form-control form-control-lg fs-6" placeholder="Contraseña">
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck">
                            <label for="customCheck" class="form-check-label text-secondary"><small>Recordame</small></label>
                        </div>
                        <div>
                            <small><a href="<?php echo RUTA_URL; ?>/AuthController/resetPassword" class="a_login">Olvidaste tu contraseña?</a></small>
                        </div>
                    </div>
                    <?php
                    if ($data['error_login'] != '') {
                        echo $data['error_login'];
                    }
                    ?>
                    <button type="submit" class="boton-submit btn btn-primary btn-lg w-100 mb-3">Login</button>
                </form>
                <div class="text-center">
                    <small>No tenes cuenta? <a class="a_login fw-bold" href="<?php echo RUTA_URL; ?>/AuthController/register">Registrate</a></small>
                </div>
            </div>

        </div>

    </div>


</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>