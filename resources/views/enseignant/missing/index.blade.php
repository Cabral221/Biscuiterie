
@extends('layouts.app', ['titlePage' => 'Gestion d\'absence'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des absences
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> Tableu de bord</a></li>
        <li class="active"><i class="fa fa-dashboard"></i> Gestion des absences</li>
    </ol>
</section>

<section class="content">
    
    <!-- Default box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{$master->classe->libele}} : {{ $master->classe->students->count() }} éléve(s)</h3>
            <p>
                <span class="badge badge-primary">
                    {{ $master->classe->students()->whereKind(true)->count() }} Garçon(s)
                </span>
                <span class="badge badge-pink">
                    {{ $master->classe->students()->whereKind(false)->count() }} Fille(s)
                </span>
            </p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
    </div>
    <!-- /.box -->
    
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Liste des éléves de de la classe</h3>
            
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
            @if ($missing == null)
                <div class="text-center">
                    <p class="text-warning">La liste d'absence du jour <span>{{ Carbon\Carbon::now() }}</span> n'est pas encore générée</p>
                    <a href="{{ route('master.missings.create') }}" class="btn btn-md btn-success">
                        <i class="fa fa-plus"></i> Générer la liste du jour
                    </a>
                </div>
            @else
                <div class="text-center"><h3>Date : {{ $missing->created_at }} </h3></div>
                <table class="table table-bordered table-striped" id="missing-table">
                    <thead>
                        <tr>
                            <td>Absent(e)</td>
                            <td>Nom</td>
                            <td>Prénom</td>
                            <td>Date de Naissance</td>
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
                                            class="toggle-missing-checkbox" 
                                            value="1" 
                                            data-missingid="{{ $missinglist->id }}"
                                            @if ($missinglist->missing)
                                                checked
                                            @endif
                                            >
                                    </div>
                                    {{-- End Checkbox to toggle --}}
                                </td>
                                <td>{{ $missinglist->student->last_name }}</td>
                                <td>{{ $missinglist->student->first_name }}</td>
                                <td>{{ $missinglist->student->birthday }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
        $('#missing').DataTable({
            "paginate": false,
            // "scrollX": true,
            // "scrollY": 600,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endsection
