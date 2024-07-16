<?php

class Beneficio {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerBeneficios() {
        $this->db->query("SELECT beneficios.*, categorias.nombre AS categoria_nombre FROM beneficios JOIN categorias ON beneficios.categoria_id = categorias.id ORDER BY beneficios.nombre");
        return $this->db->registers();
    }

    public function obtenerBeneficioPorId($id) {
        $this->db->query("SELECT * FROM beneficios WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function agregarBeneficio($data) {
        $this->db->query("INSERT INTO beneficios (nombre, descripcion, descuento, categoria_id) VALUES (:nombre, :descripcion, :descuento, :categoria_id)");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':descuento', $data['descuento']);
        $this->db->bind(':categoria_id', $data['categoria_id']);
        return $this->db->execute();
    }

    public function actualizarBeneficio($data) {
        $this->db->query("UPDATE beneficios SET nombre = :nombre, descripcion = :descripcion, descuento = :descuento, categoria_id = :categoria_id WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':descuento', $data['descuento']);
        $this->db->bind(':categoria_id', $data['categoria_id']);
        return $this->db->execute();
    }

    public function eliminarBeneficio($id) {
        $this->db->query("DELETE FROM beneficios WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }


    public function obtenerBeneficiosPorDescuento() {
        $this->db->query('
            SELECT b.id, b.nombre, b.descripcion, b.descuento, c.nombre as categoria
            FROM beneficios b
            INNER JOIN categorias c ON b.categoria_id = c.id
            ORDER BY b.descuento DESC
        ');

        return $this->db->registers();
    }

    // Obtener beneficios ordenados por categoría
    public function obtenerBeneficiosPorCategoria() {
        $this->db->query('
            SELECT b.id, b.nombre, b.descripcion, b.descuento, c.nombre as categoria
            FROM beneficios b
            INNER JOIN categorias c ON b.categoria_id = c.id
            ORDER BY c.nombre, b.nombre
        ');

        return $this->db->registers();
    }
}


?>