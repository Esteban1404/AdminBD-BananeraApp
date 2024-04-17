<?php

require_once "../Config/Conexion.php";

class BPais extends Conexion
{
    protected static $cnx;
    private $nombre;

    public function __construct()
    {
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

    public function listarPaisesDb()
    {
        $query = "SELECT NOMBRE FROM PAISES";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new BPais(); // Corregido el nombre de la clase
                $dato->setNombre($encontrado["NOMBRE"]);
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
