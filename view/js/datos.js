/*Funcion para cargar el listado en el Datatable*/
function listarUsuariosTodos() {
    tabla = $('#cursoListado').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../controller/controllerBTiposBananas.php?op=listar_para_tabla',
        type: 'get',
        dataType: 'json',
        error: function (e) {
          console.log(e.responseText);
        },
        bDestroy: true,
        iDisplayLength: 5,
      },
    });
  }

  listarUsuariosTodos();