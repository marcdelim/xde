<?php
class Maintenance_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function field_list(){
        return $this->db->query('SHOW COLUMNS FROM maintenance_table')->result_array();
    }

    public function batch_insert_data($data){
        return $this->db->insert_batch('maintenance_table',$data);
    }

    public function insert_data($data){
        return $this->db->insert('maintenance_table',$data);
    }

    public function clear_uploaded_data(){
        return $this->db->truncate('maintenance_table');
    } 

    public function data_list($data, $no_limit = false){
        $this->db->save_queries = FALSE;
        $columns = [
            "port" => "maintenance_table.port",
            "area_1" => "maintenance_table.area_1",
            "area_2" => "maintenance_table.area_2",
            "area_3" => "maintenance_table.area_3",
            "del_sla" => "maintenance_table.del_sla",
            "rts_sla" => "maintenance_table.rts_sla",
            "client" => "maintenance_table.client",
            "del_sla_point" => "maintenance_table.del_sla_point",
            "rts_sla_point" => "maintenance_table.rts_sla_point",
            "xde_wh" => "maintenance_table.xde_wh",
        ];
        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('maintenance_table')
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