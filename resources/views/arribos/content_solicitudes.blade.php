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
      <table class="table dataTable raised w-full" id="<?=$table;?>-table">
        <thead>
        </thead>
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/sop/arribos.js') }}"></script>
<script src="{{ asset('assets/js/sop/solicitudes.js') }}"></script>
<script>
  initDT('<?=$table;?>');
</script>  