<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<body class="bg-gradient-light fondopag">

    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    </head>

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
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/Manage_views/vista_vacaciones/">Solicitar vacaciones</a>
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

    <section class="seccion-principal">
        <div class="container contenedor-solicit">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-secondary text-black  text-center">
                            <p class="mt-3 font-weight-bold">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8'); ?>!</p>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?php echo htmlspecialchars(RUTA_AVATAR . $_SESSION['avatar'], ENT_QUOTES, 'UTF-8'); ?>" alt="Avatar" class="rounded-circle img-fluid mb-4" style="width: 150px; height: 150px;">
                            <p class="lead">Estamos encantados de tenerte de vuelta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>