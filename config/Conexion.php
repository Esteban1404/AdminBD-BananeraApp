<?php

require_once "global.php";

class Conexion
{
    function __construct()
    {
        # code...
    }
    public static function conectar(){
        // Conexión a Oracle
        try {
            $tns = "(DESCRIPTION =
                        (ADDRESS_LIST = 
                            (ADDRESS = (PROTOCOL = TCP)(HOST = ".DB_HOST_ORACLE.")(PORT = 1521))
                        )
                        (CONNECT_DATA =
                            (SERVICE_NAME = ".DB_SERVICE_NAME_ORACLE.")
                        )
                    )";
            $usuario = DB_USER_ORACLE;
            $contraseña = DB_PASSWORD_ORACLE;

            $cn = new PDO("oci:dbname=".$tns,$usuario,$contraseña);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Mensaje de conexión exitosa
            echo "Conexión exitosa a la base de datos Oracle.";
            
            return $cn;
        } catch (PDOException $ex) {
            die("Error al conectar a la base de datos Oracle: " . $ex->getMessage());
        }
    }

} // Fin de la clase Conexion


try {
    $conexion = Conexion::conectar();

} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}
