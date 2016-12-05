$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

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
    console.log(e.target.value);

    $.get("unidad/"+e.target.value+"", function(response, state){
        console.log(response);
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

 

$("#form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
        //console.log($('#historial').select2('data'));

        checked = $("input[name=SARR_ACTIVIDADES]:checked").length;

        if(!checked) {
          alertify.error('Selecciona al menos una actividad a realizar');
          $("#form-SARR_ACTIVIDADES-error").addClass("has-danger");
          return false;
        }

        var actividades = new Array();
        $("input:checkbox[name=SARR_ACTIVIDADES]:checked").each(function(){
            actividades.push($(this).val());
        });
        // $('.loading').show();
        
        $.post({
            type: "POST",
            url: url,
            beforeSend: function(){
                $(".loading").show();
                $(".btn-submit").hide();
            },
            complete: function(){
                $(".loading").hide();
                $(".btn-submit").show();
            },
            data: data,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    console.log("FAILS");
                    //console.log(data.length());
                    //for(i=0; i<data.length)
                    $('#form .required').each(function () {
                        index = $(this).attr('name');
                        if (index in data.errors) {
                            alertify.error(data.errors[index]);
                            $("#form-" + index + "-error").addClass("has-danger");
                            $("#" + index + "-error").html(data.errors[index]);
                            $("#" + index + "-error").addClass("has-danger");
                        }
                        else {
                            $("#form-" + index + "-error").removeClass("has-danger");
                            $("#" + index + "-error").empty();
                        }
                        
                    });
                    console.log(data.errors);
                    // $('.loading').hide();
                    $('.btn-submit').show();
                    alertify.error('Ocurrió un error, intente de nuevo');
                } else {
                    
                    alertify.success('Solicitud registrada correctamente, Folio: '+data['Folio']);
                    
                    $("#form")[0].reset();

                    $(".has-error").removeClass("has-danger");
                    $(".help-block").empty();
                    $(".info").html('<p>Folio de solicitud: '+data['Folio']+'</p>');
                    $(".info").append('<a class="btn btn-primary" target="_blank" href="../pdf/index/'+data['Folio']+'")?>ver pdf</a>')
                    //$('.btn-submit').show();
                    // $('.loading').hide();
                    //$(".btnCerrar").trigger( "click" );
                    
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        //dt.draw();
        return false;
    });


$("#form_carga").submit(function (e) {
        e.preventDefault();
        $('.loading').show();
        //$('.btn-submit').hide();
        var form = $(this);
        var data = new FormData($(this)[0]);
        //var url = form.attr("action");
        var url = "../cargas/nuevo";
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#form_add input.required').each(function () {
                        index = $(this).attr('name');
                        if (index in data.errors) {
                            $("#form-" + index + "-error").addClass("has-danger");
                            $("#" + index + "-error").html(data.errors[index]);
                        }
                        else {
                            $("#form-" + index + "-error").removeClass("has-danger");
                            $("#" + index + "-error").empty();
                        }
                    });
                    $('.loading').hide();
                    $('.btn-submit').show();
                    alertify.error('Ocurrió un error, intente de nuevo');
                } else {
                    
                    alertify.success('Carga ingresada correctamente!');
                    refreshDT(tabla);
                    form[0].reset();
                    
                    $(".has-error").removeClass("has-danger");
                    $(".help-block").empty();
                    $('.btn-submit').show();
                    $('.loading').hide();
                    $(".btn-back").trigger( "click" );
                    
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        //dt.draw();
        return false;
    });



var cargas = {CARR_TRAFICO_CLAVE:'Trafico', CARR_PELIGRO:'Peligrosa', TCAR_NOMBRE:'Tipo de carga', TPRO_NOMBRE:'Descripción', CARR_UNIDAD:'Unidades', TPRO_UNIDAD:'Medida'};

var catalogo_carga = {cargas:cargas};
var tabla;

function initDT_cargas(tabla, url, id){
  id=id;
  html ='<tr>';
  campos=[];
  i=0;
  $.each(catalogo_carga[tabla], function( index, value ) {
    html += '<th>'+value+'</th>';
    campos.splice(i, 0, {data: index});
    i++;
  });
  html +="<th></th></tr>";

  campos.splice(i, 0, {data: "action", name: "action", orderable: false, searchable: false} );

  $('#'+tabla+'-table thead').html(html);
  $('#'+tabla+'-table tfoot').html(html);

  var dt = $('#'+tabla+'-table').DataTable({
    processing: false,
    serverSide: true,
    language: { url: url+'/localisation/spanish.json' },
    ajax: url+'/cargas/data/'+id,
    columns: campos,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
  });
  
$("#"+tabla+"-table tbody").on('click', '.delete', function(e) {
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
  $.post( "../"+tabla+"/delete", {id: id})
  .done(function(data) {
    alertify.success('Carga eliminada correctamente');
  });
}