@push('estilos')
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}">
@endpush
<fieldset>
  <legend>Datos de la embarcación</legend>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-5">
    {!! Form::label("SARR_BUQUE_ID","Embarcación",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_BUQUE_ID', ['Seleciona una opcion'], $opcion, ["class"=> "form-control required", "data-plugin"=>"select2"] ) !!}
  </div>

  <div class="form-group form-material col-xs-12 col-md-3">
    {!! Form::label("SARR_TIPO_BUQUE","Tipo de Embarcación",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_TIPO_BUQUE', $types, $opcion, ["class"=> "form-control required", "data-plugin"=> "select2"] ) !!}
  </div>
  
  <div class="form-group form-material col-xs-12 col-md-2">
    <label class="form-control-label" for="SARR_BUQUE_VIAJE">Viaje:</label>
    <input type="text" class="form-control" id="SARR_BUQUE_VIAJE" name="SARR_BUQUE_VIAJE"
    placeholder="" autocomplete="off" />
  </div>
  <div class="form-group form-material col-xs-12 col-md-2">
    <button class="btn btn-primary">Viajes Buque</button>
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
        <input type="checkbox" name="SARR_ACTIVIDADES" id="carga">
        <label for="carga">Carga</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="descarga">
        <label for="descarga">Descarga</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="carga2">
        <label for="carga2">Avituallamiento</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="descarga2">
        <label for="descarga2">Reparación</label>
      </div>
    </div>
    <div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="descarga2">
        <label for="descarga2">Apoyo</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="descarga2">
        <label for="descarga2">Forzoso</label>
      </div>
      <div class="checkbox-custom checkbox-default checkbox-inline">
        <input type="checkbox" name="SARR_ACTIVIDADES" id="descarga2">
        <label for="descarga2">Otros</label>
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
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETA1">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETA2" />
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
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETB1">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETB2" />
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
      <input type="text" class="form-control" data-plugin="datepicker" name="SARR_ETD1">
    </div>
    <!-- Example Basic -->
    <div class="m-lg-0">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon md-time" aria-hidden="true"></i>
        </span>
        <input type="text" class="form-control" data-plugin="timepicker" name="SARR_ETD2" />
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
  <div class="form-group form-material col-xs-12 col-md-6">
    {!! Form::label("SARR_PUERTO_ID","Arribar al puerto",["class"=>"form-control-label"]) !!}
    {!! Form::select('SARR_PUERTO_ID', $puertos, $opcion, ["class"=> "form-control required", "data-plugin"=>"select2"] ) !!}
  </div>
  <div class="form-group form-material col-xs-12 col-md-6">
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
      <label class="form-control-label" for="inputBasicFirstName">Últimos diez puertos del itinerario:</label>
      <!-- Example Basic -->
      <select class="form-control" data-plugin="select2" multiple="" name="SARR_HISTORIAL_PUERTOS" data-placeholder="Últimos diez puertos">
        <optgroup label="Alaskan/Hawaiian Time Zone">
          <option value="AK">Alaska</option>
          <option value="HI">Hawaii</option>
        </optgroup>
        <optgroup label="Pacific Time Zone">
          <option value="CA">California</option>
          <option value="NV">Nevada</option>
          <option value="OR">Oregon</option>
          <option value="WA">Washington</option>
        </optgroup>
        <optgroup label="Mountain Time Zone">
          <option value="AZ">Arizona</option>
          <option value="CO">Colorado</option>
          <option value="ID">Idaho</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NM">New Mexico</option>
          <option value="ND">North Dakota</option>
          <option value="UT">Utah</option>
          <option value="WY">Wyoming</option>
        </optgroup>
        <optgroup label="Central Time Zone">
          <option value="AL">Alabama</option>
          <option value="AR">Arkansas</option>
          <option value="IL">Illinois</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="OK">Oklahoma</option>
          <option value="SD">South Dakota</option>
          <option value="TX">Texas</option>
          <option value="TN">Tennessee</option>
          <option value="WI">Wisconsin</option>
        </optgroup>
      </select>
      <!-- End Example Basic -->
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>Datos de carga</legend>
  <div class="row">
  <div class="form-group form-material col-xs-6 col-md-3">
    <label class="form-control-label" for="inputBasicFirstName">Trafico:</label>
    <select name="" id="" class="form-control">
      <option value="BABOR">BABOR</option>
      <option value="ESTRIBOR">ESTRIBOR</option>
    </select>
    <div class="checkbox-custom checkbox-default checkbox-inline">
      <input type="checkbox" name="actividades" id="descarga2">
      <label for="descarga2">Peligroso</label>
    </div>
  </div>
  <div class="form-group form-material col-xs-6 col-md-3">
    <label class="form-control-label" for="inputBasicFirstName">Tipo:</label>
    <select name="" id="" class="form-control">
      <option value="BABOR">BABOR</option>
      <option value="ESTRIBOR">ESTRIBOR</option>
    </select>
  </div>
  <div class="form-group form-material col-xs-8 col-md-4">
    <label class="form-control-label" for="inputBasicFirstName">DESRIPCIÓN:</label>
    <input type="text" class="form-control" id="inputTextCurrent" autocomplete="off">
  </div>
  <div class="form-group form-material col-xs-4 col-md-2">
    <div class="input-group">
      <label class="form-control-label" for="inputBasicFirstName">UNI: </label>
      <input type="text" class="form-control" id="inputTextCurrent" autocomplete="off">
      <span class="input-group-btn">
        <button type="button" class="btn btn-xs btn-primary waves-effect" id="exampleTimeButton">AGREGAR</button>
      </span>
    </div>
  </div>
</div>
</fieldset>
<fieldset>
  <legend>Documentos</legend>
<div class="row">
  <div class="form-group form-material col-xs-12 col-md-4">
    <label class="form-control-label" for="SARR_CREW-LIST">CREW-LIST:</label>
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
  {!! Form::button("<i class='icon md-boat'></i> Enviar solicitud",["type" => "submit","class"=>"btn btn-primary"])!!}
</div>