@extends('layouts.auth.app', [ 'titlePage' => 'Restauration du mot passe'])

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{ route('welcome') }}">{{ config('app.name') }}</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Restaurer votre mot de passe</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('master.password.email') }}">
      @csrf

      <div class="form-group has-feedback @error('email') has-error @enderror">
        <input id="email" type="email"
        class="form-control" name="email"
        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Votre Adresse E-mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
        <span class="help-block">{{ $message }}</span>
        @enderror 
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
