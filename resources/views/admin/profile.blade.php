@extends('layouts.app', ['titlePage' => 'Gestion du compte'])

@section('content')
<section class="content-header">
    <h1>
        Gerer mon compte
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
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
        <form action="{{ route('admin.profile.update') }}" method="post" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group @error('full_name') has-error @enderror">
                    <label for="fullname" class="col-sm-4 control-label">Nom Complet</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="full_name" id="fullname" placeholder="Votre nom" value="{{ old('full_name') ?? $user->full_name }}" required>
                        @error('full_name')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('email') has-error @enderror">
                    <label for="email" class="col-sm-4 control-label">Adresse Email</label>

                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="email" placeholder="adresse Email" value="{{ old('email') ?? $user->email }}" required>
                        @error('email')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('phone') has-error @enderror">
                    <label for="phone" class="col-sm-4 control-label">Téléphone</label>

                    <div class="col-sm-8">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Téléphone" value="{{ old('phone') ?? $user->phone }}" required>
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
        <form action="{{ route('admin.profile.password') }}" method="POST" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group @error('old_password') has-error @enderror">
                    <label for="old_password" class="col-sm-4 control-label">Ancien mot de passe</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Ancien mot de passe" required>
                        @error('old_password') 
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <label for="password" class="col-sm-4 control-label">Nouveau mot de passe</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Nouveau mot de passe" required>
                        @error('password')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-4 control-label">Confirmation mot de passe</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
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