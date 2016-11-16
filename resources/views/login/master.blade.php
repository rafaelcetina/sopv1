<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <title>@yield('title') | SOP</title>
  <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico')}}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-extend.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/site.min.css')}}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/animsition/animsition.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/asscrollable/asScrollable.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/switchery/switchery.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/intro-js/introjs.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/slidepanel/slidePanel.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/flag-icon-css/flag-icon.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/waves/waves.css')}}">
  
  @yield('style')
  <!--<link rel="stylesheet" href="{{ asset('assets/css/login-v2.css')}}">-->
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
</head>

@yield('content')

<!-- End Page -->
@extends('layout.scripts')
