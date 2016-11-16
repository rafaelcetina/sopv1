@extends('login.master')

@section('title', 'Inicio de sesión')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/login-v2.css')}}">
@endsection

@section('content')
<body class="animsition page-login-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="{{ asset('assets/img/logo.png')}}" width="160px" alt="...">
          <h2 class="brand-text font-size-40">Sistema de Operaciónes Portuarias.</h2>
        </div>
        <p class="font-size-20"></p>
      </div>
      <div class="page-login-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="{{ asset('assets/img/logo-blue@2x.png')}}" alt="...">
          <h3 class="brand-text font-size-20">Sistema de Operaciones Portuarias.</h3>
        </div>
        <h3 class="font-size-24">Iniciar sesión</h3>
        <p>Sistema de Operaciones Portuarias.</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

          <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }} form-material floating" data-plugin="formMaterial">

            {!! Form::text("usuario",null,["class"=>"form-control required","id"=>"usuario", "required"]) !!}
            @if ($errors->has('usuario'))
                <span class="help-block">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span>
            @endif
            <label class="floating-label" for="usuario">Usuario</label>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-material floating" data-plugin="formMaterial">
            
            {!! Form::password("password",["class"=>"form-control required","id"=>"password", "required"]) !!}

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <label class="floating-label" for="password">Contraseña</label>
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
              <input type="checkbox" id="remember" name="checkbox">
              <label for="inputCheckbox">Recúerdame</label>
            </div>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvide mi contraseña</a>
          </div>
          {!! Form::button("<i class='icon md-sign-in'></i> Iniciar",["type" => "submit","class"=>"btn btn-primary btn-block"])!!}
        {!! Form::close() !!}
        <p>Registrar <a href="register">nuevo usuario</a></p>
        <footer class="page-copyright">
          <p>APIQROO© <?=date('Y');?>. TODOS LOS DERECHOS RESERVADOS.</p>
          <div class="social">
            <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
          </div>
        </footer>
      </div>
    </div>
  </div>
@endsection
