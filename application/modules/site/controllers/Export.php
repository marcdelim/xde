<?php

class Export extends MX_Controller {


	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = 'site';
        
        $this->load->module("core/app");
        $this->load->library('PHPExcel/PHPExcel');
        $this->load->library('CSVReader');
    }
	
	public function _remap()
    {
      redirect('site/error');
    }
	
	
	public function excel($aOptions=NULL)
	{
		$this->phpexcel->setActiveSheetIndex($aOptions['active_sheet']);
		
		//name the worksheet
		$this->phpexcel->getActiveSheet()->setTitle($aOptions['worksheet_title']);
		
		//main title settings
		if(isset($aOptions['type']) && $aOptions['type'] == 'dtr_result'){
			$rowStart = 1;
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$headerStyle = array(
								'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '1F497D')),
								'font'  => array('color' => array('rgb' => 'FFFFFF'))
							);
			$border_style= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000'))));
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'1')->applyFromArray($headerStyle);
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'1')->applyFromArray($border_style);
		}else{
			$rowStart = 3;
			$this->phpexcel->getActiveSheet()->setCellValue('A1', $aOptions['main_title']);
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'1')->getFont()->setSize(12);
			$this->phpexcel->getActiveSheet()->mergeCells('A1:'.$aOptions['column_offset'].'1');
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A1:'.$aOptions['column_offset'].'3')->getFont()->setBold(true);
			$this->phpexcel->getActiveSheet()->getStyle('A3:'.$aOptions['column_offset'].'3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$headerStyle = array(
								'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '1F497D')),
								'font'  => array('color' => array('rgb' => 'FFFFFF'))
							);
			$border_style= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000'))));
			$this->phpexcel->getActiveSheet()->getStyle('A3:'.$aOptions['column_offset'].'3')->applyFromArray($headerStyle);
			$this->phpexcel->getActiveSheet()->getStyle('A3:'.$aOptions['column_offset'].'3')->applyFromArray($border_style);
			
			$this->phpexcel->getActiveSheet()->getRowDimension($rowStart)->setRowHeight(30);
		}
	
		if(isset($aOptions['table_data_key_use'])){
			$columns = array_keys($aOptions['table_data'][$aOptions['table_data_key_use']]);
		}else{
			$columns = array_keys($aOptions['table_data'][0]);
		}
		//set column header
		foreach($columns as $key => $val){
			$this->phpexcel->getActiveSheet()->setCellValue($this->common->numToExcelColumn($key+1).$rowStart, strtoupper($val));
			$this->phpexcel->getActiveSheet()->getColumnDimension($this->common->numToExcelColumn($key+1))->setAutoSize(true);
		}
		
		//set table  data
		$rowNum = $rowStart+1;
		foreach($aOptions['table_data'] as $key => $val){
			$cellNum = 1;
			foreach($val as $key1 => $val1){
				$this->phpexcel->getActiveSheet()->setCellValueExplicit($this->common->numToExcelColumn($cellNum).$rowNum, strtoupper($val1),PHPExcel_Cell_DataType::TYPE_STRING);
				$this->phpexcel->getActiveSheet()->getStyle($this->common->numToExcelColumn($cellNum).$rowNum, $val1)->applyFromArray($border_style);
				$cellNum++;
			}
			$rowNum++;
		}
		
		
		 //download and save excel file
		$filename= $aOptions['filename'].'.xls';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	
	}
	
	
	

	
	
}