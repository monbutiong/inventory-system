<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once FCPATH . 'vendor/autoload.php';

// use TNkemdilim\MoneyToWords\Converter;
// use Mpdf\Mpdf;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Purchasing extends CI_Controller {


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

	 
 

	public function supplier(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/suppliers";
		$module['map_link']   = "purchasing->suppliers";  
 
		$module['suppliers'] = $this->core->load_core_data('suppliers');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function add_supplier(){
  
		$this->load->view('admin/purchasing/supplier_add');

	}

	public function upload_supplier(){
  
		$this->load->view('admin/purchasing/upload_supplier');

	}

	public function save_upload_supplier()
	{
		$module['upload_type'] = $this->input->post('upload_type',true);
		$this->load->view('admin/purchasing/save_upload_supplier',$module);
	}

	public function delete_supplier($id='')
	{
		$model = $this->core->global_query(3,'suppliers',$id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/supplier","refresh");
	}

	public function edit_supplier($id){

		$module['supplier'] = $this->core->load_core_data('suppliers', $id);
  
		$this->load->view('admin/purchasing/supplier_edit', $module);

	}

	public function view_supplier($id){

		$module['supplier'] = $this->core->load_core_data('suppliers', $id);
  
		$this->load->view('admin/purchasing/supplier_view', $module);

	}

	public function save_supplier()
	{
		$model = $this->core->global_query(1,'suppliers'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/supplier","refresh");
	}

	public function update_supplier($id)
	{
		$model = $this->core->global_query(2,'suppliers', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/supplier","refresh");
	}

	public function po_list(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/po_list";
		$module['map_link']   = "sales->quotations";  
		 
		$module['customers'] = $this->core->load_core_data('clients','','id,name');

		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];

		$module['vehicles'] = $this->core->load_core_data('vehicles','','id,customer_id,manufacturer_id,plate_no');
		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers_po','','id,name');

		$module['purchase_order'] = $this->core->load_core_data('purchase_order','','','confirmed=0');
		
		$this->load->view('admin/index',$module);

	}

	public function create_po(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/create_po";
		$module['map_link']   = "sales->quotations";  
		  
		$module['customers'] = $this->core->load_core_data('clients','','id,name');

		$module['vehicles'] = $this->core->load_core_data('vehicles');

		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];
		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers_po','','id,name');
 
		$module['po'] = $this->db->select('MAX(id) as po_number')->get('purchase_order')->row();

		$module['tnc'] = $this->core->load_core_data('terms_and_conditions','','','type="po"');

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];
		
		$this->load->view('admin/index',$module);

	}

	public function add_items($sid=0, $qid=0){

		$module['quotation'] = $this->core->load_core_data('quotations',$qid,'id');

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		//$module['items'] = $this->core->load_core_data('quotations_items','','','id>0 '.($qid ? ' AND quotation_id='.$qid : ''));

		$module['ql'] = $this->core->load_core_data('quotations_locations','','',($qid ? 'quotation_id='.$qid : ''));

		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$qid);

		$module['poi'] = $this->core->load_core_data('purchase_order_items','','po_id,inventory_id,item_code,qty','quotation_id='.$qid);

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$qid);

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$qid);

		$module['inv_quo'] = $this->core->load_core_data('inventory_quotation','','','quotation_id='.$qid);
		
		$this->load->view('admin/purchasing/add_items', $module);

	}

	public function check_item_if_in_inv($simple = '') {
	    $json = [];

	    // Check if specific IDs are passed (single or multiple)
	    $ids = @$this->input->post('id', TRUE);  // can be a single id or array or CSV string

	    $is_new = $this->input->post('is_new', TRUE);

	    if ($ids) {
	        // Normalize $ids to an array
	        if (!is_array($ids)) {
	            // If comma-separated string, convert to array
	            if (strpos($ids, ',') !== false) {
	                $ids = explode(',', $ids);
	            } else {
	                $ids = [$ids];
	            }
	        }

	        // Query by these IDs only
	        

	        $this->db->where_in('i.id', $ids); 
	        $this->db->select('
	        	i.id, i.item_code, i.item_name, i.supplier_price, i.qty, i.picture_1, 
	            b.title as brand,
	            c.title as category,
	            t.title as type 
	        ');
	        $this->db->from('inventory as i');
	        $this->db->join('fm_item_brand b', 'b.id = i.item_brand_id', 'left');
	        $this->db->join('fm_item_category c', 'c.id = i.item_category_id', 'left');
	        $this->db->join('fm_item_type t', 't.id = i.item_type_id', 'left'); 
	        $items = $this->db->get()->result();

	        foreach ($items as $r) {
	            $json[] = [
	                'id' => $r->id,
	                'text' => $r->item_code . ' | ' . $r->item_name,
	                'item_code' => $r->item_code,
	                'item_name' => $r->item_name,
	                'brand' => $r->brand,
	                'category' => $r->category,
	                'type' => $r->type,
	                'supplier_price' => $r->supplier_price,
	                'image_url' => $r->picture_1, 
	                'qty' => $r->qty
	            ];
	        }

	        print_r(json_encode($json));
	        return;  // Stop execution here because we already returned the results
	    }

	    if($is_new==1){die();}

	    // Continue with original logic if no ids requested

	    $excluded_id = '';

	    if ($this->input->post('excluded_ids', TRUE)) {
	        foreach (explode('-', $this->input->post('excluded_ids', TRUE)) as $id) {
	            if ($id) {
	            	$id = str_replace('(','',$id);
	            	$id = str_replace(')','',$id);
	                $excluded_id .= ' AND i.id != ' . $id;
	            }
	        }
	    }

	    if ($excluded_id) {
	        $excluded_id = '(' . $excluded_id . ')';
	        $excluded_id = str_replace('( AND', '(', $excluded_id);
	        $this->db->where($excluded_id);
	    }

	    $search = $this->input->post('searchTerm');

	    $this->db->where_in('i.deleted', 0);
	    $this->db->group_start();
	    $this->db->like('i.item_code', $search);
	    $this->db->or_like('i.item_name', $search);
	    $this->db->or_like('b.title', $search);
	    $this->db->group_end();

	    $this->db->limit(7, 0);
 
	    $this->db->select('
	    	i.id, i.item_code, i.item_name, i.supplier_price, i.qty, i.picture_1, 
	        b.title as brand,
	        c.title as category,
	        t.title as type 
	    ');
	    $this->db->from('inventory as i');
	    $this->db->join('fm_item_brand b', 'b.id = i.item_brand_id', 'left');
	    $this->db->join('fm_item_category c', 'c.id = i.item_category_id', 'left');
	    $this->db->join('fm_item_type t', 't.id = i.item_type_id', 'left'); 
	    $items = $this->db->get()->result();

	    foreach ($items as $r) {
	        $json[] = [
	            'id' => $r->id,
	            'text' => $r->item_code . ' | ' . $r->item_name,
	            'item_code' => $r->item_code,
	            'item_name' => $r->item_name,
	            'supplier_price' => $r->supplier_price,
	            'image_url' => $r->picture_1,
	            'qty' => $r->qty,
	            'brand' => $r->brand,
	            'category' => $r->category,
	            'type' => $r->type
	        ];
	    }

	    print_r(json_encode($json));
	}

	public function save_po(){


		$po = $this->db->insert('purchase_order',[
			'date_created' => date('Y-m-d H:i'),
			'user_id' => $this->session->user_id,
			'po_number' => $this->input->post('po_number',TRUE), 
			'vehicle_id' => $this->input->post('vehicle_id',TRUE),
			'supplier_id' => $this->input->post('supplier_id',TRUE),
			'att_to' => $this->input->post('att_to',TRUE),
			'supplier_email' => $this->input->post('supplier_email',TRUE),
			'reference_no' => $this->input->post('ref_no',TRUE), 
			'description' => $this->input->post('description',TRUE),
			'less_desc' => $this->input->post('less_desc',TRUE),
			'less_amount' => $this->input->post('less_amount',TRUE),
			'terms_conditions' => @$this->input->post('terms_and_conditions'),
			'rate_id' => $this->input->post('rate_id',TRUE),
			'exchange_rate' => $this->input->post('exchange_rate',TRUE)
		]); 

		if($po){ 

			$po_id = $this->db->insert_id();

			if(@$this->input->post('items',TRUE)){
				foreach ($this->input->post('items',TRUE) as $key => $item_id) {

					  
					$inv_id = $this->input->post('inv_id'.$item_id,TRUE);
 
					$po = $this->db->insert('purchase_order_items',[
						'date_created' => date('Y-m-d H:i'),
						'user_id' => $this->session->user_id,
						'po_id' => $po_id,
						'item_code' => $this->input->post('item_code'.$item_id,TRUE),
						'item_name' => $this->input->post('item_name'.$item_id,TRUE),
						'qty' => $this->input->post('i_qty'.$item_id,TRUE),
						'price' => $this->input->post('i_unit_cost'.$item_id,TRUE),
						'inventory_quotation_id' => 0,
						'vehicle_id' => $this->input->post('vehicle_id',TRUE), 
						'inventory_id' => $item_id,
						'rate_id' => $this->input->post('rate_id',TRUE)
					]); 
				}
			}

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}
	    
		redirect("purchasing/view_po/".$po_id,"refresh");

	}

	public function add_new_item(){

		$module['i'] = $this->core->load_core_data('inventory','','id, item_code, item_name');

		$this->load->view('admin/purchasing/add_new_item',$module);

	}

	public function terms_and_conditions(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/terms_and_conditions";
		$module['map_link']   = "purchasing->terms_and_conditions";  
	  
		$module['tnc'] = $this->core->load_core_data('terms_and_conditions','','','type="po"');
	
		$this->load->view('admin/index',$module);

	}

	public function add_tnc(){

		$module['type'] = 'quotation';

		$this->load->view('admin/purchasing/add_tnc',$module);

	}

	public function edit_tnc($id){

		$module['type'] = 'quotation';

		$module['tnc'] = $this->core->load_core_data('terms_and_conditions',$id);

		$this->load->view('admin/purchasing/edit_tnc',$module);
		
	}

	public function save_tnc(){

		$q = $this->db->insert('terms_and_conditions',[
			'user_id' => $this->session->user_id,
			'date_created' => date('Y-m-d H:i'),
			'title' => $this->input->post('title',TRUE),
			'description' => $this->input->post('terms_and_conditions'),
			'type' => 'po'
		]);

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/terms_and_conditions","refresh");

	}

	public function update_tnc($id){

		$q = $this->db->where('id',$id)->update('terms_and_conditions',[
			'modified_by' => $this->session->user_id,
			'date_modified' => date('Y-m-d H:i'),
			'title' => $this->input->post('title',TRUE),
			'description' => $this->input->post('terms_and_conditions'),
			'type' => 'po'
		]);

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/terms_and_conditions","refresh");

	}

	public function delete_tnc($id){

		$q = $this->db->where('id',$id)->delete('terms_and_conditions');

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/terms_and_conditions","refresh");

	}

	public function edit_po($id){

		$module = $this->system_menu; 

		$module['module'] = "purchasing/edit_po";
		$module['map_link']   = "sales->quotations";   
  
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

		$this->load->view('admin/index',$module);

	}

	public function update_po($id){
  
		$po = $this->db->where('id',$id)->update('purchase_order',[
			'date_modified' => date('Y-m-d H:i'),
			'modified_by' => $this->session->user_id,
			'po_number' => $this->input->post('po_number',TRUE),
			'vehicle_id' => $this->input->post('vehicle_id',TRUE), 
			'supplier_id' => $this->input->post('supplier_id',TRUE),
			'att_to' => $this->input->post('att_to',TRUE),
			'supplier_email' => $this->input->post('supplier_email',TRUE),
			'reference_no' => $this->input->post('reference_no',TRUE),
			'description' => $this->input->post('description',TRUE),
			'less_desc' => $this->input->post('less_desc',TRUE),
			'less_amount' => $this->input->post('less_amount',TRUE), 
			'rate_id' => $this->input->post('rate_id',TRUE),
			'exchange_rate' => $this->input->post('exchange_rate',TRUE)
		]); 

		if($id){ 

			$po = $this->db->where('po_id',$id)->update('purchase_order_items',[ 
				'deleted' => 1,
				'date_deleted' => date('Y-m-d H:i'),
				'deleted_by' => $this->session->user_id
			]); 

			$po_id = $id;

			if(@$this->input->post('items',TRUE)){
				foreach ($this->input->post('items',TRUE) as $key => $item_id) {

					$poi = @$this->input->post('poi'.$item_id,TRUE);
					 
					if($poi){ //== already added use only for edit mode
 
						$po = $this->db->where('id',$poi)->update('purchase_order_items',[
							'date_modified' => date('Y-m-d H:i'),
							'modified_by' => $this->session->user_id,  
							'qty' => $this->input->post('i_qty'.$key,TRUE),
							'price' => $this->input->post('i_unit_cost'.$key,TRUE),
							'deleted' => 0,
							'date_deleted' => '',
							'deleted_by' => '',
							'rate_id' => $this->input->post('rate_id',TRUE)
						]); 

					}else{

						$po = $this->db->insert('purchase_order_items',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id,
							'po_id' => $po_id,
							'item_code' => $this->input->post('item_code'.$item_id,TRUE),
							'item_name' => $this->input->post('item_name'.$item_id,TRUE),
							'qty' => $this->input->post('i_qty'.$item_id,TRUE),
							'price' => $this->input->post('i_unit_cost'.$item_id,TRUE), 
							'vehicle_id' => $this->input->post('vehicle_id',TRUE), 
							'inventory_id' => $item_id,
							'rate_id' => $this->input->post('rate_id',TRUE)
						]); 
					}

					
				}
			}

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/edit_po/".$id,"refresh");

	}

	public function update_item_code_name(int $qid,int $id,int $poi_id){

		$item_code = $this->input->post('item_code',TRUE);
		$item_name = $this->input->post('item_name',TRUE);

		$extng = $this->db->select('id,item_code,item_name')->get_where('inventory_quotation',['item_code'=>$item_code,'quotation_id'=>$qid])->row();

		if(@$extng->id!=$id && @$extng->id && $item_code){
			echo 2;
		}elseif((!@$extng->id || @$extng->id==$id) && $item_code){
			if($item_code!=@$extng->item_code || $item_name!=@$extng->item_name){
				$this->db->where('id',$id)->update('inventory_quotation',[
					'item_code'=>$item_code,
					'item_name'=>$item_name
				]);

				if($poi_id>0){

					$this->db->where('id',$poi_id)->update('purchase_order_items',[
						'item_code'=>$item_code,
						'item_name'=>$item_name
					]);

				} 

				echo 1; 
			}else{
				echo 3; 
			} 
		}else{	
			echo 0;
		}

	}

	public function check_item_code_name(){

		$item_code = $this->input->post('item_code',TRUE); 

		$extng = $this->db->select('id,item_code')->get_where('inventory',['item_code'=>$item_code])->row();

		if(@$extng->id){
			echo 1; 
		}else{	
			echo 0;
		}

	}

	public function view_po($id,$confirm = 0){

		$module = $this->system_menu; 

		$module['module'] = "purchasing/view_po";
		$module['map_link']   = "sales->quotations";   
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];
		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers_po','','id,name');

		$module['po'] = $this->core->load_core_data('purchase_order',$id);

		$module['po_items'] = $this->core->load_core_data('purchase_order_items','','','po_id='.$id);

		$module['vehicles'] = $this->core->load_core_data('vehicles','','id,customer_id,manufacturer_id,plate_no');

		$module['customers'] = $this->core->load_core_data('clients','','id,name');
		
		$module['user'] = $this->core->load_core_data('account',$module['po']->user_id,'id,name');

		if($module['po']->confirmed==1){
			$module['user_confirmed'] = $this->core->load_core_data('account',$module['po']->confirmed_by); 
		}
		 
		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];

		$this->load->view('admin/index',$module);

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
		
		//$this->load->view('admin/purchasing/print_po',$module);
		//$this->export_to_pdf('admin/purchasing/print_po',$module);
		$this->export_to_excel('admin/purchasing/print_po',$module);
	}

	public function delete_po($id){

		$model = $this->core->global_query(3,'purchase_order', $id); 

		if($model['result']){ 

			$this->db->where('po_id',$id)->update('purchase_order_items',[
				'deleted'=>1,
				'deleted_by'=>$this->session->user_id,
				'date_deleted'=>date('Y-m-d H:i')
			]);
		
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/po_list","refresh");

	}

	public function confirmed_po(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/confirmed_po";
		$module['map_link']   = "sales->quotations";  
		
		$module['customers'] = $this->core->load_core_data('clients','','id,name');

		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];

		$module['vehicles'] = $this->core->load_core_data('vehicles','','id,customer_id,manufacturer_id,plate_no');
		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers_po','','id,name');

		$module['purchase_order'] = $this->core->load_core_data('purchase_order','','','confirmed=1');
		
		$this->load->view('admin/index',$module);

	}

	public function load_po_att_to($id){

		$s = $this->db->get_where('suppliers_po',['id'=>$id])->row();

		echo @$s->po_attension_to.'-x-'.@$s->email;

	}

	public function save_confirm_po($id){

		$cpo = $this->db->where('id',$id)->update('purchase_order',[
			'confirmed'=>1,
			'confirmed_by'=>$this->session->user_id,
			'date_confirmed'=>date('Y-m-d H:i')
		]);
		

		if($cpo){ 
 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/view_po/".$id,"refresh");

	}

	public function supplier_po(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "purchasing/suppliers_po";
		$module['map_link']   = "purchasing->suppliers_po";  
 
		$module['suppliers_po'] = $this->core->load_core_data('suppliers_po');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function add_supplier_po(){
  
		$this->load->view('admin/purchasing/supplier_po_add');

	}
 
	public function delete_supplier_po($id='')
	{
		$model = $this->core->global_query(3,'suppliers_po',$id); 

		if($model['result']){ 
			echo 1;
			//$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{
			echo 0;
			//$this->session->set_flashdata("error","error saving.");

		}
		die();
		//redirect("purchasing/supplier_po","refresh");
	}

	public function edit_supplier_po($id){

		$module['supplier'] = $this->core->load_core_data('suppliers_po', $id);
  
		$this->load->view('admin/purchasing/supplier_po_edit', $module);

	}

	public function view_supplier_po($id){

		$module['supplier'] = $this->core->load_core_data('suppliers_po', $id);
  
		$this->load->view('admin/purchasing/supplier_po_view', $module);

	}

	public function save_supplier_po()
	{
		$model = $this->core->global_query(1,'suppliers_po'); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/supplier_po","refresh");
	}

	public function update_supplier_po($id)
	{
		$model = $this->core->global_query(2,'suppliers_po', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("purchasing/supplier_po","refresh");
	}

	public function export_to_pdf($page, $data) {
        // Create a new instance of the Mpdf class
        $mpdf = new Mpdf();

        // Load the view file and get its output
        $html = $this->load->view($page, $data, true);

        // Add a page
        $mpdf->WriteHTML($html);

        // Set a password for the PDF (change 'password' to your desired password)
        $mpdf->SetProtection(array('print'), 'password', 'YourTitle', 128);

        // Output the PDF to the browser or save it to a file
        // Use 'I' to output to the browser or 'F' to save to a file
        //$mpdf->Output('exported.pdf', 'I'); // if direct preview

        $mpdf->Output('exported.pdf', 'D');  // if download
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