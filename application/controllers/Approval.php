<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {


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

	 

	public function pr($history = ''){

		$module = $this->system_menu; 

		$module['module'] = "approval/pr";
		$module['map_link']   = "approval->pr";  

		$module['pr'] = $this->core->load_core_data('purchase_request','','',$history ? '' : 'form_status=0');

		$module['projects'] = $this->core->load_core_data('projects');

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['history'] = $history;
  		
		$this->load->view('admin/index',$module);

	}

	public function pr_update($id, $status, $c, $max)
	{
		 
		if($c>3 && $max>3){die('invalid request');}

		$model = $this->core->approval_pr_update($id, $status, $c, $max); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("approval/pr","refresh");
	}

	public function po($history = ''){

		$module = $this->system_menu;

		$module['history'] = $history; 

		$module['module'] = "approval/po";
		$module['map_link']   = "approval->po";  

		// status 0 = pending, 1 = partial p.o., 2 = completed p.o.
		$module['po'] = $this->core->load_core_data('purchase_order','','',$history ? '' : 'form_status=0');
		foreach($module['po'] as $rs){
			@$po_items_id.='purchase_order_id='.$rs->id.' OR ';
		}

		if(@$po_items_id){
			$po_items_id = $po_items_id.')';
			$po_items_id = str_replace('OR )',' )','( '.$po_items_id);
			$module['po_items'] = $this->core->load_core_data('purchase_order_items','','id,purchase_order_id',$po_items_id);
		}
  
		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_purchase_type');
		$module['purchase_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_terms_of_payment_type');
		$module['terms_of_payment_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_terms_of_delivery_type');
		$module['terms_of_delivery_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_delivery_place');
		$module['delivery_place'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects');
 

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['uom_conversions'] = $this->core->load_core_data('uom_conversions'); 

		$result = $this->admin_model->load_filemaintenance('fm_department', $this->session->department_id);
		$module['approver'] = $result['maintenance_data']; 
  
		$this->load->view('admin/index',$module);

	}

	public function po_update($id, $status, $c, $max)
	{
		 
		if($c>3 && $max>3){die('invalid request');}

		$model = $this->core->approval_po_update($id, $status, $c, $max); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("approval/po","refresh");
	}

	 
  
	
}	