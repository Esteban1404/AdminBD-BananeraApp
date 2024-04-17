<?php
require_once "../config/Conexion.php";


class CosechasClimaticas {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarCosechas($plantacion_id,$cantidad) {
        try {
            $consulta = $this->conexion->prepare("INSERT INTO Cosechas (plantacion_id,fecha,cantidad) VALUES (?,SYSDATE,?)");
            
            $consulta->bindParam(1, $plantacion_id);
            $consulta->bindParam(2, $cantidad);
           
            
            $consulta->execute();
            return true; // Éxito
        } catch (PDOException $e) {
            return false; // Error
        }
    }
}