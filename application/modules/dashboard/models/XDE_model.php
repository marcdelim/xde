<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class XDE_model extends CI_Model {

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

		public function get_del_percentage($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_del_otp_percentage($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->select('SUM(if(otp = 1, 1, 0)) AS otp_vol');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_first_attempt($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->select('SUM(if(first_attempt_status= "delivery_successful", 1, 0)) AS first');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_pickup_ib($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('AVG(pickup_to_ho_lt) AS ave');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_dispatch_leadtime($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(first_attempt_dispatch_vol = "1", 1, 0)) AS dis_vol');
			$this->db->select('AVG(lm_dispatch_lt) AS ave');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_del_leadtime($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->select('AVG(lt) AS ave');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_percentage($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(fd = "1", 1, 0)) AS failed_vol');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_open_items($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(open = 1, 1, 0)) AS open_vol');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by('week_no');
			$this->db->order_by('week_no');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

	}
