<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      @if(Auth::guard('admin')->user() != Null)
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset('dist/img/default.gif') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info text-capitalize">

            <p>{{ auth()->user()->full_name }}</p> 
            <a href="#"><i class="fa fa-circle text-success"></i> Administrateur</a>

          </div>
        </div>
      @elseif(Auth::guard('web')->user() != Null)
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/default.gif') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info text-capitalize">
          <p>{{ auth()->user()->full_name }}</p> 
          <a href="#"><i class="fa fa-circle text-success"></i> Enseignant</a>
        </div>
      </div>
    @endif
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Tableau de bord</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>gestion Des Classes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach (all_niveaux() as $niveau)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>{{ $niveau->libele }}</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @foreach ($niveau->classes as $classe)
                  <li><a href="{{ route('admin.classes.show', $classe) }}"><i class="fa fa-circle-o"></i> {{ $classe->libele }}</a></li>
                @endforeach
              </ul>
            </li>
            @endforeach
          </ul>
        </li>

        <li class="">
          <a href="{{ route('admin.enseignants.index') }}">
            <i class="fa fa-users"></i> <span>Enseignants</span>
          </a>
        </li>

        @if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->is_admin)
        <li class="">
          <a href="{{ route('admin.users.index') }}">
            <i class="fa fa-users"></i> <span>Personnel</span>
          </a>
        </li>
        @endif
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 


