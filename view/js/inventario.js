function listarUsuariosTodos() {
  tabla = $('#tbllistado').dataTable({
      processing: true,
      serverSide: true,
      dom: 'Bfrtip',
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
          url: '../../controller/inventarioController.php?op=listar_para_tabla',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              console.log('Datos recibidos correctamente:', response);
              // Inicializar DataTables con los datos recibidos
              $('#tbllistado').DataTable({
                  data: response.aaData,
                  destroy: true,
                  columns: [
                      { title: 'Proveedor', mData: 0 },
                      { title: 'Ubicacion', mData: 1 },
                      { title: 'Cantidad', mData: 2 }
                      
                  ]
              });
          },
          error: function(xhr, status, error) {
              console.log('Error en la solicitud AJAX:', error);
          }
      },
      iDisplayLength: 5
  });
}

listarUsuariosTodos();