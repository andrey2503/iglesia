<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="plugins/iCheck/square/blue.css"> -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Sistema</b><br> Parroquia Sagrado Corazón de Jesús <b>Heredia</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese al sistema</p>

        <!-- <form action="login" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->

            <form class="form-horizontal" method="POST" action="{{ url('login') }}">
                {{ csrf_field() }}

          <div class="form-group has-feedback">

                <input type="text" class="form-control" name="usuario" placeholder="usuario">
                <span class="glyphicon  glyphicon-user form-control-feedback"></span>
                @if($errors->has('usuario'))
                  <span style="color: red;">{{ $errors->first('usuario') }}</span>
                @endif
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('password'))
                  <span style="color: red;">{{ $errors->first('password') }}</span>
                @endif
          </div>

          <div class="row">



            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
          </div>
        </form>




      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-1.12.4.js') }}"></script>
    <!-- iCheck -->
    <!-- <script src="../../plugins/iCheck/icheck.min.js"></script> -->
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <script>

      // $(function () {
      //   $('input').iCheck({
      //     checkboxClass: 'icheckbox_square-blue',
      //     radioClass: 'iradio_square-blue',
      //     increaseArea: '20%' // optional
      //   });
      // });
    </script>


  </body>
</html>
