<div class="form-group form-material floating" data-plugin="formMaterial" id="form-TCAR_NOMBRE-error">
  {!! Form::text("TCAR_NOMBRE",null,["class"=>"form-control required","id"=>"TCAR_NOMBRE", "required"]) !!}
  {!! Form::label("TCAR_NOMBRE","Nombre",["class"=>"floating-label"]) !!}
  <span id="TCAR_NOMBRE-error" class="help-block"></span>
</div>

<div class="form-group form-material floating" data-plugin="formMaterial">
  {!! Form::text("TCAR_SECTOR",null,["class"=>"form-control required","id"=>"TCAR_SECTOR", "required"]) !!}
  {!! Form::label("TCAR_SECTOR","Sector",["class"=>"floating-label"]) !!}
  <span id="TCAR_SECTOR-error" class="help-block"></span>
</div>

<div class="form-group clearfix">
  <div class="loading"></div>
</div>
{!! Form::button("<i class='icon md-floppy'></i> Enviar",["type" => "submit","class"=>"btn
btn-primary btn-block btn-submit"])!!}