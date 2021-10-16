<?php

class Site_error extends MX_Controller {

	private $smodule;
	public function __construct()
    {
        parent::__construct();
        $this->smodule = 'site';
        
        $this->load->module("core/app");
		
		$this->app->use_css(array("source"=>"site/bootstrap.min","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/font-awesome/css/font-awesome.css","cache"=>false));
		$this->app->use_css(array("source"=>"site/animate","cache"=>false));
		$this->app->use_css(array("source"=>"site/style","cache"=>false));
		$this->app->use_js(array("source"=>"site/jquery-2.1.1","cache"=>false));
		$this->app->use_js(array("source"=>"site/bootstrap.min","cache"=>false));		
    }
	
	public function _remap($param)
	{
		$this->index($param);
	}
	
	
	public function index($type)
	{
		$aData['type'] = $type=="index" ? "page_not_found" : $type;
		
		if($aData['type']=="not_authorized"){
			$aData['code'] = "403";
			$aData['title'] = "Forbidden Page";
			$aData['message'] = "We are sorry, but the page you were trying to reach is restricted to your account or your session is expired. Go back to <a class='btn btn-danger btn-sm' href='".base_url()."'><i class='fa fa-home'></i> Homepage</a>";
		}
		else if($aData['type']=="page_not_found"){
			$aData['code'] = "404";
			$aData['title'] = "Page Not Found";
			$aData['message'] = "We are sorry, but the page you were trying to reach cannot be found. Go back to <a class='btn btn-danger btn-sm' href='".base_url()."'><i class='fa fa-home'></i> Homepage</a>";
		}
		else if($aData['type']=="session_expired"){
			$aData['code'] = "401";
			$aData['title'] = "Session Expired";
			$aData['message'] = "We are sorry, your session has timed out and no longer active, Please <a class='btn btn-danger btn-sm' href='".base_url()."?referrer=".$this->input->get('referrer')."'><i class='fa fa-home'></i> re-login</a> to renew your session. Thank you";
		}
		else{
			$aData['code'] = "404";
			$aData['title'] = "Page Not Found";
			$aData['message'] = "We are sorry, but the page you were trying to reach cannot be found. Go back to <a class='btn btn-danger btn-sm' href='".base_url()."'><i class='fa fa-home'></i> Homepage</a>";
		}
		
		$aData['siteConfig'] = $this->config->item('site');

		$this->app->header('auth/header');
		$this->app->content($this->smodule.'/errors/custom',$aData);
		$this->app->footer('auth/footer');
	}
	

}