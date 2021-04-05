@extends('layouts.auth.app', ['titlePage' => 'Confirmation de mot de passe'])

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{ route('welcom') }}">{{ config('app.name') }}</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Confirmez Votre Mot De Passe Admin
    </p>

    Veuillez confirmer votre mot de passe avant de continuer.

    <form method="POST" action="{{ route('admin.password.confirm') }}">
        @csrf

   

      <div class="form-group has-feedback">
        <input id="password" type="password"
        class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="current-password" placeholder="Entre Votre Nouveau Mot De Passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
        <span class="invalid-feedback" role="alert">
          {{ $message }}
        </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control"
        name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez Le Nouveau Mot De Passe">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Envoyer Le Nouveau Mot De Passe') }}</button>
        </div>
        <!-- /.col -->
        @if (Route::has('admin.password.request'))
            <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection