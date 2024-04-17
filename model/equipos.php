
<?php
require_once "../config/Conexion.php";


class Equipos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarEquipo($nombre) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Equipos_Agricolas (nombre) VALUES (?)");
            
            $consulta->bindParam(1, $nombre);
            
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}
