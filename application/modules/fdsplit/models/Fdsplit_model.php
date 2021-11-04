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

		public function get_failed($payment_type, $group, $province, $city){
			
			$select_group = ($group =='handover_date') ?  'date(handover_date) as handover_date' : $group;
			$this->db->select($select_group);
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(fd = 1, 1, 0)) as failed');
			$this->db->from( $this->table );
			$this->db->where( 'payment_type', $payment_type);
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$this->db->group_by(str_replace(' as handover_date', '' ,$select_group));
			$this->db->order_by($group);
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_table($payment_type, $group, $province, $city){
			$select_group = ($group =='handover_date') ?  'date(handover_date)' : $group;
			$this->db->select($select_group.' as "'.ucwords(str_replace(array('_', 'date(', ')'), ' ',$select_group)).'"');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(fd = 1 and payment_type = "'.$payment_type.'" , 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0))/count(*) * 100), 2) AS "FD %"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$this->db->group_by(str_replace(' as handover_date', '' ,$select_group));
			$this->db->order_by($group);
			$query = $this->db->get();
			
			$this->db->select('"Grand Total" as "Week No."');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(fd = 1 and payment_type = "'.$payment_type.'" , 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0))/count(*) * 100), 2) AS "FD %"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$query2 = $this->db->get();
			if ( $query->result() != NULL ) {
				$query_result = array_merge($query->result(), $query2->result());
				return $query_result;
			} else {
				return FALSE;
			}
		}

		public function get_failed_area($payment_type, $province, $city){
			$this->db->select('consignee_province as "Area"');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0))/count(*) * 100), 2) AS "FD %"');
			$this->db->select('FORMAT(ROUND(SUM(if(fd = 1 and payment_type = "'.$payment_type.'", declared_value, 0)), 2), 2) as "Total Amount"');
			$this->db->from( $this->table );	
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$this->db->group_by('consignee_province');
			$this->db->order_by('SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0)) desc');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_failed_count($payment_type, $province, $city){
			$this->db->select('count(*) as count');
			$this->db->from( $this->table );
			$this->db->where('payment_type', $payment_type);
			$this->db->where('fd', 1);
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$query = $this->db->get();
			$row = $query->row();
			return (isset( $row )) ? $row : FALSE;
		}

		public function get_failed_reason($payment_type, $count, $province, $city){
			$this->db->select('fd_reason as "FD Reasons"');
			$this->db->select('SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0)) as "FD Vol"');
			$this->db->select('ROUND((SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0))/'.$count.' * 100), 2) AS "FD %"');
			$this->db->select('FORMAT(ROUND(SUM(if(fd = 1 and payment_type = "'.$payment_type.'", declared_value, 0)), 2), 2) as "Total Amount"');
			$this->db->from( $this->table );
			$this->db->where('fd', 1);
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			$this->db->group_by('fd_reason');
			$this->db->order_by('SUM(if(fd = 1 and payment_type = "'.$payment_type.'", 1, 0)) desc');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

	}
