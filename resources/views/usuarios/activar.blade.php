<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active in" id="sidebar-userlist">
    <div>
      <div>
        <h4 class="clearfix">Activación de Usuario
        </h4>
        {!! Form::model($usuario,["id"=>"form_add","autocomplete"=>"off"]) !!}
        
          @include("usuarios._activar")
        {!! Form::close() !!}
        
        
        <a class="btn btn-sm btn-primary waves-effect active btnCerrar" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat" data-url="usuarios/activar">
          <i class="icon md-close" aria-hidden="true"></i>Cerrar
        </a>

      </div>  
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/sop/add.js')}}" ></script>