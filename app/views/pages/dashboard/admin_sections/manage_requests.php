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
              <a class="nav-link mx-lg-2 active" href="<?php echo RUTA_URL; ?>/AdminController/manageRequests">Gestionar Solicitudes</a>
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

    <div class="col-lg-3 position-relative d-none d-lg-block">
      <div class="bg-holder-benemp"></div>
    </div>

    <div class="contenedor-vacation col-lg-9">
      <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
        <div class="col col-sm-6 col-lg-7 col-xl-9">
          <div class="form-container">
            <div class="text-center mb-5 mt-5">
              <h1 class="fw-bold">Listado de Vacaciones de Empleados</h1>
            </div>

            <div class="btn-group w-100 mb-4" role="group" aria-label="Ordenar beneficios">
              <a href="<?= RUTA_URL; ?>/AdminController/manageRequests/fecha" class="btn btn-primary">Ordenar por Fecha</a>
              <a href="<?= RUTA_URL; ?>/AdminController/manageRequests/apellido" class="btn btn-primary">Ordenar por Apellido</a>
            </div>

            <div class="position-relative">
              <hr class="text-secondary divider">
              <div class="divider-content-center">Listado</div>

            </div>

            <?php if (!empty($data['success_message'])) : ?>
              <div class="alert alert-success">
                <?= $data['success_message']; ?>
              </div>
            <?php elseif (!empty($data['error_message'])) : ?>
              <div class="alert alert-danger">
                <?= $data['error_message']; ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['solicitudes'])) : ?>

            <div class="table-responsive mt-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Actualizar Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data['solicitudes'] as $solicitud) : ?>
                    <tr>
                      <td><?= htmlspecialchars($solicitud->nombre); ?></td>
                      <td><?= htmlspecialchars($solicitud->apellido); ?></td>
                      <td><?= htmlspecialchars($solicitud->fecha_inicio); ?></td>
                      <td><?= htmlspecialchars($solicitud->fecha_fin); ?></td>
                      <td><?= htmlspecialchars($solicitud->motivo); ?></td>
                      <td><?= htmlspecialchars($solicitud->estado); ?></td>
                      <td>
                        <form method="POST" class="d-flex" action="<?= RUTA_URL; ?>/AdminController/actualizarEstadoSolicitud">
                          <input type="hidden" name="id" value="<?= $solicitud->id; ?>">
                          <input type="hidden" name="orden" value="<?= $data['orden']; ?>">
                          <select name="estado" class="form-select m-2">
                            <option value="pendiente" <?= $solicitud->estado === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="aprobado" <?= $solicitud->estado === 'aprobado' ? 'selected' : ''; ?>>Aprobado</option>
                            <option value="rechazado" <?= $solicitud->estado === 'rechazado' ? 'selected' : ''; ?>>Rechazado</option>
                          </select>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else : ?>
              <div class="alert alert-info" role="alert">No hay solicitudes de vacaciones registradas.</div>
            <?php endif; ?>

            <a href="<?php echo RUTA_URL; ?>/AuthController/redirectDashboard/" class="btn btn-secondary btn-lg w-100 mt-4">Volver al Panel del Empleado</a>
          </div>
        </div>
      </div>
    </div>

  </div>

























  <?php require_once RUTA_APP . "/views/layout/landing/footer.php"; ?>