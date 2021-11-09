<?php

class Raw_data_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('upload_model');
	}

	public function _remap(){
		redirect('site/error');
    }

    public function list(){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time',0);
        $data = $this->input->post();
        $res = $this->upload_model->data_list($data);
        $recordsTotal = count($res);
        $recordsFiltered = count($this->upload_model->data_list($data,true));
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
        // clear data
        $clear_data =  $this->upload_model->clear_uploaded_data();
        // import file
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time',0);
        $this->load->library('raw_data/import/data_upload');
        echo $this->data_upload->process();
    }

    public function create_form(){
        $aData['fields'] = $this->item_master_model->field_list();
        $this->load->view('forms/item_master/create',$aData);
    }

}