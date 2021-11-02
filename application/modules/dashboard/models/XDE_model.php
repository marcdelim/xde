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

		public function find_all_area () {

			$this->db->select('distinct(area) as area');
			$this->db->from( $this->table );
			$this->db->order_by('area');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_area2 () {

			$this->db->select('distinct(area2) as area2');
			$this->db->from( $this->table );
			$this->db->order_by('area2');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_province () {

			$this->db->select('distinct(consignee_province) as province');
			$this->db->from( $this->table );
			$this->db->order_by('consignee_province');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_city() {

			$this->db->select('distinct(consignee_city) as city');
			$this->db->from( $this->table );
			$this->db->order_by('consignee_city');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_payment() {

			$this->db->select('distinct(payment_type) as payment');
			$this->db->from( $this->table );
			$this->db->order_by('payment_type');
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

		public function get_del_percentage($group, $area, $area2, $province, $city, $payment){
			$select_group = ($group =='handover_date') ?  'date(handover_date) as handover_date' : $group;
			$this->db->select($select_group);
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->from( $this->table );
			if($area != 'All'){
				$this->db->where('area', $area);
			}
			if($area2 != 'All'){
				$this->db->where('area2', $area2);
			}
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by($select_group);
			$this->db->order_by($group);
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_del_otp_percentage($group, $area, $area2, $province, $city, $payment){
			$select_group = ($group =='handover_date') ?  'date(handover_date) as handover_date' : $group;
			$this->db->select($select_group);
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->select('SUM(if(otp = 1, 1, 0)) AS otp_vol');
			$this->db->from( $this->table );
			if($area != 'All'){
				$this->db->where('area', $area);
			}
			if($area2 != 'All'){
				$this->db->where('area2', $area2);
			}
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by($select_group);
			$this->db->order_by($group);
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_first_attempt($group, $area, $area2, $province, $city, $payment){
			$select_group = $group =='handover_date' ?  'date(handover_date) as handover_date' : $group;
			$this->db->select($select_group);
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS del_vol');
			$this->db->select('SUM(if(first_attempt_status= "delivery_successful", 1, 0)) AS first');
			$this->db->from( $this->table );
			if($area != 'All'){
				$this->db->where('area', $area);
			}
			if($area2 != 'All'){
				$this->db->where('area2', $area2);
			}
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by($select_group);
			$this->db->order_by($group);
			
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

		public function get_linehaul_leadtime($area_id, $area2_id){
			$this->db->select('week_no');
			$this->db->select('count(xde_id) as ship_vol');
			$this->db->select('SUM(if(transfer = 1, 1, 0)) AS trans_vol');
			$this->db->select('AVG(lh_lt) AS ave');
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

		public function get_delivery_performance($area_id, $area2_id, $hod = false){
			if($hod){
				$label_select='Date(handover_date) as "HOD"';
				$ave = 'ROUND(count(xde_id)) AS "Daily Ave"';
				$group = "Date(handover_date)";
			}else{
				$label_select='week_no as "Week No."';
				$ave = 'ROUND(count(xde_id) / 6) AS "Daily Ave"';
				$group = "week_no";
			}
			$this->db->select($label_select);
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS "Del Vol"');
			$this->db->select('ROUND(AVG(lt),2) AS "Average of LT"');
			$this->db->select('SUM(if(otp = "1", 1, 0)) AS "OTP Vol"');
			$this->db->select('SUM(if(first_attempt_status = "delivery_successful", 1, 0)) AS "1st Attempt Vol"');
			$this->db->select('SUM(if(fd = "1", 1, 0)) AS "FD Vol"');
			$this->db->select('SUM(if(open = "1", 1, 0)) AS "Open Vol"');
			$this->db->select('ROUND(AVG(pickup_to_ho_lt), 2) AS "Average of Pickup to HO LT"');
			$this->db->select('SUM(if(transfer = "1", 1, 0)) AS "Transfer Vol"');
			$this->db->select('ROUND(AVG(lh_lt),2) AS "Average of LH LT"');
			$this->db->select('SUM(if(first_attempt_dispatch_vol = "1", 1, 0)) AS "LM Dispatch Vol"');
			$this->db->select('ROUND(AVG(lm_dispatch_lt),2) AS "Average of LM Dispatch LT",');
			$this->db->select($ave);
			$this->db->select('ROUND((SUM(if(status = "delivery_successful", 1, 0))/count(*) * 100), 2) AS "Delivery %"');
			$this->db->select('ROUND((SUM(if(fd = "1", 1, 0))/count(*) * 100), 2) AS "Failed Delivery %"');
			$this->db->select('ROUND((SUM(if(open = 1, 1, 0))/count(*) * 100), 2) AS "Open %"');
			$this->db->select('ROUND((SUM(if(otp = 1, 1, 0))/SUM(if(status = "delivery_successful", 1, 0)) * 100), 2) AS "OTP %"');
			$this->db->select('ROUND((SUM(if(first_attempt_status = "delivery_successful", 1, 0))/count(*) * 100), 2) AS "1st Attempt %"');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$this->db->group_by($group);
			$this->db->order_by($group);
			$query = $this->db->get();

			$this->db->select('"Grand Total" as "Week No."');
			$this->db->select('count(xde_id) as "Ship Vol"');
			$this->db->select('SUM(if(status = "delivery_successful", 1, 0)) AS "Del Vol"');
			$this->db->select('ROUND(AVG(lt),2) AS "Average of LT"');
			$this->db->select('SUM(if(otp = "1", 1, 0)) AS "OTP Vol"');
			$this->db->select('SUM(if(first_attempt_status = "delivery_successful", 1, 0)) AS "1st Attempt Vol"');
			$this->db->select('SUM(if(fd = "1", 1, 0)) AS "FD Vol"');
			$this->db->select('SUM(if(open = "1", 1, 0)) AS "Open Vol"');
			$this->db->select('ROUND(AVG(pickup_to_ho_lt), 2) AS "Average of Pickup to HO LT"');
			$this->db->select('SUM(if(transfer = "1", 1, 0)) AS "Transfer Vol"');
			$this->db->select('ROUND(AVG(lh_lt),2) AS "Average of LH LT"');
			$this->db->select('SUM(if(first_attempt_dispatch_vol = "1", 1, 0)) AS "LM Dispatch Vol"');
			$this->db->select('ROUND(AVG(lm_dispatch_lt),2) AS "Average of LM Dispatch LT",');
			$this->db->select('ROUND(count(xde_id) / 6) AS "Daily Ave"');
			$this->db->select('ROUND((SUM(if(status = "delivery_successful", 1, 0))/count(*) * 100), 2) AS "Delivery %"');
			$this->db->select('ROUND((SUM(if(fd = "1", 1, 0))/count(*) * 100), 2) AS "Failed Delivery %"');
			$this->db->select('ROUND((SUM(if(open = 1, 1, 0))/count(*) * 100), 2) AS "Open %"');
			$this->db->select('ROUND((SUM(if(otp = 1, 1, 0))/SUM(if(status = "delivery_successful", 1, 0)) * 100), 2) AS "OTP %"');
			$this->db->select('ROUND((SUM(if(first_attempt_status = "delivery_successful", 1, 0))/count(*) * 100), 2) AS "1st Attempt %"');
			$this->db->from( $this->table );
			if($area_id != 'All'){
				$this->db->where('area', $area_id);
			}
			if($area2_id != 'All'){
				$this->db->where('area2', $area2_id);
			}
			$query2 = $this->db->get();
			if ( $query->result() != NULL ) {
				$query_result = array_merge($query->result(), $query2->result());
				return $query_result;
			} else {
				return FALSE;
			}
		}

	}
