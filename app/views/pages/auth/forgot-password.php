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
                    <h3 class="fw-bold">¿Olvidaste la contraseña?</h3>
                    <p class="text-secondary">Ingresa tu email y te enviaremos un enlace para generar una nueva.</p>
                </div>

                <div class="position-relative">
                    <hr class="text-secondary divider">
                    <div class="divider-content-center">Mail</div>
                </div>

                <form class="user" action="<?php echo RUTA_URL; ?>/AuthController/enviar_password" method="post">
                    <div class="input-group mb-2">
                        <span class="input-group-text">
                            <i class='bx bx-user'></i>
                        </span>
                        <input name="email" type="email" class="form-control form-control-lg fs-6" placeholder="Email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
                    </div>
                    <button type="submit" class="boton-submit btn btn-primary btn-lg w-100 mb-1 mt-3">Enviar</button>
                    
                    <!-- Mostrar mensajes de éxito o error-->
                    <?php if (isset($data['mail']) && $data['mail'] != ''): ?>
                            <?php echo $data['mail']; ?>
                    <?php endif; ?>
                    <?php if (isset($data['error_mail']) && $data['error_mail'] != ''): ?>
                            <?php echo $data['error_mail']; ?>
                    <?php endif; ?>
                </form>

                <div class="position-relative">
                    <hr class="text-secondary divider">
                </div>
                <div class="text-center">
                    <small>No tenes cuenta? <a class="a_login fw-bold" href="<?php echo RUTA_URL; ?>/AuthController/register">Registrate</a></small>
                </div>
                <div class="text-center mt-1">
                    <small><a href="<?php echo RUTA_URL; ?>/AuthController/login" class="a_login">Iniciar Sesion</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>