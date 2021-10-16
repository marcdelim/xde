<?php

class S3_helper
{
	
	private $aAllowedApplication;
	private $aAllowedImage;
	private $bucketName;
	private $bucketBaseUrl;
    private $CI;

    public function __construct()
	{
		
		$this->CI = & get_instance();
		$siteConfig = $this->CI->config->item('site');
		$this->bucketName = $siteConfig['aws_bucket'];
		$this->bucketBaseUrl = $siteConfig['aws_bucket_base_url'];
		
		$this->aAllowedApplication = array('.pdf');
		$this->aAllowedImage = array('.gif','.jpg','.png');
		
        
    }
	
	public function upload_base64($base64Data,$folder=null,$oldImage="")
	{
		if($oldImage){
			if(!$this->delete_aws_obj($oldImage))
			{
				return $this->bucketBaseUrl.'/'.$this->bucketName.'/'.$oldImage;
			}
		}
		
		if($base64Data){
		
			$folder = $folder!=null ? $folder.'/' : '';
			$content = file_get_contents($base64Data);
			$extension ="";
			$filename = strtotime(date("Y-m-d H:i:s")).$this->CI->common->random_string();
			$pos  = strpos($base64Data, ';');
			$image_ext = explode(':', substr($base64Data, 0, $pos));
			switch ($image_ext[1]) {
				case 'image/gif':
					$extension = '.gif';
					break;
				case 'image/jpeg':
					$extension = '.jpg';
					break;
				case 'image/png':        
					$extension = '.png';
					break;
				case 'application/pdf':        
					$extension = '.pdf';
					break;
				default:
					return false;
					break;
				}
			$path = MODULES_PATH."core/temp/";		
			$save_filename = md5($_SERVER['REMOTE_ADDR']).'-'.$filename.$extension;
					
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}

			if(file_put_contents($path.$save_filename, $content)){
				if(file_exists($path.$save_filename)){
					
					if(in_array($extension,$this->aAllowedApplication)){
						return $this->application($path,$save_filename,$folder);
					}
					
					if(in_array($extension,$this->aAllowedImage)){
						return $this->image($path,$save_filename,$folder);
					}
					
					return '';
				
				}
			}
		}
	}
	
	public function application($path,$save_filename,$folder)
	{	
		$folder .= 'application/';
		
		if($this->CI->s3->putObjectFile($path.$save_filename,$this->bucketName,ENVIRONMENT.'/'.$folder.$save_filename,S3::ACL_PUBLIC_READ)){
			unlink($path.$save_filename);
			return ENVIRONMENT.'/'.$folder.$save_filename;
		}else{
			return '';
		}
	}
	
	public function image($path,$save_filename,$folder,$resize=false)
	{
		$this->CI->load->library('image_lib');
		
		$folder .= 'image/';
		
		if($resize){		
			$thumbnail['image_library'] = 'gd2';
			$thumbnail['source_image']	= $path.$save_filename;
			$thumbnail['new_image'] = $path.'thumb_'.$save_filename;
			$thumbnail['width']	= 100;
			$thumbnail['height']	= 100;
			$this->CI->image_lib->initialize($thumbnail); 
			$this->CI->image_lib->resize();
			$this->CI->image_lib->clear();
			
			$medium['image_library'] = 'gd2';
			$medium['source_image']	= $path.$save_filename;
			$medium['new_image'] = $path.'med_'.$save_filename;
			$medium['width']	= 250;
			$medium['height']	= 250;
			$this->CI->image_lib->initialize($medium); 
			$this->CI->image_lib->resize();
			$this->CI->image_lib->clear();

			if($this->CI->s3->putObjectFile($path.$save_filename,$this->bucketName,ENVIRONMENT.'/'.$folder.'full/'.$save_filename,S3::ACL_PUBLIC_READ) && 
			$this->CI->s3->putObjectFile($path.'thumb_'.$save_filename,$this->bucketName,ENVIRONMENT.'/'.$folder.'thumbnail/thumb_'.$save_filename,S3::ACL_PUBLIC_READ) &&
			$this->CI->s3->putObjectFile($path.'med_'.$save_filename,$this->bucketName,ENVIRONMENT.'/'.$folder.'medium/med_'.$save_filename,S3::ACL_PUBLIC_READ)){
				unlink($path.$save_filename);
				unlink($path.'thumb_'.$save_filename);
				unlink($path.'med_'.$save_filename);
				return ENVIRONMENT.'/'.$folder.'full/'.$save_filename;
			}else{
				return '';
			}
		}else{
			if($this->CI->s3->putObjectFile($path.$save_filename,$this->bucketName,ENVIRONMENT.'/'.$folder.'full/'.$save_filename,S3::ACL_PUBLIC_READ)){
				unlink($path.$save_filename);
				return ENVIRONMENT.'/'.$folder.'full/'.$save_filename;
			}else{
				return '';
			}
		}
	}
	
	public function delete_aws_obj($objPath)
	{
		if($objPath!="")
		{
			$extension = '.'.strtolower(pathinfo($objPath, PATHINFO_EXTENSION));
			
			if(in_array($extension,$this->aAllowedApplication)){
				return $this->CI->s3->deleteObject($this->bucketName,$objPath);
			}
			
			if(in_array($extension,$this->aAllowedImage)){
				$thumbnail = str_replace("full/","thumbnail/thumb_",$objPath);
				$medium = str_replace("full/","medium/med_",$objPath);
				
				$this->CI->s3->deleteObject($this->bucketName,$objPath);
				$this->CI->s3->deleteObject($this->bucketName,$thumbnail);
				$this->CI->s3->deleteObject($this->bucketName,$medium);
				
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function get_aws_attachment_size($imageUrl,$type="full")
	{
		if($type=="thumbnail"){
			return str_replace("full/","thumbnail/thumb_",$imageUrl);
		}else if($type=="medium"){
			return str_replace("full/","medium/med_",$imageUrl);
		}else{
			return $imageUrl;
		}
	}	
}
