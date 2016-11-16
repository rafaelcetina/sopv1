@extends('login.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/register-v2.css')}}">
@endsection

@section('title', 'Registro de usuario')

@section('content')

<body class="animsition page-register-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="{{ asset('assets/img/logo.png')}}" width="160px" alt="...">
          <h2 class="brand-text font-size-40">Sistema Operaciones Portuarias.</h2>
        </div>
        <!--<p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>-->
      </div>
      <div class="page-register-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="{{ asset('assets/img/logo-blue@2x.png')}}" alt="...">
          <h3 class="brand-text font-size-40">SOP</h3>
        </div>
        <h3 class="font-size-24">Registro de usuarios</h3>
        <p>Nota: La autorización de esta soliciitud será enviada<br> a su e-mail en las siguientes 12 horas, entonces <br>podrá acceder a este servicio.</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <!--<form method="post" role="form" autocomplete="off">-->
        <!--
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <select name="id_tipo_usuario" class="form-control" id="id_tipo_usuario">
              <option disabled selected value></option>
              <option value="1">TRÁFICO MARÍTIMO</option>
              <option value="2">AGENTE NAVIERO</option>
            </select>
            {!! Form::label("id_tipo_usuario","Tipo de usuario",["class"=>"floating-label select"]) !!}
          </div>
            -->              
          <!--
          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-id_tipo_usuario-error">
            {!! Form::text("id_tipo_usuario",null,["class"=>"form-control required","id"=>"id_tipo_usuario", "required"]) !!}
            {!! Form::label("id_tipo_usuario","Tipo de usuario",["class"=>"floating-label"]) !!}
            <span id="id_tipo_usuario-error" class="help-block"></span>
          </div>
          -->
          
          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-id_tipo_usuario-error">
            {!! Form::select('id_tipo_usuario', $types, $opcion, ["class"=> "form-control required"] ) !!}
            {!! Form::label("id_tipo_usuario","Tipo de usuario",["class"=>"floating-label"]) !!}
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-usuario-error">
            {!! Form::text("usuario",null,["class"=>"form-control required","id"=>"usuario", "required"]) !!}
            {!! Form::label("usuario","Nombre de usuario",["class"=>"floating-label"]) !!}
            <span id="usuario-error" class="help-block"></span>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  form-material floating" data-plugin="formMaterial" id="form-email-error">
            <input type="email" class="form-control required" id="email" name="email">
            <label class="floating-label" for="email">E-mail</label>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-material floating" data-plugin="formMaterial" id="form-password-error">
            <input type="password" class="form-control" id="password" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label class="floating-label" for="password">Contraseña</label>
          </div>

          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} form-material floating" data-plugin="formMaterial" id="form-password-error">
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
            <label class="floating-label" for="password">Repiite la Contraseña</label>
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("nombre",null,["class"=>"form-control required","id"=>"nombre", "required"]) !!}
            {!! Form::label("nombre","Nombre Completo",["class"=>"floating-label"]) !!}
            <span id="nombre-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("nombrecorto",null,["class"=>"form-control required","id"=>"nombrecorto", "required"]) !!}
            {!! Form::label("nombrecorto","Nombre corto",["class"=>"floating-label"]) !!}
            <span id="nombrecorto-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("empresa",null,["class"=>"form-control required","id"=>"empresa", "required"]) !!}
            {!! Form::label("empresa","Empresa o razón social",["class"=>"floating-label"]) !!}
            <span id="empresa-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("domicilio",null,["class"=>"form-control required","id"=>"domicilio", "required"]) !!}
            {!! Form::label("domicilio","Domicilio fiscal",["class"=>"floating-label"]) !!}
            <span id="domicilio-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("rfc",null,["class"=>"form-control required","id"=>"rfc", "required"]) !!}
            {!! Form::label("rfc","Registro federal del contribuyente (RFC)",["class"=>"floating-label"]) !!}
            <span id="rfc-error" class="help-block"></span>
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
              <input type="checkbox" id="inputCheckbox" name="term">
              <label for="inputCheckbox"></label>
            </div>
            <div class="loading"></div>
            <p class="m-l-35">~Validación~</p>
          </div>
          {!! Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Enviar",["type" => "submit","class"=>"btn
    btn-primary btn-block"])!!}
        {!! Form::close() !!}
        <p>Si ya se encuentra registrado, ir a <a href="login">Iniciar sesión</a></p>
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
@push('scripts')
<script>
  $(".form-control option[value='1']").remove();
</script>
@endpush