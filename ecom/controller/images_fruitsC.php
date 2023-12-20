<?php  
require_once '../model/images_fruitsM.php';
require_once '../helper/common.php';

try {
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
        $json = file_get_contents('php://input');
        if(isset($json) && !empty($json)) {
            $request = json_decode($json);
            if(isset($request) && !empty($request)) {
                if(isset($request->action)) {
                    $pdrctImg = new PductImage();
                    @session_start();
                    $user_id = $_SESSION["c_x_user_id"];
                    if($request->action=='add') {
                        $pdrctImg->pduct_image_id = $request->pduct_image_id;
                        $pdrctImg->fruits_id      = $request->fruits_id;
                        $pdrctImg->image_name     = $request->image_name;
                        if ($pdrctImg->insert()) {
                            $pduct_image_id = $pdrctImg->last_insert_id();
                            if (isset($request->image_file_base64) && $request->image_file_base64 != '') {
                                $file_name = $pduct_image_id . '_' . date('YmdHis');
                                if (createFileFromBase64AllExtn($request->image_file_base64, "../upload_images/", $file_name)) {
                                    $pdrctImg->pduct_image_id = $pduct_image_id;
                                    $pdrctImg->product_images = $file_name . '.' . get_string_between($request->image_file_base64, '/', ';base64');
                                    print_r($pdrctImg);exit;

                                }
                            } else {
                                $response = [
                                    'success' => 1,
                                    'code' => 200,
                                    'msg' => 'Fruits Name successfully added!'
                                ];

                                http_response_code(200);
                                echo json_encode($response);
                            }
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
                        if(isset($request->pduct_image_id) && $request->pduct_image_id>0) {
                            $pdrctImg->pduct_image_id = $request->pduct_image_id;
                        }
                        $results = $pdrctImg->get($request);
                        if(isset($request->start)) {
                            $i = $request->start;
                        } else {
                            $i=0;
                            $request->draw=0;
                        }
                        // print_r($results);exit;
                        foreach($results as $res) {
                            ++$i;
                            // $pductImgs = '<button type="button" style="margin-left: 41px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            //     <i class="fas fa-folder-open" style="font-size:25px;"></i>
                            //     </button>
                            //     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            //         <div class="modal-dialog modal-dialog-centered" role="document">
                            //             <div class="modal-content">
                            //             <div class="modal-header">
                            //                 <h5 class="modal-title" id="exampleModalLongTitle">Images</h5>
                            //                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            //                 <span aria-hidden="true">&times;</span>
                            //                 </button>
                            //             </div>
                            //             <div class="modal-body">'.$res["product_images"].'</div>
                            //             <div class="modal-footer">
                            //                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            //             </div>
                            //             </div>
                            //         </div>
                            //     </div>';
                            
                            $result [] = [
                                "s_no"        => $i,
                                'pduct_image_id' => $res['pduct_image_id'],
                                "fruits_name"    => $res['fruits_name'],
                                'image_name'     => $res['image_name'],
                                "product_images" => $res["product_images"],
                                "action"         => "<a class='edit cursor-pointer' data-id='".$res['pduct_image_id']."' data-fname='".$res['image_name']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;<a class='delete cursor-pointer text-danger' data-id='".$res['pduct_image_id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>",
                            ];
                        }
                        $response = [
                            'draw'              => intval($request->draw),
                            'recordsTotal'      => count($results),
                            'recordsFiltered'   => $pdrctImg->get_total_count(),
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