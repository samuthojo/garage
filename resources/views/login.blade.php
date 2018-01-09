

  @include('header')

  <!--Pulling Awesome Font -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <style>
      /*@import url(http://fonts.googleapis.com/css?family=Roboto:400);*/

        body {
          padding-top: 40px;
          padding-bottom: 40px;
          background-color: #f5f5f5;
        }

        .form-signin {
          width: 300px;
          padding: 19px 35px 29px;
          top: 0;
          margin: 60% auto;
          /*left: 0;*/
          /*position: fixed;*/
          background-color: #fff;
          border: 1px solid #e5e5e5;
          -webkit-border-radius: 5px;
             -moz-border-radius: 5px;
                  border-radius: 5px;
          -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
             -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                  box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
          margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
          font-size: 16px;
          height: auto;
          margin-bottom: 15px;
          padding: 7px 9px;
        }

      .loader {
          /*position: fixed;
          top: 0;
          left: 0;*/
          /*width: 100%;*/
          /*padding-top: 1.5%;*/
          /*height: 40px;*/
          z-index: 9999;
          text-align: center;
          align-content: center;
          padding-bottom: 10px;
          display: none;
      }
  </style>

<script language="javascript" type="text/javascript">

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
<div class="container">
  <div class="row">
    <div class="col-md-offset-5 col-md-3">
      <form class="form-signin">
        @include('loader')
        <div class="alert alert-danger" id="login_alert" style="display:none;">
          Please fill all fields!
        </div>
        <div class="alert alert-danger" id="login_alert2" style="display:none;">
          Wrong username or password
        </div>
        <h2 class="form-signin-heading text-primary">Mechmasters</h2>
        <input type="text" id="username" class="form-control"
          placeholder="Username" autofocus>
        <input type="password" id="password" class="form-control"
          placeholder="Password">
        <button class="btn btn-primary col-sm-offset-4" type="button"
          id="login" onclick="loginReq()">Log in</button>
      </form>
    </div>
   </div>
</div> <!-- container -->
</html>
