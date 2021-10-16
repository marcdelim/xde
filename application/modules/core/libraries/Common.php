<?php

class Common
{
   private $asort_field = array();
   private $adefault_field = '';
   private $sdefault_order = 'desc';
   private $CI;
   private $cond_operators = array('=', "<", "<=", ">", ">=");

   public function __construct()
   {
      $this->CI =& get_instance();
   }

   public function curl_request( $url , $param = null)
   {
      $cl = curl_init();
      $opts[CURLOPT_RETURNTRANSFER] = 1;
      $opts[CURLOPT_URL] = $url;

      if(is_null($param) === false){
         $opts[CURLOPT_POST] = true;
         $opts[CURLOPT_POSTFIELDS] = $param;
      }
      curl_setopt_array($cl, $opts);
      return curl_exec($cl);
  }

	public function get_cond_operators(){
		return $this->$cond_operators;
	}

    public function get_file_type($sfile)
	{
	  return explode('/',$this->get_mime_type($sfile))[0];
	}
  
   public function get_mime_type($sfile)
   {
      $mime_types = array(
         "pdf"=>"application/pdf"
         ,"exe"=>"application/octet-stream"
         ,"zip"=>"application/zip"
         ,"docx"=>"application/msword"
         ,"doc"=>"application/msword"
         ,"xlsx"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
         ,"xls"=>"application/vnd.ms-excel"
         ,"ppt"=>"application/vnd.ms-powerpoint"
         ,"gif"=>"image/gif"
         ,"png"=>"image/png"
         ,"jpeg"=>"image/jpg"
         ,"jpg"=>"image/jpg"
         ,"mp3"=>"audio/mpeg"
         ,"wav"=>"audio/x-wav"
         ,"mpeg"=>"video/mpeg"
         ,"mpg"=>"video/mpeg"
         ,"mpe"=>"video/mpeg"
         ,"mov"=>"video/quicktime"
         ,"avi"=>"video/x-msvideo"
         ,"3gp"=>"video/3gpp"
         ,"css"=>"text/css"
         ,"jsc"=>"application/javascript"
         ,"js"=>"application/javascript"
         ,"php"=>"text/html"
         ,"htm"=>"text/html"
         ,"html"=>"text/html"
         ,"txt" => "text/plain"
         ,"xml" => "application/xml"
         ,"xsl" => "application/xml"
         ,"tar" => "application/x-tar"
         ,"swf" => "application/x-shockwave-flash"
         ,"odt" => "application/vnd.oasis.opendocument.text"
         ,"ods" => "application/vnd.oasis.opendocument.spreadsheet"
         ,"odp" => "application/vnd.oasis.opendocument.presentation"
      );

	  $extension = strtolower(pathinfo($sfile, PATHINFO_EXTENSION));
	  return $mime_types[$extension];
   }

   public function vd($var)
   {
      echo "<pre>";
      var_dump($var);
      echo "</pre>";
   }

	public function apiData($status,$type,$message,$data=null)
	{
		$data = array(
			'status' => $status,
			'type'=> $type,
			'message' => $message,
			'data' => $data,
		);
		
		return $data;
	}

	public function restDataToArray($restData)
	{
		return json_decode(json_encode($restData),true);
	}

	public function _send_email($tpl_name,$aData)
	{
	
		$this->CI->load->library('email');
		
		$siteConfig = $this->CI->config->item('site');
		$mailDetails = $siteConfig['mail'];
		
		$protocol = $mailDetails['protocol'];
		$host = $mailDetails['host'];
		$user = $mailDetails['user'];
		$pwd = $mailDetails['pwd'];
		$port = $mailDetails['port'];
		
		$config = array(
			'protocol' => $protocol,
			'smtp_host' => $host,
			'smtp_user' => $user,
			'smtp_pass' => $pwd,
			'smtp_port' => $port,
			'mailtype' => 'html',
			'newline' => "\r\n",
		);
		
		$this->CI->email->initialize($config);
		$this->CI->email->from($user, $siteConfig['system_slug'].' | NOREPLY');
		if(ENVIRONMENT=='production'){
			$this->CI->email->to($aData['email']);
			$recipients = '';
		}else{
			$this->CI->email->to(implode(',',$mailDetails['test_recipients']));
			$recipients = ' | To : '.$aData['email'];
		}
		$this->CI->email->subject($aData['subject'] . ' | '.$siteConfig['system_slug'].$recipients);
		$this->CI->email->message($this->CI->load->view('site/emails/'.$tpl_name, $aData, TRUE));
		
		return $this->CI->email->send();
		
	}

