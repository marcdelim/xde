<?php

class Raw_data_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('pallet_model');
	}

	public function _remap(){
		redirect('site/error');
    }

    public function list(){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3000);
        $data = $this->input->post();
        $res = $this->pallet_model->data_list($data);
        $recordsTotal = count($res);
        $recordsFiltered = count($this->pallet_model->data_list($data,true));
        $draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
        $resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
        );
        echo json_encode($resData);
    }

    public function upload(){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3000);
        $this->load->library('raw_data/import/raw_data');
        echo $this->raw_data->process();
    }

    public function create_form(){
        $aData['fields'] = $this->item_master_model->field_list();
        $this->load->view('forms/item_master/create',$aData);
    }

    public function create(){
        $data = $this->input->post('data');
        $res = $this->item_master_model->insert_data($data);
        if($res){
            $data = $this->common->apiData('success','success_saving','Successfully saved');
        }else{
            $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
        }
        echo json_encode($data);
    }

    public function delete(){
        $data = $this->input->post('data');
        $arrId = array_column($data,'id');
        // $this->common->vd($arrId);
        // return;
        // exit();
        $res = $this->item_master_model->delete_data($arrId);
        if($res){
            $data = $this->common->apiData('success','success_saving','Successfully deleted');
        }else{
            $data = $this->common->apiData('error','error_saving','An error occurred while deleting!');
        }
        echo json_encode($data);
    }
}