<?php
require_once '../config/DBConnection.php';

class PductImage{

    Public $pduct_image_id, $fruits_id, $image_name, $product_images, $is_status, $is_active, $created_on, $created_by, $update_on, $updated_by, $table_name, $db, $conn;

    function __construct(){
        $this->pduct_image_id = 0;
        $this->fruits_id = 0;
        $this->image_name = "";
        $this->product_images = "";
        $this->is_active = 1;
        $this->created_by = 0;
        $this->updated_by = 0;
        $this->table_name = "pduct_image";
        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
    }

    public function insert(){
        $data = [
            "image_name"     => $this->image_name,
            "fruits_id"      => $this->fruits_id,
            "product_images" => $this->product_images,
            "is_active"      => $this->is_active,
            "created_by"     => $this->created_by
        ];

        $sql = "INSERT INTO ".$this->table_name." (image_name, fruits_id, product_images, is_active, created_by) VALUES(:image_name, :fruits_id, :product_images, :is_active, :created_by)";
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
            $query = "SELECT pi.pduct_image_id,pi.image_name, pi.product_images,fc.fruits_name 
                FROM ".$this->table_name." pi
                INNER JOIN fruits_categories fc on fc.fruits_id = pi.fruits_id 
                WHERE pi.is_active < :is_active and fc.is_status='1'";

            if (isset($Request->search->value)) {
                $data['search_value'] = '%'.$Request->search->value.'%';
                $query .= " AND image_name LIKE :search_value";
            } 
            if (isset($Request->order) && $Request->order['0']->column > 0) {
                $query .= " ORDER BY ".$Request->order['0']->column." ".$Request->order['0']->dir;
            } else {
                $query .= ' ORDER BY fc.fruits_name asc ';
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
        // echo $debug_query;exit;
        $results = $stmt->fetchAll();
        // print_r($results);exit;
        $count = $stmt->rowCount();
        $stmt->closeCursor();

        if($count > 0){
            foreach($results as $row){
                $output[] = [
                    'pduct_image_id' => $row['pduct_image_id'],
                    'image_name'     => $row['image_name'],
                    'product_images' => $row['product_images'],
                    'fruits_name'    => $row['fruits_name']
                ];
            }
        }
        return $output;



    }

    // Check
    public function check() {

        $data = [
            'image_name'   => $this->image_name,
            'is_active'     => 1,
        ];
        $stmt = $this->conn->prepare("SELECT pduct_image_id FROM ".$this->table_name." WHERE image_name = :image_name AND is_active=:is_active");
        $stmt->execute($data);
        $count = $stmt->rowCount();
        if($count>0) {
            $row = $stmt->fetch();
            $this->fruits_id = $row['pduct_image_id'];
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

    function last_insert_id()
    {
        $stmt = $this->conn->prepare("SELECT LAST_INSERT_ID() as last_id FROM " . $this->table_name);
        $stmt->execute();
        $result = $stmt->fetch();
        $count = $stmt->rowCount();
        $stmt->closeCursor();
        return $result['last_id'];
    }

    function update_bill_path()
    {
        $data = [
            'pduct_image_id' => $this->pduct_image_id,
            'product_images' => $this->product_images,
            'updated_by'     => $this->updated_by
        ];
        $sql = "UPDATE " . $this->table_name . " SET product_images=:product_images ,updated_by=:updated_by WHERE pduct_image_id=:pduct_image_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $stmt->closeCursor();
        return true;
    }


}

?>