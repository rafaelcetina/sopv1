
<fieldset>
  <legend>Datos de la embarcación</legend>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-4 col-lg-3">
    {!! Form::label("SARR_BUQUE_ID","Embarcación",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_BUQUE_ID', ['Seleciona una opcion'], $opcion, ["class"=> "form-control required", "data-plugin"=>"select2", "required"] ) !!}
  </div>

  <div class="form-group form-material col-xs-12 col-md-3 col-lg-3">
    {!! Form::label("SARR_TIPO_BUQUE","Tipo de Embarcación",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_TIPO_BUQUE', $types, $opcion, ["class"=> "form-control required", "data-plugin"=> "select2", "required"] ) !!}
  </div>
  
    
  <div class="form-group form-material col-xs-12 col-md-2 col-lg-2">
    <label class="form-control-label" for="SARR_BUQUE_VIAJE">Viaje:</label>
    <input type="text" class="form-control" required="" id="SARR_BUQUE_VIAJE" name="SARR_BUQUE_VIAJE"
    placeholder="" autocomplete="off" />
  </div>
  <div class="form-group form-material col-xs-6 col-md-2 col-lg-1">
    <button type="button" class="btn btn-primary">Viajes Buque</button>
  </div>
</div>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-4">
    {!! Form::label("SARR_TRAFICO_CLAVE","Trafico de Buque",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_TRAFICO_CLAVE', $trafico, $opcion, ["class"=> "form-control required"] ) !!}
  </div>
  <div class="form-group form-material col-xs-12 col-md-8">
    <label class="form-control-label" for="SARR_ACTIVIDADES">Actividades en el puerto:</label>
    <div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="carga" value="CARGA">
        <label for="carga">Carga</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="descarga" value="DESCARGA">
        <label for="descarga">Descarga</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="AVI" value="AVITUALLAMIENTO">
        <label for="AVI">Avituallamiento</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="REPARACION" value="REPARACION">
        <label for="REPARACION">Reparación</label>
      </div>
    </div>
    <div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="APOYO" value="APOYO">
        <label for="APOYO">Apoyo</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="FORZOSO" value="FORZOSO">
        <label for="FORZOSO">Forzoso</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES[]" id="OTROS" value="OTROS">
        <label for="OTROS">Otros</label>
      </div>
    </div>
  </div>
  </div>
</fieldset>
<fieldset>
  <legend>Datos del arribo</legend>
  <div class="form-group form-material col-xs-12 col-md-12">
    <label class="form-control-label" for="">Tiempo estimado de arribo (ETA):</label>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="icon md-calendar" aria-hidden="true"></i>
      </span>
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETA[]">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETA[]" />
      </div>
    </div>
    <!-- End Example Basic -->
  </div>  
  <div class="form-group form-material col-xs-12 col-md-12">
    <label class="form-control-label" for="">Tiempo estimado de atraque (ETB):</label>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="icon md-calendar" aria-hidden="true"></i>
      </span>
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETB[]">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETB[]" />
      </div>
    </div>
    <!-- End Example Basic -->
  </div>  
  <div class="form-group form-material col-xs-12 col-md-12">
    <label class="form-control-label" for="">Tiempo estimado de salida (ETD):</label>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="icon md-calendar" aria-hidden="true"></i>
      </span>
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETD[]">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETD[]" />
      </div>
    </div>
    <!-- End Example Basic -->
  </div>
<div class="row">
  <div class="form-group form-material col-xs-12, col-md-4">
    <label class="form-control-label" for="SARR_BANDA_ATRAQUE">Banda de atraque:</label>
    <select name="SARR_BANDA_ATRAQUE" id="" class="form-control">
      <option value="BABOR">BABOR</option>
      <option value="ESTRIBOR">ESTRIBOR</option>
    </select>
  </div>
  <div class="form-group form-material col-xs-12, col-md-4">
    <label class="form-control-label" for="SARR_CALADA_POPA">Calada Popa Atraque:</label>
    <input type="text" class="form-control" name="SARR_CALADA_POPA" data-plugin="TouchSpin" data-min="0" data-max="100" data-step="0.5" data-decimals="2" data-boostat="5" data-maxboostedstep="10" data-postfix="Popa Pies" value="10" />
  </div>
  <div class="form-group form-material col-xs-12, col-md-4">
    <label class="form-control-label" for="SARR_CALADA_PROA">Calada Proa Atraque:</label>
    <input type="text" class="form-control" name="SARR_CALADA_PROA" data-plugin="TouchSpin" data-min="0" data-max="100" data-step="0.5" data-decimals="2" data-boostat="5" data-maxboostedstep="10" data-postfix="Proa Pies" value="10" />
  </div>
</div>

<div class="row">
  <div class="form-group form-material col-xs-12 col-md-6 col-lg-6">
    {!! Form::label("SARR_PUERTO_ID","Arribar al puerto",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_PUERTO_ID', $puertos, $opcion, ["class"=> "form-control required", "data-plugin"=>"select2"] ) !!}
  </div>
  <div class="form-group form-material col-xs-12 col-md-6 col-lg-6">
    {!! Form::label("SARR_MUELLE_ID","Muelle Solicitado",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_MUELLE_ID', [' -- Selecciona un Puerto -- '], $opcion, ["class"=> "form-control required", "data-plugin"=>"select2"] ) !!}
  </div>
</div>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_DESTINO">Destino:</label>
    <input type="text" class="form-control" id="SARR_DESTINO" name="SARR_DESTINO"
      placeholder="" autocomplete="off" />
  </div>
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_OPERADORA">Operadora:</label>
    <input type="text" class="form-control" id="SARR_OPERADORA" name="SARR_OPERADORA"
      placeholder="" autocomplete="off" />
  </div>
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_OBSERVACIONES">Observaciones:</label>
    <textarea class="maxlength-textarea form-control" name="SARR_OBSERVACIONES" data-plugin="maxlength" data-placement="bottom-right-inside" maxlength="150" rows="3" placeholder="Este elemento esta limitado a 150 caracteres."></textarea>
  </div>
</div>
</fieldset>
<fieldset>
  <legend>Historial de viaje</legend>
  <div class="row">
    <div class="form-group form-material col-xs-12 col-md-12">
      <label class="form-control-label" for="historial">Últimos diez puertos del itinerario:</label>
      <!-- Example Basic -->
      <select id="historial" class="form-control" data-plugin="select2" multiple="multiple" name="SARR_HISTORIAL_PUERTOS[]" data-placeholder="Últimos diez puertos">
      </select>
      <!-- End Example Basic -->
    </div>
  </div>
</fieldset>
<!--<fieldset>
  <legend>Datos de carga</legend>
  <a class="btn btn-sm btn-primary" data-toggle="site-sidebar" href="javascript:void(0)" title="Nuevo" data-url="../cargas/nuevo">
        <i class="icon md-plus" aria-hidden="true"></i>Añadir carga
      </a>

  <table class="table dataTable w-full" id="cargas-table">
    <thead>
    </thead>
    <tfoot>
    </tfoot>
  </table>

</fieldset>-->
<fieldset class="raised">
  <legend>Documentos</legend>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_CREW_LIST">CREW-LIST:</label>
    <div class="input-group input-group-file" data-plugin="inputGroupFile">
      <input type="text" class="form-control" readonly="">
      <span class="input-group-btn">
        <span class="btn btn-success btn-file waves-effect">
          <i class="icon md-upload" aria-hidden="true"></i>
          <input type="file" name="SARR_CREW-LIST" multiple="">
        </span>
      </span>
    </div>
  </div>
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_VOYAGE">VOYAGE MEMO:</label>
    <div class="input-group input-group-file" data-plugin="inputGroupFile">
      <input type="text" class="form-control" readonly="">
      <span class="input-group-btn">
        <span class="btn btn-success btn-file waves-effect">
          <i class="icon md-upload" aria-hidden="true"></i>
          <input type="file" name="SARR_VOYAGE" multiple="">
        </span>
      </span>
    </div>
  </div>
  <div class="form-group form-material col-xs-12 col-md-4">
    <div class="input-group">
      <label class="form-control-label" for="SARR_FACTURAR">Facturar a: </label>
      <input type="text" class="form-control" id="SARR_ACTURAR" autocomplete="off" value="5480001">
      <span class="input-group-btn">
        <button type="button" class="btn btn-xs btn-primary waves-effect" id="exampleTimeButton">CAMBIAR</button>
      </span>
    </div>
  </div>
</div>
</fieldset>
<div class="form-group clearfix">
  <div class="loading"></div>
</div>
<div class="form-group form-material">
  {!! Form::button("<i class='icon md-boat'></i> Enviar solicitud",["type" => "submit","class"=>"btn btn-primary btn-submit"])!!}
</div>