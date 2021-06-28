@extends('layouts.app', ['titlePage' => 'Gestion des utilisateurs'])

@section('content')
<section class="content-header">
    <h1>
        Gestion du personnel
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Personnel</li>
    </ol>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Liste des administrateurs</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div style="margin-bottom: 2rem;">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Ajouter un administrateur</a>
            </div>

            <table id="example" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>statut</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->full_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>
                                @if ($admin->is_active)
                                <span class="label label-success">Actif</span>
                                @else
                                <span class="label label-danger">Désactivé</span>
                                @endif
                            </td>
                            <td>
                                @if ($admin->is_admin)
                                <span class="label label-success">Super Admin</span>
                                @else
                                <span class="label label-primary">Limité</span>
                                @endif
                            </td>
                            <td>
                                {{-- Togle active account --}}
                                @if ($admin->is_active)
                                    <a href="{{ route('admin.users.toggleActive', $admin) }}" title="Activer / Desactiver" class="btn btn-xs btn-primary" onclick="if(!confirm('Êtes vous sûr de vouloir désactiver ce compte ?')){event.preventDefault();}">
                                        <i class="fa fa-toggle-on"></i>
                                    </a>
                                @else
                                    <a href="{{ route('admin.users.toggleActive', $admin) }}" title="Activer / Desactiver" class="btn btn-xs btn-primary" onclick="if(!confirm('Êtes vous sûr de vouloir activer ce compte ?')){event.preventDefault();}">
                                        <i class="fa fa-toggle-off"></i>
                                    </a>
                                @endif
                                {{-- Editing data for account --}}
                                <a href="{{ route('admin.users.edit', $admin) }}" class="btn btn-xs btn-warning" aria-label="Modifier" title="Modifier"><i class="fa fa-edit"></i></a>
                                
                                {{-- Delete Admin --}}
                                @if ($admin->id !== Auth::user()->id)
                                    <a href="#" class="btn btn-xs btn-danger" title="Supprimer" onclick="event.preventDefault();if(confirm('Êtes vous sûr de vouloir supprimer cette administrateur ?')){document.getElementById('form-delete-admin-{{$admin->id}}').submit();}">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('admin.users.destroy', $admin) }}" method="post" id="form-delete-admin-{{$admin->id}}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>    
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>statut</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection

@section('plugin-js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('js')
<script defer>
    $(document).ready(function () {
        $('#example').DataTable({
            "paginate": false,
            "scrollX": true,
            "scrollY": 600,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endsection
