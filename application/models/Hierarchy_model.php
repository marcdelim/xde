<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Hierarchy_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'tbl_hierarchy';
		}

		public function get_by_user_id ( $id ) {
			$this->db->from( $this->table );
			$this->db->where( 'user_id', $id );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( 'hierarchy_id' => $this->db->insert_id() ) );
			return $query->row();
		}

		public function delete_where ( $where ) {
			$query = $this->db->delete( $this->table, $where );
			return $query;
		}
	}
