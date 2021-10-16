<?php

class Import extends MX_Controller {


    
    public function __construct()
    {
        parent::__construct();
        $this->smodule = 'site';
        
        $this->load->module("core/app");
        $this->load->library('PHPExcel/PHPExcel');
        $this->load->library('CSVReader');
    }

    public function _format_date($date){
        return ($date != '' && strtolower($date) != 'none')? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($date)) : '';
    }
	
	public function _format_date_time($datetime){
        return ($datetime != '' && strtolower($datetime) != 'none')? date('h:i:s A', strtotime("-1 hour",PHPExcel_Shared_Date::ExcelToPHP($datetime))) : '';
    }

    public function _format_time($datetime){
        return PHPExcel_Style_NumberFormat::toFormattedString($datetime, 'hh:mm:ss');
    }

    public function Read_Excel($fname=null,$isheet=0,$irow=1,$icol='A'){       
        $inputFileName = $fname;        
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        
        $sheet = $objPHPExcel->getSheet(intval($isheet));
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        for ($row = intval($irow); $row <= $highestRow; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            $rec_tbl[] = $rowData[0];
        }
        return $rec_tbl;
    }
}