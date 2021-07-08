
<!-- sidebar menu: : style can be found in sidebar.less -->
<li class="header">Tableau de bord</li>
<li class="{{ activeClass(Route::is('admin.students.index')) }}">
    <a href="{{ route('admin.students.index') }}" class="text-sucess">
        <i class="fa fa-plus"></i> <span>Ajouter un éléve</span>
    </a>
</li>
<li class="header">Niveau</li>
@foreach (all_niveaux() as $niveau)
<li class="treeview {{ activeMenuClasseOpen($niveau->id) }}">
    
    <a href="#">
        <i class="fa fa-th"></i>
        <span>{{ $niveau->libele }}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        @foreach ($niveau->classes as $classe)
        <li class="itemMenuList  
            @if(url()->current() == route('admin.classes.show', $classe->id) 
            || strpos(url()->current(), "admin/classes/$classe->id/missing")) 
                active 
            @endif">
            <a href="{{ route('admin.classes.show', $classe) }}"><i class="fa fa-circle-o"></i> {{ $classe->libele }}</a>
        </li>
        @endforeach
    </ul>
</li>
@endforeach

<li class="header">Systéme</li>
<li class="{{ activeClass(Route::is('admin.programs.index')) }}">
    <a href="{{ route('admin.programs.index') }}">
        <i class="fa fa-users"></i> <span>Programmes</span>
    </a>
</li>
<li class="{{ activeClass(Route::is('admin.domains.index')) }}">
    <a href="{{ route('admin.domains.index') }}">
        <i class="fa fa-users"></i> <span>Domaines</span>
    </a>
</li>
<li class="{{ activeClass(Route::is('admin.histories.index')) }}">
    <a href="{{ route('admin.histories.index') }}">
        <i class="fa fa-database"></i> <span>Historique</span>
    </a>
</li>

<li class="header">Utilisateurs</li>
<li class="{{ activeClass(Route::is('admin.enseignants.index')) }}">
    <a href="{{ route('admin.enseignants.index') }}">
        <i class="fa fa-users"></i> <span>Enseignants</span>
    </a>
</li>
@if (Auth::guard('admin')->user()->is_admin)
<li class="{{ activeClass(Route::is('admin.users.index')) }}">
    <a href="{{ route('admin.users.index') }}">
        <i class="fa fa-users"></i> <span>Administrateurs</span>
    </a>
</li>
@endif
