@extends('layouts.app', ['titlePage' => $classe->libele . ' | Gestion des notes'])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        {{ $classe->libele }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.classes.show', $classe) }}"><i class="fa fa-dashboard"></i> {{ $classe->libele }}</a></li>
        <li class="active">Notes</li>
    </ol>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Liste des moyennes de chaque éléve</h3>
            
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <table id="note-list-table" class="table table-hover" data-page-length='100'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th class="text-center">Moy <br> 1ére Composition</th>
                        <th class="text-center">Moy <br> 2ème Composition</th>
                        <th class="text-center">Moy <br> 3ème Composition</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classe->students as $student)
                    <tr>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>
                            @if ($student->kind)
                            <span class="badge badge-primary">Masculin</span>
                            @else
                            <span class="badge badge-pink">Féminin</span>
                            @endif
                        </td>
                        @foreach ($student->moy() as $moy)
                        <td class="text-center text-bold">{{ $moy }}</td>
                        @endforeach
                        <td>
                            {{-- Gérer --}}
                            <a href="{{ route('admin.classes.notes.show', [$classe, $student]) }}" class="btn btn-xs btn-warning" title="Modifier" aria-label="Modifier"><i class="fa fa-edit"></i> Bulletin</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th class="text-center">Moy <br> 1ére Composition</th>
                        <th class="text-center">Moy <br> 2ème Composition</th>
                        <th class="text-center">Moy <br> 3ème Composition</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
@endsection

@section('plugin-js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('js')
<script defer>
    $(document).ready(function () {
        $('#note-list-table').DataTable({
            responsive: true,
            // ordering: false,
        });
    });
</script>
@endsection
