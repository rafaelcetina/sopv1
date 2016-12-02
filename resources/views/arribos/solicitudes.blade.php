@extends('layout.master')

@section('title', 'Solicitudes de Arribo')
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  @include('arribos.content_solicitudes')
@endsection
@push('scripts')
<script>
  var sop_dt_carga = new sop_datatable('<?=url('/arribos');?>', '<?=$table;?>');
  sop_dt_carga.initDt('<?=$table;?>');
</script>
@endpush
    