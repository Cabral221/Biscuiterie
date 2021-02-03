
<!-- sidebar menu: : style can be found in sidebar.less -->
<li class="header">niveau</li>
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

<li class="header">Utilisateurs</li>
<li class="">
    <a href="{{ route('admin.enseignants.index') }}">
        <i class="fa fa-users"></i> <span>Enseignants</span>
    </a>
</li>
<li class="">
    <a href="{{ route('admin.users.index') }}">
        <i class="fa fa-users"></i> <span>Administrateur</span>
    </a>
</li>
