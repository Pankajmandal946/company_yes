<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table width="100%" bgcolor="#E4E4E4" style="background-color:#e4e4e4" border="0" cellpadding="0" cellspacing="0" role="presentation">
        <tbody>
            <tr>
                <td>
                    <table align="center" width="600" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:600px">
                        <tbody>
                            <tr>
                                <td bgcolor="#ffffff" style="border-top:4px solid #fa0f00;background-color:#ffffff;padding-bottom:60px">
                                    <table align="center" width="500" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:500px">
                                        <tbody>
                                            <tr>
                                                <td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:50px"><img alt="Kharido" src="theme/img/sandOtp.png" width="50%" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top;" class="CToWUd" data-bit="iit"></td>
                                            </tr>
                                            <tr>
                                                <td style="color:#505050;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:18px;line-height:26px;padding-top:65px">Your verification code is:<br><br>
                                                    <strong style="font-size:28px;line-height:32px">617176</strong><br><br>
                                                    Your account can't be accessed without this verification code, even if you didn't submit this request.<br><br>
                                                    To keep your account secure, we recommend using a unique password for your Kharido account or using the Kharido Account Access app to sign in. Adobe Account Access' two-factor authentication makes signing in to your account easier, without needing to remember or change passwords.<br><br>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#F5F5F5" style="background-color:#f5f5f5">
                                    <table align="center" width="500" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:500px">
                                        <tbody>
                                            <tr>
                                                <td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:40px"><img alt="Kharido" src="theme/img/sandOtp.png" width="30%" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top;" class="CToWUd" data-bit="iit"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>

<!-- 
    $json = file_get_contents('php://input');
    if (isset($json) && !empty($json)) {
        $request = json_decode($json);
        $costumor_user = new Costumer_Userlogin();
        // print_r($costumor_user);exit;
        if (isset($request->activity) && $request->activity == 'sand_otpEmail') {
            $costumor_user->user_email_id = $request->user_email_id;
            if ($costumor_user->validate_emailid()) {
                if ($costumor_user->check() === true) {
                    if ($costumor_user->check_user_emailid() === false) {
                        $costumor_user->otp_insert();
                        print_r($costumor_user);exit;
                        $response = [
                            'success' => 1,
                            'code' => 200,
                            'msg' => 'OTP Send successfully Please Check And Verify!'
                        ];
                        $costumor_user->conn->commit();
                        http_response_code(200);
                        echo json_encode($response);
                    } else {
                        throw new Exception("Email ID already exists, please choose another Email",400);
                    }
                }
            }
        }
 -->