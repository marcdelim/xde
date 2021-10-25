<?php

class Login extends MX_Controller{
	private $smodule;
	
	public function index(){
		if($this->session->userdata('login')){
			$this->home();
		}
		$this->load->model('user/User_model', 'user');
		$data = array();
		if($this->input->post('submit')){
			if ($this->validate()) {

				$user = $this->user->get_by_attribute('username', $this->input->post('username'));
				
				if(!empty($user) && password_verify($this->input->post('password'), $user->password)){
					$this->initiate_user($user);
					
				}else{
					$data['error'] = 'Email or Password is incorrect.';
				}

            }else{
				$data['error'] = validation_errors();
			}
			
		}
		$this->load->view('login', $data);
	}

	public function logout(){
		$this->session->unset_userdata(array("logged_in"=>""));
		$this->session->sess_destroy();
		redirect('login');
	}

	function validate(){
		$this->form_validation->set_rules( 'username', 'username', 'required' );
		$this->form_validation->set_rules( 'password', 'password', 'required' );

		if ( $this->form_validation->run( $this ) == FALSE ) {
			return FALSE;
		} else {
			return TRUE;
		}

	}

	function initiate_user($user){
		$roles = array();
		$session = array(
			'login' => true,
			'user_id' => $user->user_id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'username' => $user->username,
			'temp_pass' => $user->temp_pass,
			'password' => $user->password,
		);
		$this->session->set_userdata($session);

		if($user->temp_pass){
			redirect('Changepass');
		}else{
			redirect('Dashboard');
		}
	}

	

}