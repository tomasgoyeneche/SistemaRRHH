<?php
class AdminController extends BaseController {
    private $adminModel;
    private $solicitudModel;
    private $beneficioModel;
    private $categoriaModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->adminModel = $this->model('Admin');
        $this->solicitudModel = $this->model('SolicitudVacaciones');
        $this->beneficioModel = $this->model('Beneficio');
        $this->categoriaModel = $this->model('Categoria');
        $this->disableCache();
    }

    private function disableCache() {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }



    // MANEJO DE AREAS

    public function manageAreas() {
        $areas = $this->adminModel->obtenerAreas();
        $data = [
            'areas' => $areas
        ];

        $this->view('pages/dashboard/admin_sections/manage_areas', $data);
    }

    public function crearArea() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);

            if (empty($nombre) || empty($descripcion)) {
                $data['error_message'] = 'Por favor, completa todos los campos';
                $this->view('pages/dashboard/admin_sections/manage_areas', $data);
                return;
            }

            if ($this->adminModel->crearArea($nombre, $descripcion)) {
                $data['success_message'] = 'Área creada exitosamente';
            } else {
                $data['error_message'] = 'Error al crear el área';
            }

            $areas = $this->adminModel->obtenerAreas();
            $data['areas'] = $areas;
            $this->view('pages/dashboard/admin_sections/manage_areas', $data);
        } else {
            $this->manageAreas();
        }
    }

    public function eliminarArea($id) {
        if ($this->adminModel->eliminarArea($id)) {
            $data['success_message'] = 'Área eliminada exitosamente';
        } else {
            $data['error_message'] = 'Error al eliminar el área';
        }

        $areas = $this->adminModel->obtenerAreas();
        $data['areas'] = $areas;
        $this->view('pages/dashboard/admin_sections/manage_areas', $data);
    }






        // MANEJO DE EMPLEADOS

    public function manageEmployees() {
        $empleados = $this->adminModel->obtenerEmpleados();
        $areas = $this->adminModel->obtenerAreas();

        $data = [
            'empleados' => $empleados,
            'areas' => $areas
        ];

        $this->view('pages/dashboard/admin_sections/manage_employee', $data);
    }

    public function editarEmpleado($id) {
        $empleado = $this->adminModel->obtenerEmpleadoPorId($id);
        $areas = $this->adminModel->obtenerAreas();

        $data = [
            'empleado' => $empleado,
            'areas' => $areas
        ];

        $this->view('pages/dashboard/admin_sections/edit_employee_form', $data);
    }

    public function actualizarEmpleado($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $avatar = '';
            $error_message = '';

            // Validaciones de datos
            $email = trim($_POST['email']);
            if ($this->adminModel->emailExiste($email, $id)) {
                $error_message = 'El email ya está en uso por otro empleado.';
            }

            $dni = trim($_POST['dni']);
            if ($this->adminModel->dniExiste($dni, $id)) {
                $error_message = 'El dni ya está en uso por otro empleado.';
            }

            

            // Validaciones de subida de archivo
            if (!empty($_FILES['avatar']['name'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);

                if ($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif']) && $_FILES["avatar"]["size"] <= 500000) {
                    if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        $error_message = 'Hubo un error al subir el archivo.';
                    } else {
                        $avatar = $target_file;
                    }
                } else {
                    $error_message = 'El archivo debe ser una imagen (jpg, png, jpeg, gif) y no debe superar los 500KB.';
                }
            }

            if ($error_message) {
                $empleado = $this->adminModel->obtenerEmpleadoPorId($id);
                $areas = $this->adminModel->obtenerAreas();

                $data = [
                    'error_message' => $error_message,
                    'empleado' => (object)[
                        'id' => $id,
                        'dni' => trim($_POST['dni']),
                        'nombre' => trim($_POST['nombre']),
                        'apellido' => trim($_POST['apellido']),
                        'avatar' => $avatar ?: $empleado->avatar,
                        'email' => $email,
                        'sueldo' => trim($_POST['sueldo']),
                        'area_id' => trim($_POST['area_id']),
                    ],
                    'areas' => $areas
                ];

                $this->view('pages/dashboard/admin_sections/edit_employee_form', $data);
                return;
            }

            $data = [
                'id' => $id,
                'dni' => $dni,
                'nombre' => trim($_POST['nombre']),
                'apellido' => trim($_POST['apellido']),
                'avatar' => $avatar,
                'email' => $email,
                'sueldo' => trim($_POST['sueldo']),
                'area_id' => trim($_POST['area_id'])
            ];

            if ($this->adminModel->actualizarEmpleado($data)) {
                header('location: ' . RUTA_URL . '/AdminController/manageEmployees');
            } else {
                die('Algo salió mal');
            }
        }
    }

    public function eliminarEmpleado($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModel->eliminarEmpleado($id)) {
                header('location: ' . RUTA_URL . '/AdminController/manageEmployees');
            } else {
                die('Algo salió mal');
            }
        }
    }







    
    // MANEJO DE Vacaciones

    public function manageRequests($orden = 'fecha') {
        $solicitudes = $this->solicitudModel->obtenerSolicitudesOrdenadas($orden);

        $data = [
            'solicitudes' => $solicitudes,
            'orden' => $orden,
            'success_message' => $_SESSION['success_message'] ?? null,
            'error_message' => $_SESSION['error_message'] ?? null
        ];

        unset($_SESSION['success_message'], $_SESSION['error_message']);

        $this->view('pages/dashboard/admin_sections/manage_requests', $data);
    }

    public function actualizarEstadoSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $estado = $_POST['estado'];

            if ($this->solicitudModel->actualizarEstado($id, $estado)) {
                $data['success_message'] = 'El estado de la solicitud se actualizó correctamente.';
            } else {
                $data['error_message'] = 'Hubo un error al actualizar el estado de la solicitud.';
            }

            // Redirigir a la página de gestión de solicitudes con el orden actual
            header('Location: ' . RUTA_URL . '/AdminController/manageRequests/' . $_POST['orden']);
            exit();
        }
    }












    // MANEJO DE beneficios y categorias

    public function manageBeneficios() {
        $beneficios = $this->beneficioModel->obtenerBeneficios();
        $categorias = $this->categoriaModel->obtenerCategorias();

        $data = [
            'beneficios' => $beneficios,
            'categorias' => $categorias,
            'success_message' => $_SESSION['success_message'] ?? null,
            'error_message' => $_SESSION['error_message'] ?? null
        ];

        unset($_SESSION['success_message'], $_SESSION['error_message']);

        $this->view('pages/dashboard/admin_sections/manage_beneficios', $data);
    }

    public function agregarBeneficio() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'descuento' => trim($_POST['descuento']),
                'categoria_id' => trim($_POST['categoria_id'])
            ];

            if ($this->beneficioModel->agregarBeneficio($data)) {
                $_SESSION['success_message'] = 'Beneficio agregado correctamente.';
            } else {
                $_SESSION['error_message'] = 'Hubo un error al agregar el beneficio.';
            }

            header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
            exit();
        }
    }

    public function actualizarBeneficio() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'descuento' => trim($_POST['descuento']),
                'categoria_id' => trim($_POST['categoria_id'])
            ];

            if ($this->beneficioModel->actualizarBeneficio($data)) {
                $_SESSION['success_message'] = 'Beneficio actualizado correctamente.';
            } else {
                $_SESSION['error_message'] = 'Hubo un error al actualizar el beneficio.';
            }

            header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
            exit();
        }
    }

    public function eliminarBeneficio($id) {
        if ($this->beneficioModel->eliminarBeneficio($id)) {
            $_SESSION['success_message'] = 'Beneficio eliminado correctamente.';
        } else {
            $_SESSION['error_message'] = 'Hubo un error al eliminar el beneficio.';
        }

        header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
        exit();
    }

    public function agregarCategoria() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);

            if (strlen($nombre) < 5) {
                $_SESSION['error_message'] = 'El nombre de la categoría debe tener al menos 5 caracteres.';
                header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
                exit();
            }


            if ($this->categoriaModel->agregarCategoria($nombre)) {
                $_SESSION['success_message'] = 'Categoría agregada correctamente.';
            } else {
                $_SESSION['error_message'] = 'El nombre de la categoría ya existe.';
            }

            header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
            exit();
        }
    }

    public function actualizarCategoria() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nombre = trim($_POST['nombre']);

            // Validación de longitud mínima
            if (strlen($nombre) < 5) {
                $_SESSION['error_message'] = 'El nombre de la categoría debe tener al menos 5 caracteres.';
                header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
                exit();
            }

            if ($this->categoriaModel->actualizarCategoria($id, $nombre)) {
                $_SESSION['success_message'] = 'Categoría actualizada correctamente.';
            } else {
                $_SESSION['error_message'] = 'El nombre de la categoría ya existe.';
            }

            header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
            exit();
        }
    }

    public function eliminarCategoria($id) {
        if ($this->categoriaModel->eliminarCategoria($id)) {
            $_SESSION['success_message'] = 'Categoría eliminada correctamente.';
        } else {
            $_SESSION['error_message'] = 'Hubo un error al eliminar la categoría.';
        }

        header('Location: ' . RUTA_URL . '/AdminController/manageBeneficios');
        exit();
    }
}
?>