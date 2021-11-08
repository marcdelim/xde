<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Maintenance extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
	}
	
	public function index(){
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/htmlTabletoExcel/dist/jquery.table2excel.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
		
		$this->app->use_js(array("source"=>"maintenance/upload/list","cache"=>false));
		$this->app->use_js(array("source"=>"maintenance/upload/import","cache"=>false));
		$this->app->use_js(array("source"=>"maintenance/upload/export","cache"=>false));
		$header['header_data'] = "Maintenance";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('maintenance/index');
		$this->template->adminFooterTpl();
	}

	public function export_template(){
        $headers = [
            "port",
            "area_1",
            "area_2",
            "area_3",
            "del_sla",
            "rts_sla",
            "client",
            "del_sla_point",
            "rts_sla_point",
            "xde_wh",
        ];

        $filename = "Maintenance Template";
        $arrHeader = $headers;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($arrHeader, NULL ,'A1');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }


}