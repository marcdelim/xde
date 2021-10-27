<?php
class Pallet_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function field_list(){
        return $this->db->query('SHOW COLUMNS FROM xde_table')->result_array();
    }

    public function batch_insert_data($data){
        return $this->db->insert_batch('xde_table',$data);
    }

    public function insert_data($data){
        return $this->db->insert('xde_table',$data);
    }

    public function delete_data($data){
        return $this->db->where_in('id',$data)->delete('xde_table');
    } 

    public function data_list($data, $no_limit = false){
        $this->db->save_queries = FALSE;
        $columns = [
            "client" => "xde_table.client",
            "tracking_number" => "xde_table.tracking_number",
            "status" => "xde_table.status",
            "payment_type" => "xde_table.payment_type",
            "total_price" => "xde_table.total_price",
            "declared_value" => "xde_table.declared_value",
            "package_length" => "xde_table.package_length",
            "package_width" => "xde_table.package_width",
            "package_height" => "xde_table.package_height",
            "package_weight" => "xde_table.package_weight",
            "shipping_type" => "xde_table.shipping_type",
            "first_attempt_status" => "xde_table.first_attempt_status",
            "first_attempt_date" => "xde_table.first_attempt_date",
            "first_attempt_description" => "xde_table.first_attempt_description",
            "second_attempt_description" => "xde_table.second_attempt_description",
            "third_attempt_description" => "xde_table.third_attempt_description",
            "transfer_date" => "xde_table.transfer_date",
            "last_status_date" => "xde_table.last_status_date",
            "picked_date" => "xde_table.picked_date",
            "last_delivery_date" => "xde_table.last_delivery_date",
            "handover_date" => "xde_table.handover_date",
            "location" => "xde_table.location",
            "created_at" => "xde_table.created_at",
            "consignee_province" => "xde_table.consignee_province",
            "consignee_city" => "xde_table.consignee_city",
            "consignee_barangay" => "xde_table.consignee_barangay",
            "port" => "xde_table.port",
			"area" => "xde_table.area",
            "area2" => "xde_table.area2",
            "lh" => "xde_table.lh",
            "sla" => "xde_table.sla",
            "plus_sla" => "xde_table.plus_sla",
            "total_sla" => "xde_table.total_sla",
            "volume" => "xde_table.volume",
            "delivered" => "xde_table.delivered",
            "lt" => "xde_table.lt",
            "otp" => "xde_table.otp",
            "first_attempt_within_lt" => "xde_table.first_attempt_within_lt",
            "first_attempt_dispatch_vol" => "xde_table.first_attempt_dispatch_vol",
            "transfer" => "xde_table.transfer",
            "fd" => "xde_table.fd",
            "fd_reason" => "xde_table.fd_reason",
            "open" => "xde_table.open",
            "claims" => "xde_table.claims",
            "pickup_to_ho_lt" => "xde_table.pickup_to_ho_lt",
            "lh_lt" => "xde_table.lh_lt",
            "lm_dispatch_lt" => "xde_table.lm_dispatch_lt",
			"week_no" => "xde_table.week_no",
            "handover_date2" => "xde_table.handover_date2",
            "month" => "xde_table.month",
            "year" => "xde_table.year",
            "m_and_y" => "xde_table.m_and_y",
        ];
        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('xde_table')
        ;

        // remove all unsearchable and unorderable columns
        foreach($data['columns'] AS $aKey=>$aData){
            if($aData['searchable'] === "false" OR $aData['orderable'] === "false"){
                unset($data['columns'][$aKey]);
            }
        }
        $data['columns'] = array_merge($data['columns']); // Reset array keys

        if(isset($data['filters']) AND !empty($data['filters'])){            
            foreach($data['filters'] AS $key=>$val){
                if($val != ""){
                    $this->db->like($columns[$key], $val);
                }
            }
        }

        if(isset($data['search']) && $data['search']!=null){
            $this->db->group_start();
            foreach($data['columns'] as $key => $val){
                if(isset($columns[$val['data']])){
                    if($key==0){
                        $this->db->like($columns[$val['data']], $data['search']['value']);
                    }else {
                        $this->db->or_like($columns[$val['data']], $data['search']['value']);
                    }
                }
            }
            $this->db->group_end();
        }

        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
                $this->db->order_by($columns[$data['columns'][$val['column']]['data']]." ".$val['dir']);
            }
        }
    
        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                $this->db->limit($data['length'],$data['start']);	
                }
            }
        }

        if(isset($data['id']) AND $data['id'] != ""){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }else{
            if(isset($data['recordsFiltered']) AND $data['recordsFiltered'] === true){
                return $this->db->count_all_results();
            }else{
                return $this->db->get()->result_array();
            }
        }
    }
}