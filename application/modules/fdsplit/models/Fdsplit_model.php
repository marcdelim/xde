<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class fdsplit_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'xde_table';
			$this->id = 'xde_id';
		}

		public function find_all () {

			$this->db->from( $this->table );
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_by_attribute ( $field, $value ) {
			$this->db->from( $this->table );
			$this->db->where( $field, $value );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}

		public function find ( $criteria ) {
			$query = $this->db->get_where( $this->table, $criteria );
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_by_id ( $id ) {
			$this->db->from( $this->table );
			$this->db->where( $this->id, $id );
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( $this->id => $this->db->insert_id() ) );
			return $query->row();
		}
		
		public function update ( $where, $data ) {
			$this->db->update( $this->table, $data, $where );
			$query = $this->db->get_where( $this->table, $where );
			return $query->row();
		}

		public function get_failed($payment_type){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(fd = 1, 1, 0)) as failed');
			$this->db->from( $this->table );
			$this->db->where( 'payment_type', $payment_type);
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_table($payment_type){
			$this->db->select('week_no as "Week No."');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(fd = 1, 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1, 1, 0))/count(*) * 100), 2) AS "FD %"');
			$this->db->from( $this->table );
			$this->db->where( 'payment_type', $payment_type);
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_area($payment_type){
			$this->db->select('consignee_province as "Area"');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(fd = 1, 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1, 1, 0))/count(*) * 100), 2) AS "FD %"');
			$this->db->select('FORMAT(ROUND(SUM(if(fd = 1, declared_value, 0)), 2), 2) as "Total Amount"');
			$this->db->from( $this->table );
			$this->db->where( 'payment_type', $payment_type);
			$this->db->group_by('consignee_province');
			$this->db->order_by('consignee_province');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_count($payment_type){
			$this->db->select('count(*) as count');
			$this->db->from( $this->table );
			$this->db->where('payment_type', $payment_type);
			$this->db->where('fd', 1);
			$query = $this->db->get();
			$row = $query->row();
			return (isset( $row )) ? $row : FALSE;
		}

		public function get_failed_reason($payment_type, $count){
			$this->db->select('fd_reason as "FD Reasons"');
			$this->db->select('SUM(if(fd = 1, 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1, 1, 0))/'.$count.' * 100), 2) AS "FD %"');
			$this->db->select('FORMAT(ROUND(SUM(if(fd = 1, declared_value, 0)), 2), 2) as "Total Amount"');
			$this->db->from( $this->table );
			$this->db->where('payment_type', $payment_type);
			$this->db->where('fd', 1);
			$this->db->group_by('fd_reason');
			$this->db->order_by('fd_reason');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

	}
