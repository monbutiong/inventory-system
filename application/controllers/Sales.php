<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once FCPATH . 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\IOFactory;

// use TNkemdilim\MoneyToWords\Converter;

class Sales extends CI_Controller {


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

	public function clients(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/clients";
		$module['map_link']   = "sales->clients";  
 
		$module['clients'] = $this->core->load_core_data('clients');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

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

	public function save_clients($modal = '')
	{
		$model = $this->core->global_query(1,'clients'); 
		
		if($modal == 1){

			echo $model['query_id'];

		}else{
		
			if($model['result']){ 
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		
			redirect("sales/clients","refresh");
		}
		
	}

	public function check_client_code(){

		$ccode = $this->input->post('ccode',TRUE);

		if($this->db->select('id')->get_where('clients',['code'=>$ccode,'deleted'=>0])->row()){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function update_header(int $id){

		$q = $this->core->load_core_data('quotations',$id); 

		$model = $this->core->global_query(2,'quotations',$id,['sla_margin'=>$this->input->post('margin',TRUE)]); 

		if($model['result']){ 

			if($q->margin == 0 || $q->margin == null || $q->margin == '0'){
		 
				$this->db->where([
					'quotation_id' => $id 
				])->update('quotations_items',[
					'margin' => ($this->input->post('margin',TRUE) ? $this->input->post('margin',TRUE)  : 0)
				]);
			}else{ 
				$this->db->where([
					'quotation_id' => $id,
					'margin'=>$q->margin
				])->update('quotations_items',[
					'margin' => ($this->input->post('margin',TRUE) ? $this->input->post('margin',TRUE)  : 0)
				]);
				 
			}

			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

	
		redirect("sales/edit_quotation/".$id,"refresh");
		 
	}

	public function add_location(int $id){

		$module['qid'] = $id;

		$this->load->view('admin/sales/add_location',$module);

	}

	public function save_location(int $qid)
	{
		$model = $this->core->global_query(1,'quotations_locations'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/edit_quotation/".$qid,"refresh");
	}

	public function edit_location(int $id){

		$module['q'] = $this->core->load_core_data('quotations_locations',$id);

		$this->load->view('admin/sales/edit_location',$module);

	}

	public function update_location(int $qid, int $id)
	{
		$model = $this->core->global_query(2,'quotations_locations', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/edit_quotation/".$qid,"refresh");
	}

	public function add_item_to_location(int $qid, $id){

		$module['qid'] = $qid;

		$module['location'] = $id;

		$module['quotations_locations'] = $this->core->load_core_data('quotations_locations',$id);

		$module['lcr'] = $this->core->load_core_data('landed_cost_rate');

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$qid);
		
		$this->load->view('admin/sales/add_item',$module);

	}

	public function delete_item(int $qid, int $id){

		$model = $this->core->global_query(3,'quotations_items', $id); 

		if($model['result']){ 
 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/edit_quotation/".$qid,"refresh");

	}

	public function delete_new_item(int $id){

		$model = $this->core->global_query(3,'quotations_items', $id);  

		echo 1;

	}

	public function add_new_item_to_location(int $qid, int $id, int $counter, $local_manpower=''){

		$counter+=1;

		$module['qid'] = $qid;

		$module['quotation'] = $this->core->load_core_data('quotations',$qid);

		$module['counter'] = $counter;

		$module['quotations_locations'] = $this->core->load_core_data('quotations_locations',$id);

		$module['lcr'] = $this->core->load_core_data('landed_cost_rate');

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['local_manpower'] = $local_manpower;
		
		$this->load->view('admin/sales/add_new_item',$module);

	}

	public function delete_loc(int $qid, int $id){

		$model = $this->core->global_query(3,'quotations_locations', $id); 

		if($model['result']){ 

			$this->db->where('quotation_location_id',$id)->update('quotations_items',[
				'deleted'=>1,
				'date_deleted'=>date('Y-m-d H:i'),
				'deleted_by'=>$this->session->user_id
			]); 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/edit_quotation/".$qid,"refresh");

	}

	public function update_clients(int $id)
	{
		$model = $this->core->global_query(2,'clients', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/clients","refresh");
	}

	public function delete_clients(int $id)
	{
		$model = $this->core->global_query(3,'clients', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/clients","refresh");
	}

	public function new_quotation($pid='',$cid='')
	{
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/new_quotation";
		$module['map_link']   = "sales->quotation";  
		
		$module['quotations'] = $this->core->load_core_data('quotations','','id','confirmed=1');

		$module['quote'] = $this->db->select('MAX(id) as quote_number')->get('quotations')->row();

		$module['quotations_nos'] = $this->core->load_core_data('quotations','','id,quotation_number,client_id,project_id','confirmed=1');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['projects'] = $this->core->load_core_data('projects');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['tnc'] = $this->core->load_core_data('terms_and_conditions','','','type="quotation"');

		$module['emp'] = $this->core->load_core_data('employee');

		$module['pid'] = $pid;
		$module['cid'] = $cid;

		if($pid && $cid){ 
			$module['client'] = $this->core->load_core_data('clients',$cid);
			$module['project'] = $this->core->load_core_data('projects',$pid);
		}
		
		$this->load->view('admin/index',$module);
	}

	public function load_client_projects($id){
		$module['projects'] = $this->core->load_core_data('projects','','','client_id='.$id);
		$this->load->view('admin/sales/load_client_projects',$module);
	}

	public function read_excel_file($file_path)
	{
	    $spreadsheet = IOFactory::load($file_path);
	    $worksheet = $spreadsheet->getActiveSheet();
	    $data = $worksheet->toArray();

	    return $data;
	}

	public function save_step_1()
	{

		//===== nasa vendor na ito !!!

		$supp = $this->db->get_where('suppliers',['deleted'=>0])->result();
		if($supp){
			foreach ($supp as $rs) {
				$arr_existing_supplier[strtolower($rs->name)] = $rs->id;
				$arr_existing_supplier_lcr[strtolower($rs->name)] = $rs->landed_cost_rate_id;
			}
		}



		$client_id = $this->input->post('client_id',TRUE);

		if($this->input->post('client_id',TRUE) == 'new'){

			$this->db->insert('clients',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'), 
				'code'=>$this->input->post('code',TRUE),
				'name'=>$this->input->post('client_name',TRUE)
			]);

			$client_id = $this->db->insert_id();

			$targetDir = "./assets/uploads/clients/".$client_id."/";
		
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }

		}

		if($this->input->post('project_id',TRUE)){

			$project_id = $this->input->post('project_id',TRUE);

		}elseif($this->input->post('project_name',TRUE)){

			$project_name = $this->input->post('project_name',TRUE);

			$this->db->insert('projects',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'), 
				'name'=>$project_name,
				'client_id' => $client_id
			]);

			$project_id = $this->db->insert_id();

		}

		$targetDir = "./assets/uploads/projects/".$project_id."/";
	
	    if (!file_exists($targetDir)) {
	       mkdir($targetDir, 0755, true);
	    }
 
		if($this->input->post('quotation_id',TRUE)){
			//======== IS A EXISTING QUOTATION

			@$quotation_id = $this->input->post('quotation_id',TRUE);

			$data = [
				'client_id' => $client_id,
				'project_id' => @$project_id,
				'att_to' => $this->input->post('att_to',TRUE),
				'validity' => $this->input->post('validity',TRUE),
				'quotation_date' => $this->input->post('quotation_date',TRUE),
				'start_date' => $this->input->post('start_date',TRUE),
				'completion_date' => $this->input->post('completion_date',TRUE),
				'description' => $this->input->post('description',TRUE),
				'terms_and_conditions' => $this->input->post('terms_and_conditions'),
				'margin' => $this->input->post('margin',TRUE),
				'quotation_number' => $this->input->post('quotation_number',TRUE)
			];

			$result = $this->db->where('id',$quotation_id)->update('quotations',$data);

		}else{
			//======== NEW QUITATION

			$data = [
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'), 
				'client_id' => $client_id,
				'project_id' => @$project_id,
				'att_to' => $this->input->post('att_to',TRUE),
				'validity' => $this->input->post('validity',TRUE),
				'quotation_date' => $this->input->post('quotation_date',TRUE),
				'start_date' => $this->input->post('start_date',TRUE),
				'completion_date' => $this->input->post('completion_date',TRUE),
				'description' => $this->input->post('description',TRUE),
				'terms_and_conditions' => $this->input->post('terms_and_conditions'),
				// 'margin' => $this->input->post('margin',TRUE),
				'quotation_number' => $this->input->post('quotation_number',TRUE)
			];

			$result = $this->db->insert('quotations',$data);

			$quotation_id = $this->db->insert_id();


			$this->db->insert('projects_recent',[
				'project_id'=>@$project_id,
				'table'=>'quotations',
				'date_cover'=>date('Y-m-d H:i'),
				'ref_id'=>$quotation_id,
				'client_id' => $client_id
			]);
 
			$lcr = $this->core->load_core_data('landed_cost_rate'); 
			foreach ($lcr as $rs) { 
				$rs->quotation_id = $quotation_id;  
				$rs->id_orig = $rs->id;
				unset($rs->id); 
				$this->db->insert('quotations_landed_cost_rate',$rs);
			}

			$orig_quote_itms = $this->core->load_core_data('legalization_fees'); 
			foreach ($orig_quote_itms as $rs) { 
				$rs->quotation_id = $quotation_id;  
				$rs->id_orig = $rs->id;
				unset($rs->id); 
				$this->db->insert('quotations_legalization_fees',$rs);
			}

			$lcr = $this->db->get_where('quotations_landed_cost_rate',['quotation_id'=>$quotation_id])->result();
			if($lcr){
				foreach ($lcr as $rs) {
					$arr_lcr[$rs->landed_cost_rate] = $rs->id;
					$arr_qlcr_id[$rs->id_orig] = $rs->id;
				}
			}
  
			if ($_FILES['quotation_file']['error'] == 0 && $this->input->post('prev_quotation') == 0) {
		        $file_temp = $_FILES['quotation_file']['tmp_name'];

		        // Get the uploaded file's extension
		        $ext = pathinfo($_FILES['quotation_file']['name'], PATHINFO_EXTENSION);

		        // Check if it's an Excel file (you can add more file type checks if needed)
		        if ($ext == 'xls' || $ext == 'xlsx') {
		            // Read the Excel file
		            $data = $this->read_excel_file($file_temp);

		            $count = 0;

		            // Process the data (e.g., display it)
                    foreach ($data as $row) {
                    	
                    	if($count > 0){

                    		$location = $row[0];
                    		$supplier = $row[1]; 
                    		$is_local = 0;
                    		if(strtoupper($location) == 'L'){
                    			$is_local = 1;
                    		}

                    		// LEGEND
                    		//  [0] => Section/Location [1] => Brand [2] => Part [3] => Description 
                    		//  [4] => Quantity [5] => Landed Cost Rate [6] => Unit Cost 
                    		//  [7] => Discounts [8] => Is Manpower

 							if($location && !@$arr_existing_location[$location] && $is_local==0){
 								$this->db->insert('quotations_locations',[
 									'user_id'=>$this->session->user_id,
 									'date_created'=>date('Y-m-d H:i'),
 									'project_id'=>$project_id,
 									'quotation_id'=>$quotation_id,
 									'location_name'=>$location
 								]);

 								$arr_existing_location[$location] = $this->db->insert_id();
 							}

 							if($supplier && !@$arr_existing_supplier[strtolower($supplier)]){
 								$this->db->insert('suppliers',[
 									'user_id'=>$this->session->user_id,
 									'date_created'=>date('Y-m-d H:i'), 
 									'name'=>$supplier
 								]);

 								$arr_existing_supplier[strtolower($supplier)] = $this->db->insert_id();
 							}

	                    }

	                    $count+=1;
                    }


		            $count = 0;

		            // Process the data (e.g., display it)
                    foreach ($data as $row) {

                    	$is_local = 0;
                    	if(strtoupper($row[0]) == 'L'){
                    		$is_local = 1;
                    	}

                    	$location    		   = $row[0];
                    	$supplier    		   = $row[1];
                    	$item_code   		   = trim($row[2]);
                    	$item_name   		   = trim($row[3]);
                    	$qty 		 		   = str_replace(',', '', $row[4]); 
                    	$unit_cost             = str_replace(',', '', $row[5]);
                    	$discount_percentage   = $row[6];
                    	$package_name   	   = trim($row[7]); 
                    	$is_local              = $is_local;
                    	
                    	if($count > 0){

                    		if($unit_cost>0 || $package_name){

                    			$package_id = 0;

                    			if($package_name && !@$arr_package_name[$package_name][@$arr_existing_location[$location]]){

                    				$this->db->insert('quotations_package',[
                    					'user_id'				=>$this->session->user_id,
                    					'date_created'			=>date('Y-m-d H:i'),  
                    					'package_name'			=>$package_name, 
                    					'price'					=>$unit_cost,
                    					'quotation_id'			=>$quotation_id,
                    					'quotation_location_id' =>@$arr_existing_location[$location]
                    				]);

                    				$package_id = $this->db->insert_id();
                    				$arr_package_name[$package_name][@$arr_existing_location[$location]] = $package_id;  
                    				
                    			}elseif($package_name && @$arr_package_name[$package_name][@$arr_existing_location[$location]]){

                    				$package_id = $arr_package_name[$package_name][@$arr_existing_location[$location]];  

                    			}

	                    		$this->db->insert('quotations_items',[
	                    			'user_id'				=>$this->session->user_id,
	                    			'date_created'			=>date('Y-m-d H:i'),
	                    			'project_id'			=>$project_id,
	                    			'quotation_id'			=>$quotation_id,
	                    			'quotation_location_id' =>@$arr_existing_location[$location],
	                    			'item_code'				=>$item_code,
	                    			'item_name'				=>$item_name,
	                    			'brand'					=>@$arr_existing_supplier[strtolower($supplier)],
	                    			'supplier'				=>@$arr_existing_supplier[strtolower($supplier)],
	                    			'qty'					=>$qty,
	                    			'unit_cost'				=>$unit_cost,
	                    			'discount_percentage'	=>$discount_percentage, 
	                    			'is_manpower'			=>0,
	                    			'is_local'			    =>$is_local,
	                    			'margin' 				=> @$this->input->post('margin',TRUE) ? $this->input->post('margin',TRUE) : 0,
	                    			'landed_cost_rate_id'   => @$arr_qlcr_id[@$arr_existing_supplier_lcr[strtolower($supplier)]],
	                    			'package_id'			=> $package_id
	                    		]); 

                    		}



                    	}

                    	$count+=1;

                    }

                    $result = $this->admin_model->load_filemaintenance('fm_manpower');
                    $module['manpower'] = $result['maintenance_data']; 
 
                    foreach ($module['manpower'] as $mrs) {
                    	$this->db->insert('quotations_items',[
                    		'user_id'				=>$this->session->user_id,
                    		'date_created'			=>date('Y-m-d H:i'),
                    		'project_id'			=>$project_id,
                    		'quotation_id'			=>$quotation_id,
                    		'quotation_location_id' =>0,
                    		'item_code'				=>'',
                    		'item_name'				=>$mrs->title, 
                    		'qty'					=>0,
                    		'unit_cost'				=>$mrs->ds,
                    		'discount_percentage'	=>@$discount_percentage, 
                    		'is_local'			    =>0,
                    		'is_manpower'			=>1,
                    		'margin' 				=> @$this->input->post('margin',TRUE) ? $this->input->post('margin',TRUE) : 0
                    	]);
                    }
		        } 
		    }elseif($this->input->post('prev_quotation') > 0){

		    	//===== nasa vendor na ito !!!

		    	$qid = $this->input->post('prev_quotation');

		    	$orig_quote_loc = $this->core->load_core_data('quotations_locations', '','','quotation_id='.$qid); 
		    	foreach ($orig_quote_loc as $rs) { 
		    		$rs->quotation_id = $quotation_id; 
		    		$rs->date_created = date('Y-m-d H:i');
		    		$loc_id = $rs->id;
		    		unset($rs->id); 
		    		$this->db->insert('quotations_locations',$rs); 
		    		$arr_old_loc_id[$loc_id] = $this->db->insert_id();
		    	}

		    	$orig_quote_itms = $this->core->load_core_data('quotations_landed_cost_rate', '','','quotation_id='.$qid); 
		    	foreach ($orig_quote_itms as $rs) { 
		    		$rs->quotation_id = $quotation_id;  
		    		$rs->date_created = date('Y-m-d H:i');
		    		$lcr_id = $rs->id;
		    		unset($rs->id); 
		    		$this->db->insert('quotations_landed_cost_rate',$rs);
		    		$arr_new_lcr_id[$lcr_id] = $this->db->insert_id();
		    	}

		    	$orig_quote_itms = $this->core->load_core_data('quotations_items', '','','quotation_id='.$qid); 
		    	foreach ($orig_quote_itms as $rs) { 
		    		$rs->quotation_id = $quotation_id; 
		    		$rs->quotation_location_id = @$arr_old_loc_id[$rs->quotation_location_id];
		    		$rs->landed_cost_rate_id = @$arr_new_lcr_id[$rs->landed_cost_rate_id];
		    		$rs->date_created = date('Y-m-d H:i');
		    		unset($rs->id); 
		    		$this->db->insert('quotations_items',$rs);
		    	}

		    	$orig_quote_itms = $this->core->load_core_data('quotations_package', '','','quotation_id='.$qid); 
		    	foreach ($orig_quote_itms as $rs) { 
		    		$rs->quotation_id = $quotation_id; 
		    		$rs->quotation_location_id = @$arr_old_loc_id[$rs->quotation_location_id]; 
		    		$rs->date_created = date('Y-m-d H:i');
		    		unset($rs->id); 
		    		$this->db->insert('quotations_package',$rs);
		    	}

		    }

		}

		echo @$quotation_id;
	}

	public function quote_save_item(int $quotation_id, int $item_id){

		if($item_id=='sla'){

			$this->db->where('id',$quotation_id)->update('quotations',[ 
				'sla_desc' => $this->input->post('sla_desc',TRUE),
				'sla_amount' => $this->input->post('sla_amount',TRUE) 
			]);

		}elseif($this->input->post('other',TRUE)==1){

			$oe = $this->db->select('id')->get_where('quotations_items',['other'=>$item_id])->row();

			if(@$oe->id){

				if($this->input->post('price',TRUE)>0){
					$this->db->where('id',$oe->id)->update('quotations_items',[ 
						'item_name' => $this->input->post('item_name',TRUE),
						'qty' => $this->input->post('qty',TRUE),
						'unit_cost' => $this->input->post('price',TRUE),
						'discount_percentage' => $this->input->post('discount',TRUE),
						'margin' => $this->input->post('margin',TRUE),
						'edited_margin' => ($this->input->post('margin',TRUE) ? 1 : 0) 
					]);
				}else{
					$this->db->where('id',$oe->id)->delete('quotations_items');
				}

				
			}else{	
				$this->db->insert('quotations_items',[ 
					'quotation_id' => $quotation_id,
					'item_name' => $this->input->post('item_name',TRUE),
					'qty' => $this->input->post('qty',TRUE),
					'unit_cost' => $this->input->post('price',TRUE),
					'discount_percentage' => $this->input->post('discount',TRUE),
					'margin' => $this->input->post('margin',TRUE),
					'edited_margin' => ($this->input->post('margin',TRUE) ? 1 : 0),
					'other' => $item_id
				]);
			}
			 

		}else{

			$this->db->where('id',$item_id)->update('quotations_items',[
				'item_code' => $this->input->post('item_code',TRUE),
				'item_name' => $this->input->post('item_name',TRUE),
				'package_id' => $this->input->post('package',TRUE),
				'qty' => $this->input->post('qty',TRUE),
				'unit_cost' => $this->input->post('price',TRUE),
				'discount_percentage' => $this->input->post('discount',TRUE),
				'margin' => $this->input->post('margin',TRUE),
				'edited_margin' => ($this->input->post('margin',TRUE) ? 1 : 0)
			]); 

			if(@$this->input->post('package',TRUE)){
				$this->db->where('id',$this->input->post('package',TRUE))->update('quotations_package',['quotation_location_id'=>$item_id]);
			}

		}

		echo 1;

	}

	public function check_quote_no(int $q){

		$q = $this->db->select('id')->get_where('quotations',[
			'quotation_number'=>$q,
			'deleted'=>0
		])->row();

		if(@$q->id){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function set_terms_and_cond(int $quotation_id, $edit = ''){

		$module['edit'] = $edit;

		$module['quotation'] = $this->core->load_core_data('quotations',$quotation_id);

		$module['tnc'] = $this->core->load_core_data('terms_and_conditions','','','type="quotation"');

		$this->load->view('admin/sales/set_terms_and_cond',$module);

	}

	public function update_quotation_tnc(int $quotation_id){

		$q = $this->db->where('id',$quotation_id)->update('quotations',[
			'terms_and_conditions'=>$this->input->post('terms_and_conditions')
		]);

		if($q){
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l);
		}else{
			$this->session->set_flashdata("error",$this->system_menu['clang'][$l="error saving."] ?? $l);
		} 

		redirect("sales/edit_quotation/".$quotation_id,"refresh");
	}

	public function load_quotation_location(int $quotation_id)
	{ 
		$q = $this->db->select('project_id')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);

		$this->load->view('admin/sales/load_quotation_locations',$module);

	}

	public function load_quotation_items(int $quotation_id)
	{ 
		$q = $this->db->select('project_id')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['quotation'] = $this->core->load_core_data('quotations',$quotation_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['lcr'] = $this->core->load_core_data('landed_cost_rate');

		$module['qlcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);

		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$result = $this->admin_model->load_filemaintenance('fm_manpower');
		$module['manpower'] = $result['maintenance_data'];

		$this->load->view('admin/sales/load_quotation_items',$module);

	}

	public function load_quotation_final(int $quotation_id)
	{ 

		$module['confirm_save_amount'] = @$confirm_save_amount;

		$q = $this->db->select('project_id')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['quotation'] = $this->core->load_core_data('quotations',$quotation_id);

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);

		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);
  
		$this->load->view('admin/sales/load_quotation_final',$module);

	}

	public function quotation_packages(int $quotation_id){

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$this->load->view('admin/sales/quotation_packages',$module);

	}

	public function delete_location(int $location_id)
	{
		$this->db->where('id',$location_id)->delete('quotations_locations');
		$this->db->where('quotation_location_id',$location_id)->delete('quotations_items');
		return true;
	}

	public function delete_location_package(int $pak_id)
	{
		$this->db->where('id',$pak_id)->delete('quotations_package'); 
		return true;
	}

	public function save_step_2()
	{
		
		$count = 1;
		$quotation_id = $this->input->post('quotation_id',TRUE);
		$project_id = $this->input->post('project_id',TRUE);

		$ql = $this->db->select('location_name')->get_where('quotations_locations',['quotation_id'=>$quotation_id])->result();
		if($ql){
			foreach ($ql as $rs) {
				$arr_loc_exist[$rs->location_name] = 1;
			}
		}

		$loc = $this->input->post('loc',TRUE);
		if($loc > 0){
			while($loc>$count){
		 
				if(@$this->input->post('new_loc'.$count,TRUE) && !@$arr_loc_exist[@$this->input->post('new_loc'.$count,TRUE)]){

					$this->db->insert('quotations_locations',[
						'user_id'=>$this->session->user_id,
						'date_created'=>date('Y-m-d H:i'),
						'project_id'=>$project_id,
						'quotation_id'=>$quotation_id,
						'location_name'=>@$this->input->post('new_loc'.$count,TRUE)
					]);

				}

				$count+=1;

			}
		}

		$count = 1;

		$pk = $this->db->select('package_name')->get_where('quotations_package',['quotation_id'=>$quotation_id])->result();
		if($pk){
			foreach ($pk as $rs) {
				$arr_pk_exist[$rs->package_name] = 1;
			}
		}

		$pak = 20;
		if($pak > 0){
			while($pak>$count){
		 
				if(@$this->input->post('new_pak'.$count,TRUE) && !@$arr_pk_exist[@$this->input->post('new_pak'.$count,TRUE)]){

					$this->db->insert('quotations_package',[
						'user_id'=>$this->session->user_id,
						'date_created'=>date('Y-m-d H:i'), 
						'quotation_id'=>$quotation_id,
						'package_name'=>@$this->input->post('new_pak'.$count,TRUE)
					]);

				}

				$count+=1;

			}
		}

		echo $quotation_id;
	}

	public function save_step_3()
	{
		
		$count = 1;
		$quotation_id = $this->input->post('quotation_id',TRUE);
		$project_id = $this->input->post('project_id',TRUE);
 
		echo $quotation_id;
	}

	public function quotations(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/quotations";
		$module['map_link']   = "sales->quotations";  
 
		$module['quotations'] = $this->core->load_core_data('quotations','','','confirmed=0 AND confirmed_hide=0');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['projects'] = $this->core->load_core_data('projects');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');
 
		$this->load->view('admin/index',$module);

	}

	public function cost_summary(int $quotation_id){

		$q = $this->db->select('project_id')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
 
		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);
 		
 		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$this->load->view('admin/sales/cost_summary',$module);

	}

	public function set_landed_cost_rate(int $quotation_id, $edit = ''){

		$q = $this->db->select('project_id')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
		
		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);
		
		$module['edit'] = $edit;

		$this->load->view('admin/sales/set_landed_cost_rate',$module);

	}

	public function save_lc_per_supplier(int $quotation_id){

		$lc_id = $this->input->post('lc_id',TRUE);
		$sup_id = $this->input->post('sup_id',TRUE);

		$qitem = $this->db->where([
			'supplier'=>$sup_id, 
			'quotation_id'=>$quotation_id
		])->update('quotations_items',[
			'landed_cost_rate_id'=>$lc_id
		]);

		// remember cost rate of supplier
		$this->db->where('id',$sup_id)->update('suppliers',[
			'landed_cost_rate_id'=>$lc_id
		]);

		echo 1;
	}

	public function boq(int $quotation_id){

		$q = $this->db->select('project_id,sla_amount,sla_desc,sla_margin')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation'] = $q;

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);
 

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);
 		
 		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$module['suppliers'] = $this->core->load_core_data('suppliers');
 

		$this->load->view('admin/sales/boq',$module);

	}

	public function print_quotation(int $quotation_id){

		$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
 

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);
  		
  		$module['qothers'] = $this->core->load_core_data('quotations_others');

	 	// Create an instance of the Converter class
	 	$converter = new Converter("qar", "dirham");

	 	$module['converter'] = $converter;
  

		$this->load->view('admin/sales/print_quotation',$module);

	}

	public function log_print_quotation(int $quotation_id){

		$q = $this->db->select('print_logs')->get_where('quotations',['id'=>$quotation_id])->row();

		if(@$q->print_logs){
			$print_logs = json_decode($q->print_logs);
		}else{
			$print_logs = [];
		}

		$print_logs[] = [
			'user_id'=>$this->session->user_id,
			'date'=>date('Y-m-d H:i')
		];

		$this->db->where('id',$quotation_id)->update('quotations',[
			'print_logs' => json_encode($print_logs)
		]);

		echo 1;
		die();

	}

	public function print_logs_quotation(int $quotation_id){

		$module['q'] = $this->db->select('print_logs')->get_where('quotations',['id'=>$quotation_id])->row();

		$module['users'] = $this->core->load_core_data('account','','id,name');
		
		$this->load->view('admin/sales/quotations_print_logs',$module);

	}

	public function save_quotation(int $quotation_id){
 
		$module = $this->system_menu;
 

		$module['module'] = "sales/quotation_saved";
		$module['map_link']   = "sales->quotation_saved";

		$this->db->where('id',$quotation_id)->update('quotations',['draft'=>0]);

		$this->load->view('admin/index',$module);

	}

	public function view_quotation(int $quotation_id,$from_history='',$confirm_save_amount=''){

		$module = $this->system_menu;
		 
		$module['module'] = "sales/load_quotation_final";
		$module['map_link']   = "sales->load_quotation_final";

		$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

		$module['from_history'] = $from_history;

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['confirm_save_amount'] = @$confirm_save_amount;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
 
		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);

		$module['rri'] = $this->core->load_core_data('receiving_items','','inventory_id,qty','quotation_id='.$quotation_id);

		$module['iii'] = $this->core->load_core_data('issuance_items','','inventory_id,qty','quotation_id='.$quotation_id);

		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);
 
 		$module['view'] = 1;

		$this->load->view('admin/index',$module);

	}

