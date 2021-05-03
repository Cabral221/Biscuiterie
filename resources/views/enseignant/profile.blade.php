@extends('layouts.app', ['titlePage' => 'Gestion du compte'])

@section('content')
<section class="content-header">
    <h1>
        Gerer mon compte
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Profil</li>
    </ol>
</section>
<section class="content">
        
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Informations générales</h3>
            
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
            <table class="table">
                <tr>
                    <th>Nom complet</th>
                    <td>{{ $user->full_name }}</td>
                </tr>
                <tr>
                    <th>Adresse Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Téléphone</th>
                    <td>{{ $user->phone }}</td>
                </tr>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- Default box -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Modifier vos Informations</h3>
        </div>
        <form action="{{ route('master.profile.update') }}" method="post" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group @error('kind') has-error @enderror">
                    <label class="col-sm-4 control-label">Genre</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kind" id="homme" value="1" {{ $user->kind ? 'checked' : '' }}>
                            <label class="form-check-label" for="homme">Mr.</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kind" id="femme" value="0" {{ !$user->kind ? 'checked' : '' }}>
                            <label class="form-check-label" for="femme">Mme</label>
                        </div>
                        @error('kind')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('first_name') has-error @enderror">
                    <label for="first_name" class="col-sm-4 control-label">Prénom</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Votre prénom" value="{{ old('first_name') ?? $user->first_name }}">
                        @error('first_name')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('last_name') has-error @enderror">
                    <label for="last_name" class="col-sm-4 control-label">Nom</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Votre prénom" value="{{ old('last_name') ?? $user->last_name }}">
                        @error('last_name')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('email') has-error @enderror">
                    <label for="email" class="col-sm-4 control-label">Adresse Email</label>

                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="email" placeholder="adresse Email" value="{{ old('email') ?? $user->email }}">
                        @error('email')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('phone') has-error @enderror">
                    <label for="phone" class="col-sm-4 control-label">Téléphone</label>

                    <div class="col-sm-8">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Téléphone" value="{{ old('phone') ?? $user->phone }}">
                        @error('phone')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
            <!-- /.box-footer -->
        </form>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Modifier votre mot de passe</h3>
        </div>
        <form action="{{ route('master.profile.password') }}" method="POST" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group @error('current_password') has-error @enderror">
                    <label for="current_password" class="col-sm-4 control-label">Mot de passe actuel</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Mot de passe actuel">
                        @error('current_password') 
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <label for="password" class="col-sm-4 control-label">Nouveau mot de passe</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Nouveau mot de passe">
                        @error('password')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-4 control-label">Confirmation mot de passe</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
            <!-- /.box-footer -->
        </form>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
@endsection