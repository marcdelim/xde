<script type="text/javascript">
(function(){
   window.urls = {
      base_url : '<?php echo base_url();?>',
   }
})();
</script>
<?php

	// $ajsFiles = array_column($ajs_source,'sfile');
	
	// $_ajsFiles = [];
	
	// foreach($ajsFiles as $key => $val)
	// {
		// $expAssets= explode('request/assets/',$val);
		// $module = explode('/',$expAssets[1]);
		// $path = str_replace($module[0].'/'.$module[1],"",$expAssets[1]);
		// $_ajsFiles[$key] = APPPATH.'modules/'.$module[0].'/assets/'.$module[1].$path;
	// }
	
	
	// $this->minify->js($_ajsFiles);
	// $this->minify->deploy_js();
	// echo '<script src="'.base_url('core/request/assets/site/minify/scripts.min.js').'" type="text/javascript" ></script>';


if($ajs_source):
   foreach($ajs_source as $rows):
   $aoptions = array();   
      $sattributes = "";
      if(isset($rows['attributes'])){
         foreach($rows['attributes'] as $key=>$val){
            $sattributes .= " " . $key . '="' . $val . '"'; 
         }
      }
      if($rows['cache']===true){
         $aoptions["cac"] = "true";
      }
      $sqry_string = ( ($aoptions) ? "?" : "" ).  http_build_query($aoptions);

?>
<script <?php echo $sattributes;?> type="text/javascript" src="<?php echo $rows['sfile'];?><?php echo $sqry_string;?>"></script>
<?php
  endforeach;
endif;
?>

