<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
 
	var $system_menu = array(); 

	public function __construct(){

		parent::__construct();  

		$this->load->model("employee_model");
		$this->load->model("home_model");
		$this->load->model("admin_model");
		$this->load->model("maintenance_model");

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

	public function table($table_name){

		$module = $this->system_menu;
		$table_name = str_replace("fm_","",$table_name);

		$url = $this->router->class.'/'.$this->router->method.'/'.$table_name; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module["table_name"] = ucwords (str_replace("_"," ",$table_name));
		$table_name_sql = 'fm_'.$table_name;

		$result = $this->maintenance_model->load_table_data($table_name_sql);
		$module['table_data'] = $result['table_data'];
		$module['table_name_sql'] = $table_name_sql;

		$module['module'] = "maintenance/main_table";
		$module['map_link']   = "maintenance > $table_name"; 
		 
		if($table_name_sql == 'fm_models'){
			$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
			$module['manufacturers'] = $result['maintenance_data'];
		}
 

		$this->load->view('admin/index',$module);

	}

	public function add_table_data_content($table_name){

		$module['table_name'] = $table_name;

		if($table_name == 'fm_models'){
			$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
			$module['manufacturers'] = $result['maintenance_data'];
		}

		$this->load->view('admin/maintenance/add_table_data_content',$module);

	}

	public function edit_table_data_content($table_name,$id){

	 	if($table_name == 'fm_models'){
	 		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
	 		$module['manufacturers'] = $result['maintenance_data'];
	 	}

		$result = $this->maintenance_model->load_table_data_one($table_name,$id);
		$module['table_data'] = $result['table_data']; 

		$module['table_name'] = $table_name;
		$this->load->view('admin/maintenance/edit_table_data_content',$module);

	}

	public function add_new_table_data($table_name){  
 		
 		$this->form_validation->set_rules('title','Title','trim|required|callback_check_title_duplication'); 
 		$this->form_validation->set_message('check_title_duplication', 'Title already Exist.');

		if($this->form_validation->run() == true){

			$result = $this->maintenance_model->add_table_data($table_name); 

			if($result["result"] == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > add new data";
				$log_description = "add new data in $table_name_mod maintenance table, id : ".$result["inserted_id"];
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data added to the table"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh"); 
			}else{
				$this->session->set_flashdata("error","error saving information"); 
			}

		}

		//$this->table($table_name);
		redirect("maintenance/table/".str_replace("fm_","",$table_name),"refresh");
	}


	function check_title_duplication(){ 

			return $this->maintenance_model->check_title_duplication_validation(); 
	}


	public function update_table_data($table_name,$id){ 
 		
 		$this->form_validation->set_rules('title','Title','trim|required|callback_check_title_duplication_update['.$table_name.','.$id.']'); 
 		$this->form_validation->set_message('check_title_duplication_update', 'Title already Exist.');

		if($this->form_validation->run() == true){

			$result = $this->maintenance_model->update_table_data($table_name,$id); 

			if($result == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > update data";
				$log_description = "update data in $table_name_mod , id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data successfully updated"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh");  
			}else{
				$this->session->set_flashdata("error","error saving information"); 
			}

		}

		//$this->table($table_name);
		redirect("maintenance/table/".str_replace("fm_","",$table_name),"refresh"); 

	}

	function check_title_duplication_update($var,$data){  
		list($table_name,$id) = explode(",", $data);
		return $this->maintenance_model->check_title_duplication_validation_update($table_name,$id); 
	}

	public function delete_data($table_name,$id){

		$result = $this->maintenance_model->delete_table_data($table_name,$id); 

			if($result == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > delete data";
				$log_description = "delete data in $table_name_mod , id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data deleted"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh"); 
			}else{
				$this->session->set_flashdata("error","error deleting information"); 
			}

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