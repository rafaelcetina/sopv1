$('#SARR_PUERTO_ID').change(function(e){
    $.get("muelles/"+e.target.value+"", function(response, state){
        //&console.log(response);
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


$("#form").submit(function (e) {
        e.preventDefault();
        $('.loading').show();
        
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
        
        var actividades = new Array();
        $("input:checkbox[name=SARR_ACTIVIDADES]:checked").each(function(){
            actividades.push($(this).val());
        });
        
        for (var i = actividades.length - 1; i >= 0; i--) {
            console.log(actividades[i]);
        }

        console.log(data);
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
                    
                    alertify.success('Registro actualizado correctamente');
                    
                    $(".has-error").removeClass("has-danger");
                    $(".help-block").empty();
                    $('.btn-submit').show();
                    $('.loading').hide();
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
