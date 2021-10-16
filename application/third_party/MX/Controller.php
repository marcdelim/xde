<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->load->library('email');
		$this->load->model("user/User_model", "user");
		$this->load->library('email');	
		date_default_timezone_set('Asia/Manila');
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}

	public function send_reject($rfp_id){
		$rfp = $this->rfp->get_by_id($rfp_id);
		$user = $this->user->get_by_id($rfp->requestor_user_id);

		$to = $user->email;

		$subject = "e-RFP Rejection Notification";
		
		if(in_array(3, $this->session->userdata('roles'))){
			$rejector = 'Approver';
			$note = $rfp->remarks;
		}else{
			$rejector = 'AP Processor';
			$note = $rfp->ap_note;
		}
		$data['type'] = 'reject';
		$data['note'] = $note;
		$data['reference_no'] = $rfp->rfp_reference_no;

		$message = $this->load->view('email_sending/message', $data, true);

		$sending = $this->sending($subject, $to, $message);

		return $sending;
	}

	public function send_release($rfp_id){
		$rfp = $this->rfp->get_by_id($rfp_id);
		$user = $this->user->get_by_id($rfp->requestor_user_id);

		$to = $user->email;

		$subject = "e-RFP Notification for Payment Release";
		
		$data['type'] = 'released';

		$message = $this->load->view('email_sending/message', $data, true);

		$sending = $this->sending($subject, $to, $message);

		return $sending;
	}

	public function sending($subject, $to, $message){
		
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'smtp.office365.com';
		$config['smtp_port']    = '587';
		$config['smtp_user']    = 'erfpnotification-noreply@metropacmovers.com';
		$config['smtp_pass']    = 'pfrE@dm1n!';
		$config['charset']    = 'utf-8';
		$config['smtp_crypto'] = 'tls';
		$config['newline']    = "\r\n";
		
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not  

		
		
		$this->email->initialize($config);
		$this->email->set_crlf( "\r\n" );
		$this->email->from('erfpnotification-noreply@metropacmovers.com', 'erfpnotification-noreply');
		$this->email->subject($subject);

		
		$this->email->to($to);
		$this->email->message($message);
		
		if($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();die();
		}
	}

	public function audit_trail($audit_rfp_id, $action, $message, $approver_id=false){
		$data = array(
			'audit_rfp_id' => $audit_rfp_id,
			'action' => $action,
			'data' => json_encode($message),
			'trail_user_id' => $this->session->userdata('user_id'),
			'trail_approver_id' => $approver_id ? $approver_id : '',
			'date_time' => date('Y-m-d H:i:s')
		);

		$this->user->save_trail($data);
	}

	public function tag_approver($rfp_id, $approver_id){
		$exist = $this->rfp->exist_tag_approver($rfp_id, $approver_id);

		if(!$exist){
			$data = array(
				'tag_approver_rfp_id' => $rfp_id,
				'tag_approver_approver_id' => $approver_id
			);

			$this->rfp->save_tag_approver($data);
		}
	}

}