<?php

require 'model/suportFunctions.php';
require 'model/dbback.php';
require 'PHPMailer/PHPMailerAutoload.php';
$conn = new db();
$connection = $conn->connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = array();   // array to hold validation errors
    $output = array();   // array to pass back data
    if (isset($_POST['type']) && $_POST['type'] == "forgotPassword") {
        $emailId = trim($_POST['emailId']);
        $randomPassword = randomPassword();
        try {
            $statement = $connection->prepare("select email from users where email=:email_id");
            $statement->bindValue(':email_id', $emailId);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
            if (count($result) > 0) {
                $options = ['cost' => 11];
                $stmt = $connection->prepare("UPDATE users SET password='" . password_hash($randomPassword, PASSWORD_BCRYPT, $options) . "' WHERE email='$emailId'");
                $stmt->execute();
                $message = "Hello there,<br/><br/>";
                $message .= "<table width='100%'>";
                $message .= "<tr>";
                $message .= "<td style='text-align:center; font-size:25px; background-color:#D8741E; color:white'><span style='color:black;'>V</span>oucher<span style='color:black;'>H</span>andling</td>";
                $message .= "</tr>";
                $message .= "<tr>";
                $message .= "<td style='text-align:center; padding:10px;'>Your Temporary Password is: <b>$randomPassword</b></td>";
                $message .= "</tr>";
                $message .= "</table>";
                $message .= "<br/><br/><b>Thanks & Regards<br/>Team Voucher Handling</b>";
                $email = explode("@",$emailId);
                $newmail = $emailId;
                // if(isset($email[1]) && $email[1]=='bsa.co.in'){ //update By pankaj
                //     $newmail = $email[0].'@bsacorp.co.in';
                // }
                $conn->sendMail($newmail, "Forgot Password (Voucher Handling)", $message);
                session_start();
                $_SESSION['voucher_temp_password'] = $randomPassword;
                $data['success'] = true;
            } else {
                $errors['error'] = "Invalid Email Id!";
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
    }
}

