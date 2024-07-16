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
                        <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/Manage_views/vista_vacaciones/">Solicitar vacaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/EmployeeController/requestStatus">Estado de solicitud</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/EmployeeController/editEmployee">Editar perfil</a>
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
        <div class="bg-holder-vac"></div>
    </div>

    <div class="contenedor-vacation col-lg-6">
        <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-8">

                <div class="text-center mb-5 mt-5">
                    <h1 class="fw-bold">Solicita Tus Vacaciones!</h1>
                </div>

                <div class="position-relative">
                    <hr class="text-secondary divider">
                    <div class="divider-content-center">Rellena</div>

                </div>


                <form id="vacacionesForm" method="POST" action="<?php echo RUTA_URL; ?>/EmployeeController/solicitarVacaciones">

                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <label for="fecha_fin">Fecha de Fin:</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <textarea class="form-control" id="motivo" name="motivo" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Enviar Solicitud</button>
                </form>

                <?php if (!empty($data['error_message'])) : ?>
                    <div class="alerta-reqfai alert alert-danger mt-4 mb-0" role="alert">
                        <i class="bx bx-error-circle icon"></i>
                        <?= $data['error_message']; ?>
                    </div>
                <?php elseif (!empty($data['success_message'])) : ?>
                    <div class="alerta-reqsuc alert alert-success mt-5" role="alert">
                        <i class='bx bx-check-shield'></i>
                        <?= $data['success_message']; ?>
                    </div>
                <?php endif; ?>
                <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard" class="btn btn-secondary btn-lg w-100 mt-4">Cancelar</a>
            </div>
        </div>
    </div>
</div>


<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>