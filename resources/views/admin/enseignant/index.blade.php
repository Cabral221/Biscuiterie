@extends('layouts.app', ['titlePage' => 'Gestion des Enseignants'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des enseignants
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Gestion des enseignants</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="d-flex justify-content-between">
                <span>
                    <h3 class="box-title">Liste des enseignants</h3>
                </span>
                <span>
                    <a href="{{ route('admin.print.master') }}" target="_blank" class="btn btn-info">Imprimer</a>
                </span>
            </div>
        </div>
        <div class="box-body">
            <div class="p-2 mb-2"><a href="{{ route('admin.enseignants.create') }}" class="btn btn-success">Ajouter un(e) enseignant(e)</a></div>
            <table id="example" class="table table-bordered table-striped" width="100%">
                <thead>
                    <th>Classe</th>
                    <th>Nom Complet</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($enseignants as $enseignant)
                    <tr>
                        <td>
                            @if ($enseignant->classe != null)
                                <a href="{{ route('admin.classes.show', $enseignant->classe) }}">
                                    <span class="label label-primary">{{ $enseignant->classe->libele }}</span>
                                </a>
                            @else
                                <span class="label label-primary">NÉANT</span>                                
                            @endif
                        </td>
                        <td>{{ $enseignant->full_name }}</td>
                        <td>{{ $enseignant->phone }}</td>
                        <td>{{ $enseignant->email }}</td>
                        <td>
                            {{-- show details in modal for enseignant --}}
                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-enseignant-show-{{$enseignant->id}}"><i class="fa fa-eye"></i></button>
                            <div class="modal modal-xl fade" id="modal-enseignant-show-{{$enseignant->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Détails de Mr (Mme)</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-primary">
                                                <h1> {{ $enseignant->full_name }}</h1>
                                            </div>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Adresse Email</th>
                                                        <td><span class="text-bold text-primary">{{ $enseignant->email }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Numéro de téléphone</th>
                                                        <td><span class="text-bold text-primary">{{ $enseignant->phone }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Classe</th>
                                                        <td>
                                                            @if ($enseignant->classe != null)
                                                                <a href="{{ route('admin.classes.show', $enseignant->classe) }}" class="btn btn-xs btn-primary">{{ $enseignant->classe->libele }}</a>
                                                            @else
                                                                <span class="badge badge-primary">NÉANT</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('admin.enseignants.edit', $enseignant) }}" type="button" class="btn btn-warning">Modifier les données</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Edit enseignant<User> button --}}
                            <a href="{{ route('admin.enseignants.edit', $enseignant) }}" class="btn btn-xs btn-warning" data-target="#modal-enseignant-edit-{{$enseignant->id}}"><i class="fa fa-edit"></i></a>
                                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Classe</th>
                        <th>Nom Complet</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
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
