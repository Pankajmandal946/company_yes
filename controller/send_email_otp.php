<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $otp=rand(111111,999999);
    $_SESSION['EMAIL_OTP']=$otp;
    $html= '<b style="color:red;">'.$otp.'</b>';
    $img = '';
    // print_r($html);exit;

   
	$mail->SMTPDebug = 2;									 
	$mail->isSMTP();										 
	$mail->Host	      = 'smtp.gmail.com';				 
	$mail->SMTPAuth   = true;							 
	$mail->Username   = 'bsapankajdk@gmail.com';				 
	$mail->Password   = 'qlcv xofb enyp ggos';					 
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	      = 587; 

	$mail->setFrom('bsapankajdk@gmail.com', 'Kharido.com');		 
	$mail->addAddress('bsapankajdk@gmail.com');
	$mail->addAddress('pankajdk92@gmail.com', 'Kharido.com');
	
	$mail->isHTML(true);								 
	$mail->Subject  = 'Verification Code';
	$mail->Body     = '
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
                                                <td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:50px"><img alt="Kharido" src="theme/img/sandOtp.png" width="50%" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top" class="CToWUd" data-bit="iit"></td>
                                            </tr>
                                            <tr>
                                                <td style="color:#505050;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:18px;line-height:26px;padding-top:65px">Your verification code is:<br><br>
                                                    <strong style="font-size:28px;line-height:32px">'.$html.'</strong><br><br>
                                                    Your account can’t be accessed without this verification code, even if you didn’t submit this request.<br><br>
                                                    To keep your account secure, we recommend using a unique password for your Kharido account or using the Kharido Account Access app to sign in. Adobe Account Access’ two-factor authentication makes signing in to your account easier, without needing to remember or change passwords.<br><br>

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
                                                <td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:40px"><img alt="Kharido" src="" width="30" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top" class="CToWUd" data-bit="iit"></td>
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
    ';
	$mail->AltBody  = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
