<?php
class AuthModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function crear_usuario($data) {
        $this->db->query("INSERT INTO usuario (dni, pass, nombre, apellido, avatar, email, tipo_usuario, area_id) 
                          VALUES (:dni, :pass, :nombre, :apellido, :avatar, :email, :tipo_usuario, :area_id)");
        $this->db->bind('dni', $data['dni']);
        $this->db->bind('pass', $data['pass']);
        $this->db->bind('nombre', $data['nombre']);
        $this->db->bind('apellido', $data['apellido']);
        $this->db->bind('avatar', $data['avatar']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('tipo_usuario', $data['tipo_usuario']);
        $this->db->bind('area_id', $data['area_id']);
        
        return $this->db->execute();
    }


    public function buscar_por_dni($dni) {
        $this->db->query("SELECT id, dni, nombre, apellido, avatar, email, pass, sueldo, tipo_usuario, area_id
                          FROM usuario
                          WHERE dni = :dni");
        $this->db->bind('dni', $dni);
        
        return $this->db->register();
    }

    //id, dni, nombre, apellido, avatar, email, pass, sueldo, tipo_usuario, area_id
    public function buscar_por_mail($email) {
        $this->db->query("SELECT *
                          FROM usuario
                          WHERE email = :email");
        $this->db->bind('email', $email);
        
        return $this->db->register();
    }





            
    public function change_pass($pass, $email)
    {
        try {
            // Validar la dirección de correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Correo electrónico inválido");
            }
    
            // Validar la nueva contraseña
            if (strlen($pass) < 8) {
                throw new Exception("La contraseña debe tener al menos 8 caracteres");
            }
    
            // Generar el hash de la nueva contraseña
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
    
            // Ejecutar la consulta SQL
            $this->db->query("UPDATE usuario SET
                                    pass = :new_pass
                                    WHERE email = :mail");
            $this->db->bind(':new_pass', $hashedPassword);
            $this->db->bind(':mail', $email);
            $this->db->execute();
    
            // Verificar si se actualizó correctamente
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                throw new Exception("No se pudo actualizar la contraseña");
            }
        } catch (Exception $e) {
            // Capturar y manejar errores
            error_log("Error al cambiar la contraseña: " . $e->getMessage());
            return false;
        }
    }
    
    
}
?>
