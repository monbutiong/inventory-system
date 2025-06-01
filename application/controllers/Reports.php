<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {


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
 
 
	public function inventory_masterlist(){

		$module = $this->system_menu;

		$module['module'] = "report/inventory_masterlist";
		$module['map_link']   = "report > inventory_masterlist";  

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$this->load->view('admin/index',$module);

	}

	public function generate_inventory_masterlist(){

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$module['inventory'] = $this->core->load_core_data('inventory');

		$this->load->view('admin/report/generate_inventory_masterlist',$module);


	}


	public function inventory_movement(){

		$module = $this->system_menu;

		$module['module'] = "report/inventory_movement";
		$module['map_link']   = "report > inventory_movement";  

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$this->load->view('admin/index',$module);

	}

	public function generate_inventory_movement(){

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$module['inventory'] = $this->core->load_core_data('inventory');

		$module['inventory_movement'] = $this->core->load_core_data('inventory_movement');

		$this->load->view('admin/report/generate_inventory_movement',$module);


	}

	public function inventory_report(){

		$module = $this->system_menu;

		$module['module'] = "report/inventory_report";
		$module['map_link']   = "report > inventory_report";  

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_classification');
		$module['classification'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$this->load->view('admin/index',$module);

	}

	public function generate_inventory_report(){ 

		$module['inventory_report'] = $this->core->generate_inventory_report();

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency'] = $result['maintenance_data']; 
		
		$this->load->view('admin/report/generate_inventory_report',$module);


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


	public function monitoring_of_materials(){

		$module = $this->system_menu;

		$module['module'] = "report/monitoring_of_materials";
		$module['map_link'] = "report > monitoring_of_materials";  

		$result = $this->admin_model->load_filemaintenance('fm_inventory_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_classification');
		$module['classification'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];


		$module['projects'] = $this->core->load_core_data('projects');

		$this->load->view('admin/index',$module);

	}

	public function generate_monitoring_of_materials($account_id=''){ 

		$account_id = @$this->input->post('accounts',TRUE) ? @$this->input->post('accounts',TRUE) : $account_id;

		$module['inventory_report'] = $this->core->generate_inventory_report($account_id);

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency'] = $result['maintenance_data'];

		$this->load->view('admin/report/generate_monitoring_of_materials',$module);


	}

	public function manpower(){

		$module = $this->system_menu;

		$module['module'] = "report/manpower";
		$module['map_link'] = "report > manpower";  

		$module['projects'] = $this->core->load_core_data('projects');
 
		$module['employees'] = $this->core->load_core_data('employee');

		$this->load->view('admin/index',$module);

	}

	public function generate_manpower()
	{
		$module['projects'] = $this->core->load_core_data('projects');
 
		$module['employees'] = $this->core->load_core_data('employee');

		$module['project_manpower'] = $this->core->load_core_data('project_manpower');

		$module['bsp_rate'] = $this->core->load_core_data('bsp_rate');

		$this->load->view('admin/report/generate_manpower',$module);
	}

	public function po_supplier_monitoring()
	{
		$module = $this->system_menu;

		$module['module'] = "report/po_supplier_monitoring";
		$module['map_link']   = "report > po_supplier_monitoring";  

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number');

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$this->load->view('admin/index',$module);
	} 

	public function generate_po_supplier_monitoring()
	{
		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number');

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['purchase_order'] = $this->core->load_core_data('purchase_order','','id,po_number,date_created,terms_of_payment_type_id,supplier_id');

		$module['receiving_report'] = $this->core->load_core_data('receiving_report');

		$module['received_items'] = $this->core->load_core_data('receiving_report_items');  
		$module['po_items'] = $this->core->load_core_data('purchase_order_items');

		$result = $this->admin_model->load_filemaintenance('fm_terms_of_payment_type');
		$module['terms_of_payment_type'] = $result['maintenance_data'];

		$this->load->view('admin/report/generate_po_supplier_monitoring',$module);
	}

	public function overhead_cost()
	{
		$module = $this->system_menu;

		$module['module'] = "report/overhead_cost";
		$module['map_link']   = "report > overhead_cost";  
 
		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['overhead_cost'] = $result['maintenance_data'];

		$this->load->view('admin/index',$module);
	} 

	public function generate_overhead_cost()
	{
	 
		$module['overhead_cost'] = $this->core->load_core_data('overhead_cost');
  
		$result = $this->admin_model->load_filemaintenance('fm_overhead_cost');
		$module['oc'] = $result['maintenance_data'];

		$this->load->view('admin/report/generate_overhead_cost',$module);
	}

	public function generate_issued_materials($project_id)
	{
		$module['projects'] = $this->core->load_core_data('projects', $project_id);
		//call core issued inventory table
		$module['ii_records'] = $this->core->item_ii_all($project_id);  

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency'] = $result['maintenance_data'];
		
		$this->load->view('admin/report/generate_project_report',$module); 
	}

}	