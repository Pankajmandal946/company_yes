<?php

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

// 52,
function getHodByUserId($connection, $userId) {
    $user_id = 0;
    if ($userId > 0) {
        if ($userId == 52) {
            $user_id = 6;
        } else if ($userId == 11) {
            $user_id = 36;
        } else {
            while (true) {
                $query = "select u1.user_id,u.user_type as uuType,u1.user_type from users u 
            inner join users u1 on u1.user_id=u.reporting_to
            where u.user_id=$userId";
                $statement = $connection->prepare($query);
                $statement->execute();
                $row = $statement->fetch();
                $statement->closeCursor();
                if (trim($row['uuType']) == 'HOD') {
                    $user_id = $userId;
                    break;
                } else if (trim($row['user_type']) == 'HOD') {
                    $user_id = $row['user_id'];
                    break;
                } else if (in_array(trim($row['user_type']), ['Director'])) {
                    $user_id = $row['user_id'];
                    break;
                } else {
                    if (trim($row['user_type']) == 'HOD') {
                        $user_id = $row['user_id'];
                        break;
                    }
                }
                $userId = $row['user_id'];
            }
        }
    }
    return $user_id;
}

function getUserIdByType($connection, $userId = 0, $type = "") {
    $user_id = 0;
    if (strlen($type) > 0) {

        while (true) {
            $query = "select u1.user_id,u1.user_type from users u 
            inner join users u1 on u1.user_id=u.reporting_to
            where u.user_id=$userId";
            $statement = $connection->prepare($query);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
           
            if (trim($row['user_type']) == 'Director') {
                $user_id = $row['user_id'];
                break;
            } else {
                if (trim($type) == trim($row['user_type'])) {
                    $user_id = $row['user_id'];
                    break;
                }
               
            }
            // 17-july-2021 changed from $userId to $user_id as $user_id was returnig 6 
            // break; added to overcome infinite loop. 
            $user_id = $row['user_id'];
            break;
        }
       
    } else {
        $query = "select reporting_to from users where user_id=$userId";
        $statement = $connection->prepare($query);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $user_id = $row['reporting_to'];
    }
   
    return $user_id;
}

function getReportingToId($connection, $userId = 0) {
    $user_id = 0;
    if ($userId > 0) {
        $query = "select reporting_to from users where user_id=$userId";
        $statement = $connection->prepare($query);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $user_id = $row['reporting_to'];
    }
    return $user_id;
}

function getOneStepBackId($connection = "", $userId = 0, $voucher_id = 0) {
    $user_id = 0;
    if ($userId > 0) {
        $query = "select created_by as user_id from voucher_history_new where (activity='Voucher Approved' or activity='Voucher Created')  and  visible_to_user_id='$userId' and  voucher_id='$voucher_id' order by created_on desc limit 1;";
        $statement = $connection->prepare($query);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $user_id = $row['user_id'];
    }
    return $user_id;
    
}

function getHFBAFromVoucherId($connection = "", $userId = 0, $voucher_id = 0) {
    $user_id = 0;
    if ($userId > 0) {
        $statement = $connection->prepare("select usertype_name from voucherentry v
        inner join vendor vn on vn.vendor_id=v.vendor_name
        inner join usertype u on u.usertype_id=vn.hfba
        where voucher_id=$voucher_id");
        $statement->execute();
        $oRow = $statement->fetch();
        $statement->closeCursor();
        while (true) {
            $query = "select u1.user_id,u1.user_type from users u 
            inner join users u1 on u1.user_id=u.reporting_to
            where u.user_id=$userId";
            $statement = $connection->prepare($query);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            if ($oRow['usertype_name'] == trim($row['user_type'])) {
                $user_id = $row['user_id'];
                break;
            }
            $userId = $row['user_id'];
        }
    }
    return $user_id;
}

function getAllUsersByHKey($connection, $user_id, $otherUserId = [], $otherResponse = []) {
    $response = [];
    if (count($user_id) > 0) {
        $statement = $connection->prepare("select user_id,concat(user_name,' (',email,')') as user_name from users where reporting_to in (" . implode(",", $user_id) . ")");
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $secUserId = [];
        $response = [];
        foreach ($result as $row) {
            $innerArray = [];
            $innerArray['user_id'] = $row['user_id'];
            $innerArray['user_name'] = $row['user_name'];
            $response[] = $innerArray;
            $secUserId[] = $row['user_id'];
        }
        $otherUserId = array_merge($otherUserId, $secUserId);
        $otherResponse = array_merge($otherResponse, $response);
//        print_r($otherUserId);
        return getAllUsersByHKey($connection, $secUserId, $otherUserId, $otherResponse);
    } else {
//        print_r($otherUserId);
        return $otherResponse;

//        print_r($user_id);
    }
//    return $response;
}

function getNewBillno($date=" today ")
{
    if($date=='' || !strtotime($date))
    {
        $date=" today ";
    }
    include('db.php');
    $bill_date = date('Y-m-d', strtotime($date));
    $billprefix=date('dmY', strtotime($bill_date));
    $qrY="select ifnull(max(CONVERT(SUBSTRING_INDEX( vd1.billno,'-',-1),UNSIGNED INTEGER)),0)+1 as  new_bill_no from voucherentry vd1
    where  vd1.billno like '$billprefix-%'";
    $statement = $connection->prepare($qrY);
    $statement->execute();
    $row = $statement->fetch();
    $billCount = $row['new_bill_no'];
    $statement->closeCursor();
    $newBillNo = date('dmY', strtotime($bill_date)) . "-" . $row['new_bill_no'];
    return $newBillNo;
}
