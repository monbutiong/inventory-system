<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\IOFactory;

use TNkemdilim\MoneyToWords\Converter;

class Receipt_print extends CI_Controller {


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

	 

	public function print_receipt($id,$code = '',$copy = 0)
	{

		$module['copy'] = $copy;
		$module['crv'] = $this->core->load_core_data('crv',$id);

		if(@$module['crv']->project_id){
			$module['project'] = $this->core->load_core_data('projects',@$module['crv']->project_id);
		}
		
		$module['client'] = $this->core->load_core_data('clients',$module['crv']->client_id);
		 
		$module['company'] = $this->core->load_core_data('company',$module['crv']->company);

		$converter = new Converter("&", "qar");

		$module['converter'] = $converter;

		$module['users'] = $this->core->load_core_data('account',$module['crv']->user_id,'id,name');

		$result = $this->admin_model->load_filemaintenance('fm_debit_credit_type',$module['crv']->debit_credit_type_id);
		$module['debit_credit_type'] = $result['maintenance_data'];

		$this->load->view('admin/receipt/print',$module);
	}

	 

	 
	
}	