<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title') | SOP</title>
  <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico')}}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-extend.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/site.css')}}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/animsition/animsition.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/asscrollable/asScrollable.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/alertify/alertify.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/switchery/switchery.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/intro-js/introjs.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/slidepanel/slidePanel.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-maxlength/bootstrap-maxlength.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/jt-timepicker/jquery-timepicker.css')}}">
  
  <link rel="stylesheet" href="{{ asset('assets/vendor/alertify/alertify.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/notie/notie.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/flag-icon-css/flag-icon.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/waves/waves.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-bootstrap/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-fixedheader/dataTables.fixedHeader.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-responsive/dataTables.responsive.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/datatable.css')}}">
  <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">-->
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/font-awesome.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/css/login-v2.css')}}">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/material-design/material-design.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/brand-icons/brand-icons.min.css')}}">
  <!--<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>-->
  <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="{{ asset('assets/vendor/breakpoints/breakpoints.js')}}"></script>
  <script>
  Breakpoints();
  </script>
  <style>
  .loading {
        background: lightgoldenrodyellow url('{{asset('assets/img/processing.gif')}}') no-repeat center 65%;
        height: 80px;
        width: 100px;
        position: fixed;
        border-radius: 4px;
        left: 50%;
        top: 50%;
        margin: -40px 0 0 -50px;
        z-index: 2000;
        display: none;
    }
    .dataTable thead, tfoot{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#606c88+0,3f4c6b+100;Grey+3D+%232 */
background: rgb(96,108,136); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(96,108,136,1) 0%, rgba(63,76,107,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(96,108,136,1) 0%,rgba(63,76,107,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(96,108,136,1) 0%,rgba(63,76,107,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#606c88', endColorstr='#3f4c6b',GradientType=0 ); /* IE6-9 */


  color: #ffffff !important;
  font-weight: 600;
  font-size: 1.1em;

    }
    .dataTable thead th, tfoot th{
      
      color: #ffffff !important;
    }
    .sorting_disabled{
      width: 100px !important;
    }
    .dataTable tbody tr:nth-child(even) {
      background: #D7E7F4;
    }
    .dataTable tbody tr:nth-child(odd) {
      background: #ebf1f6;
    }
  </style>
  @stack('estilos')
</head>

@include('layout.nav')
@include('layout.menu')

@yield('content')

@include('layout.footer')
<!-- End Page -->
@include('layout.scripts')
