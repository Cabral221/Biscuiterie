
@extends('layouts.app', ['titlePage' => 'Notes des éléves'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des notes
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> Tableu de bord</a></li>
        <li class="active"><i class="fa fa-dashboard"></i> Notes</li>
    </ol>
</section>

<section class="content">
    
    <!-- Default box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{$user->classe->libele}} : {{ $user->classe->students->count() }} éléve(s)</h3>
            <p>
                <span class="badge badge-primary">
                    {{ $user->classe->students()->whereKind(true)->count() }} Garçon(s)
                </span>
                <span class="badge badge-pink">
                    {{ $user->classe->students()->whereKind(false)->count() }} Fille(s)
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
            <table id="example" class="table table-hover" width="100%">
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
                            <a href="{{ route('master.notes.show', $student) }}" class="btn btn-xs btn-warning" title="Modifier" aria-label="Modifier"><i class="fa fa-edit"></i> Gérer</a>
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
        $('#example').DataTable({
            "paginate": false,
            "scrollX": true,
            "scrollY": 600,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endsection
