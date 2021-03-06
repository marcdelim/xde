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
		$this->load->model("dashboard/Xde_model", 'xde');
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

		$this->app->use_js(array("source"=>"fdsplit/weekly/failedCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedNonCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedAreaCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedAreaNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedReasonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/weekly/failedReasonNonCod","cache"=>false));
		
		$header['header_data'] = "FD Split";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		
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

		$this->app->use_js(array("source"=>"fdsplit/daily/failedCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedNonCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedAreaCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedAreaNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedReasonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/daily/failedReasonNonCod","cache"=>false));
		
		$header['header_data'] = "FD Split";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		
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

		$this->app->use_js(array("source"=>"fdsplit/monthly/failedCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedNonCodTable","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedAreaCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedAreaNonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedReasonCod","cache"=>false));
		$this->app->use_js(array("source"=>"fdsplit/monthly/failedReasonNonCod","cache"=>false));
		
		$header['header_data'] = "FD Split";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$data['provinces'] = $this->xde->find_all_province() ? $this->xde->find_all_province() : [];
		$data['cities'] = $this->xde->find_all_city() ? $this->xde->find_all_city() : [];
		
		$this->load->view('monthly', $data);
		$this->template->adminFooterTpl();
	}

	//graphs
	public function failed_cod(){
		$group = $this->input->get('group');
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$datas = $this->fds->get_failed('COD', $group, $province, $city);
		
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$failed[] = $data->failed;
				$compute = ($data->failed > 0 AND $data->ship_vol > 0) ? ($data->failed/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed' => $failed,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$datas = $this->fds->get_failed('N-COD', $group, $province, $city);
	
		if($datas){
			foreach($datas as $data){
				$label[] = $data->$group;
				$ship_vol[] = $data->ship_vol;
				$failed[] = $data->failed;
				$compute = ($data->failed > 0 AND $data->ship_vol > 0) ? ($data->failed/$data->ship_vol) * 100 : 0;
				$percentage[] = round($compute, 2);
			}
	
			$result['label'] = $label;
			$result['data'] = array(
				'ship_vol' => $ship_vol,
				'failed' => $failed,
				'percentage' => $percentage,
			); 
		}else{
			$result['label'] = [];
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
		$group = $this->input->get('group');
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$data = $this->fds->get_failed_table('COD', $group, $province, $city);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}

	public function failed_non_cod_tbl(){
		$group = $this->input->get('group');
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$data = $this->fds->get_failed_table('N-COD', $group, $province, $city);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}

	public function failed_area_cod(){
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$data = $this->fds->get_failed_area('COD', $province, $city);
		
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		echo json_encode($data);
		exit(0);
	}

	public function failed_area_non_cod(){
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$data = $this->fds->get_failed_area('N-COD', $province, $city);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		
		
		echo json_encode($data);
		exit(0);
	}


	public function failed_reason_cod(){
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$count = $this->fds->get_failed_count('COD', $province, $city);
		$data = $this->fds->get_failed_reason('COD', $count->count, $province, $city);
		
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		
		echo json_encode($data);
		exit(0);
	}

	public function failed_reason_non_cod(){
		$province = str_replace("-", " ",$this->input->get('province'));
		$city = str_replace("-", " ",$this->input->get('city'));
		$count = $this->fds->get_failed_count('N-COD', $province, $city);
		$data = $this->fds->get_failed_reason('N-COD', $count->count, $province, $city);
	
		if($data){
			$result['data'] = $data;
		}else{
			
			$result['data'] = []; 
		}
		echo json_encode($data);
		exit(0);
	}



	



	

}