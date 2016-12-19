    $("#form_add").submit(function (e) {
        e.preventDefault();
        $('.loading').show();
        $('.btn-submit').hide();
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
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
                    //$('.btn-submit').show();
                    alertify.error('Ocurrió un error, intente de nuevo');
                } else {
                    
                    alertify.success('Registro actualizado correctamente');
                    
                    refreshDT(tabla);
                    
                    $(".has-error").removeClass("has-danger");
                    $(".help-block").empty();
                    //$('.btn-submit').show();
                    $('.loading').hide();
                    $(".btnCerrar").trigger( "click" );
                    
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        //dt.draw();
        return false;
    });
