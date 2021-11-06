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