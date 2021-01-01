<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      @if(Auth::guard('admin')->user() != Null)
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/default.gif" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info text-capitalize">

            <p>{{ Auth::guard('admin')->user()->full_name }}</p> 
            <a href="#"><i class="fa fa-circle text-success"></i> Administrateur</a>

          </div>
        </div>
      @elseif(Auth::guard('web')->user() != Null)
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/default.gif" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info text-capitalize">
          <p>{{ Auth::guard('web')->user()->full_name }}</p> 
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
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>gestion Des Classes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"> 
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CI A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CI B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CP</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CP A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CP B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CE1</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CE1 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CE1 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CE2</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CE2 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CE2 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CM1</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CM1 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CM1 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CM2</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CM2 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CM2 B</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="active">
          <a href="{{ route('admin.users.index') }}">
            <i class="fa fa-th"></i> <span>Utilisateurs</span>
          </a>
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 


