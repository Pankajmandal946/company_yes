<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <link rel="shortcut icon" href="theme/img/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="theme/index2.html" class="h1"><b style="color:brown">Register</b><span style="color:green">Page</span></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="user_name" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" id="user_email_id" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-paper-plane sandOtp" type="submit" id="send_otp" style="color:black;"></i>
              </div>
            </div>
          </div>
          <span class="emailSandOtp" style="color:red;"></span>

          <div class="input-group mb-3 enter_otp">
            <input type="email" class="form-control" id="enter_otp" placeholder="Enter Email OTP">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-save" type="button" id="verify_otp" style="color:black;"></i>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="register" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="index.php" class="text-center">I already have a Account</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="theme/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="theme/dist/js/adminlte.min.js"></script>
  <script>
    // $(document).on('keydown', '#user_email_id', function(event) {
    //   // console.log(event);
    //   if (event.keyCode == 77) {
    //     $("#sand_otp").on("click", function(e) {
    //       e.preventDefault();
    //       var email=jQuery('#user_email_id').val();
    //       if(email==''){
    //         alert("please enter email id");
    //       } else{
    //         jQuery('.sand_otp').html('Please wait..');
		// 		    jQuery('.email_sent_otp').attr('disabled',true);
    //       }
    //     });
    //   }
      
    // });
    $(document).ready(function() {
      $("#send_otp").on("click", function(e) {
        $('.error').text('').hide();
        var email_id = $.trim($("#user_email_id").val());
        if (email_id == "") {
          alert('Please enter your Email Id');
          $("#user_email_id").focus();
          return false;
        } else{
          $(".emailSandOtp").html('Please wait..');
          $(".sandOtp").attr('disabled', true);

          $.ajax({
          method: "POST",
          url: "controller/send_email_otp.php",
          data: request,
          dataType: "JSON",
          async: false,
          headers: {
            "Content-Type": "application/json"
          },
          beforeSend: function() {
            console.log(request);
          },
        }).done(function(Response) {
          $('#current_password').val('');
          $('#new_password').val('');
          $('#confirm_new_password').val('');
          $('#password_change').modal('hide');
          alert('Password Change Successfully Please login');
        }).fail(function(jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
          } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
          } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
          } else if (exception === 'timeout') {
            msg = 'Time out error.';
          } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
          } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
          }
          $("#message").html(msg).show();
        }).always(function(xhr) {
          console.log(xhr);
        });
        }
      });
    });

    $(document).ready(function() {
      $("#register").on("click", function(e) {
        e.preventDefault();
        var name = $.trim($("#user_name").val());
        if (name == "") {
          alert('Please enter your Name');
          $("#user_name").focus();
          return false;
        }
        var email_id = $.trim($("#user_email_id").val());
        if (email_id == "") {
          alert('Please enter your Email Id');
          $("#user_email_id").focus();
          return false;
        }
      });
    });
  </script>
</body>

</html>