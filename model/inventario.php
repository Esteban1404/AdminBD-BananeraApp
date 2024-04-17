<?php

require_once "../Config/Conexion.php";

class Inventario extends Conexion
{
    protected static $cnx;

    private $cantidad;

    private $ubicacion;

    private $provedor;




    public function __construct()
    {
    }


    public function getubicacion()
    {
        return $this->ubicacion;
    }

    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getProvedor()
    {
        return $this->provedor;
    }

    public function setProvedor($provedor)
    {
        $this->provedor = $provedor;
    }


    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function listarInventarioDb()
    {
        $query = "SELECT i.inventario_id, p.nombre AS nombre_proveedor, u.nombre AS nombre_ubicacion, i.cantidad_disponible 
        FROM Inventario_Insumos i
        INNER JOIN Proveedores_Insumos_Agricolas p ON i.proveedor_id = p.proveedor_id
        INNER JOIN Ubicaciones u ON i.ubicacion_id = u.ubicacion_id";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new Inventario(); // Corregido el nombre de la clase
                $dato->setProvedor($encontrado["nombre_proveedor"]);
                $dato->setUbicacion($encontrado["nombre_ubicacion"]);
                $dato->setCantidad($encontrado["cantidad_disponible"]);
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
