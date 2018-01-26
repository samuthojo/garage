<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

  <!--Pulling Awesome Font -->
  <link
    href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
    rel="stylesheet">

  <link rel="stylesheet"
  	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>

  <style>
    body {
      position: relative;
    }
    .top-part {
      background:url('/images/garage.jpg') center;
      height: 50vh;
    }
    .bottom-part {
      background: #ff9720;
      height: 50vh;
    }
    .form-login {
      position: absolute;
      left: 35%;
      top: 20%;
      bottom: 0;
      width: 300px;
      height: 320px;
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
      background: #fff;
    }
    .my-form {
      position: absolute;
      left: 20%;
      top: -30%;
      bottom: 0;
    }
    div. {
      text-align: center;
    }
    div>img {
      margin: 110px 0 12px 0;
    }
    .form-control {
      display: inline-block;
      width: auto;
      position: relative;
    }
  </style>

  <script>
    $(function() {
      $(":text").keydown(function() {
        $(".alert-danger").fadeOut(0);
      });
      $("#password").keydown(function() {
        $(".alert-danger").fadeOut(0);
      });
    });
  </script>

</head>
<body>
  <div class="top-part"></div>
  <div class="bottom-part"></div>
  <div class="form-login">

    <div class="my-form">
      <img class="img-rounded col-sm-offset-1" src="{{asset('images/logo.png')}}"
        alt="BiasharaPlus Logo" width="60%" height="auto">

      @if ($errors->any())
        <div class="alert alert-danger" style="display: inline-block;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form id="login_form" name="login_form" action="{{route('login')}}"
        method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <input type="text" id="username" class="form-control"
            placeholder="Username" name="username"
            value="{{ old('username') }}" autofocus>
        </div>

        <div class="form-group">
          <input type="password" id="password" class="form-control"
            placeholder="Password" name="password">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-warning col-sm-offset-3">
            <span style="color: #000;">Login</span>
          </button>
        </div>

      </form>
    </div>

  </div>
</body>
</html>
