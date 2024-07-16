<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<body class="bg-gradient-light">



    <div class="row vh-100 g-0">

        <div class="col-lg-7 position-relative d-none d-lg-block">
            <div class="bg-holder-for"></div>
        </div>

        <div class="col-lg-5 backwhite">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-6">
                    <a href="<?php echo RUTA_URL; ?>/AuthController/backIndex/" class="logo_reg d-flex justify-content-center mb-4">
                        <img src="<?php echo RUTA_URL; ?>/img/logo-login.png" alt="" width="60">
                    </a>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mt-2">Reseteo De Contraseña</h3>
                        <p class="text-secondary mt-2">Ingresa los datos a continuacion para resetear tu contraseña.</p>
                    </div>

                    <div class="position-relative">
                        <hr class="text-secondary divider">
                        <div class="divider-content-center">Rellena</div>
                    </div>

                    <form class="user" action="<?php echo RUTA_URL; ?>/AuthController/actualizar_password/" method="POST">
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class='bx bx-user'></i>
                            </span>
                            <input name="email" type="email" class="form-control form-control-lg fs-6" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tu email">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text">
                                <i class='bx bx-lock-alt'></i>
                            </span>
                            <input name="pass_actual" type="password" class="form-control form-control-lg fs-6" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Contraseña actual">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text">
                                <i class='bx bx-lock-open-alt'></i>
                            </span>
                            <input name="pass_nueva" type="password" class="form-control form-control-lg fs-6" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nueva Contraseña">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text">
                                <i class='bx bxs-lock-open-alt'></i>
                            </span>
                            <input name="pass_nueva2" type="password" class="form-control form-control-lg fs-6" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Repetir Nueva Contraseña">
                        </div>
                        <?php
                        if ($data['error_pass'] != '') {
                            echo $data['error_pass'];
                        }
                        ?>
                        <button type="submit" class="boton-submit btn btn-primary btn-lg w-100 mt-4">Enviar</button>

                    </form>
                    <?php if ($data['mail'] != '') {
                        echo $data['mail'];
                    }
                    ?>
                    <?php if ($data['error_mail'] != '') {
                        echo $data['error_mail'];
                    }
                    ?>
                    <div class="position-relative">
                        <hr class="text-secondary divider">
                    </div>
                    <div class="text-center">
                        <small><a href="<?php echo RUTA_URL; ?>/AuthController/login" class="a_login">Iniciar Sesion</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>