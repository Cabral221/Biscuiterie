@extends('layouts.app', ['titlePage' => $user->full_name])

@section('content')
<section class="content-header">
    <h1>
        Tableau de bord
        <small>Géstion de la classe </small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Tableu de bord</li>
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
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="d-flex justify-content-between">
                <span>
                    <h3 class="box-title">Liste de la classe</h3>
                </span>
                <span>
                    <a href="{{ route('master.print.classe', $user->classe->id) }}" target="_blank" class="btn btn-info">Imprimer</a>
                </span>
            </div>
        </div>
        <div class="box-body">
            <table id="example" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th>Date et lieu de naissance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->classe->students as $student)
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
                        <td>{{ $student->birthday  . ' à ' . $student->where_birthday }}</td>
                        <td>
                            {{-- show details in modal for student --}}
                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-student-show-{{$student->id}}"><i class="fa fa-eye"></i></button>
                            
                            <div class="modal modal-xl fade" id="modal-student-show-{{$student->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Détails de l'éléve</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="text-primary">
                                                <h1>{{ $student->first_name . ' ' . $student->last_name }}</h1>
                                            </div>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Genre</th>
                                                        <td>
                                                            @if ($student->kind)
                                                            <span class="badge badge-primary">Masculin</span>
                                                            @else
                                                            <span class="badge badge-pink">Féminin</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date de naissance</th>
                                                        <td><span class="text-bold text-primary">{{ $student->birthday }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lieu de naissance</th>
                                                        <td><span class="text-bold text-primary">{{ $student->where_birthday }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Adresse</th>
                                                        <td><span class="text-bold text-primary">{!! $student->address !!}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>Filiation du père</h3>
                                                    <div>Prénom : <span class="text-bold text-primary">{{ $student->father_name }}</span></div>
                                                    <div>Téléphone : <span class="text-bold text-primary">{{ $student->father_phone }}</span></div>
                                                    <div>NIN : <span class="text-bold text-primary">{{ $student->father_nin }}</span></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>Filiation de la mère</h3>
                                                    <div>Prénom : <span class="text-bold text-primary">{{ $student->mother_first_name }}</span></div>
                                                    <div>Nom : <span class="text-bold text-primary">{{ $student->mother_last_name }}</span></div>
                                                    <div>NIN : <span class="text-bold text-primary">{{ $student->mother_nin }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                                {{-- Editing note for student --}}
                                {{-- <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-xs btn-warning" aria-label="Modifier"><i class="fa fa-edit"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th>Date et lieu de naissance</th>
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
    