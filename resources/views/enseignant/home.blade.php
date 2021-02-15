
@extends('layouts.app', ['titlePage' => $user->full_name])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

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
            {{-- @foreach ($niveau->classes as $c) --}}
            <p>10 garçon(s)</p>
            <p>10 fille(s)</p>
            {{-- @endforeach --}}
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
    </div>
    <!-- /.box -->

     <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">liste de la classe</h3>
            
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date et lieu de naissance</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->classe->students as $student)
                        <tr>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->birthday->locale('fr')->format('d M Y')  . ' à ' . $student->where_birthday }}</td>
                            <td>{{ $student->address}}</td>
                            <td>
                                {{-- show details in modal for student --}}
                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-student-show-{{$student->id}}"><i class="fa fa-eye"></i></button>

                                <div class="modal modal-xl fade" id="modal-student-show-{{$student->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Détails de l'éléve</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="text-primary">
                                                    <h1>{{ $student->first_name . ' ' . $student->last_name }}</h1>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Date de naissance</th>
                                                            <td><span class="text-bold text-primary">{{ $student->birthday->locale('fr')->format('d M Y') }}</span></td>
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
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h3>Filiation de la mère</h3>
                                                        <div>Prénom : <span class="text-bold text-primary">{{ $student->mother_first_name }}</span></div>
                                                        <div>Nom : <span class="text-bold text-primary">{{ $student->mother_last_name }}</span></div>
                                                        <div>Téléphone : <span class="text-bold text-primary">{{ $student->mother_phone }}</span></div>
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
                                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-xs btn-warning" aria-label="Modifier"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date et lieu de naissance</th>
                        <th>Adresse</th>
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
<script>
    $(function () {
        $('#example1').DataTable({
            "paginate": false,
        })
    })
</script>
@endsection
