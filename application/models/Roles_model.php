<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Roles_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'tbl_roles';
		}

		public function find_all () {

			$this->db->from( 'tbl_roles' );
			$this->db->order_by('role_name');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_by_id ( $id ) {
			$this->db->from( 'tbl_roles' );
			$this->db->where( 'role_id', $id );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( 'role_id' => $this->db->insert_id() ) );
			return $query->row();
		}

		public function update ( $where, $data ) {
			$this->db->update( $this->table, $data, $where );
			$query = $this->db->get_where( $this->table, $where );
			return $query->row();
		}
	}
