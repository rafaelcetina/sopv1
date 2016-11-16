<div class="form-group form-material floating" data-plugin="formMaterial" id="form-MUEL_PUERTO-error">
            
            {!! Form::select('MUEL_PUERTO', $puertos, $opcion, ["class"=> "form-control required"] ) !!}
            
            {!! Form::label("MUEL_PUERTO","Puerto",["class"=>"floating-label"]) !!}
            
            <span id="MUEL_PUERTO-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-MUEL_NOMBRE-error">
            {!! Form::text("MUEL_NOMBRE",null,["class"=>"form-control required","id"=>"MUEL_NOMBRE", "required"]) !!}
            {!! Form::label("MUEL_NOMBRE","Nombre",["class"=>"floating-label"]) !!}
            <span id="MUEL_NOMBRE-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("MUEL_NOMBRELARGO",null,["class"=>"form-control required","id"=>"MUEL_NOMBRELARGO", "required"]) !!}
            {!! Form::label("MUEL_NOMBRELARGO","Nombre largo",["class"=>"floating-label"]) !!}
            <span id="MUEL_NOMBRELARGO-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("MUEL_CALADO",null,["class"=>"form-control required","id"=>"MUEL_CALADO", "required"]) !!}
            {!! Form::label("MUEL_CALADO","Calado",["class"=>"floating-label"]) !!}
            <span id="MUEL_CALADO-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("MUEL_LONGITUD",null,["class"=>"form-control required","id"=>"MUEL_LONGITUD", "required"]) !!}
            {!! Form::label("MUEL_LONGITUD","Longitud",["class"=>"floating-label"]) !!}
            <span id="MUEL_LONGITUD-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("MUEL_DESCRIP",null,["class"=>"form-control required","id"=>"MUEL_DESCRIP", "required"]) !!}
            {!! Form::label("MUEL_DESCRIP","Descripción",["class"=>"floating-label"]) !!}
            <span id="MUEL_DESCRIP-error" class="help-block"></span>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("MUEL_TERMINAL",null,["class"=>"form-control required","id"=>"MUEL_TERMINAL", "required"]) !!}
            {!! Form::label("MUEL_TERMINAL","Terminal",["class"=>"floating-label"]) !!}
            <span id="MUEL_TERMINAL-error" class="help-block"></span>
          </div>
          
          <div class="form-group clearfix">
            <div class="loading"></div>
          </div>
          {!! Form::button("<i class='icon md-floppy'></i> Enviar",["type" => "submit","class"=>"btn
    btn-primary btn-block btn-submit"])!!}