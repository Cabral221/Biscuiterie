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
            <h3 class="box-title">Liste des enseignants par classe</h3>
        </div>
        <div class="box-body">
            <table id="exemple1" class="table table-bordered table-striped">
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
                        <td><span class="label label-primary">{{ $enseignant->classe->libele }}</span></td>
                        <td>{{ $enseignant->full_name }}</td>
                        <td>{{ $enseignant->phone }}</td>
                        <td>{{ $enseignant->email }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date et lieu de naissance</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>    
</section>

@endsection