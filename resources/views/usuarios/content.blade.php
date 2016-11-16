<!-- Panel Table Individual column searching -->
<div class="page">
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
          <table class="table dataTable table-bordered w-full" id="usuarios-table">
            <thead>
            </thead>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>  
  </div>
@push('scripts')
<script src="{{ asset('assets/js/sop/add.js') }}"></script>
<script src="{{ asset('assets/js/sop/usuarios.js') }}"></script>
<script>
  initDT('usuarios');
</script>
@endpush