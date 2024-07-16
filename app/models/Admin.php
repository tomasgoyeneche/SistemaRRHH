<?php
class Admin {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }



    // manejo de areas

      // Obtener todas las áreas
      public function obtenerAreas() {
        $this->db->query('SELECT * FROM areas WHERE id != 1');
        return $this->db->registers();
    }

    // Crear una nueva área
    public function crearArea($nombre, $descripcion) {
        $this->db->query('INSERT INTO areas (nombre, descripcion) VALUES (:nombre, :descripcion)');
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':descripcion', $descripcion);
        return $this->db->execute();
    }

    // Eliminar un área por id
    public function eliminarArea($id) {
        // Primero actualizamos el area_id de los usuarios asociados a null
        $this->db->query('UPDATE usuario SET area_id = NULL WHERE area_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Luego eliminamos el área
        $this->db->query('DELETE FROM areas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }





    // manejo de empleados

    public function obtenerEmpleados() {
        $this->db->query('SELECT * FROM usuario WHERE tipo_usuario = "empleado"');
        return $this->db->registers();
    }

    public function obtenerEmpleadoPorId($id) {
        $this->db->query('SELECT * FROM usuario WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function actualizarEmpleado($data) {
        $this->db->query('UPDATE usuario SET dni = :dni, nombre = :nombre, apellido = :apellido, avatar = :avatar, sueldo = :sueldo, email = :email, area_id = :area_id WHERE id = :id');
        $this->db->bind(':dni', $data['dni']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':apellido', $data['apellido']);
        $this->db->bind(':avatar', $data['avatar']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':sueldo', $data['sueldo']);
        $this->db->bind(':area_id', $data['area_id']);
        $this->db->bind(':id', $data['id']);
        

        return $this->db->execute();
    }

    public function eliminarEmpleado($id) {
        try {
            $this->db->beginTransaction();
    
            // Obtener las vacaciones asociadas al empleado
            $this->db->query('SELECT vacaciones_id FROM empleado_vacaciones WHERE usuario_id = :id');
            $this->db->bind(':id', $id);
            $vacaciones = $this->db->fetchAll(); // Usamos fetchAll para obtener los resultados
    
            // Eliminar las entradas relacionadas en empleado_vacaciones
            $this->db->query('DELETE FROM empleado_vacaciones WHERE usuario_id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            // Eliminar las solicitudes de vacaciones relacionadas
            foreach ($vacaciones as $vacacion) {
                $this->db->query('DELETE FROM solicitud_vacaciones WHERE id = :vacacion_id');
                $this->db->bind(':vacacion_id', $vacacion['vacaciones_id']);
                $this->db->execute();
            }
    
            // Finalmente, eliminar el empleado
            $this->db->query('DELETE FROM usuario WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            $this->db->endTransaction();
            return true;
        } catch (Exception $e) {
            $this->db->cancelTransaction();
            return false;
        }
    }

    public function emailExiste($email, $id) {
        $this->db->query('SELECT COUNT(*) AS total FROM usuario WHERE email = :email AND id != :id');
        $this->db->bind(':email', $email);
        $this->db->bind(':id', $id);

        $result = $this->db->register();
        return $result->total > 0;
    }

    public function dniExiste($dni, $id) {
        $this->db->query('SELECT COUNT(*) AS total FROM usuario WHERE dni = :dni AND id != :id');
        $this->db->bind(':dni', $dni);
        $this->db->bind(':id', $id);

        $result = $this->db->register();
        return $result->total > 0;
    }



}
?>