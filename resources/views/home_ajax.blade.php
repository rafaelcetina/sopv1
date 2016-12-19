<!-- Page -->
{{-- <div class="page"> --}}
    <div class="page-header">
      <h1 class="page-title">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
     <br>
    </div>
    <div class="page-content">
    <div class="col-md-4 col-xs-12">
      <div class="panel panel-info panel-line">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="icon icon-md md-boat"></i> Solicitudes de Arribo</h3>
        </div>
        <div class="panel-body">
          <a class="btn btn-info btn-large" href="{{ URL::to('arribos/nuevo') }}">Nueva solicitud de arribo</a>
        </div>
      </div>
    </div>
   <div class="col-md-4 col-xs-12">
    <div class="panel panel-primary panel-line">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="icon icon-md md-boat"></i> Solicitudes programadas</h3>
      </div>
      <div class="panel-body">
        <a class="btn btn-primary btn-large" href="{{ URL::to('arribos/solicitudes') }}">Nueva solicitud de arribo</a>
      </div>
    </div>
  </div>
  </div>  
{{-- </div> --}}
<!-- End Page -->