<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Dashboard extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("XDE_model", 'xde');
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
		$this->app->use_js(array("source"=>"dashboard/graph","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/graph","cache"=>false));
		
		
		$header['header_data'] = "Dashboard";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}

	public function del_percentage(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_del_percentage($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$del_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$del_vol[] = $data->del_vol;
				$compute = ($data->del_vol/$data->ship_vol) * 100;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'del_vol' => $del_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'del_vol' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}



	

}