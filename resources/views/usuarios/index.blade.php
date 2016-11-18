@extends('layout.master')

@section('title', 'Gestión de usuarios')
@section('content')
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->  
<!-- Page -->
<!-- End Page -->
  @include('usuarios.content')
@endsection
@push('scripts')
<script src="{{ asset('assets/js/sop/add.js') }}"></script>
<script src="{{ asset('assets/js/sop/usuarios.js') }}"></script>
<script>
  initDT_users('usuarios');
</script>

@endpush
    