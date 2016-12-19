<div class="page-header">
  <h1 class="page-title"><?=$table;?> de Arribo/Atraque</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">Movimientos</a></li>
    <li class="breadcrumb-item active"><?=$table;?></li>
  </ol>
 <br>
</div>
<div class="page-content">
  <div class="panel">
    <button class="btn btn-sm btn-info" id="btnPdf"> <i class="icon md-assignment-check" ></i> Ver Solicitud en PDF</button>
    <div class="panel-body">
      <table class="table datatable-responsive raised w-full" id="<?=$table;?>-table">
        <thead>
        </thead>
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<?php
  if(isset($ajax)){
?>
<script>
  var sop_dt_carga = new sop_datatable('<?=url('/arribos');?>', '<?=$table;?>');
  sop_dt_carga.initDt('<?=$table;?>');
</script>
<?php
}
?>
