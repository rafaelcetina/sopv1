<div class="site-menubar site-menubar-dark">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-category">General</li>
            <li class="site-menu-item">
              <a class="animsition-link" href="{{ URL::to('home/') }}">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">DASHBOARD</span>
              </a>
            </li>
            
            
            <!-- ELEMENTOS SOLO DISPONIBLES PARA ADMINISTRADOR -->
            @if (Auth::user()->id_tipo_usuario  == 1)
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">CATÁLOGOS</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/buques') }}">
                    <span class="site-menu-title">BUQUES</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/muelles') }}">
                    <span class="site-menu-title">MUELLES</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/tcargas') }}">
                    <span class="site-menu-title">TIPO DE CARGAS</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/tproductos') }}">
                    <span class="site-menu-title">TIPO DE PRODUCTOS</span>
                  </a>
                </li>

              </ul>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="{{ URL::to('/usuarios') }}">
                <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                <span class="site-menu-title">USUARIOS</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="{{ URL::to('/home/panel') }}">
                <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                <span class="site-menu-title">VISTA 2 - PANEL</span>
              </a>
            </li>
            @endif
            <!-- FIN DE SECCION PARA ADMINSITRADOR -->

            <!-- ELEMENTOS SOLO DISPONIBLES PARA AGENCIA NAVIERA -->
            @if (Auth::user()->id_tipo_usuario  == 2)
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-assignment" aria-hidden="true"></i>
                <span class="site-menu-title">PROGRAMACIÓN</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('arribos/nuevo') }}">
                    <span class="site-menu-title">INDIVIDUAL</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/programar') }}">
                    <span class="site-menu-title">CALENDARIZADO</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-storage" aria-hidden="true"></i>
                <span class="site-menu-title">MOVIMIENTOS</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('arribos/solicitudes') }}">
                    <span class="site-menu-title">SOLICITUDES</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/muelles') }}">
                    <span class="site-menu-title">PROGRAMADOS</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/muelles') }}">
                    <span class="site-menu-title">CANCELADOS</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/muelles') }}">
                    <span class="site-menu-title">HISTORICO</span>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <!-- FIN DE SECCION PARA AGENCIA NAVIERA -->

            <!-- ELEMENTOS SOLO DISPONIBLES PARA AGENTE TRAFICO -->
            @if (Auth::user()->id_tipo_usuario  == 3)
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-assignment" aria-hidden="true"></i>
                <span class="site-menu-title">ARRIBOS / ATRAQUES</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('control_arribos/solicitudes') }}">
                    <span class="site-menu-title">SOLICITUDES</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="{{ URL::to('catalogos/programar') }}">
                    <span class="site-menu-title">CALENDARIZADO</span>
                  </a>
                </li>
              </ul>
            </li>
            
            @endif
            <!-- FIN DE SECCION PARA AGENCIA NAVIERA -->

        </div>
      </div>
    </div>
    <div class="site-menubar-footer">
      <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="Settings">
        <span class="icon md-settings" aria-hidden="true"></span>
      </a>
      <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
        <span class="icon md-eye-off" aria-hidden="true"></span>
      </a>
      <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
        <span class="icon md-power" aria-hidden="true"></span>
      </a>
    </div>
  </div>
  <div class="site-gridmenu">
    <div>
      <div>
      <!--
        <ul>
          <li>
            <a href="../apps/mailbox/mailbox.html">
              <i class="icon md-email"></i>
              <span>Mailbox</span>
            </a>
          </li>
          <li>
            <a href="../apps/calendar/calendar.html">
              <i class="icon md-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="../apps/contacts/contacts.html">
              <i class="icon md-account"></i>
              <span>Contacts</span>
            </a>
          </li>
          <li>
            <a href="../apps/media/overview.html">
              <i class="icon md-videocam"></i>
              <span>Media</span>
            </a>
          </li>
          <li>
            <a href="../apps/documents/categories.html">
              <i class="icon md-receipt"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a href="../apps/projects/projects.html">
              <i class="icon md-image"></i>
              <span>Project</span>
            </a>
          </li>
          <li>
            <a href="../apps/forum/forum.html">
              <i class="icon md-comments"></i>
              <span>Forum</span>
            </a>
          </li>
          <li>
            <a href="../index.html">
              <i class="icon md-view-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
        -->
        <p>Menu en desarrollo</p>
      </div>
    </div>
  </div>