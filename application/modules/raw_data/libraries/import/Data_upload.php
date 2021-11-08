<?php

class Data_upload extends MX_Controller{
    
    public function process($transaction_details = []){
        $data = $this->input->post();
        if(!isset($_FILES['file'])){
            // Check if file exist
            return json_encode($this->common->apiData("error","error","File not found!"));
            exit();
        }
        $file = $_FILES['file'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if(!in_array($extension,['csv'])){
            // Check if file extension is correct
            return json_encode($this->common->apiData("error","error","Invalid file format!"));
            exit();
        }
        $sales_orders_columns = $this->upload_model->field_list(); // Get bed data colums/fields
        $a = [
            array_search('id',array_column($sales_orders_columns,'Field')),
            array_search('port',array_column($sales_orders_columns,'Field')),
            array_search('area',array_column($sales_orders_columns,'Field')),
            array_search('area2',array_column($sales_orders_columns,'Field')),
            array_search('lh',array_column($sales_orders_columns,'Field')),
            array_search('sla',array_column($sales_orders_columns,'Field')),
            array_search('total_sla',array_column($sales_orders_columns,'Field')),
            array_search('volume',array_column($sales_orders_columns,'Field')),
            array_search('delivered',array_column($sales_orders_columns,'Field')),
            array_search('lt',array_column($sales_orders_columns,'Field')),
            array_search('otp',array_column($sales_orders_columns,'Field')),
            array_search('first_attempt_within_lt',array_column($sales_orders_columns,'Field')),
            array_search('first_attempt_dispatch_vol',array_column($sales_orders_columns,'Field')),
            array_search('transfer',array_column($sales_orders_columns,'Field')),
            array_search('fd',array_column($sales_orders_columns,'Field')),
            array_search('fd_reason',array_column($sales_orders_columns,'Field')),
            array_search('open',array_column($sales_orders_columns,'Field')),
            array_search('claims',array_column($sales_orders_columns,'Field')),
            array_search('pickup_to_ho_lt',array_column($sales_orders_columns,'Field')),
            array_search('lh_lt',array_column($sales_orders_columns,'Field')),
            array_search('lm_dispatch_lt',array_column($sales_orders_columns,'Field')),
            array_search('week_no',array_column($sales_orders_columns,'Field')),
            array_search('handover_date2',array_column($sales_orders_columns,'Field')),
            array_search('month',array_column($sales_orders_columns,'Field')),
            array_search('year',array_column($sales_orders_columns,'Field')),
            array_search('m_and_y',array_column($sales_orders_columns,'Field')),

        ];
        foreach($a AS $a){
            // remove data in school_columns
            unset($sales_orders_columns[$a]);
        }
        $sales_orders_columns = array_merge($sales_orders_columns); // Just to reset indexes after unset $a

        $spData = $this->spread_sheet_to_array($file['tmp_name']);
        // $this->common->vd($spData);
        // exit();
         // Convert SP to Array
        $spHeader = $spData[0]; // Get SP header
        unset($spData[0]); // Unset SP header from Array Data
        $aData = [];
        $headerDiff = array_diff(array_column($sales_orders_columns,'Field'),$spHeader);
        if(!$headerDiff){
            foreach($spData AS $key=>$val){
                $arrTmp = [];
                foreach($sales_orders_columns AS $aKey=>$aVal){
                    $i = array_search($aVal['Field'],$spHeader);
                    if($aVal['Null'] == "NO" AND $val[$i] === ""){
                        return json_encode($this->common->apiData("error","error","No value found at Line: ".($key+1)." Column: ".$school_columns[$i]['Field']));
                    }else{
                        $arrTmp[$aVal['Field']] = $val[$i] === "" ? null : trim($val[$i]);
                    }
                }
                $get_details = $this->upload_model->get_ref_data($arrTmp['consignee_province']);
                // $this->common->vd($get_details);
                // exit();
                $date1 =new Datetime($val[23]);
                $date2 =new Datetime($arrTmp['transfer_date']);
                $date3 =new Datetime($arrTmp['last_status_date']);
                $date4 =new Datetime($arrTmp['handover_date']);
                $date5 =new Datetime($arrTmp['created_at']);
                $date6 =new Datetime($arrTmp['first_attempt_date']);

                $arrTmp['port'] = (isset($get_details['port'])) ? $get_details['port'] : "";
                $arrTmp['area'] = (isset($get_details['area_1'])) ? $get_details['area_1'] : "";
                $arrTmp['area2'] = (isset($get_details['area_2'])) ? $get_details['area_2'] : "";
                if($arrTmp['transfer_date'] == "" OR $val[23] ==""){
                    $arrTmp['lh'] = 0;
                }
                else{
                    $date_details =$date1->diff($date2);
                    $hour_to_sec = $date_details->h * 3600;
                    $min_to_sec = $date_details->i * 60;
                    $sec =  $date_details->s;
                    $total_sec = $hour_to_sec + $min_to_sec + $sec;
                    $con_decimal = $total_sec / 86400 ;
                    $arrTmp['lh'] = number_format($date_details->d+$con_decimal,2);
                }
                $del_sla = (isset($get_details['del_sla'])) ? $get_details['del_sla'] : 0;
                $new_date = date_parse($val[23]);
                $hour_to_sec = $new_date['hour'] * 3600;
                $min_to_sec = $new_date['minute'] * 60;
                $sec =  $new_date['second'];
                $sla_total_sec = ($hour_to_sec + $min_to_sec + $sec)/86400;
                $arrTmp['sla'] = number_format($sla_total_sec + $del_sla,2);
                $arrTmp['total_sla'] = number_format($sla_total_sec + $del_sla + $arrTmp['plus_sla'],2);
                $arrTmp['volume'] = number_format($sla_total_sec + $del_sla + $arrTmp['plus_sla'],2);;
                if(in_array($arrTmp['status'],['delivery_successful','pod_returned'])){
                    $arrTmp['delivered'] = 1;
                }
                else{
                    $arrTmp['delivered'] = 0;
                }
                $date_details_lt =$date3->diff($date4);
                $hour_to_sec_lt = $date_details_lt->h * 3600;
                $min_to_sec_lt = $date_details_lt->i * 60;
                $sec_lt =  $date_details_lt->s;
                $total_sec_lt = $hour_to_sec_lt + $min_to_sec_lt + $sec_lt;
                $con_decimal_lt = $total_sec_lt / 86400 ;
                if($arrTmp['last_status_date'] < $arrTmp['handover_date']){
                    $val_sub_lt = -($date_details_lt->d+$con_decimal_lt);
                }
                else{
                    $val_sub_lt = $date_details_lt->d+$con_decimal_lt;
                }
                $day_of_week = date('w', strtotime($arrTmp['last_status_date'])) + 1;
                $arrTmp['lt'] = number_format($val_sub_lt - number_format((($val_sub_lt - $day_of_week + 1) / 7),0) - 1,2);
                // $this->common->vd($arrTmp['lt']);
                // exit();
                if($arrTmp['lt'] < $arrTmp['total_sla']){
                    $arrTmp['otp'] = 1;
                }
                else{
                    $arrTmp['otp'] = 0;
                }
                if(in_array($arrTmp['first_attempt_status'],['delivery_successful'])){
                    $arrTmp['first_attempt_within_lt'] = 1;
                }
                else{
                    $arrTmp['first_attempt_within_lt'] = 0;
                }
                if(in_array($arrTmp['first_attempt_status'],['delivery_successful','first_attempt_failed','redelivery_attempt_failed','failed_delivery_return'])){
                    $arrTmp['first_attempt_dispatch_vol'] = 1;
                }
                else{
                    $arrTmp['first_attempt_dispatch_vol'] = 0;
                }
                if($arrTmp['transfer_date'] == ""){
                    $arrTmp['transfer'] = 0;
                }
                else{
                    $arrTmp['transfer'] = 1;
                }
                if(in_array($arrTmp['status'],['claims','branch_received_rts','failed_delivery_return','main_received_rts','out_for_return','for_return','refused_rts','received_refused_rts','returned','transfer_refused_rts'])){
                    $arrTmp['fd'] = 1;
                }
                else{
                    $arrTmp['fd'] = 0;
                }
                if($arrTmp['fd'] == 1){
                    if($arrTmp['third_attempt_description'] != ""){
                        $arrTmp['fd_reason'] =$arrTmp['third_attempt_description'];
                    }
                    elseif($arrTmp['second_attempt_description'] != ""){
                        $arrTmp['fd_reason'] =$arrTmp['second_attempt_description'];
                    }
                    else{
                        $arrTmp['fd_reason'] =$arrTmp['first_attempt_description'];
                    }
                }
                else{
                    $arrTmp['fd_reason'] = "";
                }

                if(in_array($arrTmp['status'],['accepted_by_courier','accepted_to_branch','accepted_to_warehouse','first_attempt_failed','first_delivery_attempt','for_dispatch','forwarded_to_branch','forwarded_to_hub','picked','redelivery_attempt','redelivery_attempt_failed','released'])){
                    $arrTmp['open'] = 1;
                }
                else{
                    $arrTmp['open'] = 0;
                }

                if(in_array($arrTmp['status'],['claims'])){
                    $arrTmp['claims'] = 1;
                }
                else{
                    $arrTmp['claims'] = 0;
                }

                if($arrTmp['transfer_date'] == "" OR $arrTmp['handover_date'] ==""){
                    $arrTmp['lh_lt'] = 0;
                }
                else{
                    $date_details =$date1->diff($date2);
                    $hour_to_sec = $date_details->h * 3600;
                    $min_to_sec = $date_details->i * 60;
                    $sec =  $date_details->s;
                    $total_sec = $hour_to_sec + $min_to_sec + $sec;
                    $con_decimal = $total_sec / 86400 ;
                    $arrTmp['lh_lt'] = number_format($date_details->d+$con_decimal,2);
                }

                $date_details_ho_lt =$date4->diff($date5);
                $hour_to_sec_ho_lt = $date_details_ho_lt->h * 3600;
                $min_to_sec_ho_lt = $date_details_ho_lt->i * 60;
                $sec_ho_lt =  $date_details_ho_lt->s;
                $total_sec_ho_lt = $hour_to_sec_ho_lt + $min_to_sec_ho_lt + $sec_ho_lt;
                $con_decimal_ho_lt = $total_sec_ho_lt / 86400 ;
                $val_sub_ho_lt = $date_details_ho_lt->d+$con_decimal_ho_lt;
                $day_of_week = date('w', strtotime($arrTmp['handover_date'])) + 1;
                $arrTmp['pickup_to_ho_lt'] = number_format($val_sub_ho_lt - number_format((($val_sub_ho_lt - $day_of_week + 1) / 7),0) - 1,2);

                if($arrTmp['transfer_date'] == "" OR $arrTmp['handover_date'] ==""){
                    $arrTmp['lh_lt'] = 0;
                }
                else{
                    $date_details_lh_lt =$date2->diff($date4);
                    $hour_to_sec_lh_lt = $date_details_lh_lt->h * 3600;
                    $min_to_sec_lh_lt = $date_details_lh_lt->i * 60;
                    $sec_lh_lt =  $date_details_lh_lt->s;
                    $total_sec_lh_lt = $hour_to_sec_lh_lt + $min_to_sec_lh_lt + $sec_lh_lt;
                    $con_decimal_lh_lt = $total_sec_lh_lt / 86400 ;
                    $val_sub_lh_lt = $date_details_lh_lt->d+$con_decimal_lh_lt;
                    $day_of_week = date('w', strtotime($arrTmp['transfer_date'])) + 1;
                    $arrTmp['lh_lt'] = number_format($val_sub_lh_lt - number_format((($val_sub_lh_lt - $day_of_week + 1) / 7),0) - 1,2);
                }

                if($arrTmp['handover_date'] == "" OR $arrTmp['first_attempt_date'] ==""){
                    $arrTmp['lm_dispatch_lt'] = 0;
                }
                else{
                    $date_details_lm_lt =$date6->diff($date4);
                    $hour_to_sec_lm_lt = $date_details_lm_lt->h * 3600;
                    $min_to_sec_lm_lt = $date_details_lm_lt->i * 60;
                    $sec_lm_lt =  $date_details_lm_lt->s;
                    $total_sec_lm_lt = $hour_to_sec_lm_lt + $min_to_sec_lm_lt + $sec_lm_lt;
                    $con_decimal_lm_lt = $total_sec_lm_lt / 86400 ;
                    $val_sub_lm_lt = $date_details_lm_lt->d+$con_decimal_lm_lt;
                    $day_of_week = date('w', strtotime($arrTmp['first_attempt_date'])) + 1;
                    $arrTmp['lm_dispatch_lt'] = number_format($val_sub_lm_lt - number_format((($val_sub_lm_lt - $day_of_week + 1) / 7),0) - 1,2);
                }
                $new_date = date('Y-m-d',strtotime($arrTmp['handover_date']));
                $week_count = date("W", strtotime($new_date));
                $arrTmp['week_no'] = "W-".$week_count;
                $arrTmp['handover_date2'] = $new_date;
                $arrTmp['month'] = date('M',strtotime($arrTmp['handover_date']));
                $arrTmp['year'] = date('y',strtotime($arrTmp['handover_date']));
                $arrTmp['m_and_y'] = $arrTmp['month']."-".$arrTmp['year'];

                $aData[] = $arrTmp;
            }
        }else{
            return json_encode($this->common->apiData("error","error","Missing Column/s! ".implode(',',$headerDiff)));
            exit();
        }


        $this->db->trans_begin();
        $this->upload_model->batch_insert_data($aData);
        if($this->db->trans_status() === false){
			$this->db->trans_rollback();
			return json_encode($this->common->apiData("error","error","An error occurred while saving!"));
		}else{
			$this->db->trans_commit();
			return json_encode($this->common->apiData("success","success","Successfully saved!"));
        }
    }

    private function spread_sheet_to_array($file){
		$sheetData = [];
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		$spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
		return $sheetData;
    }

}
?>