<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Fdsplit extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("Fdsplit_model", 'fds');
		include("SimpleXLSX.php");
	}
	
	public function index(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/select2/css/select2.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/js/datatable.js',"cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/Chart.bundle.min","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/graph","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/table","cache"=>false));

		$this->app->use_js(array("source"=>"fdsplit/failedCod","cache"=>false));
		
		$header['header_data'] = "FD Split";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}

	//graphs
	public function failed_cod(){
		$datas = $this->fds->get_failed_cod();
		$week_no = array();
		$ship_vol = array();
		$failed_cod = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$failed_cod[] = $data->failed_cod;
				$compute = ($data->failed_cod > 0 AND $data->ship_vol > 0) ? ($data->failed_cod/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed_cod' => $failed_cod,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'failed_cod' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}


	//tables
	public function delivery_performance(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$data = $this->xde->get_delivery_performance($area_id, $area2_id);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}



	



	

}