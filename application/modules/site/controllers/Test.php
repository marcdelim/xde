<?php

class Test extends MX_Controller {

	private $smodule;

	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = 'site';
        
        $this->load->module("core/app");
		$this->load->module("site/template");
        $this->load->library("core/S3_helper");
		
		$this->app->use_js(array("source"=>$this->smodule."/test","cache"=>false));

    }
	
	// public function _remap()
	// {
		// redirect('site/error');
	// }
	

	public function index()
	{
		
		$aData = [];
		
		$header_data['header_data'] = 'TEST';
		$this->template->adminHeaderTpl($header_data);
		$this->template->adminSideBarTpl();
		$this->load->view('test',$aData);
		$this->template->adminFooterTpl();
		
	}
	
	public function upload()
	{
	
		echo json_encode($this->s3_helper->upload_base64($this->input->post('image'),'contracts'),true);
	
	}
	
	public function del()
	{
		$del = $this->s3_helper->delete_aws_obj('development/campaign/application/617bd1b91e6396098ba0e914bc1c46e1-1537431911K5z5U.pdf');
		echo '<pre>';
		var_dump($del);
		echo '</pre>';
	}
	
	

	
	
}