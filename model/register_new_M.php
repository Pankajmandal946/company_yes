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
            'register_login_id'   => $this->register_login_id,
            'is_active' => 1
        ];
        $stmt = $this->conn->prepare("SELECT register_login_id FROM ".$this->table_name." WHERE register_login_id = :register_login_id AND is_active=:is_active");
        $stmt->execute($data);
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        $stmt->closeCursor();
        if($count>0) {
            $this->register_login_id = $row['register_login_id'];
            return true;
        } else 
            return false;
    }

    function check_username() {
        $data = [
            'username'   => $this->username,
            'is_active'     => 1
        ];
        $stmt = $this->conn->prepare("SELECT register_login_id FROM ".$this->table_name." WHERE username = :username AND is_active=:is_active");
        $stmt->execute($data);
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        $stmt->closeCursor();
        if($count>0) {
            $this->register_login_id = $row['register_login_id'];
            return true;
        } else 
            return false;
    }

    function generate_password() {
        return password_hash($this->password, PASSWORD_BCRYPT, ["cost"=>12]);
    }
}