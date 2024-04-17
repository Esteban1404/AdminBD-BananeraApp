<?php
require_once "../config/Conexion.php";


class Empleados {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarEmpleado($nombre,$edad,$genero,$rol,$ubicacion_id) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Empleados (nombre,edad,genero,rol,ubicacion_id) VALUES (?,?,?,?,?)");
            
            $consulta->bindParam(1, $nombre);
            $consulta->bindParam(2, $edad);
            $consulta->bindParam(3, $genero);
            $consulta->bindParam(4, $rol);
            $consulta->bindParam(5, $ubicacion_id);
            
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}