<!-- Panel Table Individual column searching -->
{{-- <div class="page"> --}}
  <div class="page-header">
    <h1 class="page-title"><?=$table;?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">Catálogos</a></li>
      <li class="breadcrumb-item active"><?=$table;?></li>
    </ol>
   <br>
    <a class="btn btn-sm btn-primary" data-toggle="site-sidebar" href="javascript:void(0)" title="Nuevo" data-url="<?=$table;?>/create">
      <i class="icon md-plus" aria-hidden="true"></i>Añadir nuevo
    </a>
  </div>
  <div class="page-content">
    <div class="panel">
      <div class="panel-body">
        <table class="table dataTable datatable-responsive raised w-full" id="<?=$table;?>-table">
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
    var sop_dt_<?=$table;?> = new sop_datatable('<?=url('/catalogos');?>', '<?=$table;?>');
    sop_dt_<?=$table;?>.initDt('<?=$table;?>');
    console.log(sop_dt_<?=$table;?>);
  </script>
  <?php
  }
  ?>

