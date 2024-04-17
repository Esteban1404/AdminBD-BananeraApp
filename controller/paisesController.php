<?php

require_once "../model/paises.php";


class PaisesController {
    private $paises;

    public function __construct($conexion) {
        $this->paises = new Paises($conexion);
    }

    public function agregarPais() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir datos del formulario HTML
            $pais_id=$_POST['id'];
            $nombre=$_POST['nombre'];
            

            // Insertar la nueva plantación en la base de datos
            $exito = $this->paises->insertarPais($pais_id,$nombre);

            if ($exito) {
                // Redirigir o mostrar un mensaje de éxito
                echo "<script>alert('¡Mensaje enviado correctamente!'); window.location.href='http://localhost/AdminBD-BananeraApp/view/pages/paises.php';</script>";
                
            } else {
                // Mostrar un mensaje de error
                echo "Error al insertar la plantación.";
                include '../../view/pages/paises.php';
            }
        } else {
            // Mostrar el formulario HTML para agregar una nueva plantación
            include '../../view/pages/paises.php';
        }
    }
}

// Ejemplo de uso
try {
    $conexion = Conexion::conectar();
    $paisesController = new PaisesController($conexion);
    $paisesController->agregarPais();
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}
