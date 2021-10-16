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
	
		
		$header['header_data'] = "Ship To";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
				
		
		$user_data = $this->set_object('', '', '', '', '');

		if($this->input->post('submit')){
			$user_data = $this->set_object('',  $this->input->post('username'),  $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('role_id'));

			if($this->validate('create')){
				$this->db->trans_start();
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'role_id' => $this->input->post('role_id'),
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
		$data['roles'] = $this->user->find_all_roles();
		$this->load->view('form', $data);
		$this->template->adminFooterTpl();
	}


	public function update($id){  
	
		
		$header['header_data'] = " User";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
	
		$user_data = $this->user->get_by_id($id);

		if($this->input->post('submit')){
		 	$object_setter = $this->set_object($id, $this->input->post('username'),  $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('role_id'));

			if($this->validate('update', $user_data->username)){
				$user_data = $object_setter;
				$this->db->trans_start();
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'role_id' => $this->input->post('role_id'),
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
		$data['roles'] = $this->user->find_all_roles();
		$this->load->view('form', $data);
		$this->template->adminFooterTpl();
	}

	function validate($action='create', $code=FALSE){
		if($action == 'create'){
			$this->form_validation->set_rules( 'username', 'Username', 'required|is_unique[tbl_user.username]' );
		}else{
			if($code != $this->input->post('username') ){
				$this->form_validation->set_rules( 'username', 'Username', 'required|is_unique[tbl_user.username]' );
			}
		}
		$this->form_validation->set_rules( 'first_name', 'First Name', 'required' );
		if ( $this->form_validation->run( $this ) == FALSE ) {
			return FALSE;
		} else {
			return TRUE;
		}

	}

	function set_object($id, $username, $first_name, $last_name, $role_id){
		$user = new stdClass();
		$user->user_id = $id;
		$user->username = $username;
		$user->first_name = $first_name;
		$user->last_name = $last_name;
		$user->role_id = $role_id;

		return $user;
	}

	public function set_approvers($size){
		$approvers = array();
		for($i=0; $i < $size ; $i++ ){
			$approver = new stdClass();
			$approver->email =  $this->input->post('email_address')[$i];							
			$approvers[] = $approver;
		}

		return $approvers;	

	}

	public function upload(){  
		
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/jquery.dataTable.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/select2/js/select2.min.js","cache"=>false));
		$this->app->use_js(array("source"=>"home/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>"center/form","cache"=>false));
		
		$header['header_data'] = "Center";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$approvers = array();
		$data = array();
			
		if($this->input->post('submit')){
			$this->db->trans_start();
			$handle = fopen($_FILES['file_name']['tmp_name'], "r");
			$flag = false;
			$status = 1;
			while(($data = fgetcsv($handle)) !== FALSE){
				if($flag){
					if($status == 1){
						$center_id = $this->center->get_by_attribute('center_code', $data[1]);

						if(!$center_id){
							$data_center = array(
								'center_code' => $data[1],
								'center_name' => $data[2]
							);
			
							$center= $this->center->save($data_center);

							$approver = $this->get_user_id($data[3]);
							
							$cost_center_hierarchy_data = array(
								'cost_center_id' => $center->center_id,
								'approver_user_id' => $approver,
								'level' => 1
							);
							
							$this->center->save_center_hierarchy($cost_center_hierarchy_data);
							

							if(!empty($data[4])){
								$approver = $this->get_user_id($data[4]);
							
								$cost_center_hierarchy_data = array(
									'cost_center_id' => $center->center_id,
									'approver_user_id' => $approver,
									'level' => 2
								);

								$this->center->save_center_hierarchy($cost_center_hierarchy_data);
							}

							if(!empty($data[5])){
								$approver = $this->get_user_id($data[5]);
							
								$cost_center_hierarchy_data = array(
									'cost_center_id' => $center->center_id,
									'approver_user_id' => $approver,
									'level' => 3
								);

								$this->center->save_center_hierarchy($cost_center_hierarchy_data);
							}

						}

					}else{
						$status = 0;
					}
					
				}else{
					$flag = true;
				}
			}
			if($status == 1){
				$this->db->trans_commit();
				$data['success'] = 'success';
			}else{
				$this->db->trans_rollback();
				$data['error'] = 'An Error occured while saving the data. Please try again.';
			}
		}
		$this->load->view('upload', $data);
		$this->template->adminFooterTpl();
	}

	function get_user_id($email){
		$user = $this->user->get_by_attribute('email', $email);

		if(!$user){
			$user_data = array (
				'email' => $email
			);
			
			$user = $this->user->save($user_data);
		}

		$this->role->delete_user_role('user_role_role_id=3 AND user_role_user_id='.$user->user_id );

		$data_user_role = array (
			'user_role_user_id' => $user->user_id,
			'user_role_role_id' => 3
		);
		
		$this->role->save_user_role($data_user_role);

		return $user->user_id;
		
	}
	

}