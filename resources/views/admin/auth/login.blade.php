<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admid| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Ecole</b>Biscuiterie</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>


    <form action="{{ route('admin.login') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" id="email" 
        class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Adresse E-mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback">
        </span>
          @error('email')
              <div class="text-danger text-bold">{{ $message }}</div>
          @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" required id="password" class="form-control @error('password') is-invalid @enderror" name="password"
         autocomplete="current-password" placeholder="Mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback">
        </span>
          @error('password')
              <div class="text-danger text-bold">{{ $message }}</div>
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
    <a href="{{ route('admin.password.request') }}" class="btn btn-danger btn-block mt-4" style="margin-top:20px;">J'ai oublie mon mot de passe</a><br>
    @endif
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
