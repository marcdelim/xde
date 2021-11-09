<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Trend_model extends CI_Model {

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

		public function get_volume($group, $province, $city, $payment){
			$select_group = ($group =='handover_date') ?  'date(handover_date) as handover_date' : $group;
			$this->db->select($select_group);
			$this->db->select('SUM(if(area = "GMA", 1, 0)) AS "gma"');
			$this->db->select('SUM(if(area = "N-Luzon", 1, 0)) AS "north"');
			$this->db->select('SUM(if(area = "S-Luzon", 1, 0)) AS "south"');
			$this->db->select('SUM(if(area = "Visayas", 1, 0)) AS "visayas"');
			$this->db->select('SUM(if(area = "Mindanao", 1, 0)) AS "mindanao"');
			$this->db->select('count(xde_id) as "volume"');
			$this->db->select('ROUND(count(xde_id) / 6) AS "ave"');
			$this->db->from( $this->table );
		
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by(str_replace(' as handover_date', '' ,$select_group));
			$group = ($group== 'month') ? "MONTH(handover_date)": $group;
			$this->db->order_by($group);
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function get_table_volume($group, $province, $city, $payment){
			$count = $this->count_week();
			$select_group = ($group =='handover_date') ?  'date(handover_date)' : $group;
			$this->db->select($select_group.' as "'.ucwords(str_replace(array('_', 'date(', ')'), ' ',$select_group)).'"');	
			$this->db->select('SUM(if(area = "GMA", 1, 0)) AS "GMA"');
			$this->db->select('SUM(if(area = "N-Luzon", 1, 0)) AS "N-Luzon"');
			$this->db->select('SUM(if(area = "S-Luzon", 1, 0)) AS "S-Luzon"');
			$this->db->select('SUM(if(area = "Visayas", 1, 0)) AS "Visayas"');
			$this->db->select('SUM(if(area = "Mindanao", 1, 0)) AS "Mindanao"');
			$this->db->select('count(xde_id) as "Volume"');
			if($group=="week_no"){
				$this->db->select('ROUND((count(xde_id)/6), 2) AS "Daily Average"');
			}else if($group=="month"){
				$this->db->select('ROUND((count(xde_id)/26), 2) AS "Daily Average"');
			}
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by(str_replace(' as handover_date', '' ,$select_group));
			$group = ($group== 'month') ? "MONTH(handover_date)": $group;
			$this->db->order_by($group);
			$query = $this->db->get();
			$this->db->select('"Grand Total" as "Week No."');
			$this->db->select('SUM(if(area = "GMA", 1, 0)) AS "GMA"');
			$this->db->select('SUM(if(area = "N-Luzon", 1, 0)) AS "N-Luzon"');
			$this->db->select('SUM(if(area = "S-Luzon", 1, 0)) AS "S-Luzon"');
			$this->db->select('SUM(if(area = "Visayas", 1, 0)) AS "Visayas"');
			$this->db->select('SUM(if(area = "Mindanao", 1, 0)) AS "Mindanao"');
			$this->db->select('count(xde_id) as "Volume"');
			if($group=="week_no"){
				$this->db->select('ROUND((count(xde_id)/6)/'.$count->week_count.', 2) AS "Daily Average"');
			}else if($group=="month"){
				$this->db->select('ROUND((count(xde_id)/26), 2) AS "Daily Average"');
			}
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query2 = $this->db->get();
			if ( $query->result() != NULL ) {
				$query_result = array_merge($query->result(), $query2->result());
				return $query_result;
			} else {
				return FALSE;
			}
		}

		public function get_count($province, $city, $payment){
			$this->db->select('count(*) as count');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query = $this->db->get();
			$row = $query->row();
			return (isset( $row )) ? $row : FALSE;
		}

		public function get_volume_sharing_table($count, $group, $province, $city, $payment){
			$count_week = $this->count_week();
			$select_group = ($group =='handover_date') ?  'date(handover_date)' : $group;
			$this->db->select($select_group.' as "'.ucwords(str_replace(array('_', 'date(', ')'), ' ',$select_group)).'"');
			$this->db->select('SUM(if(area = "GMA", 1, 0)) AS "GMA"');
			$this->db->select('SUM(if(area = "N-Luzon", 1, 0)) AS "N-Luzon"');
			$this->db->select('SUM(if(area = "S-Luzon", 1, 0)) AS "S-Luzon"');
			$this->db->select('SUM(if(area = "Visayas", 1, 0)) AS "Visayas"');
			$this->db->select('SUM(if(area = "Mindanao", 1, 0)) AS "Mindanao"');
			$this->db->select('count(xde_id) as "Grand Total"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by(str_replace(' as handover_date', '' ,$select_group));
			$group_order = ($group== 'month') ? "MONTH(handover_date)": $group;
			$this->db->order_by($group_order);
			$query = $this->db->get();

			$this->db->select('"Grand Total" as "total"');
			$this->db->select('SUM(if(area = "GMA", 1, 0)) AS "GMA"');
			$this->db->select('SUM(if(area = "N-Luzon", 1, 0)) AS "N-Luzon"');
			$this->db->select('SUM(if(area = "S-Luzon", 1, 0)) AS "S-Luzon"');
			$this->db->select('SUM(if(area = "Visayas", 1, 0)) AS "Visayas"');
			$this->db->select('SUM(if(area = "Mindanao", 1, 0)) AS "Mindanao"');
			$this->db->select('count(xde_id) as "Grand Total"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query2 = $this->db->get();
			if($group=="week_no"){
				$this->db->select('"Daily Ave" as "Week No."');
				$this->db->select('ROUND((SUM(if(area = "GMA", 1, 0))/6)/'.$count_week->week_count.', 2) AS "GMA"');
				$this->db->select('ROUND((SUM(if(area = "N-Luzon", 1, 0))/6)/'.$count_week->week_count.', 2)  AS "N-Luzon"');
				$this->db->select('ROUND((SUM(if(area = "S-Luzon", 1, 0))/6)/'.$count_week->week_count.', 2) AS "S-Luzon"');
				$this->db->select('ROUND((SUM(if(area = "Visayas", 1, 0))/6)/'.$count_week->week_count.', 2) AS "Visayas"');
				$this->db->select('ROUND((SUM(if(area = "Mindanao", 1, 0))/6)/'.$count_week->week_count.', 2) "Mindanao"');
				$total = ($count/6)/$count_week->week_count;
				$this->db->select('ROUND('.$total.', 2) AS "Grand Total"');
				$this->db->from( $this->table );
				if($province != 'All'){
					$this->db->where('consignee_province', $province);
				}
				if($city != 'All'){
					$this->db->where('consignee_city', $city);
				}
				if($payment != 'All'){
					$this->db->where('payment_type', $payment);
				}
				$query3 = $this->db->get();
				
			}else if($group=="month"){
				$this->db->select('"Daily Ave" as "Week No."');
				$this->db->select('ROUND((SUM(if(area = "GMA", 1, 0))/26), 2) AS "GMA"');
				$this->db->select('ROUND((SUM(if(area = "N-Luzon", 1, 0))/26), 2)  AS "N-Luzon"');
				$this->db->select('ROUND((SUM(if(area = "S-Luzon", 1, 0))/26), 2) AS "S-Luzon"');
				$this->db->select('ROUND((SUM(if(area = "Visayas", 1, 0))/26), 2) AS "Visayas"');
				$this->db->select('ROUND((SUM(if(area = "Mindanao", 1, 0))/26), 2) "Mindanao"');
				$total = ($count/26);
				$this->db->select('ROUND('.$total.', 2) AS "Grand Total"');
				$this->db->from( $this->table );
				if($province != 'All'){
					$this->db->where('consignee_province', $province);
				}
				if($city != 'All'){
					$this->db->where('consignee_city', $city);
				}
				if($payment != 'All'){
					$this->db->where('payment_type', $payment);
				}
				$query3 = $this->db->get();
			}
				
			$this->db->select('"Volume %" as "Week No."');
			$this->db->select('ROUND((SUM(if(area = "GMA", 1, 0)/'.$count.') * 100), 2) AS "GMA"');
			$this->db->select('ROUND((SUM(if(area = "N-Luzon", 1, 0)/'.$count.') * 100), 2) AS "N-Luzon"');
			$this->db->select('ROUND((SUM(if(area = "S-Luzon", 1, 0)/'.$count.') * 100), 2) AS "S-Luzon"');
			$this->db->select('ROUND((SUM(if(area = "Visayas", 1, 0)/'.$count.') * 100), 2) AS "Visayas"');
			$this->db->select('ROUND((SUM(if(area = "Mindanao", 1, 0)/'.$count.') * 100), 2) AS "Mindanao"');
			$this->db->select('ROUND(( '.$count.' /'.$count.') * 100, 2) AS "Grand Total"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query4 = $this->db->get();
			if ( $query->result() != NULL ) {
				if($group != "handover_date"){
					$query_result = array_merge($query->result(), $query2->result(), $query3->result(), $query4->result());
				}else{
					$query_result = array_merge($query->result(), $query2->result(), $query4->result());
				}
				
				return $query_result;
			} else {
				return FALSE;
			}
		}

		public function get_volume_percentage($count, $province, $city, $payment){
		
			$this->db->select('area');
			$this->db->select('count(xde_id) as volume');
			$this->db->select('ROUND((count(xde_id)/6)/4, 2) AS "ave"');
			$this->db->select('ROUND((count(xde_id) /'.$count.') * 100, 2) AS "percentage"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by('area');
			$this->db->order_by('area');
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}

		}

		public function get_volume_percentage_table($count, $group, $province, $city, $payment){
			$count_week = $this->count_week();
			$this->db->select('area as Area');
			$this->db->select('count(xde_id) as Volume');
			if($group=="week_no"){
				$this->db->select('ROUND((count(xde_id)/6)/'.$count_week->week_count.', 2) AS "Daily Average"');
			}else if($group=="month"){
				$this->db->select('ROUND((count(xde_id)/26), 2) AS "Daily Average"');
			}
			$this->db->select('ROUND((count(xde_id) /'.$count.') * 100, 2) AS "Volume %"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$this->db->group_by('area');
			$this->db->order_by('area');
			$query = $this->db->get();

			$this->db->select('"Grand Total" as Area');
			$this->db->select('count(xde_id) as Volume');
			if($group=="week_no"){
				$this->db->select('ROUND((count(xde_id)/6)/'.$count_week->week_count.', 2) AS "Daily Average"');
			}else if($group=="month"){
				$this->db->select('ROUND((count(xde_id)/26), 2) AS "Daily Average"');
			}
			$this->db->select('ROUND((count(xde_id) /'.$count.') * 100, 2) AS "Volume %"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query2 = $this->db->get();

			if ( $query->result() != NULL ) {
				$query_result = array_merge($query->result(), $query2->result());
				return $query_result;
			} else {
				return FALSE;
			}
		}

		public function get_package_percentage($province, $city, $payment){
		
			$this->db->select('SUM(IF((package_length * package_width  * package_height)/6000 >= 0 AND 
			(package_length * package_width  * package_height)/6000 <= 3 AND 
			(package_length * package_width  * package_height)/6000 >= package_weight, 1, 0)) 
			as "fast_freight"');
			$this->db->select('SUM(IF((package_length * package_width  * package_height)/6000 > 3 AND 
			(package_length * package_width  * package_height)/6000 <= 7 AND 
			(package_length * package_width  * package_height)/6000 >= package_weight, 1, 0)) 
			 as "mid_bulky"');
			$this->db->select('SUM(IF((package_length * package_width  * package_height)/6000 > 7 AND 
			(package_length * package_width  * package_height)/6000 < 15.1 AND 
			(package_length * package_width  * package_height)/6000 >= package_weight, 1, 0)) 
			 as "bulky"');
			$this->db->select('SUM(IF((package_length * package_width  * package_height)/6000 >= 15.1 AND 
			(package_length * package_width  * package_height)/6000 >= package_weight, 1, 0)) 
			 as "super_bulky"');
			$this->db->select('SUM(IF( package_weight >= 0 AND 
			package_weight <= 3 AND 
		   (package_length * package_width  * package_height)/6000 < package_weight, 1, 0)) 
			as "fast_freight_weight"');
			$this->db->select('SUM(IF( package_weight > 3 AND 
			package_weight <= 7 AND 
		   (package_length * package_width  * package_height)/6000 < package_weight, 1, 0)) 
			as "mid_bulky_weight"');
			$this->db->select('SUM(IF( package_weight > 7 AND 
			package_weight < 15.1 AND 
		   (package_length * package_width  * package_height)/6000 < package_weight, 1, 0)) 
			as "bulky_weight"');
			$this->db->select('SUM(IF( package_weight >= 15.1 AND 
			(package_length * package_width  * package_height)/6000 < package_weight, 1, 0)) 
			 as "super_bulky_weight"');
			$this->db->from( $this->table );
			if($province != 'All'){
				$this->db->where('consignee_province', $province);
			}
			if($city != 'All'){
				$this->db->where('consignee_city', $city);
			}
			if($payment != 'All'){
				$this->db->where('payment_type', $payment);
			}
			$query = $this->db->get();
			$row = $query->row();
			return (isset( $row )) ? $row : FALSE;
		}

		
		public function count_week(){
			$this->db->select('count(distinct(week_no)) as week_count');
			$this->db->from( $this->table );
			$query = $this->db->get();
			$row = $query->row();
			return (isset( $row )) ? $row : FALSE;
		}
	}
