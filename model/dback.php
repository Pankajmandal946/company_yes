<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
date_default_timezone_set('Asia/Calcutta');
class db {

    private $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;
    private $port;
    private $Debug;

    function __construct($params = array()) {
        $this->conn = false;
        $this->host = 'localhost'; 
        $this->user = 'root';
        $this->password = ''; 
        // $this->host = 'localhost'; 
        // $this->user = 'root'; 
        // $this->password = ''; 
        $this->baseName = 'company_backend';
        $this->port = '3306';
        $this->debug = true;
        $this->connect();
    }

    function __destruct() {
        $this->disconnect();
    }

    function connect() {
        if (!$this->conn) {
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->baseName . '', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

            if (!$this->conn) {
                $this->status_fatal = true;
                echo 'Connection To Database failed';
                die();
            } else {
                $this->status_fatal = false;
            }
        }

        return $this->conn;
    }

    function disconnect() {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    function getOne($query) {
        $result = $this->conn->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: ' . $query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetch();

        return $reponse;
    }

    function getAll($query) {
        $result = $this->conn->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: ' . $query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetchAll();

        return $reponse;
    }

    function execute($query) {
        if (!$response = $this->conn->exec($query)) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: ' . $query;
            die();
        }
        return $response;
    }

    function ExceptionSendMail($message) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        //$mail->SMTPDebug = 3;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = 'true';
        $mail->Username = 'bsapankajdk@gmail.com';
        $mail->Password = 'qlcv xofb enyp ggos';
        $mail->SMTPSecure = '';
        $mail->Port = '25';
        $mail->isHTML(true);
        $mail->setFrom('bsapankajdk@gmail.com', 'Kharido.com');
        $mail->addAddress('rohit.rajput@bsa.co.in', 'Rohit Rajput');
        $mail->Subject = 'Exception On Voucher Handling' . date('Y-m-d H:i:s');
        $mail->Body = $message;
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
    function sendMail($to,$subject,$message) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        //$mail->SMTPDebug = 3;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = 'true';
        $mail->Username = 'bsapankajdk@gmail.com';
        $mail->Password = 'qlcv xofb enyp ggos';
        $mail->SMTPSecure = '';
        $mail->Port = '25';
        $mail->isHTML(true);
        $mail->setFrom('bsapankajdk@gmail.com', 'Kharido.com');
        $mail->addAddress($to);
        //$mail->addAddress('rohitrajput036@gmail.com', 'Rohit Rajput');
        //$mail->addReplyTo('admin@bsa.co.in', 'info');
        $mail->Subject = $subject;
        $mail->Body = $message;
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

}

?>