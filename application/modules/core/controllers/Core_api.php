<?php

class Core_api extends MX_Controller
{
     public function __construct()
    {
        parent::__construct();
		$this->load->module("core/app");
		
		// $this->load->model("api/api_model");
		// $this->api_check = $this->api_model->checkApiKey(API_KEY);
    }
	
	public function _remap()
	{
		redirect('site/error');
	}
	
	// public function get_urls(){
		
		// $resData = $this->rest->post('url/urls/api_key/'.API_KEY);
		// $result = $this->common->restDataToArray($resData);
	
		// echo json_encode($result);
		
	// }
	
	public function get_urls()
	{
		// if ($this->api_check != FALSE )
        // {
			$urls['base_url'] = base_url();
			$urls['current_url'] = current_url();;
			$urls['module_url'] = $this->environment->module_path;
			$urls['module_assets_url'] = $this->environment->module_assets_path;
			$urls['assets_url'] = $this->environment->assets_path;
			$urls['ajax_url'] = $this->environment->ajax_path;
			$urls['exec_url'] = $this->environment->exec_path;
			$urls['request_url'] = $this->environment->request_path;
			$urls['getfile_url'] = $this->environment->getfile_path;
			$urls['ci_env'] = isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development';
			
			echo json_encode($this->common->apiData('success','success_userList','Successfully getting urls',$urls));
        // }
        // else
        // {
			// echo $this->common->apiData('error','invalid_api_key','Invalid API Key');
        // }
		
	}

}