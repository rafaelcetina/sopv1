<div class="page-header">
  <h1 class="page-title">Solicitud de Arribo/Atraque</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">Programación</a></li>
    <li class="breadcrumb-item active">Individual</li>
  </ol>
 <br>
</div>
<div class="page-content">
  <div class="panel">
    <div class="panel-body">
      <!-- CONTENT GOES HERE -->
    {!! Form::open(["id"=>"form","autocomplete"=>"off"]) !!}
    <!--<form method="post" role="form" autocomplete="off">-->
      @include("arribos._form")
    {!! Form::close() !!}
    </div>
  </div>
</div> 