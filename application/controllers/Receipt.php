<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once FCPATH . 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\IOFactory;

//use TNkemdilim\MoneyToWords\Converter;

class Receipt extends CI_Controller {


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

	public function create_crv($id = '', $client = '', $print_id = ''){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receipt/create_crv";
		$module['map_link']   = "receipt->create_crv";  

		$result = $this->admin_model->load_filemaintenance('fm_debit_credit_type');
		$module['debit_credit_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_account_receivable');
		$module['account_receivable'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cash_control_account');
		$module['cash_control_account'] = $result['maintenance_data'];
  		 
  		//$module['crv_number'] = $this->db->select('MAX(id) as crv_number')->get('crv')->row();
  		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		if($client == 1){

			$module['project'] =  []; // no project

			$module['client'] = $this->core->load_core_data('clients',$id);

		}elseif($id){  

			$module['project'] = $this->core->load_core_data('projects',$id);
			
			$module['client'] = $this->core->load_core_data('clients',$module['project']->client_id);
 
		}

		if($print_id){
			$module['print_crv'] = $this->core->load_core_data('crv',$print_id);
		}

		$module['crv'] = $this->core->load_core_data('crv','','','crv_date="'.date('Y-m-d').'"');

		$module['company'] = $this->core->load_core_data('company');

		$this->load->view('admin/index',$module);

	}

	public function load_crv_series($id = '')
	{
		if($id){
			$qry = $this->core->load_core_data('company',$id);
			echo 'CV1'.sprintf("%05d",($qry->crv_series)).$qry->code;
		}else{
			echo 0;
		}
	}

	public function crv_records()
	{
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receipt/crv_records";
		$module['map_link']   = "receipt->crv_records";   

		$module['project'] = $this->core->load_core_data('projects');

		$module['crv'] = $this->core->load_core_data('crv'); 
  
		$module['client'] = $this->core->load_core_data('clients','','id,name,code'); 
		
		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['company'] = $this->core->load_core_data('company');

		$this->load->view('admin/index',$module);
	}

	public function reports()
	{
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receipt/reports";
		$module['map_link']   = "receipt->reports";   

		$module['projects'] = $this->core->load_core_data('projects'); 
  
		$module['client'] = $this->core->load_core_data('clients','','id,name,code'); 
		
		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['company'] = $this->core->load_core_data('company');

		$this->load->view('admin/index',$module);
	}

	public function generate_report()
	{
		$module = $this->system_menu;
  
		$module['projects'] = $this->core->load_core_data('projects'); 
  
		$module['client'] = $this->core->load_core_data('clients','','id,name,code'); 
		
		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['company'] = $this->core->load_core_data('company');

		$module['crv'] = $this->core->load_core_data('crv');

		$this->load->view('admin/receipt/generate_report',$module);
	}


	public function import($value='')
	{
		
		$url = 'http://192.168.6.21:9001/dms-api/dbf.php';

		$data = [
		    'fields' => '*',
		    'table' => 'customer',
		    'location' => '\\\\192.168.6.81\\c$\\VentumTech\\VS\\'
		]; 
		$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  $response = curl_exec($ch);

		$vs_customer = json_decode($response)->data;
  
		curl_close($ch); 

		$data = [
		    'fields' => '*',
		    'table' => 'crv',
		    'location' => '\\\\192.168.6.81\\c$\\VentumTech\\VS\\'
		]; 
		$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  $response = curl_exec($ch);

		$vs_crv = json_decode($response)->data;
  		 
		curl_close($ch);

		$url = 'http://192.168.6.21:9001/dms-api/dbf.php';

		$data = [
		    'fields' => '*',
		    'table' => 'customer',
		    'location' => '\\\\192.168.6.81\\c$\\VentumTech\\VT\\'
		]; 
		$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  $response = curl_exec($ch);

		$vt_customer = $tdata = json_decode($response)->data;
  
		curl_close($ch); 

		$data = [
		    'fields' => '*',
		    'table' => 'crv',
		    'location' => '\\\\192.168.6.81\\c$\\VentumTech\\VT\\'
		]; 
		$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  $response = curl_exec($ch);

		$vt_crv = json_decode($response)->data;
  		 
		curl_close($ch); 
 
		echo "<table border='1' cellspacing='0' cellpadding='5'>"; 
		echo "<tr>";
		foreach (array_keys((array)$tdata[0]) as $header) {
		    echo "<th>" . htmlspecialchars($header) . "</th>";
		}
		echo "</tr>"; 
		foreach ($tdata as $row) {
		    echo "<tr>";
		    foreach ((array)$row as $value) {
		        echo "<td>" . htmlspecialchars($value) . "</td>";
		    }
		    echo "</tr>";
		} 
		echo "</table>";

		if(@$run==1){  //================================ 0 = run 

			foreach($vs_customer as $rs){
				$cust_code = trim($rs->cust_code);
				$cust_name = trim($rs->cust_name);
				$tel_bus1 = trim($rs->tel_bus1);
				$tel_home = trim($rs->tel_home);
				$tel_mobile = trim($rs->tel_mobile);
				$city = trim($rs->city);
				$street = trim($rs->street);
				$po_box = trim($rs->po_box);
				$this->db->insert('clients',[
					'code' => $cust_code,
					'name' => $cust_name,
					'contact_number_1' => $tel_bus1,
					'contact_number_2' => $tel_home.' '.$tel_mobile,
					'address' => $po_box.' '.$street.' '.$city, 
				]);
				$inserted_id = $this->db->insert_id();
				$arr_cust[$cust_code] = $inserted_id;
			}
			
			$arr_type['C'] = 1;
			$arr_type['T'] = 4;
			$arr_type['Q'] = 2;
			$arr_type['R'] = 3;
			
			foreach($vs_crv as $rs){
				$company = 1;
				$crv_no = trim($rs->crv_no);
				$reference = trim($rs->tran_no);
				$date_created = trim($rs->tran_date);
				$cust_code = @$arr_cust[$rs->cust_code];
				$tran_amt = trim($rs->tran_amt);
				$user_id = 1;
				$tran_type = @$arr_type[$rs->fp];
				$remarks = trim($rs->remarks);
				$bank_name = trim($rs->bank_name);
				$branch = trim($rs->branch_des);
				$cheque_no = trim($rs->cheque_ref);
				
				$this->db->insert('crv',[
					'crv_code' => $crv_no, 
					'payment_mode' => $tran_type, 
					'amount_received' => $tran_amt,  
					'bank_name' => $bank_name,  
					'branch' => $branch,  
					'cheque_no' => $cheque_no,  
					'account_no' => '',  
					'company' => 1,  
					'reference' => $reference,  
					'debit_credit_type_id' => 0,   
					'remarks' => $remarks, 
					'client_id' => $cust_code,
					'user_id' => 37,
					'date_created' => $date_created,
					'crv_date' => $date_created,
				]);
			}

			foreach($vt_customer as $rs){
				$cust_code = trim($rs->cust_code);
				$cust_name = trim($rs->cust_name);
				$tel_bus1 = trim($rs->tel_bus1);
				$tel_home = trim($rs->tel_home);
				$tel_mobile = trim($rs->tel_mobile);
				$city = trim($rs->city);
				$street = trim($rs->street);
				$po_box = trim($rs->po_box);
				$this->db->insert('clients',[
					'code' => $cust_code,
					'name' => $cust_name,
					'contact_number_1' => $tel_bus1,
					'contact_number_2' => $tel_home.' '.$tel_mobile,
					'address' => $po_box.' '.$street.' '.$city, 
				]);
				$inserted_id = $this->db->insert_id();
				 
				$arr_cust[$cust_code] = $inserted_id;
			}
			
			$arr_type['C'] = 1;
			$arr_type['T'] = 4;
			$arr_type['Q'] = 2;
			$arr_type['R'] = 3;
			
			foreach($vt_crv as $rs){
				$company = 1;
				$crv_no = trim($rs->crv_no);
				$reference = trim($rs->tran_no);
				$date_created = trim($rs->tran_date);
				$cust_code = @$arr_cust[$rs->cust_code];
				$tran_amt = trim($rs->tran_amt);
				$user_id = 1;
				$tran_type = @$arr_type[$rs->fp];
				$remarks = trim($rs->remarks);
				$bank_name = trim($rs->bank_name);
				$branch = trim($rs->branch_des);
				$cheque_no = trim($rs->cheque_ref);

				$this->db->insert('crv',[
					'crv_code' => $crv_no, 
					'payment_mode' => $tran_type, 
					'amount_received' => $tran_amt,  
					'bank_name' => $bank_name,  
					'branch' => $branch,  
					'cheque_no' => $cheque_no,  
					'account_no' => '',  
					'company' => 2,  
					'reference' => $reference,  
					'debit_credit_type_id' => 0,   
					'remarks' => $remarks,  
					'client_id' => $cust_code,
					'user_id' => 37,
					'date_created' => $date_created,
					'crv_date' => $date_created,
				]);
			}

		}

	}

	public function add_clients(){
  
		$this->load->view('admin/sales/clients_add');

	}

	public function edit_clients(int $id){

		$module['clients'] = $this->core->load_core_data('clients', $id);
  
		$this->load->view('admin/sales/clients_edit', $module);

	}

	public function view_clients(int $id){

		$module['clients'] = $this->core->load_core_data('clients', $id); 
  
		$this->load->view('admin/sales/clients_view', $module);

	}

	public function save_crv($proj_id='')
	{

		$company = $this->core->load_core_data('company',$this->input->post('company',TRUE));

		$crv_no = 'CV1'.sprintf("%05d",($company->crv_series)).$company->code;

		$crv_code_checker = $this->db->select('id')->get_where('crv',['crv_code'=>$crv_no])->row();

		$model = $this->core->global_query(1,'crv','',['project_id'=>$proj_id,'crv_code'=>$crv_no]); 
		  
		if($model['result'] && !@$crv_code_checker->id){ 

			$this->db->where('id',@$company->id)->update('company',['crv_series'=>($company->crv_series+1)]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

	
		redirect("receipt/create_crv/0/0/".@$model['query_id'],"refresh");
	 
		
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

		$converter = new Converter("qar", "dirham");

		$module['converter'] = $converter;

		$module['users'] = $this->core->load_core_data('account',$module['crv']->user_id,'id,name');

		$result = $this->admin_model->load_filemaintenance('fm_debit_credit_type',$module['crv']->debit_credit_type_id);
		$module['debit_credit_type'] = $result['maintenance_data'];

		$this->load->view('admin/receipt/print',$module);
	}

	public function save_print_counter($type, $crv_id, $copy = 0)
	{
		$crv = $this->core->load_core_data('crv',$crv_id,'print_count');

		if($type == 1){
			$this->db->where('id',$crv_id)->update('crv',[
				'last_print_review'=>date("Y-m-d H:i:s") 
			]);
		}else{
			$this->db->where('id',$crv_id)->update('crv',[
				'last_print_review'=>date("Y-m-d H:i:s"),
				'last_printed'=>date("Y-m-d H:i:s"), 
				'print_count' => (@$crv->print_count+1)
			]);
		} 

		$this->db->insert('crv_print_logs',[
			'type'=>$type,
			'date_created'=>date("Y-m-d H:i:s"),
			'crv_id' => $crv_id,
			'user_id' => $this->session->user_id,
			'print_copy' => $copy,
			'deleted' => 0
		]);

	}

	public function receivables($id,$isClient = 0){

		if($isClient == 1){ 

			$module['client'] = $this->core->load_core_data('clients',$id); 
			$module['user'] = $this->core->load_core_data('account',$module['client']->user_id); 

		}else{
		
			$module['project'] = $this->core->load_core_data('projects',$id);  
			$module['client'] = $this->core->load_core_data('clients',$module['project']->client_id); 
			$module['user'] = $this->core->load_core_data('account',$module['project']->user_id); 
		}

		 

		$module['quotation'] = $this->core->load_core_data('quotations',$id); 
 
		$module['crv'] = $this->core->load_core_data('crv','','','project_id='.$id);  
		 
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/receipt/receivables',$module);

	}

	public function view_crv($id)
	{ 

		$module['crv'] = $this->core->load_core_data('crv',$id); 

		$module['project'] = $this->core->load_core_data('projects',$module['crv']->project_id);

		$module['users'] = $this->core->load_core_data('account',$module['crv']->user_id);

		$module['client'] = $this->core->load_core_data('clients',$module['crv']->client_id); 

		$result = $this->admin_model->load_filemaintenance('fm_debit_credit_type',$module['crv']->debit_credit_type_id);
		$module['debit_credit_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_account_receivable',$module['crv']->ar_account_id);
		$module['account_receivable'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cash_control_account',$module['crv']->cash_control_account_id);
		$module['cash_control_account'] = $result['maintenance_data'];

		$module['company'] = $this->core->load_core_data('company',$module['crv']->company);

		$module['print_logs'] = $this->core->load_core_data('crv_print_logs','','','crv_id='.$id);

		$module['usersx'] = $this->core->load_core_data('account','','id,name');
 
		$this->load->view('admin/receipt/view_crv',$module);
	}

	 
	
}	