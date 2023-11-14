<?php
require_once '../model/register_new_M.php';

try{
    $json = file_get_contents('php://input');
    if (isset($json) && !empty($json)) {
        $request = json_decode($json);
        $register = new Register();
        $register->conn->beginTransaction();
        // print_r($register);exit;
        if(isset($request) && !empty($request)) {
            if (isset($request->activity)) {
                if($request->activity == 'register_newAcc'){
                    // print_r($request->name);exit;
                    $register->register_name = $request->name;
                    $register->register_email_id = $request->email_id;
                    $register->username = $request->username;
                    $register->password = $request->new_password;
                    $register->password = $request->confirm_new_password;
                    if($register->check() === false) {
                        // print_r('abc');exit;                        
                        if($register->check_username() === false) {
                            $register->insert();  
                            $response = [
                                'success' => 1,
                                'code' => 200,
                                'msg' => 'User Register successfully Done!'
                            ];
                            $register->conn->commit();
                            http_response_code(200);
                            echo json_encode($response);
                        } else {
                            throw new Exception("Username already exists, Please Choose Another Username",400);
                        } 
                    } else {
                        // print_r('def');exit;
                        throw new Exception('Please Choose Another Name, This Name Already Exists',400);
                    }
                } else {
                    throw new Exception('Invalid action type',400);
                }
            } else {
                throw new Exception('Please post request in json format or it can not be blank', 400);
            }
        } else {
            throw new Exception('Invalid JSON',400);
        }
    } else {
        throw new Exception('Please post request in json format or it can not be blank', 400);
    }
} catch (PDOException $e) {
    $response = [
        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage()
    ];
    http_response_code(500);
    echo json_encode($response);
} catch (Exception $e) {
    $response = [
        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage()
    ];
    http_response_code($e->getCode());
    echo json_encode($response);
}

?>