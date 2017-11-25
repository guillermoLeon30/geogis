<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>

        @can('ver-menu-items', new App\Models\Menus())
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-th-list"></i> <span>Items</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              @can('view', new App\Models\Equipo())
                <li><a href="{{ url('equipos') }}"><i class="fa fa-wrench"></i> Equipos</a></li>
              @endcan

              @can('view', new App\Models\Material())
                <li><a href="{{ url('materiales') }}"><i class="fa fa-industry"></i> Materiales</a></li>
              @endcan

              @can('view', new App\Models\ManoDeObra())
                <li><a href="{{ url('mano_de_obra') }}"><i class="fa fa-hand-stop-o"></i> Mano de Obra</a></li>
              @endcan
              
              @can('view', new App\Models\Transporte())
                <li><a href="{{ url('transportes') }}"><i class="fa fa-truck"></i> Transporte</a></li> 
              @endcan
            </ul>
          </li>
        @endcan
        
        @can('view', App\Models\BibliotecaApus::class)
          <li class="treeview">
            <a href="{{ url('biblioteca_apus') }}">
                <i class="fa fa-file-text-o"></i> <span>APUS</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          </li>
        @endcan

        <li class="treeview">
          <a href="{{ url('proyecto') }}">
              <i class="fa fa-book"></i> <span>PROYECTOS</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        </li>
        
        @can('VerMenuDescargar', App\Models\Menus::class)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-download"></i> <span>Descargar</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              @can('descargar', App\Models\Equipo::class)
                <li><a href="{{ url('equipos/excel') }}"><i class="fa fa-wrench"></i> Equipos</a></li>
              @endcan

              @can('descargar', App\Models\Material::class)
                <li><a href="{{ url('materiales/excel') }}"><i class="fa fa-industry"></i> Materiales</a></li>
              @endcan
              
              @can('descargar', App\Models\ManoDeObra::class)
                <li><a href="{{ url('mano_de_obra/excel') }}"><i class="fa fa-hand-stop-o"></i> Mano de Obra</a></li>
              @endcan

              @can('descargar', App\Models\Transporte::class)
                <li><a href="{{ url('transportes/excel') }}"><i class="fa fa-truck"></i> Transporte</a></li> 
              @endcan
            </ul>
          </li>
        @endcan

        @can('VerMenuUsuarios', new App\Models\Menus())
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
              @can('view', new App\User())
                <li><a href="{{ url('usuarios') }}"><i class="fa fa-book"></i> Lista de Usuarios</a></li>
              @endcan
              
              @can('view', new App\Models\Rol())
                <li><a href="{{ url('roles') }}"><i class="fa fa-book"></i> Roles</a></li>
              @endcan
            </ul>
          </li>
        @endcan
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>