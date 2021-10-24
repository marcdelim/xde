<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Trend extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("Trend_model", 'trend');
		include("SimpleXLSX.php");
	}
	
	public function index(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/select2/css/select2.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/js/datatable.js',"cache"=>false));
		$this->app->use_js(array("source"=>"trend/Chart","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/graph","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/table","cache"=>false));

		$this->app->use_js(array("source"=>"trend/weeklyTrend","cache"=>false));
		$this->app->use_js(array("source"=>"trend/weeklyTrendTable","cache"=>false));
		$this->app->use_js(array("source"=>"trend/weeklyVolumeSharing","cache"=>false));
		$this->app->use_js(array("source"=>"trend/weeklyVolumeSharingTable","cache"=>false));

		$this->app->use_js(array("source"=>"trend/volumePercent","cache"=>false));
		
		$header['header_data'] = "Weekly Trend";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}

	//graphs
	public function weekly_trend(){
		$datas = $this->trend->get_weekly_volume();
		$week_no = array();
		$gma = array();
		$north = array();
		$south = array();
		$visayas = array();
		$mindanao = array();
		$volume = array();
		$ave = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$gma[] = $data->gma;
				$north[] = $data->north;
				$south[] = $data->south;
				$visayas[] = $data->visayas;
				$mindanao[] = $data->mindanao;
				$volume[] = $data->volume;
				$ave[] = $data->ave;
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'gma' => $gma,
				'north' => $north,
				'south' => $south,
				'visayas' => $visayas,
				'mindanao' => $mindanao,
				'volume' => $volume,
				'ave' => $ave
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'gma' => $gma,
				'north' => $north,
				'south' => $south,
				'visayas' => $visayas,
				'mindanao' => $mindanao,
				'volume' => $volume,
				'ave' => $ave
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function volume_percentage(){
		$count = $this->trend->get_count();
		$datas = $this->trend->get_volume_percentage($count->count);
		$area = array();
		$percentage = array();
		
		if($datas){
			foreach($datas as $data){
				$area[] = $data->area;
				$percentage[] = $data->percentage;
				
			}
	
			$result['area'] = $area;
			$result['data'] = array(
				'percentage' => $percentage,
				
			); 
		}else{
			$result['area'] = [];
			$result['data'] = array(
				'percentage' => $percentage,
				
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}


	//tables
	public function trend_table(){
		$data = $this->trend->get_weekly_table_volume();
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		echo json_encode($data);
		exit(0);
	}
	
	public function volume_sharing_table(){
		$count = $this->trend->get_count();

		$data = $this->trend->get_volume_sharing_table($count->count);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		echo json_encode($data);
		exit(0);
	}
}