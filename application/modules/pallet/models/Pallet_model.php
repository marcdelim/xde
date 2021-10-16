<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pallet_model extends CI_Model {

		public function __construct () {
			parent::__construct();
			$this->load->database();
			$this->table = 'tbl_items';
		}

		public function find_all ($completed = false) {

			$this->db->from( $this->table );
			$this->db->join('tbl_dr_line', 'tbl_dr_line.dr_line_id = tbl_pod.dr_line_id', 'left');
			$this->db->join('tbl_dr', 'tbl_dr.dr_id = tbl_dr_line.dr_id', 'left');
			$this->db->join('tbl_wave', 'tbl_wave.wave_id = tbl_dr.wave_id', 'left');
			$this->db->join('tbl_ship', 'tbl_ship.ship_id = ship_to_id', 'left');
			$this->db->join('tbl_address', 'tbl_address.address_id = tbl_dr.address_id', 'left');
			$this->db->join('tbl_subcon', 'tbl_subcon.subcon_id = tbl_wave.subcon_id', 'left');
			$this->db->join('tbl_truck_type', 'tbl_truck_type.truck_type_id = tbl_wave.truck_type_id', 'left');
			$this->db->where('pod_status', NULL);
			$this->db->or_where('pod_status', 'Incomplete');
			$this->db->or_where('pod_status', '');

			if($completed){
				$this->db->or_where('pod_status', 'Complete');
			}

			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

		public function find_all_ap ($month) {

			$this->db->from( $this->table );
			$this->db->join('tbl_dr_line', 'tbl_dr_line.dr_line_id = tbl_pod.dr_line_id', 'left');
			$this->db->join('tbl_dr', 'tbl_dr.dr_id = tbl_dr_line.dr_id', 'left');
			$this->db->join('tbl_wave', 'tbl_wave.wave_id = tbl_dr.wave_id', 'left');
			$this->db->join('tbl_ship', 'tbl_ship.ship_id = ship_to_id', 'left');
			$this->db->join('tbl_address', 'tbl_address.address_id = tbl_dr.address_id', 'left');
			$this->db->join('tbl_subcon', 'tbl_subcon.subcon_id = tbl_wave.subcon_id', 'left');
			$this->db->join('tbl_truck_type', 'tbl_truck_type.truck_type_id = tbl_wave.truck_type_id', 'left');
			$this->db->where('rdd >= ' , date('Y-'.$month.'-01'));
			$this->db->where('rdd <= ' , date('Y-'.$month.'-31'));

			$this->db->order_by('wave');
			$this->db->order_by('sell_rate', 'desc');


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
			$this->db->where( 'pod_id', $id );
			$this->db->join('tbl_dr_line', 'tbl_dr_line.dr_line_id = tbl_pod.dr_line_id', 'left');
			$this->db->join('tbl_dr', 'tbl_dr.dr_id = tbl_dr_line.dr_id', 'left');
			$this->db->join('tbl_wave', 'tbl_wave.wave_id = tbl_dr.wave_id', 'left');
			$this->db->join('tbl_ship', 'tbl_ship.ship_id = ship_to_id', 'left');
			$this->db->join('tbl_address', 'tbl_address.address_id = tbl_dr.address_id', 'left');
			$this->db->join('tbl_subcon', 'tbl_subcon.subcon_id = tbl_wave.subcon_id', 'left');
			$this->db->join('tbl_truck_type', 'tbl_truck_type.truck_type_id = tbl_wave.truck_type_id', 'left');
			$this->db->join('tbl_delivery', 'tbl_delivery.dr_line_id = tbl_pod.dr_line_id', 'left');
			$query = $this->db->get();
			$row = $query->row();

			return (isset( $row )) ? $row : FALSE;
		}
		
		public function save ( $data ) {
			$this->db->insert( $this->table, $data );
			$query = $this->db->get_where( $this->table, array( 'pod_id' => $this->db->insert_id() ) );
			return $query->row();
		}
		
		public function update ( $where, $data ) {
			$this->db->update( $this->table, $data, $where );
			$query = $this->db->get_where( $this->table, $where );
			return $query->row();
		}

		public function get_status($id){
			
			$this->db->from( 'tbl_wave' );
			$this->db->join('tbl_dr', 'tbl_dr.wave_id = tbl_wave.wave_id', 'left');
			$this->db->join('tbl_dr_line', 'tbl_dr_line.dr_id = tbl_dr.dr_id', 'left');
			$this->db->join('tbl_pod', 'tbl_dr_line.dr_line_id = tbl_pod.dr_line_id', 'left');
			$this->db->where("(pod_status = 'Incomplete' OR pod_status is NULL OR pod_status = '')", NULL, FALSE);
			$this->db->where('tbl_wave.wave_id', $id);
			$query = $this->db->get();
			if ( $query->result() != NULL ) {
				return $query->result();
			} else {
				return FALSE;
			}
		}

	}
