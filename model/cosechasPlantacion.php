<?php

require_once "../Config/Conexion.php";

class CosechasPlantacion extends Conexion
{
    protected static $cnx;
    private $nombre;

    private $cantidad;
    private $fecha;

    private $plantacion;


    public function __construct()
    {
    }


    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getPlantacion()
    {
        return $this->plantacion;
    }

    public function setPlantacion($plantacion)
    {
        $this->plantacion = $plantacion;
    }



    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function listarCosechasDb()
    {
        $query = "SELECT c.cosecha_id, p.nombre AS nombre_plantacion, c.fecha, c.cantidad 
        FROM Cosechas c
        INNER JOIN Plantaciones p ON c.plantacion_id = p.plantacion_id";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new CosechasPlantacion(); // Corregido el nombre de la clase
                $dato->setPlantacion($encontrado["nombre_plantacion"]);
                $dato->setFecha($encontrado["FECHA"]);
                $dato->setCantidad($encontrado["CANTIDAD"]);
                $arr[] = $dato;
            }
            self::desconectar();
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}
?>
