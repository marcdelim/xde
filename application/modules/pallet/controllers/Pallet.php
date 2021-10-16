<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Pallet extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("Pallet_model", 'item_master');
		include("SimpleXLSX.php");
		include("fpdf.php");
	}
	
	public function index(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/select2/css/select2.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/js/datatable.js',"cache"=>false));
		
		$header['header_data'] = "Pallet";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		if($this->input->post()){
			$this->do_upload();
			$printing = $this->create_pallet();
			$this->create_pdf($printing);
		}
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}


	function download($file_name){

		$dir = "pod/"; // trailing slash is important
		$file = $dir . $file_name;

		if (file_exists($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$file_name);
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
		
	}

	function do_upload(){
		
		$this->load->library('upload');
		$path = $_FILES['inbound']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$ctr = 1;
		$file_name = 'inbound.xlsx';
		$_FILES['inbound']['name'] = $file_name;

		$this->upload->initialize($this->set_upload_options());
		$this->upload->do_upload('inbound');
		return $file_name;
		
	}

	function set_upload_options(){   
		//upload an image options
		$config = array();
		$config['upload_path'] = './attachments/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|zip|xls|xlsx|doc|docx|txt';
		$config['max_size']      = '0';
		$config['overwrite']     = true;

		return $config;
	}

	function create_pallet(){
		$xlsx = SimpleXLSX::parse('attachments/inbound.xlsx');
		$printing = array();
		
		$this->db->trans_start();
		for($i= 1; $i < sizeof($xlsx->rows()) ; $i++){
			
			$item = $this->item_master->get_by_attribute('mmi_code', $xlsx->rows()[$i][5]);
			if($item){
				if($xlsx->rows()[$i][7] > $item->case_per_pallet){
					$fix_page = $xlsx->rows()[$i][7]/$item->case_per_pallet;
					if(is_int($fix_page)){
						$total_pages = $fix_page;
					}else{
						$total_pages = floor($fix_page) + 1;
					}
					$page_no = 0;
					$remaining_qty = $xlsx->rows()[$i][7];
					while($remaining_qty != 0){
						$page_no++;
						if($remaining_qty >  $item->case_per_pallet){
							$remaining_qty = $remaining_qty - $item->case_per_pallet;
							$print_qty = $item->case_per_pallet;
						}else{
							$print_qty = $remaining_qty;
							$remaining_qty = 0;
						}
						$printing[] = array(
							'date_received' 	=> $xlsx->rows()[$i][0],
							'trucker' 			=> $xlsx->rows()[$i][1],
							'plate_no' 			=> $xlsx->rows()[$i][2],
							'idts' 				=> $xlsx->rows()[$i][3],
							'expiry_date' 		=> $xlsx->rows()[$i][4],
							'mmi_code' 			=> $xlsx->rows()[$i][5],
							'item_description'	=> $xlsx->rows()[$i][6],
							'cases'				=> $print_qty,
							'uom' 				=> $xlsx->rows()[$i][8],
							'pallet_count' 		=> $page_no."/".$total_pages,
							'checker'			=> $xlsx->rows()[$i][9]
						);
						
						
					}
					
				}else{
					$printing[] = array(
						'date_received' 	=> $xlsx->rows()[$i][0],
						'trucker' 			=> $xlsx->rows()[$i][1],
						'plate_no' 			=> $xlsx->rows()[$i][2],
						'idts' 				=> $xlsx->rows()[$i][3],
						'expiry_date' 		=> $xlsx->rows()[$i][4],
						'mmi_code' 			=> $xlsx->rows()[$i][5],
						'item_description'	=> $xlsx->rows()[$i][6],
						'cases'				=> $xlsx->rows()[$i][7],
						'uom' 				=> $xlsx->rows()[$i][8],
						'pallet_count' 		=> " 1/1",
						'checker'			=> $xlsx->rows()[$i][9]
					);
				}
			}else{
				pr("MMI Code: ". $xlsx->rows()[$i][5] . " doesn't exist in master data.");
				die();
				
			}
	
		}
		
		return $printing;
		

	}

	function create_pdf($printings){
		$pdf = new FPDF('P','mm',array(152.4,101.6));
		$pdf->SetMargins(6,2,6);
		$pdf->SetAutoPageBreak(false,0);
		foreach($printings as $printing){
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',35);
			
			$pdf->Cell(0,20, date("m-d-Y", strtotime($printing['date_received'])), 0, 0, 'C');
			$pdf->SetFont('Arial','B',30);
			$pdf->ln(5);
			//$pdf->Line(0, 18, 150-20, 18);
			$strlen = strlen($printing['trucker']."-".$printing['plate_no']);
			//print_r($strlen);die();
			if($strlen > 14){
				$pdf->SetFont('Arial','B',20);
			}
			$pdf->Cell(0, 43, $printing['trucker']."-".$printing['plate_no'], 0, 0, 'C');
			$pdf->ln(5);
			$pdf->SetFont('Arial','B',30);
			//$pdf->Line(0, 33, 150-20, 33);
			$pdf->Cell(0,60, $printing['idts'],0, 0, 'C');
			$pdf->ln(5);
			//$pdf->Line(0, 45, 150-20, 45);
			$pdf->SetFont('Arial','B',50);
			$pdf->Cell(0,85, date("m-d-Y", strtotime($printing['expiry_date'])),0, 0, 'C');
			$pdf->ln(5);
			$pdf->SetFont('Arial','BU',40);
			$pdf->Cell(0,105, $printing['mmi_code'],0, 0, 'C');
			$pdf->ln(5);
		
			$pdf->SetFont('Arial','',22);
			$pdf->Cell(0,120, substr($printing['item_description'], 0, 18),0, 0, 'C');
			$pdf->ln(2);
			$pdf->Cell(0,140, substr($printing['item_description'], 18, 18),0, 0, 'C');
			$pdf->ln(2);
			$pdf->Cell(0,160, substr($printing['item_description'], 36, 18),0, 0, 'C');
			$pdf->ln(2);
			$pdf->Cell(0,180, substr($printing['item_description'], 54, 18),0, 0, 'C');
			$pdf->ln(2);
			//$pdf->Line(0, 133, 150-20, 133);
			$pdf->SetFont('Arial','B',35);
			$pdf->Cell(0,210, $printing['cases'].' '.$printing['uom'],0, 0, 'L');
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(0,210, $printing['checker'].' - '.$printing['pallet_count'],0, 0, 'R');
			
			
		}
		$pdf->Output(); 
       
	}



	

}