<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Raw_data extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
	}
	
	public function index(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/htmlTabletoExcel/dist/jquery.table2excel.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
		
		$this->app->use_js(array("source"=>"raw_data/upload/list","cache"=>false));
		$this->app->use_js(array("source"=>"raw_data/upload/delete","cache"=>false));
		$this->app->use_js(array("source"=>"raw_data/upload/import","cache"=>false));
		$this->app->use_js(array("source"=>"raw_data/upload/create","cache"=>false));
		$this->app->use_js(array("source"=>"raw_data/upload/export","cache"=>false));
		$header['header_data'] = "Data Upload";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('raw_data/index');
		$this->template->adminFooterTpl();
	}

	public function export_template(){
        $headers = [
            "client",
            "tracking_number",
            "status",
            "payment_type",
            "total_price",
            "declared_value",
            "package_length",
            "package_width",
            "package_height",
            "package_weight",
            "shipping_type",
            "first_attempt_status",
            "first_attempt_date",
            "first_attempt_description",
            "second_attempt_description",
            "third_attempt_description",
            "transfer_date",
            "last_status_date",
            "picked_date",
            "last_delivery_date",
            "handover_date",
            "location",
            "created_at",
            "consignee_province",
            "consignee_city",
            "consignee_barangay",
            "port",
            "area",
            "area2",
            "lh",
            "sla",
            "plus_sla",
            "total_sla",
            "volume",
            "delivered",
            "lt",
            "otp",
            "first_attempt_within_lt",
            "first_attempt_dispatch_vol",
            "transfer",
            "fd",
            "fd_reason",
            "open",
            "claims",
            "pickup_to_ho_lt",
            "lh_lt",
            "lm_dispatch_lt",
            "week_no",
            "handover_date2",
            "month",
            "year",
            "m_and_y",
        ];

        $filename = "Raw Data Template";
        $arrHeader = $headers;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($arrHeader, NULL ,'A1');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
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

}