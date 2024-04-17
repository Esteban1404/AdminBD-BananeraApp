<?php

require_once "../model/empleados.php";


class EmpleadosController {
    private $empleado;

    public function __construct($conexion) {
        $this->empleado = new Empleados($conexion);
    }

    public function agregarEmpleado() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir datos del formulario HTML
           
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            $genero = $_POST['genero'];
            $rol = $_POST['rol'];
            $ubicacion_id = $_POST['ubicacion_id'];

        
            

            // Insertar la nueva plantación en la base de datos
            $exito = $this->empleado->insertarEmpleado($nombre,$edad,$genero,$rol,$ubicacion_id);

            if ($exito) {
                // Redirigir o mostrar un mensaje de éxito
                echo "<script>alert('¡Mensaje enviado correctamente!'); window.location.href='http://localhost/AdminBD-BananeraApp/view/pages/empleados.php';</script>";
                
            } else {
                // Mostrar un mensaje de error
                echo "Error al insertar la plantación.";
                include '../../view/pages/empleados.php';
            }
        } else {
            // Mostrar el formulario HTML para agregar una nueva plantación
            include '../../view/pages/empleados.php';
        }
    }
}

// Ejemplo de uso
try {
    $conexion = Conexion::conectar();
    $empleadoController = new EmpleadosController($conexion);
    $empleadoController->agregarEmpleado();
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos Oracle: " . $ex->getMessage();
}