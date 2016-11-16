$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

var buques = {BUQU_NOMBRE:'Nombre Buque', BUQU_BANDERA:'Bandera', TIBU_NOMBRE:'Tipo de Buque', 
BUQU_MATRICULA: 'Matricula'};

var puertos = {PUER_NOMBRE:'Nombre Puerto', PUER_PUERTO_SAP:'Puerto SAP', PUER_CAPITAN:'Capitan de Puerto', 
PUER_DOCUMENTO_SAP: 'Documento SAP'};

var muelles = {MUEL_NOMBRE:'Nombre Muelle', PUER_NOMBRE :'Puerto' , MUEL_NOMBRELARGO: 'Nombre largo', 
MUEL_CALADO: 'Calado', MUEL_LONGITUD: 'Longitud', MUEL_DESCRIP: 'Descripción', MUEL_TERMINAL: 'Terminal'};

var tcargas = {TCAR_NOMBRE:'Nombre', TCAR_SECTOR: 'Sector'}

var catalogo = {buques: buques, muelles: muelles, puertos:puertos, tcargas:tcargas };
var tabla;

function initDT(table){
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
    language: { url: 'http://localhost:8000/localisation/spanish.json' },
    ajax: 'http://localhost:8000/catalogos/'+tabla+'/data',
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