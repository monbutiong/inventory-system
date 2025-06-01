<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	var $system_menu = array(); 

	public function __construct(){

		parent::__construct(); 
  
		$this->load->model("employee_model");
		$this->load->model("admin_model");
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

	public function side_bar_menu(){
		$result = $this->admin_model->load_index_data();
		$module['main_menu'] = $result['main_menu'];
		$module['sub_menu'] = $result['sub_menu'];
		return $module;
	}

	public function home(){
		
		$module = $this->system_menu;

		$module['module'] = "home";
		$module['map_link']   = "home";  

		$this->load->view('admin/index',$module);
		/*
		$this->dashboard();
*/
	}

	public function dashboard(){

		$module = $this->system_menu;

		$module['module'] = "dashboard";
		$module['map_link']   = "dashboard"; 

		$this->load->view('admin/index',$module);

	}

	public function system_users(){

		$module = $this->system_menu;

		$module['module'] = "system_users";
		$module['map_link']   = "system_users"; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		/*
		$result = $this->admin_model->load_user_roles($id);
		$module['user_roles'] = $result['user_roles'];
		*/

		$result = $this->employee_model->load_employee_list();
		$module['employee'] = $result['employee']; 

		$this->load->view('admin/index',$module);

	} 

	public function projects(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "admin/projects";
		$module['map_link']   = "admin->projects";  
 
		$module['projects'] = $this->core->load_core_data('projects'); 

		$result = $this->admin_model->load_filemaintenance('fm_project_status');
		$module['project_status'] = $result['maintenance_data'];
  
		$this->load->view('admin/index',$module);

	}

	public function upload_manpower_all_project()
	{ 
		$this->load->view('admin/admin/upload_manpower_all_project');
	}

	 

	public function add_project(){
  		
  		$result = $this->admin_model->load_filemaintenance('fm_project_status');
		$module['project_status'] = $result['maintenance_data'];
 
		$this->load->view('admin/admin/project_add',$module);

	}

	public function save_project()
	{
		$model = $this->core->global_query(1,'projects'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects","refresh");
	}

	public function edit_project($id){

		$module['project'] = $this->core->load_core_data('projects',$id);

		$result = $this->admin_model->load_filemaintenance('fm_project_status');
		$module['project_status'] = $result['maintenance_data'];
 
  
		$this->load->view('admin/admin/project_edit',$module);

	}

	public function update_project($id)
	{
		$model = $this->core->global_query(2,'projects',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects","refresh");
	}

	public function delete_project($id)
	{
		$model = $this->core->global_query(3,'projects',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects","refresh");
	}

	public function logout()
	{	

		/* AUDIT TRAIL */
		$log_module = "account page";
		$log_description = "logout to account.";
		$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		$this->session->unset_userdata('user_id','name_of_user','account','username','datetime','logged_in');
		redirect("index/load_first","refresh");  
	}

	public function approvals($edit = ''){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "admin/approvals";
		$module['map_link']   = "admin->approvals";   

		$result = $this->admin_model->load_filemaintenance('fm_department');
		$module['dp'] = $result['maintenance_data'];

		$module['edit_id'] = $edit;

		$module['users'] = $this->core->load_core_data('account','','id,name');
  
		$this->load->view('admin/index',$module);

	}

	public function update_approvals($id)
	{
		$model = $this->core->update_approval($id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/approvals","refresh");
	}

	public function projects_control_number($id){

		$module = $this->system_menu;
   
		$module['id'] = $id;

		$module['module'] = "admin/projects_control_number";
		$module['map_link']   = "admin->projects_control_number";  
 
		$module['project'] = $this->core->load_core_data('projects',$id);

		$module['employee'] = $this->core->load_core_data('employee');

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number','','','project_id='.$id);

		$this->load->view('admin/index',$module);

	}

	public function pcn_add($id)
	{
		$module['id'] = $id;
		$this->load->view('admin/admin/project_control_number_add',$module);
	}

	public function save_pcn($id)
	{
		$model = $this->core->global_query(1,'projects_control_number'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects_control_number/".$id,"refresh");
	}

	public function pcn_edit($id,$cid)
	{
		$module['id'] = $id;

		$module['pcn'] = $this->core->load_core_data('projects_control_number',$cid);

		$this->load->view('admin/admin/project_control_number_edit',$module);
	}

	public function update_pcn($id,$cid)
	{
		$model = $this->core->global_query(2,'projects_control_number',$cid); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects_control_number/".$id,"refresh");
	}

	public function delete_pcn($id, $cid)
	{
		$model = $this->core->global_query(3,'projects_control_number',$cid); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/projects_control_number/".$id,"refresh");
	}

	public function project_overhead_cost($id){

		$module = $this->system_menu;

		$module['cid'] = $id;
   
		$module['module'] = "admin/project_overhead_cost";
		$module['map_link']   = "admin->project_overhead_cost";  
 
		$module['pcn'] = $this->core->load_core_data('projects_control_number',$id);

		$module['project'] = $this->core->load_core_data('projects','','','id='.$module['pcn']->project_id,1);

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['overhead_cost'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];
 
		$module['project_overhead_cost'] = $this->core->load_core_data('project_overhead_cost','','','control_number_id='.$id);

		$this->load->view('admin/index',$module);

	}

	public function project_overhead_cost_add($cid){

		$module['cid'] = $cid;

		$module['pcn'] = $this->core->load_core_data('projects_control_number',$cid);

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['overhead_cost'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$this->load->view('admin/admin/project_overhead_cost_add',$module);

	}

	public function project_overhead_cost_save($cid){

		$model = $this->core->global_query(1,'project_overhead_cost'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/project_overhead_cost/".$cid,"refresh");

	}

	public function project_overhead_cost_edit($cid,$id){

		$module['cid'] = $cid;

		$module['oc'] = $this->core->load_core_data('project_overhead_cost',$id);

		$module['pcn'] = $this->core->load_core_data('projects_control_number',$cid);

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['overhead_cost'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$this->load->view('admin/admin/project_overhead_cost_edit',$module);

	}

	public function project_overhead_cost_update($cid, $id){

		$model = $this->core->global_query(2,'project_overhead_cost',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/project_overhead_cost/".$cid,"refresh");

	}

	public function project_overhead_cost_delete($cid, $id){

		$model = $this->core->global_query(3,'project_overhead_cost',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("admin/project_overhead_cost/".$cid,"refresh");

	}

}