	public function get_client_ip()
	 {
	    $ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])){
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		}
		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		}
		else if(isset($_SERVER['HTTP_FORWARDED'])){
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		}
		else if(isset($_SERVER['REMOTE_ADDR'])){
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		}
		else{
			$ipaddress = 'UNKNOWN';
		}
	 
		return $ipaddress;
	 }
	
	public function numToExcelColumn($num) {
		$numeric = ($num - 1) % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval(($num - 1) / 26);
		if ($num2 > 0) {
			return $this->numToExcelColumn($num2) . $letter;
		} else {
			return $letter;
		}
	}
	
	public function ordSuffixFloor($n) 
	{
	  if($n==''){return '';}
	  $str = "$n";
	  $t = $n > 9 ? substr($str,-2,1) : 0;
	  $u = substr($str,-1);
	  if ($t==1) 
		return $str . 'th';
	  else 
		  switch ($u) 
		  {
			  case 1: return $str . 'st Floor';
			  case 2: return $str . 'nd Floor';
			  case 3: return $str . 'rd Floor';
			  default: return $str . 'th Floor';
		  }
	}
   

   public function file_size($ifile_size)
   {
       if ($ifile_size < 1024) {
           return array($ifile_size, 'B');
       } elseif ($ifile_size < 1048576) {
           return array(round($ifile_size / 1024, 2),'KiB');
       } elseif ($ifile_size < 1073741824) {
           return array(round($ifile_size / 1048576, 2),'MiB');
       } elseif ($ifile_size < 1099511627776) {
           return array(round($ifile_size / 1073741824, 2), 'GiB');
       } elseif ($ifile_size < 1125899906842624) {
           return array(round($ifile_size / 1099511627776, 2),'TiB');
       } elseif ($ifile_size < 1152921504606846976) {
           return array(round($ifile_size / 1125899906842624, 2),'PiB');
       } elseif ($ifile_size < 1180591620717411303424) {
           return array(round($ifile_size / 1152921504606846976, 2),'EiB');
       } elseif ($ifile_size < 1208925819614629174706176) {
           return array(round($ifile_size / 1180591620717411303424, 2),'ZiB');
       } else {
           return array(round($ifile_size / 1208925819614629174706176, 2),'YiB');
       }
   }

	public function ssp_filter($request,$columns)
	{
		$columnFilter = array();
		$dtColumns = $this->ssp_pluck( $columns, 'dt' );
		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['searchable'] == 'true' ) {
					$columnFilter[] = $column['db'];
				}
			}
			return $columnFilter;
		}
	}
	
	public function ssp_filter_all($request,$columns)
	{
		$columnFilter = array();
		$dtColumns = $this->ssp_pluck( $columns, 'dt' );
		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['searchable'] == 'true' ) {
					$colData['db'] = $column['db'];
					$colData['search'] = $request['search']['value'];
					$columnFilter[] = $colData;
				}
			}
			
		}
		
		// Individual column filtering
		if( isset( $request['columns'] ) ) {
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				$str = $requestColumn['search']['value'];
				if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
					// $columnFilter[] = $column['db'];
					$colData['db'] = $column['db'];
					$colData['search'] = $str;
					$columnFilter[] = $colData;
				}
			}
		}
		
		return $columnFilter;
	}
   
   public function ssp_pluck ( $a, $prop )
	{
		$out = array();
		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}
		return $out;
	}
   
   public function ssp_order ( $request, $columns )
	{
		// $order = ar;
		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			$dtColumns = $this->ssp_pluck( $columns, 'dt' );
			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				//Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';
					$orderBy[] = array($column['db'],$dir);
				}
			}
			return $orderBy;
		}
		// return $order;
	}
   
   public function ssp_data_output ( $columns, $data )
	{
		$out = array();
		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();
			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
				}
				else {
					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
				}
			}
			$out[] = $row;
		}
		return $out;
	}
	
	public function ssp_data_format($draw,$total,$filtered,$data,$columns)
	{
		return array(
			"draw"            => $draw,
			"recordsTotal"    => $total,
			"recordsFiltered" => $filtered,
			"data"            => $this->ssp_data_output($columns, $data )
		);
	}


	function generate_months( $field_name = 'month' ) {
	    $arrMonth = array();
	    for( $i = 1; $i <= 12; $i++ ) {
	        $month_num = str_pad( $i, 2, 0, STR_PAD_LEFT );
	        $month_name = date("F", mktime(0, 0, 0, $i));
	        //array_push($arrMonth, array($i=>$month_name));
	        $arrMonth[$i] = $month_name;
	    }
	    return $arrMonth;
	}

	
	public function getTimeFormat($overbreak_time){
		$time = ltrim($overbreak_time , ' ');
		$time = ltrim($overbreak_time , ':');
		$time_arr = explode(':', $time);
		if(count($time_arr) > 2){
			$time = $time_arr[0].':'.$time_arr[1].':'.$time_arr[2];
		}else if(count($time_arr) == 2){
			$time = '00:'.$time; 
		}else{
			$time = '00:00:'.$time_arr[0];
		}
		return $time;
	}

	public function date_string_dhms($time){
	
		$time = explode(':', $time);
		$timestr = '';
		if(intval($time[0]) > 0){
			$timestr .= $time[0] .'h ';
		}
		if(intval($time[1]) > 0){
			$timestr .= $time[1] .'m ';
		}
		if(intval($time[2]) > 0){
			$timestr .= $time[2] .'s ';
		}

		if(intval($time[0]) == 0 && intval($time[1]) == 0 && intval($time[2]) == 0 ){
			$timestr = '0';
		}
		return $timestr;
	}
	
	
	public function replace_key($array,$keys)
	{
		foreach($array as $key => $val){
			foreach($keys as $rKey => $rVal){
				$array[$key][$rKey] = $array[$key] [$rVal];
				unset($array[$key][$rVal]);
			}
		}
		return $array;
	}
	
	public function random_string($n=5)
	{

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < $n; $i++) {
			$_offset = rand(0, strlen($characters));
			$offset = $_offset== 0 ? $_offset : $_offset-1;
			$randstring .= $characters[$offset];
		}
		return $randstring;
	}

	public function arr_value_as_key($arr){
		$columns = [];
        foreach($arr AS $key => $value){
          $columns[] = $value." AS ".$key;
        }
        return $columns;
	}
}