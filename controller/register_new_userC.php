<?php
require_once '../model/register_new_M.php';

$register = new Register();

$register->conn->beginTransaction();

try {
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
        $json = file_get_contents('php://input');
        if(isset($json) && !empty($json)) {
            $request = json_decode($json);
            if(isset($request) && !empty($request)) {
                // ADD UPDATE DELETE FETCH
                if(isset($request->activity)) {
                    if($request->activity=='register_newAcc') {
                        // print_r($request->name);exit;
                        $register->register_name = $request->name;
                        $register->register_email_id = $request->email_id;
                        // $register->username = $request->username;
                        $register->password = $request->new_password;
                        $register->password = $request->confirm_new_password;
                        
                        if($register->check() === false) {
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
                            throw new Exception('User Name Already Exists',400);
                        }
                    } else if ($request->activity == 'login') {
                        $register->register_email_id = $request->user_email_id;
                        $register->password = $request->password;
                        $register->password = $request->password;
                        $register->password = $request->password;
                        if ($register->validate_login()) {
                            // print_r($register);exit;
                            $response = [
                                'success' => 1,
                                'code' => 200,
                                'msg' => 'Valid Login Details!'
                            ];
            
                            http_response_code(200);
                            echo json_encode($response);
                        } else {
                            throw new Exception('Please post request in json format or it can not be blank', 400);
                        }
                    } else {
                        throw new Exception('Invalid action type',400);
                    }
                } else {
                    throw new Exception('action key missing in request body',400);
                }
            } else {
                throw new Exception('Invalid JSON',400);
            }
        } else {
            throw new Exception('Request body missing',400);
        }
    } else {
        throw new Exception('Invalid Request METHOD - METHOD must be POST',400);
    }
} catch(PDOException $e) {
    $register->conn->rollBack();
    $response = [
        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage()
    ];
    http_response_code(500);
    echo json_encode($response);
} catch(Exception $e) {
    $register->conn->rollBack();
    $response = [
        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage()
    ];
    http_response_code($e->getCode());
    echo json_encode($response);
}

?>
