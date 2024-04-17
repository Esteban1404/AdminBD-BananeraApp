<?php
require_once "../config/Conexion.php";


class Empleados {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarEmpleado($empleado_id,$nombre,$edad,$genero,$rol,$ubicacion_id) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Empleados (empleado_id,nombre,edad,genero,rol,ubicacion_id) VALUES (?,?,?,?,?,?)");
            $consulta ->bindParam(1,$empleado_id);
            $consulta->bindParam(2, $nombre);
            $consulta->bindParam(3, $edad);
            $consulta->bindParam(4, $genero);
            $consulta->bindParam(5, $rol);
            $consulta->bindParam(6, $ubicacion_id);
            
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}