<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<body class="bg-gradient-light fondopag">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">Administrador</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" aria-current="page" href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageEmployees/">Gestionar Empleados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageRequests">Gestionar Solicitudes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageAreas">Manejo Areas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/AdminController/manageBeneficios">Manejo Beneficios</a>
                        </li>
                    </ul>
                </div>
            </div>

            <a href="<?php echo RUTA_URL; ?>/AuthController/logout" class="login-button">Logout</a>

            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>








    <div class="row vh-100 g-0">


        <div class="contenedor-vacation col-lg-6">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-10">
                    <div class="form-container pt-5 ">

                        <?php if (!empty($data['success_message'])) : ?>
                            <div class="alert alert-success espacio_top">
                                <?= $data['success_message']; ?>
                            </div>
                        <?php elseif (!empty($data['error_message'])) : ?>
                            <div class="alert alert-danger espacio_top">
                                <?= $data['error_message']; ?>
                            </div>
                        <?php endif; ?>

                        <div class="text-center mt-2">
                            <h1 class="fw-bold mb-4">Categorías</h1>
                        </div>




                        <h3>Agregar Categoría</h3>
                        <form method="POST" action="<?= RUTA_URL; ?>/AdminController/agregarCategoria">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Agregar</button>
                        </form>





                        <div class="position-relative mt-4">
                            <hr class="text-secondary divider">
                            <div class="divider-content-center">Listado</div>

                        </div>
                        <div class="table-responsive mt-4">

                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['categorias'] as $categoria) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($categoria->nombre); ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarCategoriaModal<?= $categoria->id ?>">Editar</button>
                                                <a href="<?= RUTA_URL; ?>/AdminController/eliminarCategoria/<?= $categoria->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            </td>
                                        </tr>

                                        <!-- Modal Editar Categoría -->
                                        <div class="modal fade" id="editarCategoriaModal<?= $categoria->id ?>" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="<?= RUTA_URL; ?>/AdminController/actualizarCategoria">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Categoría</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $categoria->id ?>">
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($categoria->nombre) ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>



                        <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/" class="btn btn-secondary btn-lg w-100 mt-2 mb-4">Volver al Panel del Empleado</a>
                    </div>
                </div>
            </div>
        </div>




















        <div class="contenedor-vacation col-lg-6">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-10">
                    <div class="form-container pt-5">



                        <div class="text-center mt-5 pt-5">
                            <h1 class="fw-bold mb-5">Manejo de Beneficios</h1>
                        </div>



                        <h3>Agregar Beneficio</h3>
                        <form method="POST" action="<?= RUTA_URL; ?>/AdminController/agregarBeneficio">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" required>

                            </div>
                            <div class="form-group">
                                <label for="descuento" class="form-label">Descuento (%):</label>
                                <input type="number" class="form-control" name="descuento" required>
                            </div>
                            <div class="form-group">
                                <label for="categoria_id" class="form-label">Descuento (%):</label>
                                <select class="form-control" name="categoria_id" required>
                                    <?php foreach ($data['categorias'] as $categoria) : ?>
                                        <option value="<?= $categoria->id ?>"><?= htmlspecialchars($categoria->nombre) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Agregar</button>
                        </form>


                        <div class="position-relative mt-4">
                            <hr class="text-secondary divider">
                            <div class="divider-content-center">Listado</div>

                        </div>
                        <div class="table-responsive">                
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Descuento</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['beneficios'] as $beneficio) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($beneficio->nombre); ?></td>
                                            <td><?= htmlspecialchars($beneficio->descripcion); ?></td>
                                            <td><?= htmlspecialchars($beneficio->descuento); ?>%</td>
                                            <td><?= htmlspecialchars($beneficio->categoria_nombre); ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarBeneficioModal<?= $beneficio->id ?>">Editar</button>
                                                <a href="<?= RUTA_URL; ?>/AdminController/eliminarBeneficio/<?= $beneficio->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            </td>
                                        </tr>

                                        <!-- Modal Editar Beneficio -->
                                        <div class="modal fade" id="editarBeneficioModal<?= $beneficio->id ?>" tabindex="-1" aria-labelledby="editarBeneficioModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="<?= RUTA_URL; ?>/AdminController/actualizarBeneficio">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarBeneficioModalLabel">Editar Beneficio</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $beneficio->id ?>">
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($beneficio->nombre) ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descripcion" class="form-label">Descripción</label>
                                                                <input type="text" class="form-control" name="descripcion" value="<?= htmlspecialchars($beneficio->descripcion) ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descuento" class="form-label">Descuento (%)</label>
                                                                <input type="number" class="form-control" name="descuento" value="<?= htmlspecialchars($beneficio->descuento) ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoria_id" class="form-label">Categoría</label>
                                                                <select class="form-control" name="categoria_id" required>
                                                                    <?php foreach ($data['categorias'] as $categoria) : ?>
                                                                        <option value="<?= $categoria->id ?>" <?= $categoria->id == $beneficio->categoria_id ? 'selected' : '' ?>><?= htmlspecialchars($categoria->nombre) ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>

    <!-- Beneficios -->



    <?php require_once RUTA_APP . "/views/layout/landing/footer.php"; ?>