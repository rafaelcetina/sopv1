$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

var usuarios = {tipo:'Tipo', usuario:'Usuario', email:'E-mail', nombre: 'Nombre', empresa: 'Empresa', rfc: 'RFC', active:'Activo'};

var catalogo = {usuarios: usuarios};
var tabla;

function initDT_users(table){
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
    ajax: 'http://localhost:8000/'+tabla+'/data',
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
alertify.confirm("<i class='icon md-delete'></i> Eliminar elemento?",
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

