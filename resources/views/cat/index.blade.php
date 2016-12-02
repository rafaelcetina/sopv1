@extends('layout.master')

@section('title', $table)
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  @include('cat.content')
@endsection
@push('scripts')
<script>
  var sop_dt_<?=$table;?> = new sop_datatable('<?=url('/catalogos');?>', '<?=$table;?>');
  sop_dt_<?=$table;?>.initDt('<?=$table;?>');
</script>
@endpush
