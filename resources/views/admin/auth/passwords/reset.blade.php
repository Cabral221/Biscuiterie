@extends('layouts.auth.app', ['titlePage' => 'Restauration du mot de passe'])

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ route('welcome') }}">{{ config('app.name') }}</a>
    </div>
    
    <div class="register-box-body">
        <p class="login-box-msg">Restaurer votre mot de passe</p>
        
        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input id="email" type="email" class="form-control" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Entre Votre Adresse Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input id="password" type="password"
                class="form-control" name="password"
                required autocomplete="new-password" placeholder="Entrez Votre Mot De Passe">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez Le Nouveau Mot De Passse">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Envoyer</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection
