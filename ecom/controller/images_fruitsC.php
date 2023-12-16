<?php  require_once '../model/fruit_cateM.php';
try {
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
        $json = file_get_contents('php://input');
        if(isset($json) && !empty($json)) {
            $request = json_decode($json);
            if(isset($request) && !empty($request)) {
                if(isset($request->action)) {
                    $fruitsCate = new FruitsCate();
                    if($request->action=='add') {
                        $fruitsCate->fruits_name   = $request->fruits_name;
                        if($fruitsCate->check() === false) {
                            $fruitsCate->insert();
                            $response = [
                                'success' => 1,
                                'code' => 200,
                                'msg' => 'Fruits Name successfully added!'
                            ];

                            http_response_code(200);
                            echo json_encode($response);
                        } else {
                            throw new Exception('Fruits Name Already Exists',400);
                        }
                    } else if($request->action=='update') {
                        // print_r($request);exit;
                        $fruitsCate->fruits_id  = $request->fruits_id;
                        $fruitsCate->fruits_name     = $request->fruits_name;
                        $fruitsCate->update();
                            $response = [
                                'success' => 1,
                                'code' => 200,
                                'msg' => 'Categories of Fruit Update Successfully!'
                            ];

                            http_response_code(200);
                            echo json_encode($response);
                    } else if($request->action=='delete') {
                        $fruitsCate->fruits_id = $request->fruits_id;
                        $fruitsCate->delete();
                        $response = [
                            'success' => 1,
                            'code' => 200,
                            'msg' => 'User Type Successfully deleted!',
                        ];

                        http_response_code(200);
                        echo json_encode($response);
                    } else if($request->action=='statusHide') {
                        $fruitsCate->fruits_id = $request->fruits_id;
                        $fruitsCate->fruits_name = $request->fruits_name;
                        $fruitsCate->is_status = $request->is_status;
                        // print_r($fruitsCate);exit;
                        $fruitsCate->statusHide();
                        $response = [
                            'success' => 1,
                            'code' => 200,
                            'msg' => 'Categories of Fruit Successfully Deactivate!',
                        ];

                        http_response_code(200);
                        echo json_encode($response);
                    } else if($request->action=='statusShow') {
                        $fruitsCate->fruits_id = $request->fruits_id;
                        $fruitsCate->fruits_name = $request->fruits_name;
                        $fruitsCate->is_status = $request->is_status;
                        // print_r($fruitsCate);exit;
                        $fruitsCate->statusShow();
                        $response = [
                            'success' => 1,
                            'code' => 200,
                            'msg' => 'Categories of Fruit Successfully Activate!',
                        ];

                        http_response_code(200);
                        echo json_encode($response);
                    } else if($request->action=='get') {
                        $result = [];
                        if(isset($request->fruits_id) && $request->fruits_id>0) {
                            $fruitsCate->fruits_id = $request->fruits_id;
                        }
                        $results = $fruitsCate->get($request);
                        if(isset($request->start)) {
                            $i = $request->start;
                        } else {
                            $i=0;
                            $request->draw=0;
                        }
                        foreach($results as $res) {                        
                            if($res['is_status'] == 1){
                                ++$i;
                                $result [] = [
                                    "s_no"        => $i,
                                    'fruits_id'   => $res['fruits_id'],
                                    "fruits_name" => $res["fruits_name"],
                                    "is_status"   => $res['is_status'],
                                    "action"      => "<a class='edit cursor-pointer' data-id='".$res['fruits_id']."' data-fname='".$res['fruits_name']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;<a class='delete cursor-pointer text-danger' data-id='".$res['fruits_id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>",
                                    "active"      => "<a class='statusHide cursor-pointer text-danger' ids='Hide_".$res["fruits_id"]."' data-id='".$res["fruits_id"]."' data-fname='".$res['fruits_name']."' data-issts='".$res['is_status']."'><i class='fas fa-eye-slash pasword_show' aria-hidden='true' style='margin-left:15px;'></i></a><a class='statusShow cursor-pointer text-danger' style='display:none;' ids='Show_".$res["fruits_id"]."' data-id='".$res["fruits_id"]."' data-fname='".$res['fruits_name']."' data-issts='".$res['is_status']."'><i class='fas fa-eye pasword_hide' aria-hidden='true' style='margin-left:15px;'></i></a>",                                   
                                ];
                            } else{
                                ++$i;
                                $result [] = [
                                    "s_no"        => $i,
                                    'fruits_id'   => $res['fruits_id'],
                                    "fruits_name" => $res["fruits_name"],
                                    "is_status"   => $res['is_status'],
                                    "action"      => "<a class='edit cursor-pointer' data-id='".$res['fruits_id']."' data-fname='".$res['fruits_name']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;<a class='delete cursor-pointer text-danger' data-id='".$res['fruits_id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>",
                                    "active"      => "<a class='statusShow cursor-pointer text-danger' ids='Hide_".$res["fruits_id"]."' data-id='".$res["fruits_id"]."' data-fname='".$res['fruits_name']."' data-issts='".$res['is_status']."'><i class='fas fa-eye pasword_hide' aria-hidden='true' style='margin-left:15px;'></i></a><a class='statusHide cursor-pointer text-danger' style='display:none;' ids='Show_".$res["fruits_id"]."' data-id='".$res["fruits_id"]."' data-fname='".$res['fruits_name']."' data-issts='".$res['is_status']."'><i class='fas fa-eye pasword_hide' aria-hidden='true' style='margin-left:15px;'></i></a>",                                   
                                ];
                            }
                        }
                        $response = [
                            'draw'              => intval($request->draw),
                            'recordsTotal'      => count($results),
                            'recordsFiltered'   => $fruitsCate->get_total_count(),
                            'success'           => 1,
                            'code'              => 200,
                            'msg'               => 'Categories of Fruit Fetch Successfully!',
                            'data'              => $result,
                        ];
                        http_response_code(200);
                        echo json_encode($response);
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
}catch(PDOException $e){
    $response =[

        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage()
    ];
      http_response_code(500);
     echo json_encode($response);

}catch(Exception $e) {
    $response = [
        'success' => 0,
        'code' => $e->getCode(),
        'msg' => $e->getMessage(),
    ];
    // http_response_code($e->getCode());
    echo json_encode($response);
}
?>