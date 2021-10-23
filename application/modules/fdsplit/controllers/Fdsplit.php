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
		$this->app->use_js(array("source"=>"fdsplit/failedNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/failedCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/failedNonCodTable","cache"=>false));
		
		$header['header_data'] = "FD Split";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}

	//graphs
	public function failed_cod(){
		$datas = $this->fds->get_failed('COD');
		$week_no = array();
		$ship_vol = array();
		$failed = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$failed[] = $data->failed;
				$compute = ($data->failed > 0 AND $data->ship_vol > 0) ? ($data->failed/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed' => $failed,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'failed' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function failed_non_cod(){
		$datas = $this->fds->get_failed('N-COD');
		$week_no = array();
		$ship_vol = array();
		$failed = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$failed[] = $data->failed;
				$compute = ($data->failed > 0 AND $data->ship_vol > 0) ? ($data->failed/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed' => $failed,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'failed' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}


	//tables
	public function failed_cod_tbl(){
		$data = $this->fds->get_failed_table('COD');
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}

	public function failed_non_cod_tbl(){
		$data = $this->fds->get_failed_table('N-COD');
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}



	



	

}