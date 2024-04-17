<?php
require_once "../config/Conexion.php";


class PlantacionModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarPlantacion($nombre, $ubicacion_id) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Plantaciones (nombre, ubicacion_id) VALUES ( ?,?)");
            
            $consulta->bindParam(1, $nombre);
            $consulta->bindParam(2, $ubicacion_id);
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}

