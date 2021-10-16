<?php

class Site_api extends MX_Controller
{
     public function __construct()
    {
        parent::__construct();
		$this->load->module("core/app");
    }
	
	public function _remap()
	{
		redirect('site/error');
	}
	
	public function _log($user_id, $log_type, $action, $description = ''){
		$this->load->model('logs/transaction_log_model');

		$data = array(
			'ttl_tau_id' => $user_id,
			'ttl_type' => $log_type,
			'ttl_method_action' => $action,
			'ttl_description' => $description,
			'ttl_user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'ttl_ip_address' => $_SERVER['REMOTE_ADDR']
		);
		$this->transaction_log_model->save($data);
	}
	
	// public function get_user_ids_using_tmv()
	// {
		
	// }
}