<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active in" id="sidebar-userlist">
    <div>
      <div>
        <h4 class="clearfix">Cargamento del arribo
          <div class="pull-xs-right">
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-plus" aria-hidden="true"></i>
            </a>
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-more" aria-hidden="true"></i>
            </a>
          </div>
        </h4>
        
        <a class="btn btn-sm btn-primary" data-toggle="site-sidebar" href="javascript:void(0)" title="Nuevo" data-url="../cargas/nuevo/<?=$id;?>">
          <i class="icon md-plus" aria-hidden="true"></i>Añadir carga
        </a>
        <table class="table raised dataTable w-full" id="cargas-table">
          <thead>
          </thead>
          <tfoot>
          </tfoot>
        </table><br>
                <br><br>
        <a class="btn btn-sm btn-primary waves-effect active btnCerrar" data-toggle="site-sidebar" href="javascript:void(0)" title="Cerrar">
          <i class="icon md-close" aria-hidden="true"></i>Cerrar
        </a>
      </div>  
    </div>
  </div>
<script src="{{ asset('assets/js/sop/arribos.js')}}" ></script>
<script>
  initDT_cargas('cargas', <?=$id;?>);
</script>  