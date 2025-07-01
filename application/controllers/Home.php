<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


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

	public function side_bar_menu(){
		$result = $this->admin_model->load_index_data();
		$module['main_menu'] = $result['main_menu'];
		$module['sub_menu'] = $result['sub_menu'];
		return $module;
	}
 

	public function index(){

		$module = $this->system_menu;

		$module['module'] = "home";
		$module['map_link']   = "home";  
  
		$this->load->view('admin/index',$module);

	}

	public function set_barcode($code)
	{
		 
		$this->load->library('zend'); 
		$this->zend->load('Zend/Barcode');
		 
		$imageResource = Zend_Barcode::render('code128', 'image', array('text'=>$code), array()); 

		/*
		return imagejpeg($imageResource, 'barcode'.$code.'.jpg', 100);

		imagedestroy($imageResource); 
		*/
	}

	public function by_serial_number(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "home/bib_by_serial";
		$module['map_link']   = "bib_by_serial";  
  
		$this->load->view('admin/index',$module);

	}

	public function inventory_data(){

		//$result = $this->core->load_inventory_data();
		//$module['inventory']    = $result['inventory'];
		//$module['totaldata']	  = $result['totaldata'];
		//$module['draw']      	  = $result['draw'];  

		$result = $this->admin_model->load_filemaintenance('fm_customer');
		$module['customer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_bib_type');
		$module['bib_type'] = $result['maintenance_data'];

		$module['inventory'] = $this->core->load_core_data('inventory');
 
		$this->load->view('admin/home/master_list_json',$module);

	}

	public function inventory_data_sn(){

		$result = $this->core->load_inventory_data();
		$module['inventory']    = $result['inventory'];
		$module['totaldata']	  = $result['totaldata'];
		$module['draw']      	  = $result['draw'];  

		$result = $this->admin_model->load_filemaintenance('fm_bib_location');
		$module['bib_location'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_bib_status');
		$module['bib_status'] = $result['maintenance_data'];
 
		$this->load->view('admin/home/master_list_sn_json',$module);

	}
 
  
	public function dashboard(){

		$module = $this->system_menu; 
  
		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "home/dashboard";
		$module['map_link']   = "home > dashboard";  

		$result = $this->admin_model->load_filemaintenance('fm_customer');
		$module['customer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_bib_type');
		$module['bib_type'] = $result['maintenance_data'];

		$module['inventory'] = $this->core->load_core_data('inventory');

		$this->load->view('admin/index',$module);  

	}


	public function employee_crud()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('employee');
		$crud->set_subject('Employee');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function profile(){

		$module = $this->system_menu;

		$module['module'] = "profile";
		$module['map_link']   = "home > profile"; 

		$result = $this->admin_model->system_user_info(); 
		$module['avatar'] = $result['avatar'];

		  
		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_designation');
		$module['designation'] = $result['maintenance_data'];

		$result = $this->admin_model->load_audit_trail();
		$module['audit_trail'] = $result['audit_trail'];

		$this->load->view('admin/index',$module);

	}

	public function change_password(){

		$module = $this->system_menu;

		$module['module'] = "change_password";
		$module['map_link']   = "home > change_password"; 

		$this->load->view('admin/index',$module);

	}

	public function save_new_password(){

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('current_password','Current Password','required|min_length[5]|max_length[225]');
		$this->form_validation->set_rules('new_password','New Password','required|min_length[5]|max_length[225]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]');

		if($this->form_validation->run() == true){

				$result = $this->home_model->change_password(); 

				if($result == true){ 

						/* AUDIT TRAIL */
						$log_module = "profile settings > change password";
						$log_description = "change profile password";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","new password saved");

				 		redirect("home/change_password","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving new password"); 
				}

		}

		  
		$this->change_password();
	}

	public function settings(){

		$module = $this->system_menu;

		$module['module'] = "settings";
		$module['map_link']   = "home > settings"; 

		$this->load->view('admin/index',$module);

	}

	public function settings_update(){

		$module = $this->system_menu;

		$module['module'] = "settings";
		$module['map_link']   = "home > dashboard"; 

		$result = $this->home_model->settings_update(); 

		if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "profile settings";
				$log_description = "update profile settings";
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","new settings saved"); 
		 		redirect("home/settings","refresh"); 
		}else{
				$this->session->set_flashdata("error","error saving new settings"); 
		}

		$this->load->view('admin/index',$module);

	}

	public function system_users(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		//$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "home/system_users";
		$module['map_link']   = "home > system_users"; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		
		$result = $this->admin_model->load_user_roles_all();
		$module['user_roles'] = $result['user_roles'];

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];
		

		$result = $this->employee_model->load_employee_list();
		$module['employee'] = $result['employee']; 

		$this->load->view('admin/index',$module);

	}

	public function user_roles($id){

		$module = $this->system_menu;

		$module['module'] = "home/user_roles";
		$module['map_link']   = "home > user_roles"; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user'];
		$emp_id = $result['emp_id'];

		$result = $this->admin_model->load_user_roles($id);
		$module['user_roles'] = $result['user_roles']; 

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_designation');
		$module['designation'] = $result['maintenance_data'];

		$module['id'] = $id;

		$this->load->view('admin/index',$module);

	}

	public function add_system_users_content(){
		
		$result = $this->employee_model->load_employee_list();
		$module['employee'] = $result['employee']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users']; 

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$this->load->view('admin/home/add_system_user_content',$module);
	}

	public function add_new_system_user(){
 		 
 		$this->form_validation->set_rules('account_details','Account Details','required');
 		$this->form_validation->set_rules('username','Username','required');
 		$this->form_validation->set_rules('password','Password','required|min_length[5]|max_length[225]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|matches[password]');
		
		if($this->form_validation->run() == true){

			$result = $this->home_model->add_system_user(); 

			if($result["result"] == true){ 


				if(@$_FILES['avatar']['name']){

					   $targetDir = "./assets/uploads/avatar/";

				       $file_name = $_FILES['avatar']['name'];
				       $file_tmp = $_FILES['avatar']['tmp_name'];
			 			
			 		   $fname = uniqid(). '_'. $file_name;		
			 
			           $newFileName = $targetDir . $fname;

			           if(move_uploaded_file($file_tmp, $newFileName)){
			                
			           		$this->db->where('id',$result["inserted_id"])->update('account',[
			           			'avatar'=>$fname
			           		]);
			           }  

				} 
				/* AUDIT TRAIL */
				$log_module = "home > system user";
				$log_description = "add new system user , user id : ".$result["inserted_id"];
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","new system user added"); 
		 		redirect("home/system_users","refresh"); 
			}else{
				$this->session->set_flashdata("error","Error saving");
			}

		}else{
			$this->session->set_flashdata("error","Error saving: Invalid Entry");
		}

		redirect("home/system_users","refresh");
	}

	public function save_user_roles($id){

		$result = $this->home_model->update_user_roles($id); 

		if($result == true){ 

			/* AUDIT TRAIL */
			$log_module = "home > system user > update user roles";
			$log_description = "update system user restriction, user id : ".$id;
			$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

	 		$this->session->set_flashdata("success","user roles successfully updates");  
		}else{
			$this->session->set_flashdata("error","error saving information");  
		}

	 	redirect("home/user_roles/$id","refresh");
	}

	public function edit_user($id){
		
		$result = $this->employee_model->load_employee_list();
		$module['employee'] = $result['employee']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users']; 

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['department'] = $result['maintenance_data'];

		$module['user'] = $this->db->get_where('account',['id'=>$id])->row();

		$this->load->view('admin/home/edit_system_user_content',$module);
	}

	public function update_system_user($id){

			$result = $this->db->where('id',$id)->update('account',[
				'name' 		  => $this->input->post('name',TRUE),
				'account_details' => $this->input->post('account_details',TRUE),
				'un'	      	  => $this->input->post('username',TRUE)
			]); 

			if($result){ 

				if(@$_FILES['avatar']['name']){

					   $targetDir = "./assets/uploads/avatar/";

				       $file_name = $_FILES['avatar']['name'];
				       $file_tmp = $_FILES['avatar']['tmp_name'];
			 			
			 		   $fname = uniqid(). '_'. $file_name;		
			 
			           $newFileName = $targetDir . $fname;

			           if(move_uploaded_file($file_tmp, $newFileName)){
			                
			           		$this->db->where('id',$id)->update('account',[
			           			'avatar'=>$fname
			           		]);
			           }  

				}  

		 		 
			}

			$this->session->set_flashdata("success","  system user updated"); 
		 	redirect("home/system_users","refresh");

	}

	public function delete_account($id){

		$result = $this->home_model->delete_system_user($id); 

			if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "home > system user > delete user";
				$log_description = "detele system user, user id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		//$this->session->set_flashdata("success","account was successfully removed"); 
		 		echo 1; 
			}else{
				//$this->session->set_flashdata("error","error deleting account");  
				echo 0;
			}
			die();
		 	//redirect("home/system_users","refresh"); 
	}

	public function change_picture(){

		$this->load->view('admin/change_picture');

	}

	public function upload_profile_picture(){

		$result = $this->home_model->update_avatar(); 

			$upload_result = $this->do_upload_images(); 

			if($upload_result == true || !$upload_result){ 
				$this->session->set_flashdata("success","profile picture successfully uploaded");  
			}else{
				$this->session->set_flashdata("error","error uploading profile picture");  
			} 

		//$this->profile();
		redirect("home/profile","refresh"); 

	}


	public function do_upload_images()
    {		
    		$result = false;
    		$file_path = './assets/uploaded_files/user/'; 

            $config['upload_path']          = $file_path;
            $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
            $config['max_size']             = 1000;
            //$config['max_width']          = 1024;
            //$config['max_height']         = 768; 
            $config['overwrite']			= true;
            $config['file_name'] 			= "profile-".$this->session->user_id;

            //$this->load->library('upload', $config);  
			$this->upload->initialize($config);

            if ( ! $this->upload->do_upload('profile_pic'))
            {
                    $this->session->set_flashdata("error","error uploading image.(".$this->upload->display_errors().")");
               		$result = true;
            }
            else
            {		 
                    $data = array('upload_data' => $this->upload->data()); 
                    $result = false;
            }

        return $result;
            
    }



    public  function log($module,$option,$log)
    { 
	     $data['module'] = $module;
	     $data['option'] = $option;
	     $data['log'] = $log;
	     $data['date_created'] = datetimedb;
	     $data['user_id'] = $this->session->user_id; 
	 	 return $this->db->insert('audit_trail',$data); 
	} 



	public function check_access($url, $sub_menu = [], $index_user_roles = []){

		$granted = 0;

		foreach($sub_menu as $rs){
			if($url == $rs->url_link){
				$sub_menu_id = $rs->id;
			}
		}

		foreach($index_user_roles as $rs){
			if($sub_menu_id == $rs->sub_menu_id){
				$granted = 1;
			}
		} 

		if($granted==0){ die('access denied'); }

	}
	
}	