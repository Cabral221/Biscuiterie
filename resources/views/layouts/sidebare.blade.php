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
        <li class="active treeview">
      
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Page 1</a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Page 2</a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Page 3</a></li>

        </li>
   
    
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
                <span>C-I</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> C-I A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> C-I B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>C-P</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> C-P A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> C-P B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>C-1</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> C-1 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> C-1 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>C-2</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> C-2 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> C-2 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CM 1</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CM 1 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CM 1 B</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>CM 2</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> CM 2 A</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> CM 2 B</a></li>
              </ul>
            </li>
          </ul>
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 


