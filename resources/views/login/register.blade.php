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
        {!! Form::open(["id"=>"form_register","autocomplete"=>"off", "action"=> 'UserController@postCreate']) !!}
        <!--<form method="post" role="form" autocomplete="off">-->
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <select name="id_tipo_usuario" class="form-control empty" id="id_tipo_usuario">
              <option disabled selected value></option>
              <option value="1">TRÁFICO MARÍTIMO</option>
              <option value="2">AGENTE NAVIERO</option>
            </select>
            {!! Form::label("id_tipo_usuario","Tipo de usuario",["class"=>"floating-label"]) !!}
            <!---<label class="floating-label" for="tipo_usuario">Tipo de usuario</label>-->              
          </div>

          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-usuario-error">
            {!! Form::text("usuario",null,["class"=>"form-control empty required","id"=>"usuario", "required"]) !!}
            {!! Form::label("usuario","Nombre de usuario",["class"=>"floating-label"]) !!}
            <span id="usuario-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-email-error">
            <input type="email" class="form-control empty required" id="inputEmail" name="email">
            <label class="floating-label" for="inputEmail">E-mail</label>
            <span id="email-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial" id="form-password-error">
            <input type="password" class="form-control empty" id="inputPassword" name="password">
            <label class="floating-label" for="inputPassword">Contraseña</label>
            <span id=password-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="password" class="form-control empty" id="inputPasswordCheck" name="passwordCheck">
            <label class="floating-label" for="inputPasswordCheck">Repita su contraseña</label>
            <span id="repeat-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("nombre",null,["class"=>"form-control empty required","id"=>"nombre", "required"]) !!}
            {!! Form::label("nombre","Nombre Completo",["class"=>"floating-label"]) !!}
            <span id="nombre-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("nombrecorto",null,["class"=>"form-control empty required","id"=>"nombrecorto", "required"]) !!}
            {!! Form::label("nombrecorto","Nombre corto",["class"=>"floating-label"]) !!}
            <span id="nombrecorto-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("empresa",null,["class"=>"form-control empty required","id"=>"empresa", "required"]) !!}
            {!! Form::label("empresa","Empresa o razón social",["class"=>"floating-label"]) !!}
            <span id="empresa-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("domicilio",null,["class"=>"form-control empty required","id"=>"domicilio", "required"]) !!}
            {!! Form::label("domicilio","Domicilio fiscal",["class"=>"floating-label"]) !!}
            <span id="domicilio-error" class="help-block"></span>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            {!! Form::text("rfc",null,["class"=>"form-control empty required","id"=>"rfc", "required"]) !!}
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