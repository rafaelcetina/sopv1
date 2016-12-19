$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
$(document).ready(function() {
  
});
      
var solicitudes = {SARR_FOLIO:'Folio', BUQU_NOMBRE:'Embarcación', SARR_TRAFICO_CLAVE:'Trafico', SARR_ACTIVIDADES:'Actividades', SARR_ETA:'Tiempo Arribo (ETA)', SARR_ETB:'Tiempo Atraque (ETB)', SARR_ETD:'Tiempo Salida (ETD)', PUER_NOMBRE: 'Puerto', MUEL_NOMBRE: 'Muelle Solicitado'}
var catalogo = {solicitudes:solicitudes};
var tabla;

function initDT(table, url){



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

  campos.splice(i, 0, {data: "action", name: "action", orderable: false, searchable: false,  sWidth : "200px !important"} );

  $('thead').html(html);
  $('tfoot').html(html);

  // $('#'+tabla+'-table tfoot th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input type="text" class="" placeholder="'+title+'" />' );
  // } );

  var dt = $('#'+tabla+'-table').DataTable({
    processing: false,
    serverSide: true,
    language: { url: url+'/localisation/spanish.json' },
    ajax: url+'/control_arribos/data',
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

$('#'+tabla+'-table tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
} );

$('#button').click( function () {

  ids = $.map(dt.rows('.selected').data(), function (item) {
    return item.SARR_ID;
  });

  console.log(ids);

  console.log(dt.rows('.selected').data().length + ' fila(s) seleccionadas');

});

$('.filtro').on( 'change', function () {
    var i =$(this).attr('id');  // getting column index
    var s =$("#start").val();  // getting search input value
    var e =$("#end").val();  // getting search input value
    console.log(s)
    dt.columns(5).search(s).draw();
    dt.columns(7).search(e).draw();
} );
 
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
