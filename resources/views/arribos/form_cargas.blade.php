<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active in" id="sidebar-userlist">
    <div>
      <div>
        <h4 class="clearfix">Formulario de registro de Cargas
          <div class="pull-xs-right">
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-plus" aria-hidden="true"></i>
            </a>
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-more" aria-hidden="true"></i>
            </a>
          </div>
        </h4>
        
{!! Form::open(["id"=>"form_carga","autocomplete"=>"off"]) !!}
<fieldset>
  <legend>Datos de carga</legend>
        
  <div class="form-group form-material col-xs-12 col-md-12">
    <label class="form-control-label" for="CARR_TRAFICO_CLAVE">Trafico:</label>
    <select name="CARR_TRAFICO_CLAVE" id="" class="form-control">
      <option value="ALTURA_CARGA">ALTURA - CARGA</option>
      <option value="ALTURA_DESCARGA">ALTURA - DESCARGA</option>
      <option value="CABOTAJE">CABOTAJE</option>
    </select>
    <div class="checkbox-custom checkbox-default checkbox-inline">
      <input type="checkbox" name="CARR_PELIGRO" id="PELIGRO">
      <label for="CARR_PELIGRO">Peligroso</label>
    </div>
  </div>
  <div class="form-group form-material  col-xs-12 col-md-12" id="form-CARR_TCARGA_ID-error">
    {!! Form::label("CARR_TCARGA_ID","Tipo de carga",["class"=>"form-control-label"]) !!}
    {!! Form::select('CARR_TCARGA_ID', $tcargas, $opcion, ["class"=> "form-control required", "data-plugin"=> "select2", "required"] ) !!}
    <span id="CARR_TCARGA_ID-error" class="help-block"></span>
  </div>
  <div class="form-group form-material col-xs-12 col-md-12" id="form-CARR_TPRODUCTO_ID-error">
    {!! Form::label("CARR_TPRODUCTO_ID","Descripción",["class"=>"form-control-label"]) !!}
    {!! Form::select('CARR_TPRODUCTO_ID', [' -- Selecciona tipo de carga -- '], $opcion, ["class"=> "form-control required", "data-plugin"=>"select2"] ) !!}
    <span id="CARR_TPRODUCTO_ID-error" class="help-block"></span>
  </div>

  <div class="form-group form-material col-xs-4 col-md-4" id="form-CARR_UNIDAD-error">
    <div class="input-group">
      <label class="form-control-label" for="CARR_UNIDAD">UNI: (<span id="unidad"></span>) </label>
      <input type="text" class="form-control" id="CARR_UNIDAD" name="CARR_UNIDAD" autocomplete="off" required="">
       <span id="CARR_UNIDAD-error" class="help-block"></span>
    </div>
  </div>

      {!! Form::button("<i class='icon md-boat'></i> Agregar carga",["id"=>"btn_carga" ,"type" => "submit","class"=>"btn btn btn-primary btn-waves-effect"])!!}
      <hr>
  {!! Form::close() !!}
</fieldset>

        <a class="btn btn-sm btn-primary waves-effect active btnCerrar" data-toggle="site-sidebar" href="javascript:void(0)" title="Cerrar">
          <i class="icon md-close" aria-hidden="true"></i>Cerrar
        </a>
        <a data-toggle="site-sidebar" href="javascript:;" data-url="../cargas/cargas/<?=$id;?>" class="btn btn-sm btn-pure btn-icon btn-back"><i class="icon md-boat"></i> Ver cargas</a>
      </div>  
    </div>
  </div>
<script src="{{ asset('assets/js/sop/arribos.js')}}" ></script>