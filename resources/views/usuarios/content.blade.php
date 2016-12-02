<!-- Panel Table Individual column searching -->
{{-- <div class="page"> --}}
  <div class="page-header">
    <h1 class="page-title">Usuarios</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item active">Usuarios</li>
    </ol>
   <br>
    <a class="btn btn-sm btn-primary" data-toggle="site-sidebar" href="javascript:void(0)" title="Nuevo" data-url="usuarios/create">
      <i class="icon md-plus" aria-hidden="true"></i>Añadir nuevo
    </a>
  </div>
  <div class="page-content">
    <div class="panel">
      <div class="panel-body">
        <table class="table dataTable raised w-full" id="usuarios-table">
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
  var sop_dt = new sop_datatable('<?=url('/');?>', 'usuarios');
  sop_dt.initDt('usuarios');
  </script>
  <?php
  }
  ?>