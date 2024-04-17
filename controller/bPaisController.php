<?php
require_once '../model/bPais.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $pais = new BPais();
        $paises = $pais->listarPaisesDb();
        $data = array();       

        foreach ($paises as $reg) {
            $data[] = array(
                $reg->getNombre() // Agregar cada fecha directamente al array
            );
            
        }

        

        // Construye el resultado como un simple array de datos
        $resultados = array(
            "sEcho" => 1, // Información para datatables
            "iTotalRecords" => count($data), // Total de registros al datatable
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );

        // Envía el JSON con los resultados
        echo json_encode($resultados);
        break;
       
}

