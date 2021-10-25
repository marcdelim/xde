<?php

class Changepass extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("user/User_model", "user");
	}
	
	public function index(){  

		if(empty($this->session->userdata('login'))){
			redirect('login');
		}
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/jquery.dataTable.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
	
		
		$header['header_data'] = "Change Password";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$data = array();
		if($this->input->post('submit')){
			if($this->input->post('new') == $this->input->post('confirm')){
				if($this->input->post('current') != $this->input->post('new')){
					$user = $this->user->get_by_id($this->session->userdata('user_id'));
					if(password_verify($this->input->post('current'), $user->password )){
						$this->db->trans_start();
						$data = array(
							'password' => password_hash($this->input->post('new'), PASSWORD_BCRYPT),
							'temp_pass' => 0
						);

						$user_saving = $this->user->update(array('user_id' =>$this->session->userdata('user_id')), $data);
						$this->session->set_userdata(array('temp_pass'=> 0));
						$data['success'] = 'success';
						$this->db->trans_commit();
					}else{
						$data['error'] = "Old Password is incorrect.";
					}
				}else{
					$data['error'] = "New password shouldn't be the same with current password.";
				}
				
				
			}else{
				$data['error'] = "New and confirm password doesn't match.";
			}
			

			
		}
		
		$this->load->view('form', $data);
		$this->template->adminFooterTpl();
	}

	public function reset_pass(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/jquery.dataTable.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
	
		
		$header['header_data'] = "Reset Password";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$data = array();
		if($this->input->post('submit')){
			
			$user = $this->user->get_by_attribute('email', $this->input->post('email'));
			if($user){
				$generated = $this->generateRandomString();
				$data = array(
					'password' => password_hash($generated, PASSWORD_BCRYPT),
					'temp_pass' => 1
				);
				$user_saving = $this->user->update(array('user_id'=>$user->user_id), $data);
				$message_data = array(
					'generated' => $generated
				);
				
				$message = $this->load->view('message', $message_data, true);
				$subject = "eRFP Reset Password";
				$this->sending($subject, $this->input->post('email'), $message);

				$data['success'] = "Temporary password is now sent to your email ".  $this->input->post('email') .".";
			}else{
				$data['error'] = "Email".  $this->input->post('email') ." doesn't exist.";
			}
			
		}
		
		$this->load->view('reset_form', $data);
		$this->template->adminFooterTpl();
	}

	function generateRandomString($length = 10) {
		$characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


}