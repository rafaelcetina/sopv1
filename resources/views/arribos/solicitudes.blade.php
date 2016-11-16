@extends('layout.master')

@section('title', 'Solicitudes de Arribo')
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  <!-- Panel Table Individual column searching -->
<div class="page">
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
          <table class="table table-responsive dataTable w-full" id="<?=$table;?>-table">
            <thead>
            </thead>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>  
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/sop/arribos.js') }}"></script>
<script src="{{ asset('assets/js/sop/solicitudes.js') }}"></script>
<script src="{{ asset('assets/js/Plugin/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('assets/js/Plugin/jt-timepicker.js')}}"></script>
<script>
  initDT('<?=$table;?>');
</script>
@endpush
    