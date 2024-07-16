<?php
class AuthController extends BaseController
{
    private $authModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Asegurarse de iniciar la sesión
        }
        $this->authModel = $this->model('AuthModel');
        $this->disableCache();
    }

    private function disableCache()
    {
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
    }

    // Función para llamar a la vista login con blanqueo de errores
    public function login()
    {
        $data = [
            'error_login' => '',
        ];
        $this->view('pages/auth/login', $data);
    }

    // Función que verifica los datos del usuario, guarda los datos en la sesión y redirige al panel correspondiente
    public function loginUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = $_POST['dni'];
            $password = $_POST['password'];

            $usuario = $this->authModel->buscar_por_dni($dni);

            if ($usuario && password_verify($password, $usuario->pass)) {
                // Guardar datos del usuario en la sesión
                $_SESSION['id'] = $usuario->id;
                $_SESSION['nombre'] = $usuario->nombre;
                $_SESSION['avatar'] = $usuario->avatar;
                $_SESSION['tipo_usuario'] = $usuario->tipo_usuario;

                // Redirigir según el tipo de usuario
                if ($usuario->tipo_usuario == 'administrador') {
                    $this->view('pages/dashboard/hr_dashboard');
                } else {
                    $this->view('pages/dashboard/employee_dashboard');
                }
                exit;
            } else {
                $data = [
                    'error_login' => '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    DNI o contraseña incorrectos.</div>'
                ];
                $this->view('pages/auth/login', $data);
            }
        }
    }

    // Función para llamar a la vista registro con blanqueo de errores
    public function register()
    {
        $data = [
            'error_tipo' => '',
            'error_megas' => '',
            'error_pass' => '',
            'error_email' => '',
            'error_nombre' => '',
            'error_apellido' => '',
            'error_tipo_usuario' => '',
            'error_dni' => '',
        ];

        $this->view('pages/auth/register', $data);
    }

    // Función que toma los datos del formulario, hace las verificaciones y los envía al modelo
    public function registrarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $pass2 = $_POST['password2'];
            $tipo_usuario = $_POST['tipo_usuario'];
            $avatar = $_FILES['avatar']['name'];
            $image_type = $_FILES['avatar']['type'];
            $image_size = $_FILES['avatar']['size'];
            $ubi = $_SERVER['DOCUMENT_ROOT'] . RUTA_AVATAR;

            // Inicializar los errores a valores predeterminados
            $data = [
                'error_tipo' => '',
                'error_megas' => '',
                'error_pass' => '',
                'error_email' => '',
                'error_nombre' => '',
                'error_apellido' => '',
                'error_tipo_usuario' => '',
                'error_dni' => '',
            ];

            if (empty($dni)) {
                $data['error_dni'] = '<div class="alerta-logreg alert alert-danger mt-4" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El DNI es obligatorio
                </div>';
            } elseif (strlen($dni) < 7 || strlen($dni) > 9) {
                $data['error_dni'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El Dni debe tener entre 7 y 9 caracteres
                </div>';
            }
            if (empty($nombre)) {
                $data['error_nombre'] = '<div class="alerta-logreg alert alert-danger mt-4" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El nombre es obligatorio
                </div>';
            }
            if (empty($apellido)) {
                $data['error_apellido'] = '<div class="alerta-logreg alert alert-danger mt-4" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El apellido es obligatorio
                </div>';
            }
            // Validar la longitud de la contraseña
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validar el formato del correo electrónico
                $data['error_email'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El formato del correo electrónico es inválido
                </div>';
            }
            if (strlen($pass) < 8 || strlen($pass) > 12) {
                $data['error_pass'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    La contraseña debe tener entre 8 y 12 caracteres
                </div>';
            } elseif ($pass != $pass2) { // Validar que las dos contraseñas coincidan
                $data['error_pass'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Las contraseñas no coinciden
                </div>';
            } elseif ($avatar != '') {
                if ($image_size <= 10000000) {
                    if ($image_type == 'image/jpg' || $image_type == 'image/jpeg' || $image_type == 'image/png') {
                        move_uploaded_file($_FILES['avatar']['tmp_name'], $ubi . $avatar);
                    } else {
                        $data['error_tipo'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                            <i class="bx bx-error-circle icon"></i>
                            El tipo de imagen debe ser jpg, jpeg o png.
                        </div>';
                    }
                } else {
                    $data['error_megas'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                        <i class="bx bx-error-circle icon"></i>
                        El tamaño de la imagen es demasiado grande
                    </div>';
                }
            } else {
                $avatar = 'img_default.png';
            }

            $auth = $this->authModel->buscar_por_dni($dni);
            if ($auth) {
                $data['error_dni'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Este DNI ya está registrado
                </div>';
            }

            $authMail = $this->authModel->buscar_por_mail($email);
            if ($authMail) {
                $data['error_email'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Este Mail ya está registrado
                </div>';
            }

            if (empty($tipo_usuario)) {
                // Si no se seleccionó ningún rol, establece el mensaje de error correspondiente
                $data['error_tipo_usuario'] = '<div class="alerta-logreg alert alert-danger" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Debes seleccionar un rol
                </div>';
            }

            // Si hay algún error, mostramos la vista de registro con los errores
            if (!empty($data['error_dni']) || !empty($data['error_nombre']) || !empty($data['error_apellido']) || !empty($data['error_email']) || !empty($data['error_pass']) || !empty($data['error_tipo']) || !empty($data['error_megas']) || !empty($data['error_tipo_usuario'])) {
                $this->view('pages/auth/register', $data);
                return;
            } else {
                if ($pass == $pass2) {
                    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

                    $area_id = null;
                    if ($tipo_usuario == 'administrador') {
                        $area_id = 1; // Recursos Humanos
                    }

                    $data = [
                        'dni' => $dni,
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'avatar' => $avatar,
                        'email' => $email,
                        'pass' => $hashedPassword,
                        'tipo_usuario' => $tipo_usuario,
                        'area_id' => $area_id,
                    ];
                    $auth = $this->authModel->buscar_por_dni($dni);
                    if (empty($auth)) {
                        if ($this->authModel->crear_usuario($data)) {
                            $this->loginUsuario();
                            return;
                        } else {
                            die("NO SE PUDO CREAR EL USUARIO");
                        }
                    }
                }
            }
        }
    }



    public function backIndex()
    {
        $this->view('pages/index');
    }

    public function resetPassword($data = null)
    {
        if ($data === null) {
            $data = [
                'mail' => '',
                'error_mail' => '',
            ];
        }
        $this->view('pages/auth/forgot-password', $data);
    }


    public function enviar_password()
    {
        // Verificar si el email fue enviado en el formulario
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];

            // Verificar si el formato del email es válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error_mail'] = '<div class="alerta-logreg alert alert-danger mt-2" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    El formato del mail no es valido
                </div>';
                $this->resetPassword($data);
                return;
            }

            // Buscar el email en la base de datos
            $usuario = $this->authModel->buscar_por_mail($email);

            // Si se encuentra el usuario, enviar nueva contraseña
            if (!empty($usuario)) {
                $where = "new_pass";
                include(RUTA_APP . "/mails/mail_pass.php");
            } else {
                // Mostrar mensaje de error si el email no se encuentra en la base de datos
                $data['error_mail'] = '<div class="alerta-logreg alert alert-danger mt-2" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    No es un mail valido
                </div>';
                $this->resetPassword($data);
            }
        } else {
            // Mostrar mensaje de error si no se envió un email en el formulario
            $data['error_mail'] = '<div class="alerta-logreg alert alert-danger mt-2" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Debe ingresar un Email
                </div>';
            $this->resetPassword($data);
        }
    }

    public function update_pass()
    {
        $data = [
            'mail' => '',
            'error_mail' => '',
            'error_pass' => '',
        ];
        $this->view('pages/auth/updated-password', $data);
    }


    public function actualizar_password()
    {
        $email = $_POST['email'];
        $passActual = $_POST['pass_actual'];
        $passNueva = $_POST['pass_nueva'];
        $passNueva2 = $_POST['pass_nueva2'];

        // Obtener la información del usuario desde la base de datos
        $usuario = $this->authModel->buscar_por_mail($email);

        // Verificar si el usuario existe y si la contraseña actual es correcta
        if (!empty($usuario) && password_verify($passActual, $usuario->pass)) {
            // Verificar si las contraseñas nuevas coinciden
            if ($passNueva != $passNueva2) {
                $data = [
                    'mail' => '',
                    'error_mail' => '',
                    'error_pass' => '<div class="alerta-logreg alert alert-danger mt-4" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    Las contraseñas no coinciden
                </div>',
                ];
                $this->view('pages/auth/updated-password', $data);
            } else {
                // Cambiar la contraseña en la base de datos
                if ($this->authModel->change_pass($passNueva, $email)) {
                    $data = [
                        'mail' => '',
                        'error_mail' => '',
                        'error_pass' => '<div class="alerta-reqsuc alert alert-success mt-2" role="alert">
                    La contraseña fue actualizada
                </div>',
                    ];
                    $this->view('pages/auth/updated-password', $data);
                }
            }
        } else {
            // Mostrar mensaje de error si la contraseña actual no es válida
            $data = [
                'mail' => '',
                'error_mail' => '',
                'error_pass' => '<div class="alerta-logreg alert alert-danger mt-4" role="alert">
                    <i class="bx bx-error-circle icon"></i>
                    La contraseña actual es incorrecta
                </div>',
            ];
            $this->view('pages/auth/updated-password', $data);
        }
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página de inicio
        $this->view('pages/index');
    }

    // Función para utilizar al momento de volver hacia atras en las vistas. (PREGUNTAR AL PROFE)
    public function redirectDashboard()
    {
        if ($_SESSION['tipo_usuario'] == 'administrador') {
            $this->view('pages/dashboard/hr_dashboard');
        } else {
            $this->view('pages/dashboard/employee_dashboard');
        }
        exit;
    }
}
