<?php

class Template extends MX_Controller {

	private $smodule;
	public $enable_page_heading = false;
	public $enable_page_breadcrumbs = false;
	protected $system_name = "";
	
	public function __construct()
    {
      parent::__construct();
      $this->smodule = 'site';
        
      	$this->load->module("core/app");
		$this->system_name = $this->config->item('site')['system_name'];
		
		// CSS
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/bootstrap/css/bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/font-awesome/css/font-awesome.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/themify-icons/css/themify-icons.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/pace/themes/orange/pace-theme-minimal.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/vendor/animate/animate.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/bootstrap-tour/css/bootstrap-tour.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/vendor/jqvmap/jqvmap.min.css","cache"=>false));
		
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/main.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/skins/sidebar-nav-darkgray.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/skins/navbar3.css","cache"=>false));
		/*
		<!-- MAIN CSS -->
		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
		*/

		// JS
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery/jquery.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'core/js/core.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/bootstrap/js/bootstrap.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/pace/pace.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/Flot/jquery.flot.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/Flot/jquery.flot.resize.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/Flot/jquery.flot.time.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/flot.tooltip/jquery.flot.tooltip.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery.maskedinput/jquery.maskedinput.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/moment/min/moment.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-sparkline/js/jquery.sparkline.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/bootstrap-tour/js/bootstrap-tour.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/widget.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/data.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/scroll-parent.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/disable-selection.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/widgets/mouse.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-ui/ui/widgets/sortable.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/datatables/js-main/jquery.dataTables.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/datatables/js-bootstrap/dataTables.bootstrap.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jquery-appear/jquery.appear.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jqvmap/jquery.vmap.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jqvmap/maps/jquery.vmap.world.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/jqvmap/maps/jquery.vmap.usa.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/chart-js/Chart.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/raphael/raphael.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/vendor/justgage-toorshia/justgage.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/scripts/klorofilpro-common.min.js',"cache"=>false));
    }
	
	public function _remap()
    {
      redirect('site/error');
    }
	
	/* Admin Templates */
	
	public function adminHeaderTpl($header_data=NULL)
	{
		$header_data['sys_name'] = $this->system_name;
		$this->app->header($this->smodule.'/layout/default/header',$header_data);
	}
	
	public function adminSideBarTpl($aData=NULL)
	{
		$this->load->config('menu');
		$aData['active'] = $this->uri->segment(1);
		$this->load->helper('site');
		$aData['user_profile']["tup_fname"] = "Admin";
		$aData['user_profile']["tup_mname"] = "";
		$aData['user_profile']["tup_lname"] = "";
		$aData['user_profile']["tut_name"] = "";
		$aData['menu'] = "";
		$this->app->content($this->smodule.'/layout/default/sidebar',$aData);
	}
	
	public function adminFooterTpl($aData=NULL)
	{
		$this->app->footer($this->smodule.'/layout/default/footer',$aData);
	}
}