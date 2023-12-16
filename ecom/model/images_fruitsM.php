<?php
require_once '../config/DBConnection.php';

class FruitsCate{

    Public $pduct_image_id, $fruits_id, $image_name, $product_images, $is_status, $is_active, $created_on, $created_by, $update_on, $update_by, $table_name, $db, $conn;

    function __construct(){
        $this->pduct_image_id = "";
        $this->fruits_id = "";
        $this->image_name = "";
        $this->product_images = "";
        $this->is_active = 1;
        $this->is_status = 1;
        $this->created_by = 0;
        $this->updated_by = 0;
        $this->table_name = "pduct_image";
        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
    }

    public function insert(){
        $data = [
            "image_name"     => $this->image_name,
            "product_images" => $this->product_images,
            "is_active"      => $this->is_active,
            "is_status"      => $this->is_status,
            "created_by"     => $this->created_by
        ];

        $sql = "INSERT INTO ".$this->table_name." (image_name, product_images, is_active, is_status, created_by) VALUES(:image_name, :product_images, :is_active, :is_status, :created_by)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        // $last_query = $stmt->queryString;
        // $debug_query = $stmt->_debugQuery();
        // echo $debug_query;exit;
        $last_query = $stmt->queryString;
        return true;
    }

    // Update 
    public function update(){
        $data = [
            "fruits_id"   => $this->fruits_id,
            "fruits_name" => $this->fruits_name,
            "is_active"   => $this->is_active,
           
        ];
        // print_r($data);exit;
        $sql = "UPDATE ".$this->table_name." SET fruits_name = :fruits_name, is_active = :is_active WHERE fruits_id = :fruits_id AND is_active = :is_active";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return true;
    }


    //Delete
    public function delete(){
        $data = [
            "fruits_id"  => $this->fruits_id,
            "is_active"  => 2
        ];
        $sql = "UPDATE ".$this->table_name." SET is_active = :is_active WHERE fruits_id = :fruits_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return true;
    }

    //Status Hide
    public function statusHide(){
        $data = [
            "fruits_id"  => $this->fruits_id,
            "is_status"  => 2
        ];
        $sql = "UPDATE ".$this->table_name." SET is_status = :is_status WHERE fruits_id = :fruits_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return true;
    }

    //Status Show
    public function statusShow(){
        $data = [
            "fruits_id"  => $this->fruits_id,
            "is_status"  => 1
        ];
        $sql = "UPDATE ".$this->table_name." SET is_status = :is_status WHERE fruits_id = :fruits_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    
    // Get
    public function get($Request = []){
        $output = [];
        $data = [
            "is_active"  => 2
        ];

        if(!empty($Request)){
            $query = "SELECT image_name, product_images,is_status FROM ".$this->table_name." WHERE is_active < :is_active";

            if (isset($Request->search->value)) {
                $data['search_value'] = '%'.$Request->search->value.'%';
                $query .= " AND image_name LIKE :search_value";
            } 
            if (isset($Request->order) && $Request->order['0']->column > 0) {
                $query .= " ORDER BY ".$Request->order['0']->column." ".$Request->order['0']->dir;
            } else {
                $query .= ' ORDER BY image_name asc ';
            }
            if (isset($Request->length) && $Request->length != -1) {
                $query .= ' LIMIT ' . $Request->start. ', ' . $Request->length;
            }

        }else{
            $query = "SELECT * FROM ".$this->$table_name." WHERE is_active < :is_active";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        // $last_query = $stmt->queryString;
        // $debug_query = $stmt->_debugQuery();
        $results = $stmt->fetchAll();
        $count = $stmt->rowCount();
        $stmt->closeCursor();

        if($count > 0){
            foreach($results as $row){
                $output[] = [
                    'fruits_id'  => $row['fruits_id'],
                    'fruits_name'=> $row['fruits_name'],
                    'is_status'=> $row['is_status']
                ];
            }
        }
        return $output;



    }

    // Check
    public function check() {

        $data = [
            'fruits_name'   => $this->fruits_name,
            'is_active'     => 1,
        ];
        $stmt = $this->conn->prepare("SELECT fruits_id FROM ".$this->table_name." WHERE fruits_name = :fruits_name AND is_active=:is_active");
        $stmt->execute($data);
        $count = $stmt->rowCount();
        if($count>0) {
            $row = $stmt->fetch();
            $this->fruits_id = $row['fruits_id'];
            return true;
        } else 
            return false;
    }

    function get_total_count(){
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name." WHERE is_active < 2");
        $stmt->execute();
        $results = $stmt->fetchAll();
        $count = $stmt->rowCount();
        $stmt->closeCursor();
        return $count;
    }





}

?>