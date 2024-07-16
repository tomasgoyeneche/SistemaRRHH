<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<body class="bg-gradient-light">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">Empleado</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" aria-current="page" href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/Manage_views/vista_vacaciones/">Solicitar vacaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/EmployeeController/requestStatus">Estado de solicitud</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/EmployeeController/editEmployee">Editar perfil</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/EmployeeController/beneficios">Beneficios</a>
                        </li>
                    </ul>
                </div>
            </div>

            <a href="<?php echo RUTA_URL; ?>/AuthController/logout" class="login-button">Cerrar Sesión</a>

            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <div class="row vh-100 g-0">

        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div class="bg-holder-edit"></div>
        </div>

        <div class="contenedor-vacation col-lg-6 pt-5">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-10 mt-5">

                    <div class="text-center mb-5 mt-5">
                        <h1 class="fw-bold">Edita Tus Datos!</h1>
                    </div>

                    <div class="position-relative">
                        <hr class="text-secondary divider">
                        <div class="divider-content-center">Modifica</div>

                    </div>


                    <form method="POST" action="<?php echo RUTA_URL; ?>/EmployeeController/editEmployee" enctype="multipart/form-data">

                        <label for="nombre">Nombre:</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($data['usuario']->nombre); ?>" required>
                        </div>
                        <label for="apellido">Apellido:</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($data['usuario']->apellido); ?>" required>
                        </div>
                        <label for="email">Email:</label>
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data['usuario']->email); ?>" required>
                        </div>

                        <label for="avatar">Avatar:</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>

                        <div class="form-group mb-2">
                            <label for="pass">Contraseña:</label>

                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>

                        <label for="pass_repeat">Repetir Contraseña:</label>
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" id="pass_repeat" name="pass_repeat" required>

                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Guardar Cambios</button>
                    </form>

                    <?php if (!empty($data['error_message'])) : ?>
                        <div class="alerta-logreg alert alert-danger d-flex align-items-center mt-4" role="alert">
                            <i class="bx bx-error-circle icon"></i>
                            <?= $data['error_message']; ?>
                        </div>
                    <?php elseif (!empty($data['success_message'])) : ?>
                        <div class="alerta-reqsuc alert alert-success d-flex align-items-center mt-4" role="alert">
                            <i class="bx bx-check-circle icon"></i>
                            <?= $data['success_message']; ?>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard" class="btn btn-secondary btn-lg w-100 mt-4 mb-4">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once RUTA_APP . "/views/layout/landing/footer.php"; ?>