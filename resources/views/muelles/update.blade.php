<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active in" id="sidebar-userlist">
    <div>
      <div>
        <h4 class="clearfix">Formulario de actualización de Muelles
          <div class="pull-xs-right">
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-plus" aria-hidden="true"></i>
            </a>
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon md-more" aria-hidden="true"></i>
            </a>
          </div>
        </h4>
        {!! Form::model($muelle,["id"=>"form_add","autocomplete"=>"off"]) !!}
        <!--<form method="post" role="form" autocomplete="off">-->
          @include("muelles._form")
        {!! Form::close() !!}
        
        <hr>
        <a class="btn btn-sm btn-primary waves-effect active btnCerrar" data-toggle="site-sidebar" href="javascript:void(0)" title="Cerrar">
          <i class="icon md-close" aria-hidden="true"></i>Cerrar
        </a>

      </div>  
    </div>
  </div>
<script src="{{ asset('assets/js/sop/add.js')}}" ></script>