<?php

require_once "../model/cosechasClimaticas.php";


class CosechasClimaticasController {
    private $cosecha;

    public function __construct($conexion) {
        $this->cosecha = new cosechasClimaticas($conexion);
    }

    public function agregarCosecha() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir datos del formulario HTML
            $cosecha_id=$_POST['idCosecha'];
            $plantacion_id = $_POST['idP'];
            $cantidad = $_POST['cantidad'];
            

            // Insertar la nueva plantación en la base de datos
            $exito = $this->cosecha->insertarCosechas($cosecha_id,$plantacion_id,$cantidad);

            if ($exito) {
                // Redirigir o mostrar un mensaje de éxito
                echo "<script>alert('¡Mensaje enviado correctamente!'); window.location.href='http://localhost/AdminBD-BananeraApp/view/pages/cosechasClimaticas.php';</script>";
                
            } else {
                // Mostrar un mensaje de error
                echo "Error al insertar la plantación.";
                include '../../view/pages/cosechasClimaticas.php';
            }
        } else {
            // Mostrar el formulario HTML para agregar una nueva plantación
            include '../../view/pages/cosechasClimaticas.php';
        }
    }
}

// Ejemplo de uso
try {
    $conexion = Conexion::conectar();
    $cosechasController = new CosechasClimaticasController($conexion);
    $cosechasController->agregarCosecha();
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}