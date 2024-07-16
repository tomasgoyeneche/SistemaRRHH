<?php
class Employee {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerUsuarioPorId($id) {
        $this->db->query("SELECT * FROM usuario WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function obtenerAreas() {
        $this->db->query("SELECT * FROM areas");
        return $this->db->registers();
    }

    public function actualizarUsuario($id, $nombre, $apellido, $email, $pass, $avatar) {
        $this->db->query("UPDATE usuario SET nombre = :nombre, apellido = :apellido, email = :email, pass = :pass, avatar = :avatar WHERE id = :id");
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':apellido', $apellido);
        $this->db->bind(':email', $email);
        $this->db->bind(':pass', $pass);
        $this->db->bind(':avatar', $avatar);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function emailExiste($email, $userid) {
        $this->db->query('SELECT * FROM usuario WHERE email = :email AND id != :userid');
        $this->db->bind(':email', $email);
        $this->db->bind(':userid', $userid);
        return $this->db->register() ? true : false;
    }
}
?>
