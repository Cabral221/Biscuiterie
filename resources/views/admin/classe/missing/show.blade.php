@extends('layouts.app', ['titlePage' => $classe->libele . ' | Gestion d\'absence'])

@section('plugin-css')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Gestion des absences
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> Tableu de bord</a></li>
        <li><a href="{{ route('admin.classes.show', [$classe]) }}"><i class="fa fa-dashboard"></i> {{ $classe->libele }}</a></li>
        <li><a href="{{ route('admin.classes.missings.index', [$classe]) }}"><i class="fa fa-dashboard"></i> Gestion des absences</a></li>
        <li class="active">{{ $missing->created_at }}</li>
    </ol>
</section>

<section class="content">
    
    
    
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Feuille d'absence</h3>
            
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
            
            <div class="text-center"><h3>Liste d'absence : <span class="bg-primary p-2">{{ $missing->created_at }}</span> </h3></div>
            <table class="table table-bordered table-striped" id="missing-day" data-order='[[ 3, "asc" ]]' data-page-length='50'>
                <thead>
                    <tr>
                        <th>Marquer</th>
                        <th>Absent(e)</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de Naissance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missing->missinglists as $missinglist)
                    <tr>

                        <td>
                            {{-- Checkbox to toggle --}}
                            <div>
                                <input 
                                    type="checkbox" 
                                    name="toggle-missing" 
                                    class="toggle-missing-checkbox-admin" 
                                    value="1" 
                                    data-missingid="{{ $missinglist->id }}"
                                    data-classeid="{{ $classe->id }}"
                                    @if ($missinglist->missing)
                                        checked
                                    @endif
                                    >
                            </div>
                            {{-- End Checkbox to toggle --}}
                        </td>
                        <td>
                            {{-- Checkbox to toggle --}}
                            @if ($missinglist->missing)
                            <span class="badge badge-danger">Absent</span>
                            @else
                            <span class="badge badge-success"><i class="fa fa-check"></i></span>
                            @endif
                            {{-- End Checkbox to toggle --}}
                        </td>
                        <td>{{ $missinglist->student->first_name }}</td>
                        <td>{{ $missinglist->student->last_name }}</td>
                        <td>{{ $missinglist->student->birthday }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Marquer</th>
                        <th>Absent(e)</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de Naissance</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Liste des feuilles d'absences</h3>
            
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
            <table class="table table-bordered table-striped" id="missing-recent">
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>nombre d'Absent</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missings as $missingrec)
                    <tr>
                        <td><a href="{{ route('admin.classes.missings.list', [$classe, $missingrec]) }}">{{ $missingrec->created_at }}</a></td>
                        <td><span class="title bg-primary p-3">{{ $missingrec->missing_count }}</span></td>
                        <td>
                            <a href="{{ route('admin.classes.missings.list', [$classe, $missingrec]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                            
                            <a href="#" 
                                class="btn btn-xs btn-danger"
                                onclick="event.preventDefault();
                                    if(confirm('Êtes-vous sûr de vouloir supprimer cette liste ?'))
                                    {
                                        document.getElementById('form-delete-missing-{{$missingrec->id}}').submit();
                                    }"><i class="fa fa-trash"></i> </a>
                            <form action="{{ route('admin.classes.missings.delete', [$classe]) }}"
                                method="POST"
                                id="form-delete-missing-{{$missingrec->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                                <input type="number" name="list_id" value="{{$missingrec->id}}" id="list_id_{{$missingrec->id}}" class="d-none">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
        $('#missing-recent').DataTable({
            responsive: true,
            ordering: false,
        });
    });

    $(document).ready(function () {
        $('#missing-day').DataTable({
            responsive: true,
        });
    });
</script>
@endsection
