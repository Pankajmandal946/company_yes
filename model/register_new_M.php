<?php require_once '../config/DBConnection.php';

class Register{
    public $table_name,$register_login_id, $register_name, $register_email_id, $username, $password,$last_login_time,$last_login_ip, $password_change_time, $is_active, $login_account,$created_by,$created_on, $updated_by, $updated_on, $db, $conn;
    function __construct(){
        $this->register_login_id = 0;
        $this->register_name = "";
        $this->register_email_id = "";
        $this->username = "";
        $this->password = "";
        $this->last_login_time = "";
        $this->last_login_ip = "";
        $this->password_change_time = 0;
        $this->login_account = 1;
        $this->is_active = 1;
        $this->created_by = 0;
        $this->updated_by = 0;
        $this->table_name = 'registerUserLogin_New';
        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
    }

    function insert(){
        $data = [
            'register_name'      => $this->register_name,
            'register_email_id'  => $this->register_email_id,
            'username'           => $this->username,
            'password'           => $this->generate_password($this->password),
            'is_active'          => $this->is_active
        ];
        $sql = "INSERT INTO ".$this->table_name."(register_name, register_email_id, username, password, is_active) VALUES (:register_name, :register_email_id, :username, :password, :is_active)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data);
        $this->user_id = $this->conn->lastInsertId();
        $stmt->closeCursor();
        return true;
    }

    function check() {
        $data = [
            'register_email_id'   => $this->register_email_id,
            'is_active' => 1
        ];
        $stmt = $this->conn->prepare("SELECT register_email_id FROM ".$this->table_name." WHERE register_email_id = :register_email_id AND is_active=:is_active");
        $stmt->execute($data);
        // $last_query = $stmt->queryString;
        // $debug_query = $stmt->_debugQuery();
        // echo $debug_query;exit;
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        $stmt->closeCursor();
        if($count>0) {
            $this->register_email_id = $row['register_email_id'];
            return true;
        } else 
            return false;
    }

    function validate_login() {
        $data = [
            'register_email_id'  => $this->register_email_id,
            'is_active' => 1
        ];
        $stmt = $this->conn->prepare("SELECT register_login_id, register_name, register_email_id, password FROM ".$this->table_name." WHERE register_email_id = :register_email_id AND ".$this->table_name.".is_active=:is_active");
        $stmt->execute($data);
        // $last_query = $stmt->queryString;
        // $debug_query = $stmt->_debugQuery();
        // echo $debug_query;exit;Query();
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        // print_r($row);exit;
        $stmt->closeCursor();
        if($count>0) {  
            if($this->validate_password($this->password, $row['password'])) {
                // print_r($row['password']);exit;
                $data = [
                    'register_login_id'               => $row['register_login_id'],
                    'last_login_time'             => date('Y-m-d H:i:s')
                ];
                $sql = "UPDATE ".$this->table_name." SET last_login_time =:last_login_time 
                WHERE register_login_id=:register_login_id";
                $stmt= $this->conn->prepare($sql);
                $stmt->execute($data);
                $stmt->closeCursor();

                session_start();
                $_SESSION["customerUser_session_status"] = true;
                // $_SESSION["customerUser_user_id"] = $row['user_id'];
                $_SESSION["customerUser_user_login_id"] = $row['register_login_id'];
                $_SESSION["customerUser_name"] = $row['register_name'];
                $_SESSION["customerUser_email_id"] = $row['register_email_id'];
                // $_SESSION["customerUser_mobile_no"] = $row['mobile_no'];
                // $_SESSION["customerUser_user_type"] = $row['user_type'];
                // $_SESSION["customerUser_username"] = $row['username'];
                // print_r($_SESSION);exit;
                return true;
            } else {
                throw new Exception("Invalid Password",401);
            }
        } else {
            throw new Exception('User does not exists',401);
        }
    }

    function validate_password($password='', $db_password='') {
        if(password_verify($password, $db_password)) {
            return true;
        }
        return false;
    }

    function generate_password() {
        return password_hash($this->password, PASSWORD_BCRYPT, ["cost"=>12]);
    }
}