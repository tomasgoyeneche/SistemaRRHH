<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>
<body class="bg-gradient-light">
<div class="row vh-100 g-0">

    <div class="col-lg-5 position-relative d-none d-lg-block">
        <div class="bg-holder-reg"></div>
    </div>

    <div class="col-lg-7">
        <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-6">
                <a href="<?php echo RUTA_URL; ?>/AuthController/backIndex/" class="logo_reg d-flex justify-content-center mb-3">
                    <img src="<?php echo RUTA_URL; ?>/img/logo-login.png" alt="" width="60">
                </a>

                <div class="text-center mb-4">
                    <h3 class="fw-bold">Sign Up</h3>
                    <p class="text-secondary">Crea Tu Cuenta</p>

                </div>

                <div class="position-relative">
                    <hr class="text-secondary divider">
                    <div class="divider-content-center">Rellena Los Campos</div>

                </div>

                <form class="user" action="<?php echo RUTA_URL; ?>/AuthController/registrarUsuario/" method="POST" enctype="multipart/form-data">


                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-id-card'></i>
                        </span>
                        <input name="dni" type="text" class="form-control form-control-lg fs-6" placeholder="DNI">
                    </div>
                    
                    <?php
                    if ($data['error_dni'] != '') {
                        echo $data['error_dni'];
                    }
                    ?>


                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-rename'></i>
                        </span>
                        <input name="nombre" type="text" class="form-control form-control-lg fs-6" placeholder="Nombre">
                    </div>

                    <?php
                    if ($data['error_nombre'] != '') {
                        echo $data['error_nombre'];
                    }
                    ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bxs-rename'></i>
                        </span>
                        <input name="apellido" type="text" class="form-control form-control-lg fs-6" placeholder="Apellido">
                    </div>

                    <?php
                    if ($data['error_apellido'] != '') {
                        echo $data['error_apellido'];
                    }
                    ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-image-add'></i>
                        </span>
                        <input name="avatar" type="file" id="formFile" class="form-control form-control-lg fs-6">
                    </div>

                    <?php
                    if ($data['error_tipo'] != '') {
                        echo $data['error_tipo'];
                    }
                    ?>
                    <?php
                    if ($data['error_megas'] != '') {
                        echo $data['error_megas'];
                    }
                    ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-user'></i>
                        </span>
                        <input name="email" type="email" class="form-control form-control-lg fs-6" placeholder="Email">
                    </div>

                    <?php
                    if ($data['error_email'] != '') {
                        echo $data['error_email'];
                    }
                    ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-lock-alt'></i>
                        </span>
                        <input name="password" type="password" class="form-control form-control-lg fs-6" placeholder="Contraseña">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-lock-alt'></i>
                        </span>
                        <input name="password2" type="password" class="form-control form-control-lg fs-6" placeholder="Repeti Tu Contraseña">
                    </div>

                    <?php
                    if ($data['error_pass'] != '') {
                        echo $data['error_pass'];
                    }
                    ?>
                    <div class="input-group mb-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="empleado" name="tipo_usuario" value="empleado" checked>
                            <label for="empleado" class="form-check-label text-secondary"><small>Empleado</small></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="administrador" name="tipo_usuario" value="administrador">
                            <label for="administrador" class="form-check-label text-secondary"><small>Administrador</small></label>
                        </div>
                    </div>
                    <?php
                    if ($data['error_tipo_usuario'] != '') {
                        echo $data['error_tipo_usuario'];
                    }
                    ?>
                    <button type="submit" class="boton-submit btn btn-primary btn-lg w-100 mb-3">Register</button>

                </form>
                <div class="text-center">
                    <small>Ya tenes cuenta? <a class="a_login fw-bold" href="<?php echo RUTA_URL; ?>/AuthController/login">Ingresa</a></small>
                </div>
                <div class="text-center mt-1">
                    <small><a href="<?php echo RUTA_URL; ?>/AuthController/resetPassword" class="a_login">Olvidaste tu contraseña?</a></small>
                </div>
            </div>

        </div>

    </div>


</div>


<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>


