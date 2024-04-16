<?php
require_once '../model/modelBTiposBananas.php';
switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $dato_reg = new modelBTiposBananas();
        $datos = $dato_reg->listarTodosDb();
        $data = array();
        foreach ($datos as $reg) {

            $data[] = array(
                "0" => $reg->getNombre();
                
            );
        }
        $resultados = array(
            "sEcho" => 1, ##informacion para datatables
            "iTotalRecords" => count($data), ## total de registros al datatable
            "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;
    case 'insertar':
        //$id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
        $anyo_inicio = isset($_POST["anyo_inicio"]) ? trim($_POST["anyo_inicio"]) : "";
        echo $anyo_inicio;
        $anyo_fin = isset($_POST["anyo_fin"]) ? trim($_POST["anyo_fin"]) : "";
        $data = new Dato();
        $data->setAnyo_inicio($anyo_inicio);
        $encontrado = $data->verificarExistenciaDb();
        if ($encontrado == true) {
            // $data->setId($id);
            $data->setAnyo_inicio($anyo_inicio);
            $data->setAnyo_fin($anyo_fin);
            $data->guardarEnDb();
            if ($data->verificarExistenciaDb()) {
                //if(enviarCorreo($email,$clave,$nombre)){
                echo 1; //usuario registrado y envio de correo exitos


            } else {
                echo 3; //Fallo al realizar el registro


            }
        } else {
            echo 2; //el usuario ya existe
        }
        break;
    case 'existeUsuario':
        $dato = isset($_POST["data"]) ? $_POST["data"] : "";
        $dato_exi = new Dato();
        $dato_exi->setDato($dato);
        $encontrado = $dato_exi->verificarExistenciaDb();
        if ($encontrado != null) {
            echo 1;
        } else {
            echo 0;
        }
        break;
    case 'mostrar':
        $datos = isset($_POST["data"]) ? $_POST["data"] : "";
        $data = new Dato();
        $data->setDato($datos);
        $encontrado = $data->mostrar($datos);
        if ($encontrado != null) {
            $arr = array();
            $arr[] = [
                "id" => $encontrado->getId(),
                "anyo_inicio" => $encontrado->getAnyo_inicio(),
                "anyo_fin" => $encontrado->getAnyo_fin()
            ];

            echo json_encode($arr);
        } else {
            echo 0;
        }
        break;
}
?>
