$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

var buques = {BUQU_NOMBRE:'Nombre Buque', BUQU_BANDERA:'bandera', TIBU_NOMBRE:'Tipo de Buque', 
BUQU_MATRICULA: 'Matricula', BUQU_NAVIERA: 'Naviera', BUQU_LINEA_NAVIERA: 'Linea naviera'};

var puertos = {PUER_NOMBRE:'Nombre Puerto', PUER_PUERTO_SAP:'Puerto SAP', PUER_CAPITAN:'Capitan de Puerto', 
PUER_DOCUMENTO_SAP: 'Documento SAP'};

var muelles = {MUEL_NOMBRE:'Nombre Muelle', PUER_NOMBRE :'Puerto' , MUEL_NOMBRELARGO: 'Nombre largo', 
MUEL_CALADO: 'Calado', MUEL_LONGITUD: 'Longitud', MUEL_DESCRIPCION: 'Descripción', MUEL_TERMINAL: 'Terminal'};

var tcargas = {TCAR_NOMBRE:'Nombre', TCAR_SECTOR: 'Sector'}

var tproductos = {TPRO_NOMBRE:'Nombre', TPRO_UNIDAD: 'Unidad', TCAR_NOMBRE:'Tipo de Carga'}

var catalogo = {buques: buques, muelles: muelles, puertos:puertos, tcargas:tcargas, tproductos:tproductos };
var tabla;

function initDT_cat(table, url){
  tabla = table;
  html ='<tr>';
  campos=[];
  i=0;
  $.each(catalogo[tabla], function( index, value ) {
    html += '<th>'+value+'</th>';
    campos.splice(i, 0, {data: index});
    i++;
  });
  html +="<th></th></tr>";
  
  
  campos.splice(i, 0, {data: "action", name: "action", orderable: false, searchable: false} );


  $('thead').html(html);
  $('tfoot').html(html);

  
  var dt = $('#'+tabla+'-table').DataTable({
    processing: false,
    serverSide: true,
    language: { url: url+'/localisation/spanish.json' },
    ajax: url+'/catalogos/'+tabla+'/data',
    columns: campos,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
  });
  
$("tbody").on('click', '.delete', function(e) {
alertify.confirm("<i class='icon md-delete'></i> Eliminar elemento?.",
  function(){

    eliminar(tabla, $(e.currentTarget).data('id'));
    //Refresh
    refreshDT(tabla);
  });
});   
}

function refreshDT(tabla) {
  $('#'+tabla+'-table').DataTable().draw();
}

function eliminar(tabla, id) {
  $.post( ""+tabla+"/delete", {id: id})
  .done(function(data) {
    alertify.success('Registro eliminado correctamente');
  });
}