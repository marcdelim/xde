<?php

class Site_Model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }
   
	
	
	public function test_method()
	{

/* 		$this->db->select('tu_user_email AS email, tu_fname AS first_name, tu_mname AS middle_name, tu_lname AS last_name, tu_position AS position, tu_bu_id AS bu_id, tau_tp_permissions AS permission, tp_description AS permission_desc, tp_type AS permission_type');
		$this->db->from('tbl_users');
		$this->db->join('tbl_api_users', 'tau_tu_user_id = tu_user_id','left');
		$this->db->join('tbl_permissions', 'tp_idx = tau_tp_permissions','left');
		$this->db->where('tu_user_id',$user_id);		
		$query = $this->db->get();
		return $query->row_array(); */

	}
	
	public function get_user_profile($user_id){
		// $this->db->select('tu_user_email AS email, tu_fname AS first_name, tu_mname AS middle_name, tu_lname AS last_name, tu_position AS position,tau_tp_permissions AS permission, tp_description AS permission_desc, tp_type AS permission_type');
		// $this->db->from('tbl_users');
		// $this->db->join('tbl_api_users', 'tau_tu_user_id = tu_user_id','left');
		// $this->db->join('tbl_permissions', 'tp_idx = tau_tp_permissions','left');
		// $this->db->where('tu_user_id',$user_id);		
		// $query = $this->db->get();
		// return $query->row_array(); 
		
		$userProfile['first_name'] = "First";
		$userProfile['last_name'] = "Name";
		$userProfile['position'] = "Static Position";
		$userProfile['permission_desc'] = "Static Permission";
		
		return $userProfile;
	}
	
	public function get_approval_request($approver_id){
		$approver_id = intval($approver_id);
		$this->db->where('tar_status', 'pending');
		$this->db->where('tar_approver_id', $approver_id);
		return $this->db->get('tbl_approval_request')->result_array();
	}
	
	
}