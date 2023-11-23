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
  <!-- Register style -->
  <link rel="stylesheet" href="theme/cssR_L/style.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h1><b style="color:green">Create</b><span style="color:chartreuse"> Account</span></h1>
      </div>
      <div class="card-body">
        <!-- <p class="login-box-msg">It's quick and easy.</p> -->

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="user_name" placeholder="Full name">
          </div>
          <!-- Email Id Verification code start -->
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="user_email_id" placeholder="Email">
            <div class="input-group-append otpSend">
              <div class="input-group-text emailSandOtp" style="color:red;">
                <span class="fas fa-paper-plane" style="color:red;" type="submit" id="send_otp"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3 email_verify_otp">
            <input type="hidden" id="randomOtp" name="randomOtp" value="" />
            <input type="password" class="form-control" id="enter_otp" placeholder="Enter Email OTP">
            <input type="hidden" name="rendemotp" id="rendemotp" value="" />
            <div class="input-group-append enterotp">
              <div class="input-group-text">
                <i class="fas fa-save" style="color:red;" type="submit" id="verify_otp"></i>
              </div>
            </div>
          </div>
          <!-- Email Id Verification code start -->

          <div class="input-group mb-3">
            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-eye-slash pasword_show" style="color:red;" type="submit" ></span>
                <span class="fas fa-eye pasword_hide" style="color:red; display:none;" type="submit" ></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" id="confirm_new_password" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-eye-slash paswordShow" style="color:red;" type="submit" ></span>
                <span class="fas fa-eye paswordHide" style="color:red; display:none;" type="submit" ></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3 error_text">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="error text-danger text-center" style="font-size: 14px; font-weight: bold;"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3 success_text">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="success text-success text-center" style="font-size:14px;"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div ></div>
              <div ></div>
              <button type="submit" id="registerUser" class="btn btn-primary btn-block">Sign Up</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="login.php" class="text-center t-2">I already have a Account</a>
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
      // Send OTP Jquary Code
      $('.email_verify_otp').hide();
      $('.success_text').hide();
      $("#send_otp").on("click", function(e) {
        var user_email_id = $.trim($("#user_email_id").val());
        if (user_email_id == "") {
          alert('Please enter your Email Id');
          $("#user_email_id").focus();
          return false;
        } else {
          $(".emailSandOtp").html('Please wait..');
          $(".emailSandOtp").attr('disabled', true);
          $('.email_verify_otp').show();

          $.ajax({
            method: "POST",
            url: "controller/send_email_otp.php",
            datatype: "json",
            data: {
              type: "sand_otpEmail",
              user_email_id: user_email_id
            },
            success: function(theResponse) {
              //alert(theResponse);
              var obj = JSON.parse(theResponse);
              if (obj.success == true) {
                $('.success').text('').show();
                $('.success_text').show();
                $('#randomOtp').val(obj.randomOtp);
                $('#user_email_id').attr('disabled', true);
                $('.emailSandOtp').hide();
                $('.otpSend').html('<div class="input-group-append"><div class="input-group-text"><i class="fas fa-paper-plane" style="color:black;"></i></div></div>');
                $('.success').html("Successfully Send Your Verification Code<br/> Please Confirm It!");
              } else {
                $('.otpSend').html('<div class="input-group-text"><span class="fas fa-paper-plane" style="color:red;"></span></div>');
                alert(obj.errors.error);
                location.reload(true);
              }
            }
          });
        }
      });

      // Verify OTP Jquary Code
      $("#verify_otp").on("click", function(e) {
        $('.success_text').hide();
        var randomOtp = $('#randomOtp').val();
        var enter_otp = $.trim($("#enter_otp").val());
        if (enter_otp == "") {
          // alert('Please enter your OTP');
          $("#enter_otp").focus();
          return false;
        } else {
          $.ajax({
            method: "POST",
            url: "controller/send_email_otp.php",
            datatype: "json",
            data: {
              type: "enter_otpEmail",
              randomOtp: randomOtp,
              enter_otp: enter_otp
            },
            success: function(theResponse) {
              //alert(theResponse);
              var obj = JSON.parse(theResponse);
              if (obj.success == true) {
                $('.success').text('').show();
                $('.success_text').show();
                $('#rendemotp').val(obj.rendemotp);
                $('#enter_otp').attr('disabled', true);
                $('.email_verify_otp').hide();
                $('.emailSandOtp').hide();
                $('.otpSend').html('<div class="input-group-append"><div class="input-group-text"><i class="fas fa-paper-plane" style="color:green;"></i></div></div>');
                $('.success').html("Verification Successfully Completed!");
              } else {
                $('.enterotp').html('<div class="input-group-text" style="color:red;"><span class="fas fa-paper-plane rptemail" style="color:red;"></span></div>');
                alert(obj.errors.error);
                location.reload(true);
              }
            }
          });
        }
      });

      /* Password Show & hind start */ 
      $(".pasword_show").click(function() {
          $("#new_password").attr("type", "text");
          $(".pasword_show").hide();
          $(".pasword_hide").show();
      });
      $(".pasword_hide").click(function() {
          $("#new_password").attr("type", "password");
          $(".pasword_show").show();
          $(".pasword_hide").hide();
      });
      $(".paswordShow").click(function() {
          $("#confirm_new_password").attr("type", "text");
          $(".paswordShow").hide();
          $(".paswordHide").show();
      });
      $(".paswordHide").click(function() {
        $("#confirm_new_password").attr("type", "password");
        $(".paswordShow").show();
        $(".paswordHide").hide();
      });
      /* Password Show & hind End */ 
    });

    // $(document).ready(function() {
    //   $("#user_valid").on("click", function(e) {
    //     $('.error').text('').hide();
    //     var username = $.trim($("#username").val());
    //     if (username == "") {
    //       alert('Please enter your Username');
    //       $("#username").focus();
    //       return false;
    //     } else {
    //       $.ajax({
    //         method: "POST",
    //         url: "controller/send_email_otp.php",
    //         datatype: "json",
    //         data: {
    //           type: "user_valid",
    //           username: username
    //         },
    //         success: function(theResponse) {
    //           //alert(theResponse);
    //           var obj = JSON.parse(theResponse);
    //           if (obj.success == true) {
    //             // $('#randomOtp').val(obj.randomOtp);
    //             // $('#user_email_id').attr('disabled', true);
    //             // $('.emailSandOtp').hide();
    //             $('.uservalid').html('<div class="input-group-append"><div class="input-group-text"><i class="fas fa-check-double" style="color:black;"></i></div></div>');
    //             alert("Successfully Send Your Verification Code Please Confirm It!");
    //           } else {
    //             $('.uservalid').html('<div class="input-group-text" style="color:red;"><span class="fas fa-paper-plane rptemail" style="color:red;"></span></div>');
    //             alert(obj.errors.error);
    //             location.reload(true);
    //           }
    //         }
    //       });
    //     }
    //   });
    // });

    $(document).ready(function() {
      $('.error_text').hide();
      $('.success_text').hide();
      $(document).on('click', '#registerUser', function(e) {
        e.preventDefault();
        rendemotp = $('#rendemotp').val();
        // console.log(rendemotp);return false;
        var email_id = $.trim($("#user_email_id").val());
        var name = $.trim($("#user_name").val());
        // var username = $.trim($('#username').val());
        var new_password = $.trim($('#new_password').val());
        var confirm_new_password = $.trim($('#confirm_new_password').val());
        $('.error').text('').show();
        $('.error_text').show();

        if(rendemotp == ''){
          $('.error').text("Please Verify Your Email Id");
          return false;
        } else {
          var email_id = $.trim($("#user_email_id").val());
        }

        if (name == "") {
          $('.error').text('Please enter your Name');
          $("#user_name").focus();
          return false;
        }

        if (email_id == "" ) {
          $('.error').text('Please enter your Email Id');
          $("#user_email_id").focus();
          return false;
        }

        if (new_password == '' || new_password == "") {
          $('.error').html('New Password Password is required').show();
          $('#new_password').focus();
          return false;
        }

        if (confirm_new_password == '' || confirm_new_password == "") {
          $('.error').text('Confirm New Password Password is required').show();
          $('#confirm_new_password').focus();
          return false;
        }

        if (new_password.length < 7) {
          $('.error').text('New Password is must have 8 length').show();
          $('#new_password').focus();
          return false;
        }

        if (confirm_new_password.length < 7) {
          $('.error').text('Confirm New Password Password is must have 8 length').show();
          $('#confirm_new_password').focus();
          return false;
        }

        if (!password_fromat(new_password)) {
          $('.error').html('New Password must be contain a upercase,<br/>number and spaciel character').show();
          $('#new_password').focus();
          return false;
        }

        if (new_password != confirm_new_password) {
          $('.error').text('New Password must be same as Confirm Password').show();
          $('#new_password').focus();
          return false;
        }

        let arr = {
          activity: 'register_newAcc',
          name: name,
          email_id: email_id,
          new_password: new_password,
          confirm_new_password:confirm_new_password
        };
        var request = JSON.stringify(arr);

        $.ajax({
          method: "POST",
          url: "controller/register_new_userC.php",
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
          $('.error_text').hide();
          location.href = 'successfully_add.php';
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
            msg = jqXHR.responseJSON.msg;
          }
          $(".error").html(msg).show();
        }).always(function(xhr) {
          console.log(xhr);
        });
      });
    });

    function password_fromat(new_password) {
      var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
      if (!format.test(new_password)) {
        return false;
      }
      if (!/\d/.test(new_password)) {
        return false;
      }
      if (!/^[A-Z]/.test(new_password)) {
        return false;
      }
      return true;
    }
  </script>
</body>

</html>