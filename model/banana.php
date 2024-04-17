
<?php

require_once "../Config/Conexion.php";

class Banana extends Conexion
{

    // Consulta para obtener las fechas ocupadas\
    protected static $cnx;

    private $banana;

    public function __construct()
    {
    }
    public function getBanana()
    {

        return $this->banana;
    }

    public function setBanana($banana)
    {

        $this->banana = $banana;
    }
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }


public function listarBananasDb()
    {
        $query = "SELECT nombre FROM TIPOS_BANANA ";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new Banana();
                $dato->setBanana($encontrado['nombre']);               
                $arr[] = $dato;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }


}


