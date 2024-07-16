<?php
class EmployeeController extends BaseController {
    private $solicitudModel;
    private $beneficiosModel;
    private $employeeModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->solicitudModel = $this->model('SolicitudVacaciones');
        $this->beneficiosModel = $this->model('Beneficio');
        $this->employeeModel = $this->model('Employee');
        $this->disableCache();
    }

    private function disableCache() {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }


    // controlador de las vacaciones

    public function solicitarVacaciones() {
        if (!isset($_SESSION['id'])) {
            $data = [
                'error_message' => 'No has iniciado sesión. Por favor, <a href="' . RUTA_URL . '/AuthController/login">inicia sesión</a>.'
            ];
            $this->view('employee/solicitar_vacaciones', $data);
            return;
        }
    
        $data = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userid = $_SESSION['id'];
            $fecha_inicio = $_POST["fecha_inicio"];
            $fecha_fin = $_POST["fecha_fin"];
            $motivo = $_POST["motivo"];
            $hoy = date('Y-m-d');
    
            // Convertir fechas a timestamps
            $inicio = strtotime($fecha_inicio);
            $fin = strtotime($fecha_fin);
            $diasVacaciones = ($fin - $inicio) / (60 * 60 * 24) + 1; // +1 para incluir el primer día
            
            // validar 2 empleados misma fecha
            $empleadosVacaciones = $this->solicitudModel->validarVacacionesSimultaneas($fecha_inicio, $fecha_fin);
            // Validaciones
            if ($inicio < strtotime($hoy)) {
                $data['error_message'] = "La fecha de inicio no puede ser anterior a hoy.";
            } elseif ($diasVacaciones < 7) {
                $data['error_message'] = "El minimo de vacaciones es de 7 dias.";
            } elseif ($diasVacaciones > 30) {
                $data['error_message'] = "No puedes solicitar más de 30 días de vacaciones.";
            } elseif ($this->solicitudModel->tieneSolicitudActiva($userid)) {
                $data['error_message'] = "Ya tienes una solicitud de vacaciones activa.";
            } elseif ($empleadosVacaciones >= 2) {
                $data['error_message'] = "No se pueden tomar más de 2 empleados vacaciones en el mismo período.";
            } else {
                if ($this->solicitudModel->insertarSolicitud($userid, $fecha_inicio, $fecha_fin, $motivo)) {
                    $data['success_message'] = "Solicitud de vacaciones enviada exitosamente";
                } else {
                    $data['error_message'] = "Error al enviar la solicitud de vacaciones";
                }
            }
        }

        $this->view('pages/dashboard/employee_sections/request_vacation', $data);
    }

    // Nuevo método para mostrar el estado de las solicitudes de vacaciones
    public function requestStatus() {
        if (!isset($_SESSION['id'])) {
            $data = [
                'error_message' => 'No has iniciado sesión. Por favor, <a href="' . RUTA_URL . '/AuthController/login">inicia sesión</a>.'
            ];
            $this->view('pages/dashboard/employee_sections/request_status', $data);
            return;
        }
    
        $userid = $_SESSION['id'];
        $solicitudes = $this->solicitudModel->obtenerSolicitudesPorUsuario($userid);
    
        $formattedSolicitudes = array_map(function($solicitud) {
            return [
                'fecha_inicio' => htmlspecialchars($solicitud->fecha_inicio),
                'fecha_fin' => htmlspecialchars($solicitud->fecha_fin),
                'motivo' => htmlspecialchars($solicitud->motivo),
                'estado' => htmlspecialchars($solicitud->estado),
            ];
        }, $solicitudes);
    
        $data = [
            'solicitudes' => $formattedSolicitudes,
            'hasSolicitudes' => !empty($formattedSolicitudes),
            'dashboardUrl' => RUTA_URL . '/AuthController/redirectDashboard'
        ];
    
        $this->view('pages/dashboard/employee_sections/request_status', $data);
    }



    // controlador de los beneficios
    public function beneficios($criterio = 'descuento') {
        if ($criterio == 'categoria') {
            $beneficios = $this->beneficiosModel->obtenerBeneficiosPorCategoria();
        } else {
            $beneficios = $this->beneficiosModel->obtenerBeneficiosPorDescuento();
        }

        $data = [
            'beneficios' => $beneficios,
            'criterio' => $criterio
        ];

        $this->view('pages/dashboard/employee_sections/beneficios_employee', $data);
    }










    public function editEmployee() {
        if (!isset($_SESSION['id'])) {
            $data = [
                'error_message' => 'No has iniciado sesión. Por favor, <a href="' . RUTA_URL . '/AuthController/login">inicia sesión</a>.'
            ];
            $this->view('pages/dashboard/employee_sections/edit_employee', $data);
            return;
        }

        $userid = $_SESSION['id'];
        $usuario = $this->employeeModel->obtenerUsuarioPorId($userid);

        $data = [
            'usuario' => $usuario,
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $pass = !empty($_POST['pass']) ? $_POST['pass'] : null;
            $pass_repeat = !empty($_POST['pass_repeat']) ? $_POST['pass_repeat'] : null;

            if ($this->employeeModel->emailExiste($email, $userid)) {
                $data['error_message'] = "El email ya está en uso por otro usuario";
            } else if ($pass && $pass_repeat && $pass !== $pass_repeat) {
                $data['error_message'] = "Las contraseñas no coinciden";
            } else {
                // Validar y subir el avatar
                $avatar = $usuario->avatar;
                if (!empty($_FILES['avatar']['name'])) {
                    $result = $this->validarYSubirAvatar($_FILES['avatar']);
                    if ($result['success']) {
                        $avatar = $result['filename'];
                    } else {
                        $data['error_message'] = $result['message'];
                        $this->view('pages/dashboard/employee_sections/edit_employee', $data);
                        return;
                    }
                }

                $hashedPass = $pass ? password_hash($pass, PASSWORD_DEFAULT) : $usuario->pass;

                // Actualizar datos del usuario
                if ($this->employeeModel->actualizarUsuario($userid, $nombre, $apellido, $email, $hashedPass, $avatar)) {
                    $data['success_message'] = "Datos actualizados correctamente";
                    // Actualizar los datos de sesión
                    $_SESSION['nombre'] = $nombre;
                } else {
                    $data['error_message'] = "Error al actualizar los datos";
                }

                // Obtener datos actualizados
                $usuario = $this->employeeModel->obtenerUsuarioPorId($userid);
                $data['usuario'] = $usuario;
            }
        }   

        $this->view('pages/dashboard/employee_sections/edit_employee', $data);
    }

    private function validarYSubirAvatar($file) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Solo se permiten archivos JPG, PNG y GIF.'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'message' => 'El archivo no debe superar los 2MB.'];
        }


        $target_dir = "../public/img/avatar/";
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return ['success' => true, 'filename' => basename($file["name"])];
        } else {
            return ['success' => false, 'message' => 'Error al subir el archivo.'];
        }
    }
}
?>


