<?php
class Categoria {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerCategorias() {
        $this->db->query("SELECT * FROM categorias ORDER BY nombre");
        return $this->db->registers();
    }

    public function obtenerCategoriaPorId($id) {
        $this->db->query("SELECT * FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function agregarCategoria($nombre) {

        if ($this->categoriaExiste($nombre)) {
            return false;
        }
        $this->db->query("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $this->db->bind(':nombre', $nombre);
        return $this->db->execute();
    }

    public function actualizarCategoria($id, $nombre) {
        // Verificar si la categoría ya existe
        if ($this->categoriaExiste($nombre, $id)) {
            return false;
        }

        $this->db->query("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':nombre', $nombre);
        return $this->db->execute();
    }
    public function eliminarCategoria($id) {
        $this->db->query("DELETE FROM beneficios WHERE categoria_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();



        $this->db->query("DELETE FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    private function categoriaExiste($nombre, $id = null) {
        $this->db->query("SELECT COUNT(*) as count FROM categorias WHERE nombre = :nombre" . ($id ? " AND id != :id" : ""));
        $this->db->bind(':nombre', $nombre);
        if ($id) {
            $this->db->bind(':id', $id);
        }
        $result = $this->db->register();
        return $result->count > 0;
    }
}

?>