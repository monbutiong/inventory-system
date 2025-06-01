<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {


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
		$this->system_menu['pr_request'] = $result['pr_request'];
		$this->system_menu['po_request'] = $result['po_request'];


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

	public function accounts_payable(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "accounts/accounts_payable";
		$module['map_link']   = "accounts->accounts_payable";   
 
		$module['projects'] = $this->core->load_core_data('projects');
		//$module['projects_control_number'] = $this->core->load_core_data('projects_control_number');

		// status 0 = pending, 1 = partial p.o., 2 = completed p.o.
		$module['rr'] = $this->core->load_core_data('receiving_report','','','history=0');
		foreach($module['rr'] as $rs){
			@$rrs_id.='receiving_report_id='.$rs->id.' OR ';
			@$pos_id.='id='.$rs->purchase_order_id.' OR ';
		}

		if(@$rrs_id){

			$rrs_id = $rrs_id.')';
			$rrs_id = str_replace('OR )',' )','( '.$rrs_id); 

			$module['rr_items'] = $this->core->load_core_data('receiving_report_items','','receiving_report_id,id,qty,price',$rrs_id);

			$pos_id = $pos_id.')';
			$pos_id = str_replace('OR )',' )','( '.$pos_id); 

			$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,terms_of_payment_type_id',$pos_id);

			$module['accounts_payable'] = $this->core->load_core_data('accounts_payable','','',$rrs_id);
			
		}

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$result = $this->admin_model->load_filemaintenance('fm_terms_of_payment_type');
		$module['terms_of_payment_type'] = $result['maintenance_data'];

	 	
		$this->load->view('admin/index',$module);

	} 

	public function manage_payable($id)
	{

		$module = $this->system_menu;
		
		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($this->router->class.'/accounts_payable', $module['sub_menu'], $module['index_user_roles']);
  

		$module['rr'] = $this->core->load_core_data('receiving_report',$id); 

		$module['received_items'] = $this->core->load_core_data('receiving_report_items','', '','receiving_report_id='.$id);   

		// foreach($module['received_items'] as $rs){
		// 	@$inv_id.='id='.$rs->inventory_id.' OR '; 
		// }

		// if(@$inv_id){

		// 	$inv_id = $inv_id.')';
		// 	$inv_id = str_replace('OR )',' )','( '.$inv_id); 

		// 	$module['inv'] = $this->core->load_core_data('inventory','','id,name,short_description',$inv_id);
  
		// }
		
		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$module['accounts_payable'] = $this->core->load_core_data('accounts_payable','','', 'receiving_report_id='.$id);

		$this->load->view('admin/accounts/manage_ap', $module);
	}

	public function save_ap($po_id)
	{
		$model = $this->core->save_ap($po_id); 

		if($model){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("accounts/accounts_payable","refresh");
	}

	public function remove_ap($id)
	{
		$model = $this->core->global_query(3, 'accounts_payable', $id); 

		echo 1;
	}

	public function bsp_currency_rate()
	{
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "accounts/bsp_currency_rate";
		$module['map_link']   = "accounts->accounts_payable";   
	
		$module['bsp_rate'] = $this->core->load_core_data('bsp_rate');
	 
	 	$result = $this->admin_model->load_filemaintenance('fm_currency_type');
	 	$module['currency_type'] = $result['maintenance_data'];

		$this->load->view('admin/index',$module);

	} 

	public function bsp_rate_add()
	{
		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$this->load->view('admin/accounts/bsp_rate_add',$module);
	}

	public function save_bsp_rate()
	{

		$bsp_rate = $this->core->load_core_data('bsp_rate','','id','date_for="'.@$this->input->post('date_for',TRUE).'"',1);

		if(!@$bsp_rate->id){

			$model = $this->core->global_query(1, 'bsp_rate'); 

			if($model){ 
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving. Date already exist");

		}

		redirect("accounts/bsp_currency_rate","refresh");
	}

	public function bsp_rate_edit($id)
	{
		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$module['bsp_rate'] = $this->core->load_core_data('bsp_rate',$id);

		$this->load->view('admin/accounts/bsp_rate_edit',$module);
	}

	public function update_bsp_rate($id)
	{
		$bsp_rate = $this->core->load_core_data('bsp_rate','','id','date_for="'.@$this->input->post('date_for').'" AND id<>'.$id,1);

		if(!@$bsp_rate->id){ 

			$model = $this->core->global_query(2, 'bsp_rate',$id); 

			if($model){ 
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving. Date already exist");

		}

		redirect("accounts/bsp_currency_rate","refresh");
	}

	public function load_project($id)
	{
		$q = $this->core->load_core_data('projects',$id);
		echo @$q->name;	
	}

	public function overhead_cost(){

		$module = $this->system_menu;
  
		$module['module'] = "accounts/overhead_cost";
		$module['map_link']   = "accounts->overhead_cost";  
		
		$module['overhead_cost'] = $this->core->load_core_data('overhead_cost'); 

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['oc_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data']; 

		$this->load->view('admin/index',$module);

	}

	public function overhead_cost_add(){

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['oc_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$this->load->view('admin/accounts/overhead_cost_add',$module);

	}

	public function overhead_cost_save(){

		$model = $this->core->global_query(1,'overhead_cost'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("accounts/overhead_cost","refresh");

	}

	public function overhead_cost_edit($id){

		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['oc_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data']; 

		$module['overhead_cost'] = $this->core->load_core_data('overhead_cost',$id);

		$this->load->view('admin/accounts/overhead_cost_edit',$module);

	}

	public function overhead_cost_update($id){

		$model = $this->core->global_query(2,'overhead_cost',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("accounts/overhead_cost","refresh");

	}

	public function overhead_cost_delete($id){

		$model = $this->core->global_query(3,'overhead_cost',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("accounts/overhead_cost","refresh");

	}
  
}	 