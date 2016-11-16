<div class="form-group form-material floating" data-plugin="formMaterial" id="form-active-error">
  {!! Form::text("active",null,["class"=>"form-control required","id"=>"active", "required"]) !!}
  {!! Form::label("active","Activo",["class"=>"floating-label"]) !!}
  <span id="active-error" class="help-block"></span>
</div>
<div class="form-group clearfix">
  <div class="loading"></div>
</div>
{!! Form::button("<i class='icon md-floppy'></i> Enviar",["type" => "submit","class"=>"btn
btn-primary btn-block"])!!}
<br>