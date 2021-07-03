
<!-- sidebar menu: : style can be found in sidebar.less -->
<li class="header">Gestion</li>
<li class="{{ activeClass(Route::is('master.notes.index')) }}">
    <a href="{{ route('master.notes.index') }}">
        <i class="fa fa-th"></i> <span>Notes</span>
    </a>
</li>
<li class="treeview {{ activeMenuOpen('master/missing') }}">
    
    <a href="#">
        <i class="fa fa-th"></i>
        <span>Gestion d'absence</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="itemMenuList  {{ activeClass(Route::is('master.missings.index')) }}">
            <a href="{{ route('master.missings.index') }}"><i class="fa fa-circle-o"></i> Liste du jour</a>
        </li>
        <li class="itemMenuList  {{ activeClass(Route::is('master.missings.list')) }}">
            <a href="{{ route('master.missings.list') }}"><i class="fa fa-circle-o"></i> Toutes les listes</a>
        </li>
    </ul>
</li>