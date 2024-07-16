<?php
class SolicitudVacaciones {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function obtenerSolicitudesPorUsuario($userid) {
        $this->db->query("
            SELECT sv.* 
            FROM solicitud_vacaciones sv
            INNER JOIN empleado_vacaciones ev ON sv.id = ev.vacaciones_id
            WHERE ev.usuario_id = :userid
            ORDER BY sv.fecha_inicio DESC
        ");
        $this->db->bind(':userid', $userid);
        return $this->db->registers();
    }

    public function insertarSolicitud($userid, $fecha_inicio, $fecha_fin, $motivo) {
        try {
            $this->db->beginTransaction();

            $this->db->query("
                INSERT INTO solicitud_vacaciones (fecha_inicio, fecha_fin, motivo)
                VALUES (:fecha_inicio, :fecha_fin, :motivo)
            ");
            $this->db->bind(':fecha_inicio', $fecha_inicio);
            $this->db->bind(':fecha_fin', $fecha_fin);
            $this->db->bind(':motivo', $motivo);
            $this->db->execute();

            $vacaciones_id = $this->db->lastInsertId();

            $this->db->query("
                INSERT INTO empleado_vacaciones (usuario_id, vacaciones_id)
                VALUES (:usuario_id, :vacaciones_id)
            ");
            $this->db->bind(':usuario_id', $userid);
            $this->db->bind(':vacaciones_id', $vacaciones_id);
            $this->db->execute();

            return $this->db->endTransaction();
        } catch (Exception $e) {
            $this->db->cancelTransaction();
            return false;
        }
    }

    public function obtenerEmpleadoPorId($id) {
        $this->db->query('SELECT * FROM empleados WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function actualizarEmpleado($id, $nombre, $email, $direccion) {
        $this->db->query('UPDATE empleados SET nombre = :nombre, email = :email, direccion = :direccion WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':email', $email);
        $this->db->bind(':direccion', $direccion);
        return $this->db->execute();
    }

    public function validarVacacionesSimultaneas($fecha_inicio, $fecha_fin) {
        $this->db->query("
            SELECT COUNT(DISTINCT usuario_id) AS total
            FROM empleado_vacaciones ev
            INNER JOIN solicitud_vacaciones sv ON ev.vacaciones_id = sv.id
            WHERE (sv.fecha_inicio BETWEEN :fecha_inicio AND :fecha_fin)
               OR (sv.fecha_fin BETWEEN :fecha_inicio AND :fecha_fin)
        ");
        $this->db->bind(':fecha_inicio', $fecha_inicio);
        $this->db->bind(':fecha_fin', $fecha_fin);
        $result = $this->db->register();
        return $result->total;
    }

    public function tieneSolicitudActiva($userid) {
        $this->db->query('
            SELECT COUNT(*) AS total 
            FROM solicitud_vacaciones sv
            INNER JOIN empleado_vacaciones ev ON sv.id = ev.vacaciones_id
            WHERE ev.usuario_id = :userid AND (sv.estado = "Pendiente" OR sv.estado = "Aprobada")
        ');
        $this->db->bind(':userid', $userid);
    
        $result = $this->db->register();
        return $result->total > 0;
    }




    // funciones de administrador

    public function obtenerSolicitudesOrdenadas($orden) {
        if ($orden === 'fecha') {
            $this->db->query('
                SELECT sv.id, sv.fecha_inicio, sv.fecha_fin, sv.motivo, sv.estado, u.nombre, u.apellido 
                FROM solicitud_vacaciones sv
                JOIN empleado_vacaciones ev ON sv.id = ev.vacaciones_id
                JOIN usuario u ON ev.usuario_id = u.id
                ORDER BY YEAR(sv.fecha_inicio), MONTH(sv.fecha_inicio), DAY(sv.fecha_inicio), u.apellido
            ');
        } elseif ($orden === 'apellido') {
            $this->db->query('
                SELECT sv.id, sv.fecha_inicio, sv.fecha_fin, sv.motivo, sv.estado, u.nombre, u.apellido 
                FROM solicitud_vacaciones sv
                JOIN empleado_vacaciones ev ON sv.id = ev.vacaciones_id
                JOIN usuario u ON ev.usuario_id = u.id
                ORDER BY u.apellido
            ');
        }
        return $this->db->registers();
    }

    public function actualizarEstado($id, $estado) {
        $this->db->query('UPDATE solicitud_vacaciones SET estado = :estado WHERE id = :id');
        $this->db->bind(':estado', $estado);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    
}
?>
