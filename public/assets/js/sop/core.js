$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

      
var solicitudes = {SARR_ID:'Folio', BUQU_NOMBRE:'Embarcación', SARR_BUQUE_VIAJE:'Num de Viaje', SARR_TRAFICO_CLAVE:'Trafico', SARR_ACTIVIDADES:'Actividades', SARR_ETA:'Tiempo Arribo (ETA)', SARR_ETB:'Tiempo Atraque (ETB)', SARR_ETD:'Tiempo Salida (ETD)', PUER_NOMBRE: 'Puerto', MUEL_NOMBRE: 'Muelle Solicitado'}

var buques = {BUQU_NOMBRE:'Nombre Buque', BUQU_BANDERA:'bandera', TIBU_NOMBRE:'Tipo de Buque', 
BUQU_MATRICULA: 'Matricula', BUQU_NAVIERA: 'Naviera', BUQU_LINEA_NAVIERA: 'Linea naviera'};

var puertos = {PUER_NOMBRE:'Nombre Puerto', PUER_PUERTO_SAP:'Puerto SAP', PUER_CAPITAN:'Capitan de Puerto', 
PUER_DOCUMENTO_SAP: 'Documento SAP'};
var muelles = {MUEL_NOMBRE:'Nombre Muelle', PUER_NOMBRE :'Puerto' , MUEL_NOMBRELARGO: 'Nombre largo', 
MUEL_CALADO: 'Calado', MUEL_LONGITUD: 'Longitud', MUEL_DESCRIPCION: 'Descripción', MUEL_TERMINAL: 'Terminal'};
var tcargas = {TCAR_NOMBRE:'Nombre', TCAR_SECTOR: 'Sector'}
var tproductos = {TPRO_NOMBRE:'Nombre', TPRO_UNIDAD: 'Unidad', TCAR_NOMBRE:'Tipo de Carga'}

var usuarios = {tipo:'Tipo', usuario:'Usuario', email:'E-mail', nombre: 'Nombre', empresa: 'Empresa', rfc: 'RFC', active:'Activo'};

var cargas = {CARR_TRAFICO_CLAVE:'Trafico', CARR_PELIGRO:'Peligrosa', TCAR_NOMBRE:'Tipo de carga', TPRO_NOMBRE:'Descripción', CARR_UNIDAD:'Unidades', TPRO_UNIDAD:'Medida'};

////****/////***//// ---- Objeto datatables ----////****////*****//
function sop_datatable(url, tabla, id='') {

var catalogo = {buques: buques, muelles: muelles, puertos:puertos, tcargas:tcargas, tproductos:tproductos, usuarios: usuarios, cargas: cargas, solicitudes: solicitudes };

  this.url = url;
  this.tabla = tabla;
  this.id = id;
  
  this.campos = catalogo[this.tabla];

  this.initDt = function(tabla){
    $( ".filtro" ).datepicker();

    html ='<tr>'; campos=[]; i=0;

    $.each(catalogo[tabla], function( index, value ) {
      html += '<th>'+value+'</th>';
      campos.splice(i, 0, {data: index});
      i++;
    });
    
    html +="<th>Acciones</th></tr>";
    campos.splice(i, 0, {data: "action", name: "action", orderable: false, searchable: false} );

    $('#'+tabla+'-table thead').html(html);
    $('#'+tabla+'-table tfoot').html(html);

    if(tabla == 'solicitudes'){
      urlData= url+'/data/'
    }else if(id!=''){
      urlData= url+'/cargas/data/'+id
    }else{
      urlData= url+'/'+tabla+'/data'
    }



    var dt = $('#'+tabla+'-table').DataTable({
      processing: false,
      serverSide: true,
      language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
      ajax: urlData,
      columns: campos,
    });

    $('.filtro').on( 'change', function () {
      var s =$("#start").val();  // 
      var e =$("#end").val();  //
      dt.columns(5).search(s).draw();
      dt.columns(7).search(e).draw();
    });


    $("tbody").on('click', '.delete', function(e) {
      alertify.confirm("<i class='icon md-delete'></i> Desea eliminar elemento?",
        function(){

          eliminar(tabla, $(e.currentTarget).data('id'));
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

      });

  }
  
  this.eliminar = function (tabla, id){
    $.post( ""+tabla+"/delete", {id: id})
      .done(function(data) {
      alertify.success('Registro eliminado correctamente');
    });
  }

  this.refreshDT = function(tabla) {
    $('#'+tabla+'-table').DataTable().draw();
    alertify.success('Tabla refresacada :)');
  }

}


////////////////**************////////////
$('#SARR_PUERTO_ID').change(function(e){
    $.get("muelles/"+e.target.value+"", function(response, state){
        //console.log(response);
        $('#SARR_MUELLE_ID').empty();
        for (i=0; i < response.length; i++) {
            $("#SARR_MUELLE_ID").append("<option value='"+response[i].MUEL_ID+"'>"+response[i].MUEL_NOMBRE+"</option>");
        }
    });
});

$('#SARR_TIPO_BUQUE').change(function(e){
    $.get("buques/"+e.target.value+"", function(response, state){
        //console.log(response);
        $('#SARR_BUQUE_ID').empty();
        for (i=0; i < response.length; i++) {
            $("#SARR_BUQUE_ID").append("<option value='"+response[i].BUQU_ID+"'>"+response[i].BUQU_NOMBRE+"</option>");
        }
    });
});

$('#CARR_TCARGA_ID').change(function(e){
    $.get("tproductos/"+e.target.value+"", function(response, state){
        //console.log(response);
        $('#CARR_TPRODUCTO_ID').empty();
        $('#unidad').empty();
        if(response.length > 0)
            $("#unidad").html(response[0].TPRO_UNIDAD);
        for (i=0; i < response.length; i++) {
            $("#CARR_TPRODUCTO_ID").append("<option value='"+response[i].TPRO_ID+"'>"+response[i].TPRO_NOMBRE+"</option>");
            console.log(response[i].TPRO_UNIDAD);
        }
    });
});

$("#CARR_TPRODUCTO_ID").change(function (e) {
    
    $.get("unidad/"+e.target.value+"", function(response, state){
        $('#unidad').empty();
        if(response.length > 0)
            $("#unidad").html(response[0].TPRO_UNIDAD);
    });
})  

$('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    }
});

