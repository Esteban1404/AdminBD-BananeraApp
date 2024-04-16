
<?php
require_once '../config/Conexion.php'; // Ajusta la ruta si es necesario

class ModelBTiposBanana {
   

    protected static $cnx;
    private $nombre = null;
   

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

    public function listarTodosDb()
    {
        $query = "SELECT nombre FROM TIPOS_BANANAS";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new ModelBTiposBanana();
                $dato->setNombre($encontrado['nombre']);               
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
?>
