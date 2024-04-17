<?php
require_once "../config/Conexion.php";


class Paises {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarPais($nombre) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Paises (nombre) VALUES (?)");
           
            $consulta->bindParam(1, $nombre);          
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}