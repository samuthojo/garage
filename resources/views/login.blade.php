<!doctype html>
<html>
<head>

  <title>Login</title>

  <!-- Csrf token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet"
  	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> -->

  <!--Pulling Awesome Font -->
  <link
    href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
    rel="stylesheet">

  <!-- jQuery library -->
  <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>

  <!-- Latest compiled JavaScript -->
  <script
  	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>

  <script src="{{ asset('js/main.js') }}"></script>

 <style>
     /*@import url(http://fonts.googleapis.com/css?family=Roboto:400);*/
    body {
      position: relative;
    }
    .top-part {
      background:url('/images/garage.jpg') center;
      height: 50vh;
      position: relative;
      z-index: 1;
    }
    .bottom-part {
      background: #fb8a0b;
      height: 50vh;
      position: relative;
    }
    .bottom-part::before{
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.22;
      z-index: 1;
      background-image: url(images/ptn.png);
    }
    .form-login {
      z-index: 3;
      padding-top: 40px;
      padding-bottom: 35px;
      position: absolute;
      left: 0;
      right: 0;
      top: 20%;
      margin: auto;
      height: auto;
      width: 300px;
      border: 1px solid #e5e5e5;
      border-radius: 4px;
      box-shadow: 0 1px 50px rgba(0, 0, 0, 0.05);
      background: #fff;
    }
    .my-form {
      text-align: center;
    }
    .my-form button {
      text-transform: uppercase;
      min-width: 120px;
    }
    div>img {
      display: inline-block;
      margin-bottom: 20px;
    }
    .form-control {
      display: inline-block;
      width: auto;
      position: relative;
    }
    .loader {
          position: relative;
          width: 178px;
          left: 0;
          right: 0;
          margin: auto;
          z-index: 9999;
          text-align: center;
          padding-bottom: 10px;
          display: none;
      }
      .alert {
        display: inline-block;
      }
  </style>

  <script>
  $(document).ready( function() {
    $("#password").on('keydown', function(e) {
        if (e.which == 13) {
            loginReq();
        }
    });
  });

  function loginReq() {
    $(".loader").fadeIn(0);
    var username = $("#username").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if( username =='' || password ==''){
      $(".loader").fadeOut(0);

      $("#login_alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#login_alert").slideUp(500);
      });
    } else {

        var link="login";

        var user = {
          'username': $('#username').val(),
          'password': $('#password').val()
        };

        $.ajax({
                type: 'post',
                dataType: 'html',
                url: link,
                cache: false,
                data: user,
                success: function (result) {
                  var obj = jQuery.parseJSON(result);
                  var status = obj['success'];
                  if(status == 'success'){
                    $(".loader").fadeOut(0);
                    window.location.href = "{{ url('dashboard') }}";
                  }else{
                      $(".loader").fadeOut(0);
                      $("#password").val("");
                      $("#login_alert2").fadeTo(2000, 500).slideUp(500, function(){
                        $("#login_alert2").slideUp(500);
                      });
                  }
                }
          });
    }
  }

  </script>

</head>
<body>
  <div class="top-part"></div>
  <div class="bottom-part"></div>
  <div class="form-login">

    <div class="my-form">
      <img class="img-rounded" src="{{asset('images/logo.png')}}"
        alt="BiasharaPlus Logo" width="60%" height="auto">

        @include('loader')
        <div class="alert alert-danger" id="login_alert" style="display:none;">
          Please fill all fields!
        </div>
        <div class="alert alert-danger" id="login_alert2" style="display:none;">
          Wrong username or password
        </div>

      <form id="login_form" name="login_form">
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
          <button type="button" class="btn btn-warning"
            id="login" onclick="loginReq()" style="background-color: #ff9720;">
            <span style="color: #000;">Login</span>
          </button>
        </div>

      </form>
    </div>

  </div>
</body>
</html>
