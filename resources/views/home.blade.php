@extends('layout.master')

@section('title', 'Dashboard')
@push('estilos')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/chart.css')}}"> --}}
@endpush
@section('content')
<!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
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
        <a class="btn btn-primary btn-large" href="{{ URL::to('arribos/solicitudes') }}">Ver solicitudes de arribo</a>
      </div>
    </div>
  </div>
  </div>  
{{-- </div> --}}
<!-- End Page -->
@endsection
@push('scripts')
{{-- <script src="{{asset('assets/vendor/chartist/chartist.min.js')}}"></script>
<script src="{{asset('assets/js/chart.js')}}"></script> --}}
@endpush