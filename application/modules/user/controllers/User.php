<?php

class User extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model("user/User_model", "user");
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
		
		$header['header_data'] = "User";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$user = $this->user->find_all();
		$data['users'] = $user ? $user : array();

		$this->load->view('user', $data);
		$this->template->adminFooterTpl();
	}

	public function create(){  
		
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/jquery.dataTable.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
	
		
		$header['header_data'] = "User";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
				
		
		$user_data = $this->set_object('', '', '', '');

		if($this->input->post('submit')){
			$user_data = $this->set_object('',  $this->input->post('username'),  $this->input->post('first_name'), $this->input->post('last_name'));

			if($this->validate('create')){
				$this->db->trans_start();
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'password' => password_hash('123456', PASSWORD_BCRYPT),
					'date_updated' => date('Y-m-d H:i:s')
				);

				$user_saving = $this->user->save($data);


				$this->db->trans_commit();

				$data['success'] = 'success';
				$user_data = $this->set_object('', '', '', '', '');
				
			}else{
				$data['error'] = validation_errors();
			}
		}
		$data['action'] = 'Create';
		$data['user'] = $user_data;
		$this->load->view('form', $data);
		$this->template->adminFooterTpl();
	}


	public function update($id){  
	
		
		$header['header_data'] = " User";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
	
		$user_data = $this->user->get_by_id($id);

		if($this->input->post('submit')){
		 	$object_setter = $this->set_object($id, $this->input->post('username'),  $this->input->post('first_name'), $this->input->post('last_name'));

			if($this->validate('update', $user_data->username)){
				$user_data = $object_setter;
				$this->db->trans_start();
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'date_updated' => date('Y-m-d H:i:s')
				);


				$user_saving = $this->user->update(array('user_id' =>$id), $data);

				$this->db->trans_commit();

				$data['success'] = 'success';
				
			}else{
				$user_data = $object_setter;
				$data['error'] = validation_errors();
			}
		}
		$data['action'] = 'Update';
		$data['user'] = $user_data;
		$this->load->view('form', $data);
		$this->template->adminFooterTpl();
	}

	function validate($action='create', $code=FALSE){
		if($action == 'create'){
			$this->form_validation->set_rules( 'username', 'Username', 'required|is_unique[user_table.username]' );
		}else{
			if($code != $this->input->post('username') ){
				$this->form_validation->set_rules( 'username', 'Username', 'required|is_unique[user_table.username]' );
			}
		}
		$this->form_validation->set_rules( 'first_name', 'First Name', 'required' );
		if ( $this->form_validation->run( $this ) == FALSE ) {
			return FALSE;
		} else {
			return TRUE;
		}

	}

	function set_object($id, $username, $first_name, $last_name){
		$user = new stdClass();
		$user->user_id = $id;
		$user->username = $username;
		$user->first_name = $first_name;
		$user->last_name = $last_name;

		return $user;
	}


}