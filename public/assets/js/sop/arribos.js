/**********
$('#PUER_ID').on('change', function(e){
    //console.log(e);
    var PUER_ID = e.target.value;

    $.getJSON('/arribos/nuevo/ajax-muelles?PUER_ID=' + PUER_ID, function(data) {
        //console.log(data);
        $('#MUEL_ID').empty();
        $.each(data, function(index, subCatObj){
            $('#MUEL_ID').append(''+subCatObj.MUEL_NOMBRE+'');
            //alert(subCatObj);
        });
    });
});
*******/
$('#SARR_PUERTO_ID').change(function(e){
    $.get("muelles/"+e.target.value+"", function(response, state){
        console.log(response);
        $('#SARR_MUELLE_ID').empty();
        for (i=0; i < response.length; i++) {
            $("#SARR_MUELLE_ID").append("<option value='"+response[i].MUEL_ID+"'>"+response[i].MUEL_NOMBRE+"</option>");
        }
    });
});

$('#SARR_TIPO_BUQUE').change(function(e){
    $.get("buques/"+e.target.value+"", function(response, state){
        console.log(response);
        $('#SARR_BUQUE_ID').empty();
        for (i=0; i < response.length; i++) {
            $("#SARR_BUQUE_ID").append("<option value='"+response[i].BUQU_ID+"'>"+response[i].BUQU_NOMBRE+"</option>");
        }
    });
});