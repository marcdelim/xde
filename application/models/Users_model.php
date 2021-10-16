<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'tbl_users';
		}

		public function find_all () {

			$this->db->from( $this->table );
			$this->db->order_by('first_name');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_manager () {

			$this->db->from( $this->table );
			$this->db->order_by('first_name');
			$this->db->where('role_id', '3');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_by_id ( $id ) {
			$this->db->from( $this->table );
			$this->db->where( 'user_id', $id );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}

		public function find_username ( $username ) {
			$this->db->from( $this->table );
			$this->db->where( 'username', $username );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( 'user_id' => $this->db->insert_id() ) );
			return $query->row();
		}

		public function update ( $where, $data ) {
			$this->db->update( $this->table, $data, $where );
			$query = $this->db->get_where( $this->table, $where );
			return $query->row();
		}
	}
