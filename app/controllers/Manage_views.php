<?php
class Manage_views extends BaseController {

public function vista_vacaciones() {
    $this->view('pages/dashboard/employee_sections/request_vacation');
}

public function vista_estado_solicitud(){
    $this->view('pages/dashboard/employee_sections/request_status');
}

public function vista_agregar_empleados(){
    $this->view('pages/dashboard/admin_sections/add_employee');
}

public function vista_ver_empleados(){
    $this->view('pages/dashboard/admin_sections/view_employees');
}

public function vista_administrar_solicitudes(){
    $this->view('pages/dashboard/admin_sections/manage_requests');
}

public function vista_inicio(){
    $this->view('pages/dashboard/employee_dashboard');
}

}

?>
