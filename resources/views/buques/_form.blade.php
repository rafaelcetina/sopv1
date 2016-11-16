<div class="form-group form-material floating" data-plugin="formMaterial" id="form-BUQU_TIPO_BUQUE-error">
  {!! Form::select('BUQU_TIPO_BUQUE', $types, $opcion, ["class"=> "form-control required"] ) !!}
  {!! Form::label("BUQU_TIPO_BUQUE","Tipo de Buque",["class"=>"floating-label"]) !!}
</div>

<div class="form-group form-material floating" data-plugin="formMaterial" id="form-BUQU_NOMBRE-error">
  {!! Form::text("BUQU_NOMBRE",null,["class"=>"form-control required","id"=>"BUQU_NOMBRE", "required"]) !!}
  {!! Form::label("BUQU_NOMBRE","Nombre de buque",["class"=>"floating-label"]) !!}
  <span id="BUQU_NOMBRE-error" class="help-block"></span>
</div>

<div class="form-group form-material floating" data-plugin="formMaterial" id="form-BUQU_BANDERA-error">
  {!! Form::text("BUQU_BANDERA",null,["class"=>"form-control required","id"=>"BUQU_BANDERA", "required"]) !!}
  {!! Form::label("BUQU_BANDERA","Bandera",["class"=>"floating-label"]) !!}
  <span id="BUQU_BANDERA-error" class="help-block"></span>

</div>

<div class="form-group form-material floating" data-plugin="formMaterial" id="form-BUQU_MATRICULA-error">
  {!! Form::text("BUQU_MATRICULA",null,["class"=>"form-control required","id"=>"BUQU_MATRICULA", "required"]) !!}
  {!! Form::label("BUQU_MATRICULA","Matricula",["class"=>"floating-label"]) !!}
  <span id="BUQU_MATRICULA-error" class="help-block"></span>
</div>

<div class="form-group clearfix">
  <div class="loading"></div>
</div>
{!! Form::button("<i class='icon md-floppy'></i> Enviar",["type" => "submit","class"=>"btn
btn-primary btn-block"])!!}