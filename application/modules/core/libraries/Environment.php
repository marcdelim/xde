<?php

class Environment
{
   public $assets_path;
   public $asset_path;
   public $exec_path;
   public $ajax_path;
   public $upload_path;
   public $request_path;
   public $getfile_path;
   public $module_path;
   public $module_assets_path;
   public $module_name;
   public $CI;
   // public $sjquery_js;
   // public $sjquery_ui_js;
   // public $sjquery_css;
   // public $score_style;


   public function __construct()
   {
      $this->CI =& get_instance();
      $asegment = $this->CI->uri->segment_array();
      $smain_module = "core/";
      $this->assets_path = base_url() . $smain_module . 'request/assets/';
      $this->asset_path = base_url() . $smain_module . 'request/assets';
      $this->exec_path = base_url() . $smain_module . 'request/exec/';
      $this->ajax_path = base_url() . $smain_module . 'request/ajax/';
      $this->request_path = base_url() . $smain_module . 'request/';
      $this->upload_path = base_url() . $smain_module . 'request/upload/';
      $this->getfile_path = base_url() . $smain_module . 'request/getfile/';
	  $this->module_name = isset($asegment[1]) ? $asegment[1] : '';
      $this->module_path = base_url() . $this->module_name . '/';
      
      
      // $ainfo['assets_path'] = $this->assets_path;
      // $ainfo['exec_path'] = $this->exec_path;
      // $ainfo['ajax_path'] = $this->assets_path;
      // $ainfo['upload_path'] = $this->upload_path;
      // $ainfo['module_path'] = $this->module_path;
      // $ainfo['request_path'] = $this->request_path;
      // $ainfo['module_assets_path'] = $this->module_assets_path;
      // $ainfo['module_name'] = $this->module_name;
   }
}
