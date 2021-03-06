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
		$this->load->model("Xde_model", 'xde');
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

		$this->app->use_js(array("source"=>"dashboard/weekly/deliveryPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/deliveryOtpPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/firstAttempt","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/pickupIb","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/deliveryLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/dispatchLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/failedPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/openItems","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/weekly/linehaulLeadtime","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/weekly/deliveryPerformance","cache"=>false));
		
		$header['header_data'] = "Dashboard";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		$data['areas'] = $this->xde->find_all_area() ? $this->xde->find_all_area() : [];
		$data['area2s'] = $this->xde->find_all_area2() ? $this->xde->find_all_area2() : [];
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		$data['payments'] = $this->xde->find_all_payment() ? $this->xde->find_all_payment() : [];
		$this->load->view('index', $data);
		$this->template->adminFooterTpl();
	}

	public function daily(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/select2/css/select2.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/js/datatable.js',"cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/Chart.bundle.min","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/graph","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/table","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/daily/deliveryPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/deliveryOtpPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/firstAttempt","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/pickupIb","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/deliveryLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/dispatchLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/failedPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/openItems","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/daily/linehaulLeadtime","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/daily/deliveryPerformance","cache"=>false));
		
		$header['header_data'] = "Daily Dashboard";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		$data['areas'] = $this->xde->find_all_area() ? $this->xde->find_all_area() : [];
		$data['area2s'] = $this->xde->find_all_area2() ? $this->xde->find_all_area2() : [];
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		$data['payments'] = $this->xde->find_all_payment() ? $this->xde->find_all_payment() : [];
		$this->load->view('daily', $data);
		$this->template->adminFooterTpl();
	}

	public function monthly(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/select2/css/select2.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/js/datatable.js',"cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/Chart.bundle.min","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/graph","cache"=>false));
		$this->app->use_css(array("source"=>"dashboard/table","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/monthly/deliveryPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/deliveryOtpPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/firstAttempt","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/pickupIb","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/deliveryLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/dispatchLeadtime","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/failedPercentage","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/openItems","cache"=>false));
		$this->app->use_js(array("source"=>"dashboard/monthly/linehaulLeadtime","cache"=>false));

		$this->app->use_js(array("source"=>"dashboard/monthly/deliveryPerformance","cache"=>false));
		
		$header['header_data'] = "Monthly Dashboard";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		
		$data['areas'] = $this->xde->find_all_area() ? $this->xde->find_all_area() : [];
		$data['area2s'] = $this->xde->find_all_area2() ? $this->xde->find_all_area2() : [];
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		$data['payments'] = $this->xde->find_all_payment() ? $this->xde->find_all_payment() : [];
		$this->load->view('monthly', $data);
		$this->template->adminFooterTpl();
	}

	//graphs
	public function del_percentage(){
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_del_percentage($group, $area, $area2, $province, $city, $payment);
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$del_vol[] = $data->del_vol;
				$compute = ($data->del_vol > 0 AND $data->ship_vol > 0) ? ($data->del_vol/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'del_vol' => $del_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_del_otp_percentage($group, $area, $area2, $province, $city, $payment);
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$del_vol[] = $data->del_vol;
				$otp_vol[] = $data->otp_vol;
				$compute = ($data->otp_vol > 0 AND $data->del_vol > 0) ? ($data->otp_vol/$data->del_vol) * 100 : 0 ;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'del_vol' => $del_vol,
				'otp_vol' => $otp_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_first_attempt($group, $area, $area2, $province, $city, $payment);
		
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$del_vol[] = $data->del_vol;
				$first[] = $data->first;
				$compute = ($data->first > 0 AND $data->del_vol > 0) ? ($data->first/$data->del_vol) * 100 : 0 ;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'del_vol' => $del_vol,
				'first' => $first,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_pickup_ib($group, $area, $area2, $province, $city, $payment);
	
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'ave' => $ave,
			); 
		}else{
			$result['label'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'ave' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function dispatch_leadtime(){
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_dispatch_leadtime($group, $area, $area2, $province, $city, $payment);
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$dis_vol[] = $data->dis_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'dis_vol' => $dis_vol,
				'ave' => $ave,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_del_leadtime($group, $area, $area2, $province, $city, $payment);
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$del_vol[] = $data->del_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'del_vol' => $del_vol,
				'ave' => $ave,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_failed_percentage($group, $area, $area2, $province, $city, $payment);
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$failed_vol[] = $data->failed_vol;
				$compute = ($data->failed_vol > 0 AND $data->ship_vol > 0) ? ($data->failed_vol/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed_vol' => $failed_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_open_items($group, $area, $area2, $province, $city, $payment);
	
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$open_vol[] = $data->open_vol;
				$compute = ($data->open_vol > 0 AND $data->ship_vol > 0) ? ($data->open_vol/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'open_vol' => $open_vol,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
			$result['data'] = array(
				'ship_vol' => [],
				'percentage' => [],
			); 
		}
		
		
		
		echo json_encode($result);
		exit(0);
		
	}

	public function linehaul_leadtime(){
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$datas = $this->xde->get_linehaul_leadtime($group, $area, $area2, $province, $city, $payment);
		
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$trans_vol[] = $data->trans_vol;
				$ave[] = round($data->ave, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'trans_vol' => $trans_vol,
				'ave' => $ave,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$area = $this->input->get('area');
		$area2 = str_replace("-", " ",$this->input->get('area2'));
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$payment = $this->input->get('payment');
		$data = $this->xde->get_delivery_performance($group, $area, $area2, $province, $city, $payment);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}



	



	

}