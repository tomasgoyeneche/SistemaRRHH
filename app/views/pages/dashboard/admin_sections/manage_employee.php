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
              <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/AdminController/manageEmployees/">Gestionar Empleados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageRequests">Gestionar Solicitudes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageAreas">Manejo Areas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="<?php echo RUTA_URL; ?>/AdminController/manageBeneficios">Manejo Beneficios</a>
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
    <div class="col-lg-12">
      <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
        <div class="col col-sm-6 col-lg-7 col-xl-10 text-white">
          <div class="form-container pt-5">
            <div class="text-center mt-5 mb-4">
              <h1 class="fw-bold">Gestión de Empleados</h1>
            </div>

            <div class="position-relative mt-5">
              <hr class="text-secondary divider">
              <div class="divider-content-center">Listado</div>
            </div>

            <div class="table-responsive mt-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Área</th>
                    <th>Sueldo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data['empleados'] as $empleado) : ?>
                    <tr>
                      <td><?= $empleado->id; ?></td>
                      <td><?= htmlspecialchars($empleado->dni); ?></td>
                      <td><?= htmlspecialchars($empleado->nombre); ?></td>
                      <td><?= htmlspecialchars($empleado->apellido); ?></td>
                      <td><?= htmlspecialchars($empleado->email); ?></td>
                      <td><?= htmlspecialchars($empleado->area_id); ?></td>
                      <td>$<?= htmlspecialchars($empleado->sueldo); ?></td>
                      <td>
                        <a href="<?php echo RUTA_URL; ?>/AdminController/editarEmpleado/<?= $empleado->id; ?>" class="btn btn-warning">Editar</a>
                        <form method="POST" action="<?php echo RUTA_URL; ?>/AdminController/eliminarEmpleado/<?= $empleado->id; ?>" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');" style="display:inline;">
                          <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/" class="btn btn-secondary btn-lg w-100 mt-4 mb-4">Volver al Panel del Empleado</a>
          </div>
        </div>
      </div>
    </div>
  </div>




  <?php require_once RUTA_APP . "/views/layout/landing/footer.php"; ?>