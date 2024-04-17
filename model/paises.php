<?php
require_once "../config/Conexion.php";


class Paises {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarPais($tipo_id,$nombre,) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Paises (pais_id,nombre) VALUES (?,?)");
            $consulta ->bindParam(1,$tipo_id);
            $consulta->bindParam(2, $nombre);
            
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}