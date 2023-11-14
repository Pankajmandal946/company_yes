<?php
if (isset($_POST['type']) && $_POST['type'] == 'getdispatchsummary') {
    require "../../classes/Excel_lib/PHPExcel/IOFactory.php";
    try {
        $query = "";
        $query ="select
        summary_no_dispactch, vd.company_id, dispatch_date, u1.user_name as hod,  count(*) total_voucher,            
        sum(total) voucher_value,vd.summary_no_dispatch_datetime,
        vd.received_on,upper(c.short_name) comp_name            
        from voucher_history_new v            
        inner join voucherentry vd on v.voucher_id=vd.voucher_id
        inner join company c on c.comp_id=vd.company_id
        inner join exphead ex on ex.exp_id=vd.exp_id
        inner join vendor vn on vn.vendor_id=vd.vendor_name
        left outer join users u3 on u3.user_id=v.visible_to_user_id
        left outer join users u2 on u2.user_id=vd.created_by
        left outer join users u1 on u1.user_id=u2.hod
        where
        ( u3.user_type='Director' and activity not in ('Voucher Approved By QC') and is_looked = 'N'
        AND vd.is_reject='N' and is_visible_to_ac='N' )
        OR
        (u3.user_type='Director'
        and activity in ('Voucher Approved By QC') and is_looked = 'N' AND vd.is_reject='N' )
        OR
        (is_looked = 'N' AND vd.is_reject='N' and is_visible_to_batra='Y' )
        group by summary_no_dispactch
        ORDER BY vd.bill_date,vd.created_on";
        // $query = "select summary_no_dispactch, v.company_id, dispatch_date, vendor_hods.ven_hods as hod,  count(*) total_voucher, sum(total) voucher_value,v.summary_no_dispatch_datetime,v.received_on,upper(c.short_name) comp_name from voucherentry v
        // inner join voucher_history_new vh on (vh.voucher_id=v.voucher_id and activity='Voucher created')
        // inner join company c on c.comp_id=v.company_id
        // INNER JOIN (select vendor.vendor_id,group_concat(users.user_name) as ven_hods,count(vendor.vendor_id) from vendor INNER JOIN vendor_hod ON (vendor.vendor_id = vendor_hod.vendor_id AND vendor_hod.is_active='Y') INNER JOIN users ON (vendor_hod.user_id = users.user_id AND users.is_active='Y') group by vendor.vendor_id) as vendor_hods ON v.vendor_name=vendor_hods.vendor_id
        // left join users u on u.user_id=vh.created_by 
        // left join users u1 on u1.user_id=vh.visible_to_user_id 
        // where is_received='Y' and summary_no_dispatch_datetime>='2023-01-01 00:00:00' and final_approval_by <> 6 and v.is_active='Y' and dispatch_date IS NOT NULL and v.is_reject='N'
        // group by summary_no_dispactch "; 
    
        $statement = $connection->prepare($query);

        $statement->execute();
        $rowCount = $statement->rowCount();
        $result = $statement->fetchAll();
        // print_r($result);exit;
        $statement->closeCursor();
        if ($rowCount > 0) {
            // include("classes/PHPExcel/IOFactory.php");
            //set the desired name of the excel file
            $file_name = time() . 'Dispatchsummary'.'.xlsx';
            $dir_name = '../../../download/';
            $full_name = $dir_name . $file_name;
            if (!is_dir($dir_name)) {
                mkdir($dir_name, 0777);
            }
            if (file_exists($full_name)) {
                unlink($full_name);
            }
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");
        
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $ctr = 1;
            $prefix = 'X';
            // $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                ->setCellValue('A1', 'S. No.')
                ->setCellValue('B1', 'Dispatch Summary (DS) No')
                ->setCellValue('C1', 'Date of DS')
                ->setCellValue('D1', 'Name of the HOD')
                ->setCellValue('E1', 'No of Vouchers in that DS')
                ->setCellValue('F1', 'Total Value of DS')
                ->setCellValue('G1', 'Received In Account Team');
        
            $i = 0;
            $arraycount =  [];
            foreach ($result as $row) {
                ++$i;
                ++$ctr;
                // print_r($row);exit;
                // $summary_no_dispatch_datetime = date('d-m-Y', strtotime($row['summary_no_dispatch_datetime']));
            //    $received_on = date('Y-m-d', strtotime($row['dispatch_date']));
                if ($row['summary_no_dispactch'] >= 10000) {
                    switch ($row['company_id']) {
                        case 1:
                            $prefix = 'C';
                            break;
                        case 2:
                            $prefix = 'L';
                            break;
                        case 3:
                            $prefix = 'I';
                            break;
                        case 4:
                            $prefix = 'D';
                            break;
                        case 5:
                            $prefix = 'B';
                            break;
                        case 6:
                            $prefix = 'Q';
                            break;
                        default:
                            $prefix = 'X';
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue('A' . ($ctr), $i);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . ($ctr), $prefix . '-' . $row['summary_no_dispactch']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . ($ctr), $row['dispatch_date']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . ($ctr), $row['hod']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . ($ctr), $row['total_voucher']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . ($ctr), $row['voucher_value']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . ($ctr), date('Y-m-d', strtotime($row['dispatch_date'])));
                
            }
            $objPHPExcel->getActiveSheet()->setTitle('sheet');
            $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getAlignment()->setWrapText(true);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            try {
                $objWriter->save($full_name);
            } catch (Exception $ex) {
                $errrr = $errors['error'] = $ex . Message;
                $data['success'] = false;
                $data['errors'] = $errors;
                echo json_encode($data);
            }
            if ($ctr > 0) {
                if ($_SERVER['HTTP_HOST'] == 'localhost') {
                    $file_name = 'http://localhost/download/' . $file_name;
                    //$file_name = 'http://7/download/' . $file_name;
                } else {
                    $file_name = 'https://www.bsaapps.co.in/download/' . $file_name;
                    //$file_name = '203.115.106.3/download/' . $file_name;
                }
        
                $data['success'] = true;
                $data['filename'] = $file_name;
            }
        } else {
            $errors['error'] = "No Record Found!";
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        
    } catch (Exception $ex) {
        $errors['error'] = $ex->getMessage();
        $data['success'] = false;
        $data['errors'] = $errors;
    } catch (PDOException $ex) {
        $errors['error'] = $ex->getMessage();
        $data['success'] = false;
        $data['errors'] = $errors;
    }
    echo json_encode($data);
}
?>