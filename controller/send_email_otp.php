<?php
require_once '../model/dback.php';
require_once '../model/costumor_user.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$costumor_user = new Costumer_Userlogin();
$conn = new db();
$connection = $conn->connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = array();   // array to hold validation errors
    $output = array();   // array to pass back data
    if (isset($_POST['type']) && $_POST['type'] == "sand_otpEmail") {
        $register_email_id = trim($_POST['user_email_id']);
        $randomOTP = $costumor_user->randomOTP();
        // print_r($randomOTP);exit;
        try {
            $statement = $connection->prepare("select register_email_id from registerUserLogin_New where register_email_id=:register_email_id");
            $statement->bindValue(':register_email_id', $register_email_id);
            $statement->execute();
            $count = $statement->rowCount();
            $result = $statement->fetch();
            $statement->closeCursor();
            if (isset($count) && $count == 0) {
                $message = '';
                $message .= '<table width="100%" bgcolor="#E4E4E4" style="background-color:#e4e4e4" border="0" cellpadding="0" cellspacing="0" role="presentation">';
                    $message .= ' <tbody>';
                        $message .= ' <tr>';    
                            $message .= ' <td>';  
                                $message .= '<table align="center" width="600" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:600px">';  
                                    $message .= ' <tbody>';
                                    $message .='<tr>';
                                        $message .='<td bgcolor="#ffffff" style="border-top:4px solid #fa0f00;background-color:#ffffff;padding-bottom:60px">';
                                            $message .= ' <table align="center" width="500" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:500px">'; 
                                                $message .= '<tbody>'; 
                                                    $message .='<tr>';
                                                        $message .='<td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:50px"><img alt="Kharido" src="theme/img/sandOtp.png" width="50%" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top" class="CToWUd" data-bit="iit"></td>';
                                                    $message .='</tr>';
                                                    $message .='<tr>';
                                                        $message .='<td style="color:#505050;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:18px;line-height:26px;padding-top:65px">';
                                                        $message .='Your verification code is:<br><br>
                                                        <strong style="font-size:28px;line-height:32px">' . $randomOTP . '</strong><br><br>
                                                        Your account can’t be accessed without this verification code, even if you didn’t submit this request.<br><br>
                                                        To keep your account secure, we recommend using a unique password for your Kharido account or using the Kharido Account Access app to sign in. Adobe Account Access’ two-factor authentication makes signing in to your account easier, without needing to remember or change passwords.<br><br>';
                                                        $message .='</td>';
                                                    $message .='</tr>';
                                                $message .= '</tbody>';  
                                            $message .= '</table>'; 
                                        $message .= ' <td>';   
                                    $message .='</tr>';
                                    $message .='<tr>';
                                        $message .='<td bgcolor="#F5F5F5" style="background-color:#f5f5f5">';
                                            $message .='<table align="center" width="500" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:500px">';
                                                $message .= ' <tbody>';
                                                    $message .='<tr>';
                                                        $message .='<td style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;padding-top:40px"><img alt="Kharido" src="" width="30" height="auto" border="0" hspace="0" vspace="0" style="color:#ff3c00;font-family:adobe-clean,Helvetica Neue,Helvetica,Verdana,Arial,sans-serif;font-size:12px;line-height:18px;display:block;vertical-align:top" class="CToWUd" data-bit="iit"></td>';
                                                    $message .='</tr>';
                                                $message .= ' </tbody>';
                                            $message .='</table>';
                                        $message .='</td>';
                                    $message .='</tr>';
                                    $message .= ' <tbody>';
                                $message .= ' </table>';  
                            $message .= ' </td>';     
                        $message .= '</tr>';
                    $message .= '</tbody>';
                $message .= '</table>';
                $message .= '<br/><br/><b>This message was Verification code by Karido Web Services</b>';
                // $email = explode("@",$emailId);
                // $newmail = $emailId;
                // if(isset($email[1]) && $email[1]=='bsa.co.in'){ //update By pankaj
                //     $newmail = $email[0].'@bsacorp.co.in';
                // }
                $conn->sendMail($register_email_id, "Verification code (Karido Web Services)", $message);
                session_start();
                $_SESSION['send_otpMail'] = $randomOTP;
                $data['randomOtp'] = $randomOTP;
                $data['success'] = true;
            } else {
                $errors['error'] = "This Email ID Already Exists";
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        } catch (Exception $e) {
            $conn->ExceptionSendMail("Page: UserController.php | Action: addNewUser | " . $e->getMessage());
            $errors['error'] = $e->getMessage();
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        echo json_encode($data);
    } else if (isset($_POST['type']) && $_POST['type'] == "enter_otpEmail") {
        // print_r($_POST);exit;
        $rendemotp = $_POST['randomOtp'];
        if($rendemotp === $_POST['enter_otp']){
            $data['success'] = true;
            $data['rendemotp'] = $rendemotp;
        }else{
            $errors['error'] = "Please Enter Valid Verification Code";
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        echo json_encode($data);
    }
}

