

  @include('header')

  <!--Pulling Awesome Font -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <style>
      @import url(http://fonts.googleapis.com/css?family=Roboto:400);

      body {
      background-color:#fff;
      -webkit-font-smoothing: antialiased;
      font: normal 14px Roboto,arial,sans-serif;
      }

      .container {
        padding: 25px;
        position: fixed;
      }

      .form-login {
        background-color: #EDEDED;
        padding-top: 10px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 15px;
        border-color:#d2d2d2;
        border-width: 5px;
        box-shadow:0 1px 0 #cfcfcf;
      }

      h4 {
      border:0 solid #fff;
      border-bottom-width:1px;
      padding-bottom:10px;
      text-align: center;
      }

      .form-control {
        border-radius: 10px;
      }

      .wrapper {
        text-align: center;
      }

  </style>

<script language="javascript" type="text/javascript">

function loginReq() {
  var username = $("#username").val();
  var password = $("#password").val();
  // Checking for blank fields.
  if( username =='' || password ==''){
    $('input[type="text"],input[type="password"]').css("border","2px solid red");
    $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
    //$('#login_alert').show()
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
                    window.location.href = "{{ url('dashboard') }}";
                }else{
                    //$("#login_alert2" ).show();
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

<div class="container">

    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="alert alert-danger" id="login_alert" style="display:none;">
              Please fill all fields!
            </div>
            <div class="alert alert-danger" id="login_alert2" style="display:none;">
              Wrong username or password
            </div>
            <div class="form-login">
            <h4>Mechmaster Garage</h4>
            <form id="login_form">
              <div class="form-group">
                <input type="text" id="username"
                  class="form-control input-sm chat-input"
                  name="username"
                  placeholder="username" />
              </div>
              <div class="form-group">
                <input type="password" id="password"
                  class="form-control input-sm chat-input"
                  name="password"
                  placeholder="password" />
              </div>

            <div class="form-group">
              <div class="wrapper">
                <span class="group-btn">
                    <button type="button" onclick="loginReq()" class="btn btn-primary btn-md"
                      id="login">login <i class="fa fa-sign-in"></i></button>
                </span>
              </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</html>
