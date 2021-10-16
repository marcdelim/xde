<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Payment_status_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'tbl_payment_status';
        }
        
		public function get_by_payment_id ( $id ) {
			$this->db->from( $this->table );
			$this->db->where( 'payment_id', $id );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( 'payment_status_id' => $this->db->insert_id() ) );
			return $query->row();
		}

		public function update ( $where, $data ) {
			$this->db->update( $this->table, $data, $where );
			$query = $this->db->get_where( $this->table, $where );
			return $query->row();
		}
	}
