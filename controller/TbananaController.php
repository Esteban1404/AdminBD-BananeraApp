<?php

require_once "../model/modelPlantaciones.php";


class TbananaController {
    private $tbanana;

    public function __construct($conexion) {
        $this->tbanana = new Tbanana($conexion);
    }

    public function agregarBanana() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir datos del formulario HTML
            $tipo_id=$_POST['id'];
            $nombre = $_POST['nombre'];
            

            // Insertar la nueva plantación en la base de datos
            $exito = $this->tbanana->insertarBanana($tipo_id,$nombre);

            if ($exito) {
                // Redirigir o mostrar un mensaje de éxito
                echo "<script>alert('¡Mensaje enviado correctamente!'); window.location.href='http://localhost/AdminBD-BananeraApp/view/pages/plantaciones.php';</script>";
                
            } else {
                // Mostrar un mensaje de error
                echo "Error al insertar la plantación.";
                include '../../view/pages/plantaciones.php';
            }
        } else {
            // Mostrar el formulario HTML para agregar una nueva plantación
            include '../../view/pages/plantaciones.php';
        }
    }
}

// Ejemplo de uso
try {
    $conexion = Conexion::conectar();
    $bananaController = new TbananaController($conexion);
    $bananaController->agregarBanana();
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}
