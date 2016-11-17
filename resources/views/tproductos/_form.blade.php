<div class="form-group form-material floating" data-plugin="formMaterial" id="form-TPRO_NOMBRE-error">
  {!! Form::text("TPRO_NOMBRE",null,["class"=>"form-control required","id"=>"TPRO_NOMBRE", "required"]) !!}
  {!! Form::label("TPRO_NOMBRE","Nombre",["class"=>"floating-label"]) !!}
  <span id="TPRO_NOMBRE-error" class="help-block"></span>
</div>

<div class="form-group form-material floating" data-plugin="formMaterial" id="form-TPRO_UNIDAD-error">
  {!! Form::text("TPRO_UNIDAD",null,["class"=>"form-control required","id"=>"TPRO_UNIDAD", "required"]) !!}
  {!! Form::label("TPRO_UNIDAD","Unidad",["class"=>"floating-label"]) !!}
  <span id="TPRO_UNIDAD-error" class="help-block"></span>
</div>

<div class="form-group form-material floating" data-plugin="formMaterial" id="form-TPRO_TCAR_ID-error">
  {!! Form::select('TPRO_TCAR_ID', $tcargas, $opcion, ["class"=> "form-control required"] ) !!}          
  {!! Form::label("TPRO_TCAR_ID","Tipo de Carga",["class"=>"floating-label"]) !!}
  <span id="TPRO_TCAR_ID-error" class="help-block"></span>
</div>

<div class="form-group clearfix">
  <div class="loading"></div>
</div>
{!! Form::button("<i class='icon md-floppy'></i> Enviar",["type" => "submit","class"=>"btn
btn-primary btn-block btn-submit"])!!}