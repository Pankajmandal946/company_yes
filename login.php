<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <link rel="shortcut icon" href="theme/img/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  <!-- Login style -->
  <link rel="stylesheet" href="theme/cssR_L/style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <p class="h1"><b style="color:chartreuse">Lo</b><span style="color:green">gin</span></p>
    </div>
    <div class="card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->

      <form method="post">
          <div class="input-group mb-3">
            <input type="text" id="user_email_id" class="form-control" placeholder="user_email_id">
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" class="form-control" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" id="login" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      <p class="mb-1" style="margin-top:15px; text-align: center;">
        <a href="forgot-password.html">Forgotten password?</a>
      </p>
      <div class="inline"></div>
      <p class="mb-0" style="margin-left: 24px;">
          <button class="btn-grad">
            <a href="register.php" class="text-center CrNewAccc">Create new account</a>
          </button>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<script>
  $(document).ready(function() {
    $("#login").on("click", function(e) {
        e.preventDefault();
        var user_email_id = $.trim($("#user_email_id").val());
        if (user_email_id == "") {
          alert('Please enter your user_email_id');
          $("#user_email_id").focus();
          return false;
        }
        var password = $.trim($("#password").val());
        if (user_email_id == "") {
          alert('Please enter your password');
          $("#password").focus();
          return false;
        }
        if (user_email_id != "" && password != "") {
          $.ajax({
            url: "controller/register_new_userC.php",
            type: "POST",
            dataType: "json",
            async: false,
            headers: {
              "Content-Type": "application/json"
            },
            data: JSON.stringify({
              'activity': 'login',
              'user_email_id': user_email_id,
              'password': password
            }),
            success: function(response) {
              window.location.href = "index.php";
            },
            error: function(jqXHR, exception) {
              var msg = '';
              if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
              } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
              } else if (jqXHR.status == 401) {
                msg = jqXHR.responseJSON.msg;
              } else if (jqXHR.status == 402) {
                $('#password_change').modal('show');
              } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
              } else if (exception === 'timeout') {
                msg = 'Time out error.';
              } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
              } else {
                msg = 'Uncaught Error.\n' + jqXHR.rsponseJSON.msg;
              }
              if (msg != '') {
                alert(msg);
              }
            }
          });
        };
      });
  });
</script>
</body>
</html>
