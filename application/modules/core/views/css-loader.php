<?php
if($acss_source){
	
	// $acssFiles = array_column($acss_source,'sfile');
	
	// $_acssFiles = [];
	
	// foreach($acssFiles as $key => $val)
	// {
		// $expAssets= explode('request/assets/',$val);
		// $module = explode('/',$expAssets[1]);
		// $path = str_replace($module[0].'/'.$module[1],"",$expAssets[1]);
		// $_acssFiles[$key] = APPPATH.'modules/'.$module[0].'/assets/'.$module[1].$path;
	// }
	
	// $this->minify->css($_acssFiles);
	// $this->minify->deploy_css();
	// echo '<link rel="stylesheet" href="'.base_url('core/request/assets/site/minify/styles.min.css').'" />';
	
  foreach($acss_source as $rows){
   $sattributes = "";
   if(isset($rows['attributes'])){
      foreach($rows['attributes'] as $key=>$val){
         $sattributes .= " " . $key . '="' . $val . '"'; 
      }
   }
?>
<link rel="stylesheet" href="<?php echo $rows['sfile'];?><?php echo ( $rows['cache'] === true ) ? "?cac=true" : "";?>" <?php echo $sattributes;?>/>
<?php
  }
}