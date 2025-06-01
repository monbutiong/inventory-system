<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {


	var $system_menu = array(); 

	public function __construct(){

		parent::__construct();  

		$this->load->model("home_model");
		$this->load->model("admin_model"); 
		$this->load->model("employee_model"); 
		$this->load->model("core_model", "core"); 

		$result = $this->admin_model->load_index_data();
		$this->system_menu['main_menu'] = $result['main_menu'];
		$this->system_menu['sub_menu'] = $result['sub_menu'];  
		$this->system_menu['index_user_roles'] = $result['index_user_roles'];
		$this->system_menu['settings'] = $result['settings']; 
		$this->system_menu['avatar'] = $result['avatar']; 


		/* check session if valid $this->load->helper("accountsession"); */
 		$accountsession = new Session_check();
		$accountsession->check_account_session($this->session->user_id);
		
	}

	public function master_list(){

		$module = $this->system_menu;

		$module['module'] = "employee/master_list";
		$module['map_link']   = "employee > employee_master_list";  

		$result = $this->employee_model->load_employee_list();
		$module['employee'] = $result['employee']; 

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manpower');
		$module['designation'] = $result['maintenance_data'];

		$this->load->view('admin/index',$module);

	}

	public function add_employee_content(){
		
		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manpower');
		$module['designation'] = $result['maintenance_data'];

		$this->load->view('admin/employee/add_employee_content',$module);
	}

	public function add_new_employee(){
 		
 		$this->form_validation->set_rules('last_name','Last Name','required');
 		$this->form_validation->set_rules('first_name','First Name','required');
 		$this->form_validation->set_rules('department_id','Department','required');
 		$this->form_validation->set_rules('designation_id','Designation','required');


		if($this->form_validation->run() == true){

			$result = $this->employee_model->add_employee(); 

			if($result['result'] == true){ 

				/* AUDIT TRAIL */
				$log_module = "employee > add new employee";
				$log_description = "create new employee information. employee id : ".$result['employee_id'];
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","new employee added"); 
		 		redirect("employee/master_list","refresh"); 
			}

		} 

		$this->master_list();
	}

	public function delete_employee($id){

		$result = $this->employee_model->delete_employee($id); 

			if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "employee > delete employee";
				$log_description = "delete employee information. employee id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","employee was successfully deleted");  
			}else{
				$this->session->set_flashdata("error","error deleting employee");  
			}

		 	redirect("employee/master_list","refresh"); 
	}

	public function edit_employee_content($id){
		
		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manpower');
		$module['designation'] = $result['maintenance_data'];

		$result = $this->employee_model->select_employee($id);
		$module['employee'] = $result['employee'];

		$this->load->view('admin/employee/edit_employee_content',$module);
	}


	public function update_employee($id){

		$this->form_validation->set_rules('last_name','Last Name','required');
 		$this->form_validation->set_rules('first_name','First Name','required');
 		$this->form_validation->set_rules('department_id','Department','required');
 		$this->form_validation->set_rules('designation_id','Designation','required');


		if($this->form_validation->run() == true){

			$result = $this->employee_model->update_employee($id); 

			if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "employee > update employee";
				$log_description = "update employee information. employee id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","employee information successfully updated");  
			}else{
				$this->session->set_flashdata("error","error saving information");  
			}

		 	redirect("employee/master_list","refresh");

		 }

		 $this->master_list();

	}

	public function view_employee_content($id){
		
		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manpower');
		$module['designation'] = $result['maintenance_data'];
  
		$result = $this->employee_model->select_employee($id);
		$module['employee'] = $result['employee']; 

		$this->load->view('admin/employee/view_employee_content',$module);
	}

	public function upload(){

		$emp = $this->db->select('id,employee_number,first_name,last_name')->get_where('employee',['deleted'=>0])->result();
 
		$this->db->where('a.deleted',0);
		$this->db->select('a.id, a.job_order_number, b.name'); 
        $this->db->from('projects_job_order a'); 
        $this->db->join('projects b', 'b.id=a.project_id', 'left');   

        $jo = $this->db->get()->result();  

		// API Endpoint
		$apiUrl = api_url.'/api/update_employees';

		// Data to be sent in the POST request
		$postData = [ 
		    'emp' => json_encode($emp),
		    'jo' => json_encode($jo),
		    // Add more key-value pairs as needed
		];

		// Initialize cURL session
		$ch = curl_init($apiUrl);

		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
		curl_setopt($ch, CURLOPT_POST, true); // Set as POST request
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Set POST data

		// Execute cURL session and get the response
		$response = curl_exec($ch);

		// Check for cURL errors
		if (curl_errno($ch)) {
			
			$this->session->set_flashdata("error","error saving information: ".json_encode(curl_error($ch))); 

		  

		}else{

			$this->session->set_flashdata("success","employee information successfully updated");  

			

		}

		// Close cURL session
		curl_close($ch);

		redirect("employee/master_list","refresh");

	}


}