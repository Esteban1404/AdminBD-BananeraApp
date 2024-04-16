<?php

require_once "../model/modelPlantaciones.php";


class PlantacionController {
    private $plantacionModel;

    public function __construct($conexion) {
        $this->plantacionModel = new PlantacionModel($conexion);
    }

    public function agregarPlantacion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir datos del formulario HTML
            $plantacion_id=$_POST['id'];
            $nombre = $_POST['nombre'];
            $ubicacion_id = $_POST['idUbicacion'];

            // Insertar la nueva plantación en la base de datos
            $exito = $this->plantacionModel->insertarPlantacion($plantacion_id,$nombre, $ubicacion_id);

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
    $plantacionController = new PlantacionController($conexion);
    $plantacionController->agregarPlantacion();
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}

