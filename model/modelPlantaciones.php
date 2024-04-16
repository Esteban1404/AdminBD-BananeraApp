<?php
require_once "../config/Conexion.php";


class PlantacionModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarPlantacion($plantacion_id,$nombre, $ubicacion_id) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Plantaciones (plantacion_id,nombre, ubicacion_id) VALUES (?, ?,?)");
            $consulta ->bindParam(1,$plantacion_id);
            $consulta->bindParam(2, $nombre);
            $consulta->bindParam(3, $ubicacion_id);
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}

