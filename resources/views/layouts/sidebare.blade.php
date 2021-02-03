<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/default.gif') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info text-capitalize">
                <p>{{ auth()->user()->full_name }}</p> 
                @if(Auth::guard('admin')->user() != Null)
                <i class="fa fa-circle text-success"></i> Administrateur
                @elseif(Auth::guard('web')->user() != Null)
                <i class="fa fa-circle text-success"></i> Enseignant
                @endif
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @if (Auth::guard('admin')->user() != null)
                @include('layouts.includes.sidebarAdmin')
            @elseif(Auth::guard('web')->user() != null)
                @include('layouts.includes.sidebarMaster')
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
