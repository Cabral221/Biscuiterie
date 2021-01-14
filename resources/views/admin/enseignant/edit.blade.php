@extends('layouts.app', ['titlePage' => $enseignant->full_name .' | Modification des informations'])

@section('content')
<section class="content-header">
    <h1>
        Modifier les informations de Mr (Mme) {{ $enseignant->full_name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.enseignants.index') }}"><i class="fa fa-users"></i> Enseignants</a></li>
        <li class="active"> {{ $enseignant->full_name }}</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Modifier en toutes sécurité</h3>
        </div>
        <form action="{{ route('admin.enseignants.update', $enseignant) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group @error('full_name') has-error @enderror">
                    <label for="full_name">Nom Complet</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') ?? $enseignant->full_name }}">
                    @error('full_name')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('email') has-error @enderror">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? $enseignant->email }}">
                    @error('email')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error('phone') has-error @enderror">
                    <label for="phone">Numéro de Téléphone</label>
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone') ?? $enseignant->phone }}">
                    @error('phone')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>

    </div>
</section>
@endsection
