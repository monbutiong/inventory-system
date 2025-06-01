<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){

		parent::__construct(); 

		$this->load->model("index_model");
		$this->load->model("admin_model");
		
	}

	public function load_first()
	{  
		$this->load->view('login');
	}

	public function validate_login(){

		$this->form_validation->set_rules('username','Username','required|max_length[225]');
		$this->form_validation->set_rules('password','Password','required|max_length[225]');

		if($this->form_validation->run() == TRUE){ 

				$result = $this->index_model->validate_login();

				if ($result['success'] == TRUE) { 

				    $account_data = array(
				        'user_id'        => $result['user_id'],
				        'name_of_user'   => $result['name_of_user'],
				        'account'        => $result['account'],
				        'department_id'  => $result['department_id'],
				        'username'       => $this->input->post("username", TRUE),
				        'datetime'       => sdatetime,
				        'logged_in'      => TRUE
				    );

				    $this->session->set_userdata($account_data);
				    $this->session->set_flashdata("success", "Login success");

				    // Audit Trail
				    $log_module = "login page";
				    $log_description = "login to account.";
				    $this->admin_model->audit_trail_logging($log_module, $log_description);

				    // Generate and store remember_token
				    $remember_token = bin2hex(random_bytes(32)); // Secure random token

				    // Set cookie (30 days)
				    setcookie('remember_token', $remember_token, time() + (86400 * 30), "/", "", true, true);

				    // Update DB
				    $this->db->where('id', $result['user_id']);
				    $this->db->update('account', [
				        'remember_token' => $remember_token,
				        'last_login' => date("Y-m-d H:i:s")
				    ]);

				    redirect("home", "refresh");

				} else {
				    $this->session->set_flashdata("error", "Invalid username/password.");
				}


				if($result['success']==FALSE){ 
					redirect(base_url(),"refresh");
				}

		}

		
		

	}

	public function email()
	{
		if(@$this->input->post('send_to')){

			$smtp_host = $this->input->post('smtp_host');
			$smtp_port = $this->input->post('smtp_port');
			$username  = $this->input->post('username');
			$password  = $this->input->post('password');
			$sender    = $this->input->post('send_from');
			$receiver  = $this->input->post('send_to');
			$security  = $this->input->post('security_type');
			$message   = $this->input->post('message');


			$this->load->library('email');
			//$this->email->set_newline("\r\n");


			//SMTP & mail configuration

			$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => $smtp_host,
		    'smtp_port' => $smtp_port,
		    'smtp_user' => $username,
		    'smtp_pass' => $password,
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8',
		    'smtp_crypto' => $security
		     //'newline'=>'\r\n',
		    // 'crlf'=>'\r\n'
			);
			$config['newline'] = "\r\n";
			$this->email->initialize($config);

			// //Email content
			$this->email->clear(TRUE);
			$this->email->to($receiver);
			$this->email->from($username,$sender);
			$this->email->subject('Serttech Email Testing');
			$this->email->message($message);
			//Send email
			
			$this->email->message($message);
			if($this->email->send()) {
				echo 'success'.'<br>'.$this->email->print_debugger();
			} 
			else 
			{   
				 echo 'error'.'<br>'.$this->email->print_debugger();
			} 

		}

		$this->load->view('email');
	}

}
