<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory; 
use TNkemdilim\MoneyToWords\Converter; 
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Vendor extends CI_Controller {

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

		public function read_excel_file($file_path)
		{
		    $spreadsheet = IOFactory::load($file_path);
		    $worksheet = $spreadsheet->getActiveSheet();
		    $data = $worksheet->toArray();

		    return $data;
		}

		public function save_step_1()
		{

			

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
					'margin' => @$this->input->post('margin',TRUE) ? $this->input->post('margin',TRUE) : 0,
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
	                    					'price'					=>(@$unit_cost>0 ? $unit_cost : 0),
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
		                    			'unit_cost'				=>(@$unit_cost>0 ? $unit_cost : 0),
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

			    	$orig_quote_itms = $this->core->load_core_data('quotations_package', '','','quotation_id='.$qid); 
			    	foreach ($orig_quote_itms as $rs) { 
			    		$rs->quotation_id = $quotation_id; 
			    		$rs->quotation_location_id = @$arr_old_loc_id[$rs->quotation_location_id]; 
			    		$rs->date_created = date('Y-m-d H:i');
			    		$pkg_id = $rs->id;
			    		unset($rs->id); 
			    		$this->db->insert('quotations_package',$rs);
			    		$arr_new_package_id[$pkg_id] = $this->db->insert_id();
			    	}

			    	$orig_quote_itms = $this->core->load_core_data('quotations_items', '','','quotation_id='.$qid); 
			    	foreach ($orig_quote_itms as $rs) { 
			    		$rs->quotation_id = $quotation_id; 
			    		$rs->quotation_location_id = @$arr_old_loc_id[$rs->quotation_location_id];
			    		$rs->landed_cost_rate_id = @$arr_new_lcr_id[$rs->landed_cost_rate_id];
			    		$rs->package_id = @$arr_new_package_id[$rs->package_id];
			    		$rs->date_created = date('Y-m-d H:i');
			    		unset($rs->id); 
			    		$this->db->insert('quotations_items',$rs);
			    	}



			    }

			}

			echo @$quotation_id;
		}

			public function export_to_excel($page, $data) {
			    // Create a new instance of the PhpSpreadsheet Spreadsheet
			    $spreadsheet = new Spreadsheet();

			    // Load the view file and get its output
			    $html = $this->load->view($page, $data, true);

			    // Create a new worksheet
			    $worksheet = $spreadsheet->getActiveSheet();

			    // Load the HTML content into a worksheet
			    $worksheet->fromArray($this->htmlTo2DArray($html));

			    // Set a password for the Excel file (change 'password' to your desired password)
			    $spreadsheet->getSecurity()->setLockWindows(true);
			    $spreadsheet->getSecurity()->setLockStructure(true);
			    $spreadsheet->getSecurity()->setWorkbookPassword('pass123');

			    // Create a writer to save the Excel file
			    $writer = new Xlsx($spreadsheet);

			    // Save the Excel file to a temporary location
			    $tempFile = tempnam(sys_get_temp_dir(), 'excel_export');
			    $writer->save($tempFile);

			    // Set appropriate headers for download
			    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			    header('Content-Disposition: attachment;filename="exported.xlsx"');
			    header('Cache-Control: max-age=0');
			    readfile($tempFile);

			    // Clean up the temporary file
			    unlink($tempFile);
			}


			public function print_po($id){

				$module = $this->system_menu;   
				 
				$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
				$module['manufacturers'] = $result['maintenance_data'];
				
				$module['users'] = $this->core->load_core_data('account','','id,name');

				$module['suppliers'] = $this->core->load_core_data('suppliers_po','','id,name');

				$module['po'] = $this->core->load_core_data('purchase_order',$id);

				$module['po_items'] = $this->core->load_core_data('purchase_order_items','','','po_id='.$id);

				$module['vehicles'] = $this->core->load_core_data('vehicles','','id,customer_id,manufacturer_id,plate_no');

				$module['customers'] = $this->core->load_core_data('clients','','id,name');
				
				$module['user'] = $this->core->load_core_data('account',$module['po']->user_id,'id,name');
				 
				$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
				$module['rates'] = $result['maintenance_data'];
				
				// Create an instance of the Converter class
				$converter = new Converter("qar", "dirham");

				$module['converter'] = $converter;
				 
				
				$this->load->view('admin/purchasing/print_po',$module);
				//$this->export_to_pdf('admin/purchasing/print_po',$module);
				//$this->export_to_excel('admin/purchasing/print_po',$module);
			}

			// Helper function to convert HTML to a 2D array
			private function htmlTo2DArray($html) {
			    $dom = new DOMDocument;
			    libxml_use_internal_errors(true);
			    $dom->loadHTML($html);
			    libxml_clear_errors();

			    $rows = array();
			    $table = $dom->getElementsByTagName('table')->item(0);
			    $rowIndex = 0;

			    foreach ($table->getElementsByTagName('tr') as $row) {
			        $colIndex = 0;
			        foreach ($row->getElementsByTagName('td') as $cell) {
			            $rows[$rowIndex][$colIndex] = $cell->textContent;
			            $colIndex++;
			        }
			        $rowIndex++;
			    }

			    return $rows;
			}



}