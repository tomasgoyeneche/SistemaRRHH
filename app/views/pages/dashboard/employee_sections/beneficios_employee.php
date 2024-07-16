<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<body class="bg-gradient-light fondopag">
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
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/EmployeeController/editEmployee">Editar perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/EmployeeController/beneficios">Beneficios</a>
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
            <div class="bg-holder-benemp"></div>
        </div>

        <div class="contenedor-vacation col-lg-6">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-9">
                    <div class="form-container">
                        <div class="text-center mb-5 mt-5">
                            <h1 class="fw-bold">Beneficios</h1>
                        </div>

                        <div class="btn-group w-100 mb-4" role="group" aria-label="Ordenar beneficios">
                            <a href="<?php echo RUTA_URL; ?>/EmployeeController/beneficios/descuento" class="btn btn-primary <?php echo $data['criterio'] == 'descuento' ? 'active' : ''; ?>">Ordenar por Descuento</a>
                            <a href="<?php echo RUTA_URL; ?>/EmployeeController/beneficios/categoria" class="btn btn-primary <?php echo $data['criterio'] == 'categoria' ? 'active' : ''; ?>">Ordenar por Categoría</a>
                        </div>

                        <div class="position-relative">
                            <hr class="text-secondary divider">
                            <div class="divider-content-center">Listado</div>

                        </div>

                        <?php if (!empty($data['beneficios'])) : ?>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Descuento</th>
                                        <th>Categoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['beneficios'] as $beneficio) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($beneficio->nombre); ?></td>
                                            <td><?php echo htmlspecialchars($beneficio->descripcion); ?></td>
                                            <td><?php echo htmlspecialchars($beneficio->descuento); ?>%</td>
                                            <td><?php echo htmlspecialchars($beneficio->categoria); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-info mt-4" role="alert">No hay beneficios disponibles.</div>
                        <?php endif; ?>

                        <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/" class="btn btn-secondary btn-lg w-100 mt-4">Volver al Panel del Empleado</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <?php require_once RUTA_APP . "/views/layout/landing/footer.php"; ?>