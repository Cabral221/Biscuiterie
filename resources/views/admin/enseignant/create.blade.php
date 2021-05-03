@extends('layouts.app', ['titlePage' => 'Ajouter un enseignant'])

@section('content')
<section class="content-header">
    <h1>
        Ajout d'un enseignant
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.enseignants.index') }}"><i class="fa fa-users"></i> Enseignants</a></li>
        <li class="active"> Ajout</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Ajouter un(e) enseignant(e) en toutes sécurité</h3>
        </div>
        <form action="{{ route('admin.enseignants.store') }}" method="POST" class="form">
            @csrf
            @method('POST')
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('kind') has-error @enderror">
                            <label>Genre</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kind" id="homme" value="1">
                                <label class="form-check-label" for="homme">Mr.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kind" id="femme" value="0">
                                <label class="form-check-label" for="femme">Mme</label>
                            </div>
                            @error('kind')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('first_name') has-error @enderror">
                            <label for="first_name">Prénom</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                            @error('first_name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('last_name') has-error @enderror">
                            <label for="last_name">Nom</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                            @error('last_name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone">Numéro de Téléphone</label>
                            <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-center text-warning">Infos </h3>
                        <p class="pr-5 pl-5 pb-5">Un(e) enseignant(e) qui n'est pas affecté à une classe ne poura pas se connecter à la plateforme.</p>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>

    </div>
</section>
@endsection
