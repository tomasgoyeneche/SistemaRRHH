<?php require RUTA_APP . '/views/layout/landing/header.php'; ?>

<body class="bg-gradient-light fondopag">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">RRHH</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RRHH</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                    </ul>
                </div>
            </div>

            <a href="<?php echo RUTA_URL; ?>/AuthController/register" class="register-button">Register</a>
            <a href="<?php echo RUTA_URL; ?>/AuthController/login" class="login-button">Login</a>

            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <section class="seccion-principal">
        <div class="container mt-5 pt-5">
            <h1 class="text-center mb-5 text-white mt-5">Noticias y Actualizaciones</h1>
            <div class="row">
                <!-- Artículo 1 -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="<?php echo RUTA_URL; ?>/img/card-aumento.jpg" class="card-img-top" alt="Aumento de Sueldo">
                        <div class="card-body">
                            <h5 class="card-title">La compañía anuncia aumento de sueldo del 10%</h5>
                            <p class="card-text">

                                La empresa líder en tecnología, ha anunciado un incremento salarial del 10% para todos sus trabajadores a partir del próximo mes. Este aumento se implementa como parte de su compromiso continuo con el bienestar y la motivación de su equipo, destacando el valor que la empresa otorga a la dedicación y el esfuerzo de cada uno de sus miembros.</p>
                        </div>
                    </div>
                </div>
                <!-- Artículo 2 -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="<?php echo RUTA_URL; ?>/img/card-beneficios.jpg" class="card-img-top" alt="Beneficios Destacados">
                        <div class="card-body">
                            <h5 class="card-title">Beneficios Destacados</h5>
                            <p class="card-text">La empresa hizo un aumento salarial del 10% para sus empleados, además de nuevos beneficios que incluyen seguro médico ampliado y días de vacaciones adicionales. Esta medida busca fortalecer el compromiso de la empresa con el bienestar y la satisfacción de su equipo.</p>

                        </div>
                    </div>
                </div>
                <!-- Artículo 3 -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="<?php echo RUTA_URL; ?>/img/card-ascenso.jpg" class="card-img-top" alt="Ascensos">
                        <div class="card-body">
                            <h5 class="card-title">La compania promueve el crecimiento</h5>
                            <p class="card-text">La empresa ha lanzado un programa de ascensos internos para sus empleados, con el objetivo de reconocer y cultivar el talento dentro de la empresa. Este programa ofrece a los empleados la oportunidad de avanzar en sus carreras profesionales, alineando sus habilidades con nuevas responsabilidades y oportunidades de liderazgo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require RUTA_APP . '/views/layout/landing/footer.php'; ?>