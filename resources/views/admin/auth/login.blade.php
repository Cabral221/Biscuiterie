@extends('layouts.auth.app', ['titlePage' => 'Se connecter à l\'administration'])

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('welcome') }}"><b>Ecole</b>Biscuiterie</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg text-danger"><i class="fa fa-warning"></i> Atention ! Partie réservée aux administrateurs</p>
        
        <form action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="form-group @error('email') has-error @enderror">
                <input type="email" id="email" 
                class="form-control" name="email"
                value="{{ old('email') }}" placeholder="Adresse E-mail"  autocomplete="email" autofocus required >
                @error('email')
                    <div class="help-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('password') has-error @enderror">
                <input type="password" required id="password" class="form-control" name="password"
                autocomplete="current-password" placeholder="Mot de passe">
                @error('password')
                    <div class="help-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label style="margin-bottom: 10px;margin-top:10px;">
                            <input type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}> Se Souvenire de moi
                        </label>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        
        <!-- /.social-auth-links -->
        @if (Route::has('admin.password.request'))
        <a href="{{ route('admin.password.request') }}" class="btn btn-link text-center" style="margin-top:20px;">J'ai oublie mon mot de passe</a><br>
        @endif
    </div>
    <!-- /.login-box-body -->
</div>
@endsection