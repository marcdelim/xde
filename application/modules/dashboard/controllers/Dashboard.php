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
		if(empty($this->session->userdata('login'))){
			redirect('login');
		}
		if(($this->session->userdata('temp_pass'))){
			redirect('changepass');
		}
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

		$this->app->use_js(array("source"=>"dashboard/deliveryPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/deliveryOTPPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/firstAttempt","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/pickupIb","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/deliveryLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/dispatchLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/failedPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/openItems","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/linehaulLeadtime","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/deliveryPerformance","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/deliveryPerformanceHod","cache"=>false));
		
		$header['header_data'] = "Dashboard";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		
		$this->load->view('index');
		$this->template->adminFooterTpl();
	}

	//graphs
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
				$compute = ($data->del_vol > 0 AND $data->ship_vol > 0) ? ($data->del_vol/$data->ship_vol) * 100 : 0;
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

	public function del_otp_percentage(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_del_otp_percentage($area_id, $area2_id);
		$week_no = array();
		$del_vol = array();
		$otp_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$del_vol[] = $data->del_vol;
				$otp_vol[] = $data->otp_vol;
				$compute = ($data->otp_vol > 0 AND $data->del_vol > 0) ? ($data->otp_vol/$data->del_vol) * 100 : 0 ;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'del_vol' => $del_vol,
				'otp_vol' => $otp_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'del_vol' => [],
				'otp_vol' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function first_attempt(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_first_attempt($area_id, $area2_id);
		$week_no = array();
		$del_vol = array();
		$otp_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$del_vol[] = $data->del_vol;
				$first[] = $data->first;
				$compute = ($data->first > 0 AND $data->del_vol > 0) ? ($data->first/$data->del_vol) * 100 : 0 ;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'del_vol' => $del_vol,
				'first' => $first,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'del_vol' => [],
				'first' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function pickup_ib(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_pickup_ib($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$otp_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'ave' => $ave,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'ave' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function dispatch_leadtime(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_dispatch_leadtime($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$dis_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$dis_vol[] = $data->dis_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'dis_vol' => $dis_vol,
				'ave' => $ave,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'dis_vol' => [],
				'ave' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function del_leadtime(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_del_leadtime($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$del_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$del_vol[] = $data->del_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'del_vol' => $del_vol,
				'ave' => $ave,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'del_vol' => [],
				'ave' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function failed_percentage(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_failed_percentage($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$failed_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$failed_vol[] = $data->failed_vol;
				$compute = ($data->failed_vol > 0 AND $data->ship_vol > 0) ? ($data->failed_vol/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed_vol' => $failed_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'failed_vol' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function open_items(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_open_items($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$open_vol = array();
		$del_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$open_vol[] = $data->open_vol;
				$compute = ($data->open_vol > 0 AND $data->ship_vol > 0) ? ($data->open_vol/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'open_vol' => $open_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function linehaul_leadtime(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$datas = $this->xde->get_linehaul_leadtime($area_id, $area2_id);
		$week_no = array();
		$ship_vol = array();
		$ship_vol = array();
		$trans_vol = array();
		if($datas){
			foreach($datas as $data){
				$week_no[] = $data->week_no;
				$ship_vol[] = $data->ship_vol;
				$trans_vol[] = $data->trans_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['week_no'] = $week_no;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'trans_vol' => $trans_vol,
				'ave' => $ave,
			); 
		}else{
			$result['week_no'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'trans_vol' => [],
				'ave' => [],
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

	public function delivery_performance_hod(){
		$area_id = $this->input->get('area_id');
		$area2_id = str_replace("-", " ",$this->input->get('area2_id'));
		$data = $this->xde->get_delivery_performance($area_id, $area2_id, true);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}


	



	

}