	public function view_quotation_status(int $quotation_id){

		$module = $this->system_menu;
		 
		$module['module'] = "sales/view_quotation_status";
		$module['map_link']   = "sales->view_quotation_status";

		$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['confirm_save_amount'] = @$confirm_save_amount;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
 
		$module['rri'] = $this->core->load_core_data('receiving_items','','inventory_id,qty','quotation_id='.$quotation_id);

		$module['iii'] = $this->core->load_core_data('issuance_items','','inventory_id,qty','quotation_id='.$quotation_id);

		$module['poi'] = $this->core->load_core_data('purchase_order_items','','item_code,qty','quotation_id='.$quotation_id);
 
		$module['qothers'] = $this->core->load_core_data('quotations_others');

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);
 
 		$module['inv_quo'] = $this->core->load_core_data('inventory_quotation','','','quotation_id='.$quotation_id);

 		$module['inv'] = $this->core->load_core_data('inventory','','id,item_code');

		$this->load->view('admin/index',$module);

	}


	public function quotation_status(int $quotation_id){

		$module = $this->system_menu;
		 
		$module['module'] = "sales/quotation_status";
		$module['map_link']   = "sales->quotation_status";

		$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

		$module['quotation_id'] = $quotation_id;

		$module['project_id'] = @$q->project_id;

		$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

		$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,date_created,date_confirmed','quotation_id='.$quotation_id);
		$module['po_items'] = $this->core->load_core_data('purchase_order_items','','po_id,inventory_quotation_id,qty','quotation_id='.$quotation_id);

		$module['rr'] = $this->core->load_core_data('receiving','','id,dr_number,invoice_number,date_created','quotation_id='.$quotation_id);
		$module['rr_items'] = $this->core->load_core_data('receiving_items','','receiving_id, qty,inventory_quotation_id','quotation_id='.$quotation_id);
 
		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

		$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);

		$module['qothers'] = $this->core->load_core_data('quotations_others');
 
 		$module['view'] = 1;

		$this->load->view('admin/index',$module);

	}

	public function edit_quotation(int $quotation_id, $filter_by='', $filter_val=''){

			$module = $this->system_menu;
			 
			$module['module'] = "sales/edit_quotation";
			$module['map_link']   = "sales->edit_quotation";

			$module['filter_by'] = $filter_by;
			$module['filter_val'] = $filter_val;

			$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

			$module['quotation_id'] = $quotation_id;

			$module['project_id'] = @$q->project_id;

			$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

			$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

			$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

			$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

			$module['suppliers'] = $this->core->load_core_data('suppliers');

			$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

			$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);

			$module['qothers'] = $this->core->load_core_data('quotations_others');

			$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);
	 		
	 		$module['view'] = 1;

			$this->load->view('admin/index',$module);

	} 

	public function reload_edit_quotation(int $quotation_id, $filter_by='', $filter_val=''){

			$module = $this->system_menu;
			  

			$module['filter_by'] = $filter_by;
			$module['filter_val'] = $filter_val;

			$q = $module['quotation'] = $this->db->get_where('quotations',['id'=>$quotation_id])->row();

			$module['quotation_id'] = $quotation_id;

			$module['project_id'] = @$q->project_id;

			$module['project'] = $this->core->load_core_data('projects',@$q->project_id);

			$module['client'] = $this->core->load_core_data('clients',@$q->client_id);

			$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

			$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);

			$module['suppliers'] = $this->core->load_core_data('suppliers');

			$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$quotation_id);

			$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$quotation_id);
	 		
	 		$module['view'] = 1;
 
	 		$this->load->view('admin/sales/edit_quotation',$module);
	 	 
			

	} 

	public function edit_item(int $qid, int $id){

		$module['qid'] = $qid;

		$module['i'] = $this->core->load_core_data('quotations_items',$id);

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$qid);

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$qid);
  
		$this->load->view('admin/sales/edit_item',$module);

	}

	public function edit_other(int $qid, int $id, int $other_id){

		$module['qid'] = $qid;

		$module['i'] = $this->core->load_core_data('quotations_items',$id);

		$module['other'] = $this->db->get_where('quotations_others',['id'=>@$other_id])->row(); 

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$qid);

		$module['suppliers'] = $this->core->load_core_data('suppliers');
  
		$this->load->view('admin/sales/edit_other',$module);

	}

	public function update_other(int $qid, $id='', $other_id=''){
 		
		if($this->input->post('unit_cost',TRUE)<=0 && $id){

			$this->db->where('id',$id)->delete('quotations_items');

		}else{

	 		if($id){

				$this->db->where('id',$id)->update('quotations_items',[
					'modified_by'=>$this->session->user_id,
					'date_modified'=>date('Y-m-d H:i'),
					'unit_cost'=>$this->input->post('unit_cost',TRUE)
				]);

			}else{
			 
				$this->db->insert('quotations_items',[ 
					'user_id'				=>$this->session->user_id,
					'date_created'			=>date('Y-m-d H:i'), 
					'other'				    =>$other_id, 
					'qty'					=>1,
					'margin'				=>$this->input->post('margin',TRUE),
					'unit_cost'				=>$this->input->post('unit_cost',TRUE),
					'landed_cost_rate_id'   =>0,
					'is_manpower'			=>0,
					'quotation_id' 			=> $qid
				]);

			}

		}

		$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 

		redirect("sales/edit_quotation/".$qid,"refresh");

	}

	public function edit_sla(int $quotation_id){

		$module['qid'] = $quotation_id;

		$module['q'] = $this->core->load_core_data('quotations',$quotation_id); 

		$this->load->view('admin/sales/edit_sla',$module);

	}

	public function update_sla(int $quotation_id){

		$this->db->where('id',$quotation_id)->update('quotations',[ 
			'sla_desc'=>$this->input->post('sla_desc',TRUE),
			'sla_amount'=>$this->input->post('sla_amount',TRUE),
			'sla_margin'=>$this->input->post('sla_margin',TRUE)
		]);

		$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 

		redirect("sales/edit_quotation/".$quotation_id,"refresh");

	}

	public function update_item(int $qid, int $id){

		if($this->input->post('supplier',TRUE) == 'new'){

			$this->db->insert('suppliers',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'),
				'name'=>$this->input->post('supplier_name',TRUE)
			]);

			$supplier = $this->db->insert_id();

		}else{
			$supplier = $this->input->post('supplier',TRUE);
		}

		$is_manpower = 0;
		$is_local = 0;

		$lcr_id = $this->input->post('landed_cost_rate_id',TRUE);

		if($lcr_id == 'LOCAL'){
			$lcr_id = 0;
			$is_local = 1;
		}

		if($lcr_id == 'MANPOWER'){
			$lcr_id = 0;
			$is_manpower = 1;
		}

		$qi = $this->db->select('margin')->get_where('quotations_items',['id'=>$id])->row();

		$package_id = $this->input->post('package_id',TRUE);
		if($package_id == 'new'){

			$this->db->insert('quotations_package',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'),
				'package_name'=>$this->input->post('package_name',TRUE),
				'quotation_id'=>$qid
			]);

			$package_id = $this->db->insert_id();
		}

		$this->db->where('id',$id)->update('quotations_items',[ 
			'user_id'				=>$this->session->user_id,
			'date_modified'			=>date('Y-m-d H:i'), 
			'item_code'				=>$this->input->post('item_code',TRUE),
			'item_name'				=>$this->input->post('item_name',TRUE),
			'brand'					=>@$supplier,
			'supplier'				=>@$supplier,
			'qty'					=>$this->input->post('qty',TRUE),
			'unit_cost'				=>$this->input->post('unit_cost',TRUE),
			'discount_percentage'	=>$this->input->post('discount_percentage',TRUE),
			'package_id'   			=>$package_id,
			'landed_cost_rate_id'   =>$lcr_id,
			'is_manpower'			=>$is_manpower,
			'is_local'			    =>$is_local,
			'margin' 				=> $this->input->post('margin',TRUE),
			'edited_margin'			=> ($qi->margin!=$this->input->post('margin',TRUE) ? 1 : 0)
		]);

		$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 

		redirect("sales/edit_quotation/".$qid,"refresh");

	}


	public function save_item(int $qid, int $lid, $is_from_js=''){

		if($this->input->post('supplier',TRUE) == 'new'){

			$this->db->insert('suppliers',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'),
				'name'=>$this->input->post('supplier_name',TRUE)
			]);

			$supplier = $this->db->insert_id();

		}else{
			$supplier = @$this->input->post('supplier',TRUE);
		}

		$is_manpower = 0;
		$is_local = 0;

		$lcr_id = $this->input->post('landed_cost_rate_id',TRUE);

		if($lcr_id == 'LOCAL'){
			$lcr_id = 0;
			$is_local = 1;
		}

		if($lcr_id == 'MANPOWER'){
			$lcr_id = 0;
			$is_manpower = 1;
		}

		$package_id = $this->input->post('package_id',TRUE);
		if($package_id == 'new'){

			$this->db->insert('quotations_package',[
				'user_id'=>$this->session->user_id,
				'date_created'=>date('Y-m-d H:i'),
				'package_name'=>$this->input->post('package_name',TRUE),
				'quotation_id'=>$qid
			]);

			$package_id = $this->db->insert_id();
		}


		$this->db->insert('quotations_items',[ 
			'user_id'				=>$this->session->user_id,
			'date_modified'			=>date('Y-m-d H:i'), 
			'item_code'				=>$this->input->post('item_code',TRUE),
			'item_name'				=>$this->input->post('item_name',TRUE),
			'brand'					=>@$supplier,
			'supplier'				=>@$supplier,
			'qty'					=>$this->input->post('qty',TRUE),
			'unit_cost'				=>$this->input->post('unit_cost',TRUE),
			'discount_percentage'	=>$this->input->post('discount_percentage',TRUE),
			'landed_cost_rate_id'   =>$lcr_id,
			'is_manpower'			=>$is_manpower,
			'is_local'			    =>$is_local,
			'margin' 				=> $this->input->post('margin',TRUE),
			'package_id' 			=> $package_id,
			'quotation_location_id' => $lid,
			'quotation_id'			=> $qid
		]);

		$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 

		if($is_from_js == 1){
			echo $this->db->insert_id();
		}else{
			redirect("sales/edit_quotation/".$qid,"refresh");
		}

	}

	public function landed_cost_rate($view = '', $qid='',$edit=''){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/landed_cost_rate";
		$module['map_link']   = "sales->landed_cost_rate"; 
		$module['view']   = $view;  
		$module['qid']   = $qid;
		$module['edit']   = $edit;

		$module['quotation'] = $this->core->load_core_data('quotations', $qid, 'id,confirmed');
 	 	
 		if($qid){
 			$module['landed_cost_rate'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$qid);
 		}else{
 			$module['landed_cost_rate'] = $this->core->load_core_data('landed_cost_rate');
 		} 
 		
 		if($view){
 			$this->load->view('admin/sales/landed_cost_rate',$module);
 		}else{
 			$this->load->view('admin/index',$module);
 		}
		
	}

	public function update_lc(int $qid){

		$lc = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$qid);
		if(@$lc){
			foreach ($lc as $rs) {
				$this->db->where('id',$rs->id)->update('quotations_landed_cost_rate',[
					'conversion_factor' => $this->input->post('conversion_factor'.$rs->id,TRUE),
					'freight_percent' => $this->input->post('freight_percent'.$rs->id,TRUE),
					'custom_percent' => $this->input->post('custom_percent'.$rs->id,TRUE),
					'landed_cost_factor' => $this->input->post('landed_cost_factor'.$rs->id,TRUE) 
				]);
			}
		}

		echo 1;

	}

	public function update_lp(int $qid){

		$lc = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$qid);
		if(@$lc){
			foreach ($lc as $rs) {
				$this->db->where('id',$rs->id)->update('quotations_legalization_fees',[
					'amount_from' => $this->input->post('amount_from'.$rs->id,TRUE),
					'amount_to' => $this->input->post('amount_to'.$rs->id,TRUE),
					'fees' => $this->input->post('fees'.$rs->id,TRUE) 
				]);
			}
		}

		echo 1;

	}

	public function legalization_fees($view='', $qid = '',$edit=''){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/legalization_fees";
		$module['map_link']   = "sales->legalization_fees"; 
		$module['view']   = $view;  
		$module['qid']   = $qid;
		$module['edit']   = $edit;

		$module['quotation'] = $this->core->load_core_data('quotations', $qid);
 		
 		if($qid){
 			$module['legalization_fees'] = $this->core->load_core_data('quotations_legalization_fees','','','quotation_id='.$qid); 
 		}else{
 			$module['legalization_fees'] = $this->core->load_core_data('legalization_fees'); 
 		} 
 
		if($view){
			$this->load->view('admin/sales/legalization_fees',$module);
		}else{
			$this->load->view('admin/index',$module);
		}

	}

	public function add_legal_fees()
	{
		 
		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');
		
		$this->load->view('admin/sales/add_legal_fees', $module);
	}

	public function save_legal_fees(){

		$model = $this->core->global_query(1,'legalization_fees'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/legalization_fees","refresh");

	}

	public function edit_legal_fees(int $id)
	{
		 
		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$module['lf'] = $this->core->load_core_data('legalization_fees',$id);
	 
		$this->load->view('admin/sales/edit_legal_fees', $module);

	}

	public function update_legal_fees(int $id){

		$model = $this->core->global_query(2,'legalization_fees', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/legalization_fees","refresh");

	}

	 
	public function delete_quotations(int $id)
	{
		$model = $this->core->global_query(3,'quotations', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/quotations","refresh");
	}

	public function print_quotations(int $id)
	{
		$module['clients'] = $this->core->load_core_data('clients');

		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$module['quotation'] = $this->core->load_core_data('quotations', $id);

		$result = $this->admin_model->load_filemaintenance('fm_quotation_type');
		$module['quotation_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_type');
		$module['currency_type'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/sales/quotations_print', $module);

	}

	public function find_client(int $id){
		echo json_encode($this->db->where('id',$id)->get('clients')->row());
	}
 
 	public function search_project()
 	{
 		if(@$this->input->post('excluded_ids',TRUE)){
			foreach(explode('-',$this->input->post('excluded_ids',TRUE)) as $id){
				if($id){
					$excluded_id.=' AND id!='.$id;
				}
			}
		}

		if($excluded_id){
			$excluded_id = '('.$excluded_id.')';
			$excluded_id = str_replace('( AND','(',$excluded_id);
		}

		$search = @$this->input->post('searchTerm');

		$i = $this->core->search_data('projects','id,name', ['name'],$search,7,$excluded_id);

		foreach($i as $rs){
			$json[] = [
				'id'=>$rs->id, 
				'text'=>$rs->name, 
				'find'=>$search
			];
		}

		echo json_encode($json);
	}

	public function revise_quotation(int $id){

		$quote_main = $this->core->load_core_data('quotations', $id, 'quotation_id');

		if($quote_main->quotation_id){
			$main_quotation_id = $quote_main->quotation_id;
		}else{
			$main_quotation_id = $id;
		}

		$count = $this->core->load_core_data('quotations', '', 'id', 'quotation_id='.$main_quotation_id); 
		
		$orig_quote = $this->core->load_core_data('quotations', $main_quotation_id); 
		$orig_quote->quotation_id = $orig_quote->id;
		$orig_quote->date_created = date('Y-m-d H:i');
		$orig_quote->user_id = $this->session->user_id;  
		$orig_quote->version = count($count)+1;
		unset($orig_quote->id);
		$this->db->insert('quotations',$orig_quote);

		$qid = $this->db->insert_id();

		$orig_quote_loc = $this->core->load_core_data('quotations_locations', '','','quotation_id='.$id); 
		foreach ($orig_quote_loc as $rs) { 
			$rs->quotation_id = $qid; 
			$rs->date_created = date('Y-m-d H:i');
			$loc_id = $rs->id;
			unset($rs->id); 
			$this->db->insert('quotations_locations',$rs); 
			$arr_old_loc_id[$loc_id] = $this->db->insert_id();
		}


		$orig_quote_itms = $this->core->load_core_data('quotations_landed_cost_rate', '','','quotation_id='.$id); 
		foreach ($orig_quote_itms as $rs) { 
			$rs->quotation_id = $qid;  
			$rs->date_created = date('Y-m-d H:i');
			$lcr_id = $rs->id;
			unset($rs->id); 
			$this->db->insert('quotations_landed_cost_rate',$rs);
			$arr_new_lcr_id[$lcr_id] = $this->db->insert_id();
		}

		$orig_quote_itms = $this->core->load_core_data('quotations_legalization_fees', '','','quotation_id='.$id); 
		foreach ($orig_quote_itms as $rs) { 
			$rs->quotation_id = $qid;  
			$rs->date_created = date('Y-m-d H:i');
			unset($rs->id); 
			$this->db->insert('quotations_legalization_fees',$rs);
		}

		$orig_quote_itms = $this->core->load_core_data('quotations_items', '','','quotation_id='.$id); 
		foreach ($orig_quote_itms as $rs) { 
			$rs->quotation_id = $qid; 
			$rs->quotation_location_id = @$arr_old_loc_id[$rs->quotation_location_id];
			$rs->landed_cost_rate_id = @$arr_new_lcr_id[$rs->landed_cost_rate_id];
			$rs->date_created = date('Y-m-d H:i');
			unset($rs->id); 
			$this->db->insert('quotations_items',$rs);
		}
		 
		redirect("sales/edit_quotation/".$qid,"refresh");

	}

	public function confirm_quotation(int $id){
 
		$qi = $this->db->select('id')->get_where('quotations_items',[
			'quotation_id'=>$id,
			'other'=>null,
			'landed_cost_rate_id'=>null,
			'is_local'=>0,
			'is_manpower'=>0
		])->row();

		$quo = $this->core->load_core_data('quotations',$id);
 		
 		if($quo->margin == 0){

 			$this->session->set_flashdata("error",$this->system_menu['clang'][$l="Margin not set."] ?? $l); 
 				  
 			redirect("sales/quotations","refresh");

		}elseif(@$qi->id){

			$this->session->set_flashdata("error",$this->system_menu['clang'][$l="Some items dosent have landed cost rate records yet."] ?? $l); 
				  
			redirect("sales/quotations","refresh");

		}else{

			// $this->db->where('quotation_id',$quo->quotation_id)->update('quotations',[
			// 	'confirmed_hide' => 1,
			// 	'master_confirmed' => 1 
			// ]);

			$this->db->query('UPDATE quotations SET confirmed_hide=1, master_confirmed=1 WHERE 1');

			$this->db->where('id',$id)->update('quotations',[
				'confirmed_hide' => 1 
			]);
 			 
			$this->db->where('id',$id)->update('quotations',[
				'confirmed' => 1,
				'confirmed_by' => $this->session->user_id,
				'confirmed_date' => date('Y-m-d H:i'),
				'confirmed_hide' => 0
			]);
	 		
	 		//== INSERT TO INVENTORY QUOTATION MASTERLIST (FOR PO CONSOLIDATION)
	 		
			$inv_master = $this->core->load_core_data('inventory_quotation','','','quotation_id='.$id); 
			foreach ($inv_master as $rs) { 
				$arr_inv[strtolower($rs->item_code)][$rs->quotation_id] = $rs;
			}
			
			$orig_quote_itms = $this->core->load_core_data('quotations_items', '','','quotation_id='.$id); 
			foreach ($orig_quote_itms as $rs) { 

				if($rs->qty<=0){$rs->qty=0;}

				if($rs->is_manpower || $rs->other){}else{

					if(@$arr_inv[strtolower($rs->item_code)][$id]->id){

						$quotation_location_ids = json_decode($arr_inv[strtolower($rs->item_code)][$id]->quotation_location_ids);
						if (!in_array($rs->quotation_location_id, $quotation_location_ids)) {
							array_push($quotation_location_ids, $rs->quotation_location_id); 
							$arr_inv[strtolower($rs->item_code)][$id]->quotation_location_ids = json_encode($quotation_location_ids);
						}

						$suppliers = json_decode($arr_inv[strtolower($rs->item_code)][$id]->suppliers);
						if (!in_array($rs->supplier, $suppliers)) {
							array_push($suppliers, $rs->supplier);
							$arr_inv[strtolower($rs->item_code)][$id]->suppliers = json_encode($suppliers);
						}

						$landed_cost_rate_ids = json_decode($arr_inv[strtolower($rs->item_code)][$id]->landed_cost_rate_ids);
						if (!in_array($rs->landed_cost_rate_id, $landed_cost_rate_ids)) {
							array_push($landed_cost_rate_ids, $rs->landed_cost_rate_id);
							$arr_inv[strtolower($rs->item_code)][$id]->landed_cost_rate_ids = json_encode($landed_cost_rate_ids);
						}

						$package_ids = json_decode($arr_inv[strtolower($rs->item_code)][$id]->package_ids);
						if (!in_array($rs->package_id, $package_ids)) {
							array_push($package_ids, $rs->package_id);
							$arr_inv[strtolower($rs->item_code)][$id]->package_ids = json_encode($package_ids);
						}

						if($arr_inv[strtolower($rs->item_code)][$id]->unit_cost<$rs->unit_cost){
							$unit_cost = $rs->unit_cost;
						}else{
							$unit_cost = $arr_inv[strtolower($rs->item_code)][$id]->unit_cost;
						}

						$this->db->where('id',@$arr_inv[strtolower($rs->item_code)][$id]->id)->update('inventory_quotation',[
							'qty'                   =>	($arr_inv[strtolower($rs->item_code)][$id]->qty)+($rs->qty),
							'quotation_location_ids'=>	json_encode($quotation_location_ids),
							'suppliers'				=>	json_encode($suppliers),
							'landed_cost_rate_ids'	=>	json_encode($landed_cost_rate_ids),
							'package_ids'	        =>	json_encode($package_ids),
							'unit_cost'				=>  $unit_cost
						]);

						$arr_inv[strtolower($rs->item_code)][$id]->qty = $arr_inv[strtolower($rs->item_code)][$id]->qty + $rs->qty;
						
					}else{

						if($rs->item_code){
							$data_qi = [
								'user_id'				=>$this->session->user_id,
								'date_created'			=>date('Y-m-d H:i'), 
								'item_code'				=>$rs->item_code,
								'item_name'				=>$rs->item_name,
								'qty'					=>$rs->qty,
								'quotation_id'			=>$id,
								'quotation_location_ids'=>json_encode([($rs->quotation_location_id ?? "0")]),
								'suppliers'				=>json_encode([($rs->supplier ?? "0")]),
								'landed_cost_rate_ids'	=>json_encode([($rs->landed_cost_rate_id ?? "0")]),
								'package_ids'			=>json_encode([($rs->package_id ?? "0")]),
								'unit_cost'				=>$rs->unit_cost,
								'is_local'				=>$rs->is_local
							];
							$this->db->insert('inventory_quotation',$data_qi);

							$inv_q_id = $this->db->insert_id();
							//array_push($data_qi,['id'=>$inv_q_id]);

							$iq_data = $this->db->get_where('inventory_quotation',['id'=>$inv_q_id])->row();
	 
							$arr_inv[strtolower($rs->item_code)][$id] = $iq_data;
						}
		 
					}

					$this->db->where('id',$rs->id)->update('quotations_items',[
						'inventory_quotation_id' => $inv_q_id
					]);

				}
			}

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			//redirect("sales/confirmed_quotation","refresh");
			redirect("sales/view_quotation/".$id."/0/confirm_save_amount","refresh");

		}

	}

	public function confirmed_quotation(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/quotations_confirmed";
		$module['map_link']   = "sales->quotations";  
	
		$module['quotations'] = $this->core->load_core_data('quotations','','','confirmed=1');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['projects'] = $this->core->load_core_data('projects');
	 
		$module['users'] = $this->core->load_core_data('account','','id,name');
	
		$this->load->view('admin/index',$module);

	}

	public function quotation_history(int $id){

		$module = $this->system_menu;
 
		$module['module'] = "sales/quotations_history";
		$module['map_link']   = "sales->quotations_history";  

		$module['quotation_id'] = $id;
		
		$q = $this->core->load_core_data('quotations',$id,'id,quotation_id','',1);
		if($q->quotation_id==0){$q->quotation_id = $q->id;}

		$module['quotations'] = $this->core->load_core_data('quotations','','','(quotation_id='.$q->quotation_id.' OR id='.$q->quotation_id.')');
		 
		$module['clients'] = $this->core->load_core_data('clients');

		$module['projects'] = $this->core->load_core_data('projects');
		
		$module['users'] = $this->core->load_core_data('account','','id,name');
		
		$this->load->view('admin/index',$module);

	}

	public function terms_and_conditions(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/terms_and_conditions";
		$module['map_link']   = "sales->terms_and_conditions";  
	  
		$module['tnc'] = $this->core->load_core_data('terms_and_conditions','','','type="quotation"');
	
		$this->load->view('admin/index',$module);

	}

	public function add_tnc(){

		$module['type'] = 'quotation';

		$this->load->view('admin/sales/add_tnc',$module);

	}

	public function edit_tnc(int $id){

		$module['type'] = 'quotation';

		$module['tnc'] = $this->core->load_core_data('terms_and_conditions',$id);

		$this->load->view('admin/sales/edit_tnc',$module);
		
	}

	public function save_tnc(){

		$q = $this->db->insert('terms_and_conditions',[
			'user_id' => $this->session->user_id,
			'date_created' => date('Y-m-d H:i'),
			'title' => $this->input->post('title',TRUE),
			'description' => $this->input->post('terms_and_conditions'),
			'type' => 'quotation'
		]);

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/terms_and_conditions","refresh");

	}

	public function update_tnc(int $id){

		$q = $this->db->where('id',$id)->update('terms_and_conditions',[
			'modified_by' => $this->session->user_id,
			'date_modified' => date('Y-m-d H:i'),
			'title' => $this->input->post('title',TRUE),
			'description' => $this->input->post('terms_and_conditions'),
			'type' => 'quotation'
		]);

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/terms_and_conditions","refresh");

	}

	public function delete_tnc(int $id){

		$q = $this->db->where('id',$id)->delete('terms_and_conditions');

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/terms_and_conditions","refresh");

	}

	public function load_template(int $id){

		$tnc = $this->core->load_core_data('terms_and_conditions',$id);

		echo  @$tnc->description ;

	}

	public function quotation_margin_projection($quotation_id){

		$module['type'] = 'quotation'; 

		$this->load->view('admin/sales/projection',$module);

	}

	public function financial_charges(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "sales/financial_charges";
		$module['map_link']   = "sales->financial_charges";  
	  
		$module['qothers'] = $this->core->load_core_data('quotations_others');
	
		$this->load->view('admin/index',$module);

	}

	public function add_financial_charges(){
  
		$module = [];

		//$module['qothers'] = $this->core->load_core_data('qothers',$id);

		$this->load->view('admin/sales/add_financial_charges',$module);

	}

	public function edit_financial_charges(int $id){
  
		$module = [];

		$module['qothers'] = $this->core->load_core_data('quotations_others',$id);

		$this->load->view('admin/sales/edit_financial_charges',$module);

	}

	public function save_financial_charges(){

		$model = $this->core->global_query(1,'quotations_others'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/financial_charges","refresh");

	}

	public function update_financial_charges(int $id){

		$model = $this->core->global_query(2,'quotations_others',$id); 

		if(@$model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/financial_charges","refresh");

	}

	public function applied_ave_margin_quotation(int $quotation_id){

		$module = [];

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['q'] = $this->core->load_core_data('quotations',$quotation_id);

		$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id.' AND margin<>"'.$module['q']->margin.'" AND margin<>"0"');
		
		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$this->load->view('admin/sales/applied_ave_margin_quotation',$module);

	}

	public function delete_financial_charges($id){

		$model = $this->core->global_query(3,'quotations_others',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("sales/financial_charges","refresh");

	}
	
}	