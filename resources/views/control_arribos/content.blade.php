<div class="page-header">
  <h1 class="page-title">Solicitudes de Arribo/Atraque</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">Movimientos</a></li>
    <li class="breadcrumb-item active">Solicitudes</li>
  </ol>
 <br>
</div>
<div class="page-content">
  <div class="panel">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <button class="btn btn-sm btn-info" id="button"> <i class="icon md-assignment-check" ></i> Programar Arribo</button>
          <button class="btn btn-sm btn-info" id="button2"> <i class="icon md-block"></i> Cancelar Arribo</button>
        </div><br>
        <div class="col-lg-6 col-md-6">
          <div class="input-daterange" data-plugin="datepicker">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="icon md-calendar" aria-hidden="true"></i>
              </span>
              <input type="text" class="form-control filtro" id="start" name="start" />
            </div>
            <div class="input-group">
              <span class="input-group-addon">hasta</span>
              <input type="text" class="form-control filtro" id="end" name="end" />
            </div>
          </div>          
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-12">
          <table class="table datatable-responsive w-full" id="<?=$table;?>-table">
            <thead>
            </thead>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  if(isset($ajax)){
?>
<script>
  var sop_dt_<?=$table;?> = new sop_datatable('<?=url('control_arribos');?>', '<?=$table;?>');
  sop_dt_<?=$table;?>.initDt('<?=$table;?>');
</script>

<?php
}
?>
