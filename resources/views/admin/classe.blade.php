@extends('layouts.app', ['titlePage' => $classe->libele])

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
        <li class="active">{{ $classe->libele }}</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="d-flex justify-content-between">
                <span>
                    <h3 class="box-title"><span class="text-primary">{{ $classe->libele }} :  {{ $classe->total }}</span>  éléve(s)</h3>
                </span>
                <span>
                    <h3 class="box-title">Enseignant(e) : <span class="text-primary">{{ $classe->user->full_name }}</span></h3>
                </span>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
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
                        <td>{{ $student->birthday->locale('fr')->format('d M Y')  . ' à ' . $student->where_birthday }}</td>
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
                                                    <h1>{{ $student->fullName }}</h1>
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
                                
                                {{-- Editing data for student --}}
                                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-xs btn-warning" aria-label="Modifier"><i class="fa fa-edit"></i></a>
                                {{-- Delete student --}}
                                <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault();if(confirm('Êtes vous sûr de vouloir supprimer cet (cette) éléve ?')){document.getElementById('form-delete-student-{{$student->id}}').submit();}">
                                    <i class="fa fa-trash"></i>
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="post" id="form-delete-student-{{$student->id}}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </a>
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
    </section>
    @endsection
    
    @section('plugin-js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    @endsection
    
    @section('js')
    <script>
        $(function () {
            $('#example1').DataTable()
        })
    </script>
    @endsection