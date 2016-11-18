@extends('layout.master')

@section('title', 'Nuevo Arribo')
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  @include('arribos.content_nuevo')
@endsection
@push('scripts')
<script src="{{ asset('assets/js/sop/arribos.js') }}"></script>
{{-- <script src="{{ asset('assets/js/sop/cat.js') }}"></script> --}}
<script src="{{ asset('assets/js/Plugin/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('assets/js/Plugin/jt-timepicker.js')}}"></script>
<script>
  initDT('cargas');
</script>
@endpush
    