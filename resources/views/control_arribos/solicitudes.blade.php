@extends('layout.master')

@section('title', 'Solicitudes de Arribo')
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  <!-- Panel Table Individual column searching -->
{{-- <div class="page"> --}}
    
{{-- </div> --}}
@include('control_arribos.content')

@endsection
@push('scripts')

<script>
var sop_dt = new sop_datatable('<?=url('control_arribos');?>', '<?=$table;?>');
sop_dt.initDt('<?=$table;?>');
</script>
@endpush
    