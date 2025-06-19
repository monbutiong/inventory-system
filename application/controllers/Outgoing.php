<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outgoing extends CI_Controller {


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

	public function create_issuance($id = ''){
	
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "outgoing/create_issuance";
		$module['map_link']   = "outgoing->create_issuance";   
 
		$module['vehicles'] = $this->core->load_core_data('vehicles');

		$module['clients'] = $this->core->load_core_data('clients','','id,name,customer_type,phone,qid,business_registration_no');  

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];
 

		if($id){
			$module['quotation'] = $this->core->load_core_data('issuance_quotation',$id);
	 		
	 		$this->db->where('issuance_quotation_id',$id);
			$this->db->select('
				i.id as id, 
				i.qty as qty, 
				i.retail_price as retail_price, 
				i.inventory_id as inventory_id, 
				inv.qty as qoh, 
				i.unit_cost_price as unit_cost_price,
				i.discount_percentage as discount_percentage, 
				i.discount_amount as discount_amount, 
				inv.item_code, 
				inv.item_name, 
				b.title as brand'); 
	        $this->db->from('issuance_quotation_items i');  
	        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
	        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
			$module['items'] = $this->db->get()->result(); 

			if($module['quotation']->vehicle_id){
				$module['vehicles'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
			}

			if($module['quotation']->customer_id){
				$module['clients'] = $this->core->load_core_data('clients',$module['quotation']->customer_id);  
			}

			$result = $this->admin_model->load_filemaintenance('fm_payment_type');
			$module['payment_type'] = $result['maintenance_data'];

			if($module['quotation']->vehicle_id){
				$module['vehicle'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
			}
			
		  
			$module['user'] = $this->core->load_core_data('account',$module['quotation']->user_id);
		}
		
		$this->load->view('admin/index',$module);

	}

	public function load_vehicles()
	{
	    $search = $this->input->post('searchTerm');
	    $id = $this->input->post('id'); // Support fetching by ID

	    $this->db->select('
	        vehicles.id,
	        vehicles.plate_no,
	        fm_models.model_year,
	        vehicles.picture_1 as image,
	        vehicles.vin as vin,
	        clients.id AS customer_id,
	        clients.name AS customer_name,
	        clients.customer_type AS customer_type,
	        clients.phone AS phone,
	        clients.qid AS qid,
	        clients.business_registration_no AS business_registration_no,
	        fm_manufacturers.title AS manufacturer_title,
	        fm_models.title AS model_title
	    ');
	    $this->db->from('vehicles');
	    $this->db->join('clients', 'clients.id = vehicles.customer_id', 'left');
	    $this->db->join('fm_manufacturers', 'fm_manufacturers.id = vehicles.manufacturer_id', 'left');
	    $this->db->join('fm_models', 'fm_models.id = vehicles.vehicle_model_id', 'left');
	    $this->db->where('vehicles.deleted', 0);

	    if (!empty($id)) {
	        $this->db->where('vehicles.id', $id);
	    } elseif (!empty($search)) {
	        $this->db->group_start();
	        $this->db->like('vehicles.plate_no', $search);
	        $this->db->or_like('vehicles.vin', $search);
	        $this->db->or_like('clients.name', $search);
	        $this->db->or_like('clients.phone', $search);
	        $this->db->or_like('clients.qid', $search);
	        $this->db->or_like('clients.business_registration_no', $search);
	        $this->db->or_like('fm_manufacturers.title', $search);
	        $this->db->or_like('fm_models.title', $search);
	        $this->db->group_end();
	        
	    }
		$this->db->limit(5);
	    $this->db->order_by('vehicles.plate_no', 'ASC');
	    $query = $this->db->get()->result();

	    $results = [];
	    foreach ($query as $v) {
	        $results[] = [
	            'id'                  => $v->id,
	            'text'                => $v->plate_no,
	            'plate_no'            => $v->plate_no,
	            'vin'                 => $v->vin,
	            'manufacturer'        => $v->manufacturer_title,
	            'model'               => $v->model_title,
	            'model_year'          => $v->model_year,
	            'customer_id'         => $v->customer_id,
	            'customer'            => $v->customer_name,
	            'phone'               => $v->phone,
	            'customer_type'       => $v->customer_type ? 1 : 0,
	            'customer_type_label' => $v->customer_type == 1 ? 'QID' : 'Business Reg #',
	            'customer_qid_bus'    => $v->customer_type == 1 ? $v->business_registration_no : $v->qid,
	            'image'               => !empty($v->image)
	                ? base_url('assets/uploads/vehicles/' . $v->image)
	                : base_url('assets/images/no-image.png')
	        ];
	    }



	    echo json_encode($results);
	}

	public function load_so($id)
	{
		$data = $this->core->load_core_data('issuance',$id);
		$cus = $this->core->load_core_data('clients',$data->customer_id);
		$data->customer = @$cus->name ? $cus->name : 'none';
		echo json_encode($data);
		die();
	}

	public function load_customers()
	{
	    $search = $this->input->post('searchTerm');

	    $this->db->select('
	        clients.id,
	        clients.name,
	        clients.phone,
	        clients.customer_type,
	        clients.qid,
	        clients.business_registration_no 
	    ');
	    $this->db->from('clients');
	    $this->db->where('deleted', 0);

	    if (!empty($search)) {
	        $this->db->group_start();
	        $this->db->like('clients.name', $search);
	        $this->db->or_like('clients.phone', $search);
	        $this->db->or_like('clients.qid', $search);
	        $this->db->or_like('clients.business_registration_no', $search);
	        $this->db->group_end();
	    }

	    $this->db->order_by('clients.name', 'ASC');
	    $this->db->limit(20);

	    $query = $this->db->get()->result();

	    $results = [];
	    foreach ($query as $c) {
	        $results[] = [
	            'id'            => $c->id,
	            'text'          => $c->name,
	            'phone'         => $c->phone,
	            'qid'           => $c->qid,
	            'business_registration_no'  => $c->business_registration_no,
	            'customer_type' => $c->customer_type == 1 ? 'business' : 'individual',
	            'image'         => file_exists('./assets/images/clients/logo-'.$c->id.'.png') ? base_url('assets/images/clients/logo-'.$c->id.'.png?'.time()) : base_url('assets/images/no-image.png')
	        ];
	    }

	    echo json_encode($results);
	}

 
	public function load_items(){
		
		$json = [];

		// Check if specific IDs are passed (single or multiple)
		$ids = $this->input->post('id', TRUE);  // can be a single id or array or CSV string

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
		    $this->db->where_in('a.id', $ids);
		    $this->db->select('a.id, a.item_code, a.item_name, a.supplier_price, a.qty, a.picture_1, b.title as brand, a.unit_cost_price, a.retail_price');
		    $this->db->from('inventory as a');
		    $this->db->join('fm_item_brand as b', 'b.id = a.item_brand_id', 'left');
		    $items = $this->db->get()->result();

		    foreach ($items as $r) {
		        $json[] = [
		            'id' => $r->id,
		            'text' => $r->item_code . ' | ' . $r->item_name,
		            'item_code' => $r->item_code,
		            'item_name' => $r->item_name, 
		            'image_url' => $r->picture_1, 
		            'unit_cost_price' => round($r->unit_cost_price,2),
		            'supplier_price' => round($r->supplier_price,2), 
		            'retail_price' => round($r->retail_price,2),
		            'qty' => $r->qty,
		            'brand' => $r->brand,
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
		            $excluded_id .= ' AND a.id != ' . $id;
		        }
		    }
		}

		if ($excluded_id) {
		    $excluded_id = '(' . $excluded_id . ')';
		    $excluded_id = str_replace('( AND', '(', $excluded_id);
		    $this->db->where($excluded_id);
		}

		$search = $this->input->post('searchTerm');

		$this->db->group_start();
		$this->db->like('a.item_code', $search);
		$this->db->or_like('a.item_name', $search);
		$this->db->or_like('b.title', $search);
		$this->db->group_end();

		$this->db->limit(7, 0);

		$this->db->where_in('id', $ids);
		$this->db->select('a.id, a.item_code, a.item_name, a.supplier_price, a.qty, a.picture_1, b.title as brand, a.unit_cost_price, a.retail_price');
		$this->db->from('inventory as a');
		$this->db->join('fm_item_brand as b', 'b.id = a.item_brand_id', 'left');
		$items = $this->db->get()->result();

		foreach ($items as $r) {
		    $json[] = [
		        'id' => $r->id,
		        'text' => $r->item_code . ' | ' . $r->item_name,
		        'item_code' => $r->item_code,
		        'item_name' => $r->item_name,
		        'unit_cost_price' => $r->unit_cost_price,
		        'supplier_price' => $r->supplier_price, 
		        'retail_price' => $r->retail_price,
		        'image_url' => $r->picture_1,
		        'qty' => $r->qty,
		        'brand' => $r->brand,
		    ];
		}

		print_r(json_encode($json));

	}


	public function load_so_items(){
		
		$json = [];

		// Check if specific IDs are passed (single or multiple)
		$so_id = $this->input->post('so_id', TRUE);  // can be a single id or array or CSV string

		$is_new = $this->input->post('is_new', TRUE);
 
		// Continue with original logic if no ids requested

		$excluded_id = '';

		if ($this->input->post('excluded_ids', TRUE)) {
		    foreach (explode('-', $this->input->post('excluded_ids', TRUE)) as $id) {
		        if ($id) {
		            $excluded_id .= ' AND a.id != ' . $id;
		        }
		    }
		}

		if ($excluded_id) {
		    $excluded_id = '(' . $excluded_id . ')';
		    $excluded_id = str_replace('( AND', '(', $excluded_id);
		    $this->db->where($excluded_id);
		}

		$search = $this->input->post('searchTerm');

		$this->db->group_start();
		$this->db->like('a.item_code', $search);
		$this->db->or_like('a.item_name', $search);
		$this->db->or_like('b.title', $search);
		$this->db->group_end();

		$this->db->limit(7, 0);

		$this->db->where('issuance_id', $so_id);
		$this->db->select('
			a.id, 
			a.item_code, 
			a.item_name, 
			a.supplier_price, 
			a.qty, 
			a.picture_1, 
			b.title as brand, 
			a.unit_cost_price, 
			i.retail_price as retail_price,  
			i.qty as so_qty,
			a.qty as inv_stock,
			i.discount_percentage as discount_percentage,
			i.discount_amount as discount_amount');
		$this->db->from('issuance_items as i');
		$this->db->join('inventory as a', 'a.id = i.inventory_id', 'left');
		$this->db->join('fm_item_brand as b', 'b.id = a.item_brand_id', 'left');
		$items = $this->db->get()->result();

		foreach ($items as $r) {
		    $json[] = [
		        'id' => $r->id,
		        'text' => $r->item_code . ' | ' . $r->item_name,
		        'item_code' => $r->item_code,
		        'item_name' => $r->item_name,
		        'unit_cost_price' => $r->unit_cost_price,
		        'supplier_price' => $r->supplier_price, 
		        'retail_price' => $r->retail_price,
		        'image_url' => $r->picture_1,
		        'qty' => $r->so_qty,
		        'inv_stock' => $r->inv_stock,
		        'brand' => $r->brand,
		        'discount_percentage'=> $r->discount_percentage,
		        'discount_amount'=> $r->discount_amount
		    ];
		}

		print_r(json_encode($json));

	}

	public function add_vehicle(){
 	 
 		$result = $this->admin_model->load_filemaintenance('fm_models');
 		$module['models'] = $result['maintenance_data'];
 		
 		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
 		$module['manufacturers'] = $result['maintenance_data'];

 		$module['customers'] = $this->core->load_core_data('clients');
		
		$this->load->view('admin/outgoing/add_vehicle',$module);

	}

	public function save_vehicle() { 

		if($this->input->post('new_customer_name',TRUE)){
			$name = trim($this->input->post('new_customer_name',TRUE));
			$e = $this->db->select('id')->get_where('clients',['name'=>$name,'deleted'=>0])->row();
			if(@$e->id){
				$_POST['customer_id'] = $e->id;
			}else{ 
				$this->db->insert('clients',['name'=>$name,'qid'=>$this->input->post('new_customer_qid',TRUE)]);
				$_POST['customer_id'] = $this->db->insert_id();
			}
		}

	    $model = $this->core->global_query(1, 'vehicles');

	    if ($model) {
	        $pid = $model['query_id'];

	        $targetDir = "./assets/uploads/vehicles/";
	        if (!file_exists($targetDir)) {
	            mkdir($targetDir, 0755, true);
	        }

	        $this->load->library('image_lib');
	        $this->load->helper('string');

	        for ($pic_count = 1; $pic_count <= 3; $pic_count++) {
	            $field_name = 'picture_' . $pic_count;

	            if (!empty($_FILES[$field_name]['name'])) {
	                $fileTmp = $_FILES[$field_name]['tmp_name'];
	                $fileExt = pathinfo($_FILES[$field_name]['name'], PATHINFO_EXTENSION);
	                $random = random_string('alnum', 20) . '.' . strtolower($fileExt);
	                $fullPath = $targetDir . $random;

	                if (move_uploaded_file($fileTmp, $fullPath)) {
	                    $config['image_library']  = 'gd2';
	                    $config['source_image']   = $fullPath;
	                    $config['maintain_ratio'] = TRUE;
	                    $config['width']          = 800;
	                    $config['height']         = 600;
	                    $config['new_image']      = $fullPath;

	                    $this->image_lib->initialize($config);
	                    if (!$this->image_lib->resize()) {
	                        log_message('error', 'Image resize failed: ' . $this->image_lib->display_errors());
	                    }
	                    $this->image_lib->clear();

	                    $this->db->where('id', $pid)->update('vehicles', [
	                        $field_name => $random
	                    ]);
	                }
	            }
	        }

	        echo @$pid;
	        //$this->session->set_flashdata("success", $this->system_menu['clang']["successfuly saved."] ?? "Successfully saved.");
	    } else {
	        echo 0;
	        //$this->session->set_flashdata("error", "Error saving.");
	    }

	    die();
	}

	public function add_customer($value='')
	{
		$module['clients_code'] = count($this->core->load_core_data('clients','','id','code LIKE "%CNO%"'))+1;

		$this->load->view('admin/outgoing/add_customer',$module);
	}

	public function save_customer()
	{
		$model = $this->core->global_query(1,'clients'); 

 		if($_FILES["logo"]){
			move_uploaded_file($_FILES["logo"]["tmp_name"], './assets/images/clients/logo-'.$model['query_id'].'.png');
		} 
		
		if($model['result']){ 
			 
			echo 1; 	
			//$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			echo 0;
			//$this->session->set_flashdata("error","error saving.");

		}

		die();
		//redirect("crm/clients","refresh");
		 
	}

	public function load_client(int $id){  
		$q = $this->db->get_where('quotations',['project_id'=>$id])->row(); 
		$c = $this->db->get_where('clients',['id'=>@$q->client_id])->row();
		echo @$c->id.'-'.@$c->name;
	}

	public function save_issuance($qid = ''){

		if(@$this->input->post('items',TRUE)){
		 			
 			if($this->input->post('vehicle_id',TRUE)){
 				$vh = $this->db->select('customer_id')->get_where('vehicles',['id'=>$this->input->post('vehicle_id',TRUE)])->row();
 				$_POST['customer_id'] = @$vh->customer_id;
 			}

			$result = $this->core->global_query(1,'issuance','',[
				'confirmed' => 0,
				'quotation_id'=> $qid 
			]); 
 

			if($result['result']){ 

				$qid = $result['query_id']; 
 				
 				$vehicle_id = @$this->input->post('vehicle_id',TRUE);
 				$customer_id = @$this->input->post('customer_id',TRUE);

		    	foreach ($this->input->post('items',TRUE) as $iid => $val) {
	 
		    		if($this->input->post('qty'.$iid,TRUE) > 0 && $this->input->post('discount_amount'.$iid,TRUE)<=($this->input->post('qty'.$iid,TRUE)*$this->input->post('retail_price'.$iid,TRUE))){

		    			$inventory_id = $this->input->post('inventory_id'.$iid,TRUE); 

	    				$has = 1;
	    				
				    	$this->db->insert('issuance_items',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id, 
							'issuance_id' => $qid,   
							'vehicle_id' => $vehicle_id,
							'customer_id' => $customer_id,
							'qoh' => $this->input->post('qoh'.$iid,TRUE),
							'qty' => $this->input->post('qty'.$iid,TRUE),
							'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
							'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
							'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
							'inventory_id' => $inventory_id,
							'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
							'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
						]); 
	  
					}

				}

			}

		}

		if(@$has == 1){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		redirect("outgoing/view_issuance/".$qid,"refresh");
	}

	public function view_issuance($id){
	
		$module = $this->system_menu;
  
		$module['module'] = "outgoing/view_issuance";
		$module['map_link']   = "outgoing->view_issuance";   
	
		$module['issuance'] = $this->core->load_core_data('issuance',$id);
 		
 		$this->db->where('issuance_id',$id);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['issuance']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		 
		if($module['issuance']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['issuance']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['issuance']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['issuance']->user_id);

		if($module['issuance']->confirmed_by){
			$module['user_confirmed'] = $this->core->load_core_data('account',$module['issuance']->confirmed_by);
		}
		
		$this->load->view('admin/index',$module);

	}


	public function edit_issuance($id){
	
		$module = $this->system_menu;
  
		$module['module'] = "outgoing/edit_issuance";
		$module['map_link']   = "outgoing->edit_issuance";   
	
		$module['issuance'] = $this->core->load_core_data('issuance',$id);
 		
 		$this->db->where('issuance_id',$id);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['issuance']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		 
		if($module['issuance']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['issuance']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['issuance']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['issuance']->user_id);
		
		$this->load->view('admin/index',$module);

	}


	public function create_quotation(){
	
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "outgoing/create_quotation";
		$module['map_link']   = "outgoing->create_quotation";   
 
		 
		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		$module['vehicles'] = $this->core->load_core_data('vehicles');
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];

		$module['customers'] = $this->core->load_core_data('clients');
		
		$this->load->view('admin/index',$module);

	}

	public function save_quotation(){

		if(@$this->input->post('items',TRUE)){
 			
 			if($this->input->post('vehicle_id',TRUE)){
 				$vh = $this->db->select('customer_id')->get_where('vehicles',['id'=>$this->input->post('vehicle_id',TRUE)])->row();
 				$_POST['customer_id'] = @$vh->customer_id;
 			}

			$result = $this->core->global_query(1,'issuance_quotation','',[
				'confirmed' => 1 
			]); 
 

			if($result['result']){ 

				$qid = $result['query_id']; 
 				
 				$vehicle_id = @$this->input->post('vehicle_id',TRUE);
 				$customer_id = @$this->input->post('customer_id',TRUE);

		    	foreach ($this->input->post('items',TRUE) as $iid => $val) {
	 
		    		if($this->input->post('qty'.$iid,TRUE) > 0 && $this->input->post('discount_amount'.$iid,TRUE)<=($this->input->post('qty'.$iid,TRUE)*$this->input->post('retail_price'.$iid,TRUE))){

		    			$inventory_id = $this->input->post('inventory_id'.$iid,TRUE); 

	    				$has = 1;
	    				
				    	$this->db->insert('issuance_quotation_items',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id, 
							'issuance_quotation_id' => $qid,   
							'vehicle_id' => $vehicle_id,
							'customer_id' => $customer_id,
							'qoh' => $this->input->post('qoh'.$iid,TRUE),
							'qty' => $this->input->post('qty'.$iid,TRUE),
							'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
							'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
							'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
							'inventory_id' => $inventory_id,
							'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
							'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
						]); 
	  
					}

				}

			}

		}

		if(@$has == 1){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		//redirect("outgoing/quotation_list","refresh");
		redirect("outgoing/view_quotation/".$qid,"refresh");	
	}

	public function quotation_list($value='')
	{
		$module = $this->system_menu; 

		$module['module'] = "outgoing/quotation_list";
		$module['map_link']   = "outgoing->quotation_list";    
		
		$this->load->view('admin/index',$module);
	}

	public function quotations_ajax($modal = '')
	{
	    // Get DataTables parameters
	    $start = $this->input->get('start');
	    $length = $this->input->get('length');
	    $search = $this->input->get('search')['value'];

	    // Count total records
	    $this->db->from('issuance_quotation');
	    $recordsTotal = $this->db->count_all_results();

	    // Main query with joins
	    $this->db->select('q.*, q.id as id, c.name AS client_name, a.name AS account_name');
	    $this->db->from('issuance_quotation q');
	    $this->db->join('clients c', 'q.customer_id = c.id', 'left');
	    $this->db->join('account a', 'q.user_id = a.id', 'left');

	    // Apply search filter if any
	    if (!empty($search)) {
	        $this->db->group_start();
	        $this->db->like('q.plate_no', $search);
	        $this->db->or_like('q.vin', $search);
	        $this->db->or_like('c.name', $search);
	        $this->db->or_like('q.phone', $search);
	        $this->db->or_like('q.remarks', $search);
	        $this->db->or_like("CONCAT('QO', LPAD(q.id, 6, '0'))", $search);
	        $this->db->group_end();
	    }
	    $this->db->where('q.deleted', 0);

	    $recordsFiltered = $this->db->count_all_results('', false); // for filtered count

	    // Apply limit and offset
	    $this->db->order_by('q.id', 'DESC');
	    $this->db->limit($length, $start);
	    $query = $this->db->get();
	    $quotations = $query->result();

	    $data = [];
	    foreach ($quotations as $q) {
	        $qn = 'QO' . sprintf("%06d", $q->id);

	        if($modal){
	        	$option = '
	                <a href="Javascript:select_quotatation(' . $q->id . ');"   >
	                    <i class="fa fa-download"></i> Select
	                </a> | 
	                <a  href="Javascript:print_quo('.$q->id.')">
	                    <i class="fa fa-print"></i> Print
	                </a>
	                ';
	        }else{
	        	$option = '
	                <a href="' . base_url('outgoing/view_quotation/' . $q->id) . '"   >
	                    <i class="fa fa-eye"></i> View
	                </a> | 
	                <a href="' . base_url('outgoing/edit_quotation/' . $q->id) . '">
	                    <i class="fa fa-edit"></i> Edit
	                </a> | 
	                <a href="javascript:prompt_delete(\'Delete\', \'Delete Quotation # ' . $qn . '?\', \'' . base_url('outgoing/delete_quotation/' . $q->id) . '\', \'tr' . $q->id . '\')">
	                    <i class="fa fa-trash"></i> Delete
	                </a> | 
	                <a href="Javascript:print_quo('.$q->id.')">
	                    <i class="fa fa-print"></i> Print
	                </a>'; 
	        }

	        $data[] = [
	        	'id'=>$q->id,
	            'date_created' => date('M d, Y', strtotime($q->date_created)),
	            'valid_until' => $q->valid_until ? date('M d, Y', strtotime($q->valid_until)) : '',
	            'quotation_no' => $qn,
	            'plate_no' => $q->plate_no,
	            'vin' => $q->vin,
	            'client_name' => @$q->client_name,
	            'phone' => $q->phone,
	            'remarks' => $q->remarks,
	            'created_by' => $q->account_name,
	            'options' => $option
	        ];
	    }

	    // Return JSON in DataTables format
	    echo json_encode([
	        'draw' => intval($this->input->get('draw')),
	        'recordsTotal' => $recordsTotal,
	        'recordsFiltered' => $recordsFiltered,
	        'data' => $data
	    ]);
	}


	public function issuance_ajax($confirmed = '')
	{
	    // Get DataTables parameters
	    $start = $this->input->get('start');
	    $length = $this->input->get('length');
	    $search = $this->input->get('search')['value'];

	    // Count total records
	    $this->db->from('issuance');
	    $recordsTotal = $this->db->count_all_results();

	    // Main query with joins
	    $this->db->select("q.*, 
	    	q.id as id,  
	    	c.name AS client_name, 
	    	a.name AS account_name,
	    	b.name AS confirmed_account_name,
	    	e.title as pay_type");
	    $this->db->from('issuance q');
	    $this->db->join('clients c', 'q.customer_id = c.id', 'left');
	    $this->db->join('account a', 'q.user_id = a.id', 'left');
	    $this->db->join('account b', 'q.confirmed_by = b.id', 'left');
	    $this->db->join('fm_payment_type e', 'q.pay_type_id = e.id', 'left');

	    // Apply search filter if any
	    if (!empty($search)) {
	        $this->db->group_start();
	        $this->db->like('q.plate_no', $search);
	        $this->db->or_like('q.vin', $search);
	        $this->db->or_like('e.title', $search);
	        $this->db->or_like('c.name', $search);
	        $this->db->or_like('q.phone', $search);
	        $this->db->or_like('q.remarks', $search);
	        $this->db->or_like("CONCAT('SO', LPAD(q.id, 6, '0'))", $search);
	        $this->db->group_end();
	    }
	    $this->db->where('q.deleted', 0);
	    if($confirmed){
	    	$this->db->where('q.confirmed', 1);
	    }else{
	    	$this->db->where('q.confirmed', 0);
	    }

	    $recordsFiltered = $this->db->count_all_results('', false); // for filtered count

	    // Apply limit and offset
	    $this->db->order_by('q.id', 'DESC');
	    $this->db->limit($length, $start);
	    $query = $this->db->get();
	    $quotations = $query->result();

	    $data = [];
	    foreach ($quotations as $q) {
	        $qn = 'SO' . sprintf("%06d", $q->id);

	        if($confirmed){
	        	$option = ' 
	                <a href="Javascript:print_so(' . $q->id . ')">
	                    <i class="fa fa-print"></i> Print
	                </a>
	                ';
	        }else{
	        	$option = '
	                <a href="' . base_url('outgoing/view_issuance/' . $q->id) . '"   >
	                    <i class="fa fa-eye"></i> View
	                </a> | 
	                <a href="' . base_url('outgoing/edit_issuance/' . $q->id) . '">
	                    <i class="fa fa-edit"></i> Edit
	                </a> | 
	                <a href="javascript:prompt_delete(\'Delete\', \'Delete Sales Order # ' . $qn . '?\', \'' . base_url('outgoing/delete_issuance/' . $q->id) . '\', \'tr' . $q->id . '\')">
	                    <i class="fa fa-trash"></i> Delete
	                </a> | 
	                <a href="Javascript:print_so(' . $q->id . ')">
	                    <i class="fa fa-print"></i> Print
	                </a>'; 
	        }

	        if($confirmed){

	        	$data[] = [
	        		'id'=>$q->id,
	        	    'date_created' => date('M d, Y', strtotime($q->date_created)),
	        	    'pay_type' => $q->pay_type,
	        	    'sales_order_no' => $qn,
	        	    'plate_no' => $q->plate_no,
	        	    'vin' => $q->vin,
	        	    'client_name' => @$q->client_name,
	        	    'phone' => $q->phone,
	        	    'remarks' => $q->remarks,
	        	    'created_by' => $q->account_name,
	        	    'confirmed_date' => date('M d, Y', strtotime($q->confirmed_date)),
	        	    'confirmed_by' => $q->confirmed_account_name,
	        	    'options' => $option
	        	];


	        }else{

	        	$data[] = [
	        		'id'=>$q->id,
	        	    'date_created' => date('M d, Y', strtotime($q->date_created)),
	        	    'pay_type' => $q->pay_type,
	        	    'sales_order_no' => $qn,
	        	    'plate_no' => $q->plate_no,
	        	    'vin' => $q->vin,
	        	    'client_name' => @$q->client_name,
	        	    'phone' => $q->phone,
	        	    'remarks' => $q->remarks,
	        	    'created_by' => $q->account_name,
	        	    'options' => $option
	        	];

	        } 
	    }

	    // Return JSON in DataTables format
	    echo json_encode([
	        'draw' => intval($this->input->get('draw')),
	        'recordsTotal' => $recordsTotal,
	        'recordsFiltered' => $recordsFiltered,
	        'data' => $data
	    ]);
	}

	public function delete_quotation(int $id)
	{
		$model = $this->core->global_query(3,'issuance_quotation', $id); 

		if($model['result']){ 

			$this->db->where('issuance_quotation_id',$id)->update('issuance_quotation_items',[
				'deleted'=>1,
				'deleted_by'=>$this->session->user_id,
				'date_deleted'=>date('Y-m-d H:i')
			]);
			
			echo 1;
			//$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			echo 0;
			//$this->session->set_flashdata("error","error saving.");

		}

		die();
	}


	public function edit_quotation($id){
	
		$module = $this->system_menu;
  
		$module['module'] = "outgoing/edit_quotation";
		$module['map_link']   = "outgoing->edit_quotation";   
	
		$module['quotation'] = $this->core->load_core_data('issuance_quotation',$id);
 		
 		$this->db->where('issuance_quotation_id',$id);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_quotation_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['quotation']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		 
		if($module['quotation']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['quotation']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['quotation']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['quotation']->user_id);
		
		$this->load->view('admin/index',$module);

	}

	public function update_quotation(int $qid){

		if(@$this->input->post('items',TRUE)){
 			
 			if($this->input->post('vehicle_id',TRUE)){
 				$vh = $this->db->select('customer_id')->get_where('vehicles',['id'=>$this->input->post('vehicle_id',TRUE)])->row();
 				$_POST['customer_id'] = @$vh->customer_id;
 			}

			$result = $this->core->global_query(2,'issuance_quotation',$qid); 
  
			if($result['result']){ 
  
				$this->db->where('issuance_quotation_id',$qid)->update('issuance_quotation_items',[
					'deleted'=>1,
					'date_deleted'=>date("Y-m-d"),
					'deleted_by'=>$this->session->user_id
				]);
 				
 				$vehicle_id = @$this->input->post('vehicle_id',TRUE);
 				$customer_id = @$this->input->post('customer_id',TRUE);

		    	foreach ($this->input->post('items',TRUE) as $iid => $val) {
	 
		    		if($this->input->post('qty'.$iid,TRUE) > 0 && $this->input->post('discount_amount'.$iid,TRUE)<=($this->input->post('qty'.$iid,TRUE)*$this->input->post('retail_price'.$iid,TRUE))){

		    			$inventory_id = $this->input->post('inventory_id'.$iid,TRUE); 

	    				$has = 1;

	    				if(@$this->input->post('ex_inventory_id'.$iid,TRUE)){

	    					$tid = $this->input->post('ex_inventory_id'.$iid,TRUE);

					    	$this->db->where('id',$tid)->update('issuance_quotation_items',[
								'deleted'=>0,
								'date_deleted'=>null,
								'deleted_by'=>null,  
								'vehicle_id' => $vehicle_id,
								'customer_id' => $customer_id,
								'qoh' => $this->input->post('qoh'.$iid,TRUE),
								'qty' => $this->input->post('qty'.$iid,TRUE),
								'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
								'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
								'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
								'inventory_id' => $inventory_id,
								'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
								'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
							]); 

	    				}else{
	    				
					    	$this->db->insert('issuance_quotation_items',[
								'date_created' => date('Y-m-d H:i'),
								'user_id' => $this->session->user_id, 
								'issuance_quotation_id' => $qid,   
								'vehicle_id' => $vehicle_id,
								'customer_id' => $customer_id,
								'qoh' => $this->input->post('qoh'.$iid,TRUE),
								'qty' => $this->input->post('qty'.$iid,TRUE),
								'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
								'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
								'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
								'inventory_id' => $inventory_id,
								'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
								'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
							]); 

					    }
	  
					}

				}

			}

		}

		if(@$has == 1){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		redirect("outgoing/edit_quotation/".$qid,"refresh");
		//redirect("outgoing/edit_quotation/".$qid,"refresh");	
	}


	public function update_issuance(int $qid){

		if(@$this->input->post('items',TRUE)){
 			
 			if($this->input->post('vehicle_id',TRUE)){
 				$vh = $this->db->select('customer_id')->get_where('vehicles',['id'=>$this->input->post('vehicle_id',TRUE)])->row();
 				$_POST['customer_id'] = @$vh->customer_id;
 			}

			$result = $this->core->global_query(2,'issuance',$qid); 
  
			if($result['result']){ 
  
				$this->db->where('issuance_id',$qid)->update('issuance_items',[
					'deleted'=>1,
					'date_deleted'=>date("Y-m-d"),
					'deleted_by'=>$this->session->user_id
				]);
 				
 				$vehicle_id = @$this->input->post('vehicle_id',TRUE);
 				$customer_id = @$this->input->post('customer_id',TRUE);

		    	foreach ($this->input->post('items',TRUE) as $iid => $val) {
	 
		    		if($this->input->post('qty'.$iid,TRUE) > 0 && $this->input->post('discount_amount'.$iid,TRUE)<=($this->input->post('qty'.$iid,TRUE)*$this->input->post('retail_price'.$iid,TRUE))){

		    			$inventory_id = $this->input->post('inventory_id'.$iid,TRUE); 

	    				$has = 1;

	    				if(@$this->input->post('ex_inventory_id'.$iid,TRUE)){

	    					$tid = $this->input->post('ex_inventory_id'.$iid,TRUE);

					    	$this->db->where('id',$tid)->update('issuance_items',[
								'deleted'=>0,
								'date_deleted'=>null,
								'deleted_by'=>null,  
								'vehicle_id' => $vehicle_id,
								'customer_id' => $customer_id,
								'qoh' => $this->input->post('qoh'.$iid,TRUE),
								'qty' => $this->input->post('qty'.$iid,TRUE),
								'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
								'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
								'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
								'inventory_id' => $inventory_id,
								'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
								'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
							]); 

	    				}else{
	    				
					    	$this->db->insert('issuance_items',[
								'date_created' => date('Y-m-d H:i'),
								'user_id' => $this->session->user_id, 
								'issuance_id' => $qid,   
								'vehicle_id' => $vehicle_id,
								'customer_id' => $customer_id,
								'qoh' => $this->input->post('qoh'.$iid,TRUE),
								'qty' => $this->input->post('qty'.$iid,TRUE),
								'unit_cost_price' => $this->input->post('unit_cost_price'.$iid,TRUE), 
								'supplier_price' => $this->input->post('supplier_price'.$iid,TRUE), 
								'retail_price' => $this->input->post('retail_price'.$iid,TRUE), 
								'inventory_id' => $inventory_id,
								'discount_percentage' => $this->input->post('discount_percentage'.$iid,TRUE),
								'discount_amount' => $this->input->post('discount_amount'.$iid,TRUE)
							]); 

					    }
	  
					}

				}

			}

		}

		if(@$has == 1){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		redirect("outgoing/edit_issuance/".$qid,"refresh");
		//redirect("outgoing/edit_quotation/".$qid,"refresh");	
	}


	public function view_quotation($id){
	
		$module = $this->system_menu;
  
		$module['module'] = "outgoing/view_quotation";
		$module['map_link']   = "outgoing->view_quotation";   
	
		$module['quotation'] = $this->core->load_core_data('issuance_quotation',$id);
 		
 		$this->db->where(['deleted'=>0,'issuance_quotation_id'=>$id]);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_quotation_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['quotation']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		 
		if($module['quotation']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['quotation']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['quotation']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['quotation']->user_id);
		
		$this->load->view('admin/index',$module);

	}

	public function print_quotation(int $id){

		$module['quotation'] = $this->core->load_core_data('issuance_quotation',$id);
 		
 		$this->db->where('issuance_quotation_id',$id);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_quotation_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['quotation']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		 
		if($module['quotation']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['quotation']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['quotation']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['quotation']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['quotation']->user_id);
		
		$this->load->view('admin/outgoing/print_quotation',$module);

	}

	public function print_issuance(int $id){

		$module = $this->system_menu;
		  
		$module['module'] = "outgoing/print_issuance";
		$module['map_link']   = "outgoing->print_issuance";   
	
		$module['issuance'] = $this->core->load_core_data('issuance',$id);
 		
 		$this->db->where('issuance_id',$id);
		$this->db->select('
			i.id as id, 
			i.qty as qty, 
			i.retail_price as retail_price, 
			i.inventory_id as inventory_id, 
			inv.qty as qoh, 
			i.unit_cost_price as unit_cost_price,
			i.discount_percentage as discount_percentage, 
			i.discount_amount as discount_amount, 
			inv.item_code, 
			inv.item_name, 
			b.title as brand'); 
        $this->db->from('issuance_items i');  
        $this->db->join('inventory inv', 'i.inventory_id=inv.id', 'left');
        $this->db->join('fm_item_brand b', 'inv.item_brand_id=b.id', 'left');  
		$module['items'] = $this->db->get()->result(); 

		if($module['issuance']->vehicle_id){
			$module['vehicles'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		 
		if($module['issuance']->customer_id){
			$module['clients'] = $this->core->load_core_data('clients',$module['issuance']->customer_id);  
		}

		$result = $this->admin_model->load_filemaintenance('fm_payment_type');
		$module['payment_type'] = $result['maintenance_data'];

		if($module['issuance']->vehicle_id){
			$module['vehicle'] = $this->core->load_core_data('vehicles',$module['issuance']->vehicle_id);
		}
		
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data']; 

		$module['user'] = $this->core->load_core_data('account',$module['issuance']->user_id);

		if($module['issuance']->confirmed_by){
			$module['user_confirmed'] = $this->core->load_core_data('account',$module['issuance']->confirmed_by);
		}

		$this->load->view('admin/outgoing/print_issuance',$module);

	}

	public function load_quotation_list()
	{
		$this->load->view('admin/outgoing/load_quotation_list');
	}

	public function issue_batch(){

		$module['projects'] = $this->core->load_core_data('projects');
		$module['suppliers'] = $this->core->load_core_data('suppliers');
		$module['purchase_order'] = $this->core->load_core_data('purchase_order','','','confirmed=1');
		
		$this->load->view('admin/outgoing/load_batch',$module);

	}

	public function load_search_items($project_id, $filter, $excluded_ids=''){

		$module['ex_ids'] = $excluded_ids;

		list($type,$filter_id) = explode('-',$filter);

		$excluded_id = '';

		if($excluded_ids){
			foreach(explode('-',$excluded_ids) as $id){
				$id = str_replace('(', '', $id);
				$id = str_replace(')', '', $id);
				if($id){
					$excluded_id.=' AND a.id!='.$id;
				}
			}
		}

		if(@$excluded_id){
			$excluded_id = '('.$excluded_id.')';
			$excluded_id = str_replace('( AND','(',$excluded_id);
		} 

		$this->db->where('a.deleted',0); 
		$this->db->where('e.confirmed',1); 
		
		if($project_id){
			$this->db->where('d.id',$project_id);
		}

		if($type == 'supp'){
			$this->db->where('e.id',$filter_id);
		}

		if($type == 'po'){
			$this->db->where('c.id',$filter_id);
		}
		
		
		if(@$excluded_id){
			//$this->db->where($excluded_id);
		}
 
		$this->db->select('a.*,
			b.item_code as item_code, 
			b.item_name as item_name, 
			c.po_number as po_number,
			d.name as project_name,
			e.dr_number as dr_number,
			e.invoice_number as invoice_number, 
			f.name as supplier_name, 
			e.currency as lcr,
			a.id as id,
			g.unit_cost_price as cost_price 
			');

        $this->db->from('receiving_items a'); 
        $this->db->join('purchase_order_items b', 'b.id=a.po_item_id', 'left');
        $this->db->join('purchase_order c', 'c.id=a.po_id', 'left');
        $this->db->join('projects d', 'd.id=a.project_id', 'left'); 
        $this->db->join('receiving e', 'e.id=a.receiving_id', 'left'); 
        $this->db->join('suppliers f', 'f.id=c.supplier_id', 'left'); 
        $this->db->join('inventory g', 'g.id=a.inventory_id', 'left');  

        $this->db->limit(100,0);

        $module['items'] = $this->db->get()->result();   

        if($module['items']){

        	foreach ($module['items'] as $rs) {
        		if(@!$rri_ids){
        			$rri_ids = 'receiving_item_id='.$rs->id;
        		}else{
        			$rri_ids.=' OR receiving_item_id='.$rs->id;
        		}
        		
        	}
        	if($rri_ids){
        		$rri_ids = '('.$rri_ids.')';
        		$module['iii'] = $this->core->load_core_data('issuance_items','','',$rri_ids);
        	} 
        }

        $this->load->view('admin/outgoing/load_search_items',$module);

	}

	public function issuance_records(){
	
		$module = $this->system_menu; 

		$module['module'] = "outgoing/issuance_records";
		$module['map_link']   = "outgoing->issuance_records";   

		$module['issuances'] = $this->core->load_core_data('issuance','','','confirmed=1'); 
		$module['users'] = $this->core->load_core_data('account','','id,name'); 
  
		$this->load->view('admin/index',$module);

	}

	public function edit_ii(int $id){

		$module = $this->system_menu;
  
		$module['module'] = "outgoing/edit_ii";
		$module['map_link']   = "outgoing->edit_ii";   
		
		$module['ii'] = $this->core->load_core_data('issuance',$id);
		
		$module['user'] = $this->core->load_core_data('account',$module['ii']->user_id);  

		$module['project'] = $this->core->load_core_data('projects',$module['ii']->project_id); 

		$module['client'] = $this->core->load_core_data('clients',$module['ii']->client_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',$module['ii']->confirmed_by); 

		$module['jo'] = $this->core->load_core_data('projects_job_order',$module['ii']->job_order_id,'id,job_order_number,project_id,client_id,quotation_id','',1); 
	 
		$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id,'id,quotation_number','',1); 

		$module['inv'] = $this->core->load_core_data('inventory','','id,qty');
 
		$this->db->where('issuance_id',$module['ii']->id);
		$this->db->where('a.deleted',0);
		$this->db->select('a.*,
			a.id as iii_id,
			b.id as inventory_id,
			b.item_code as item_code, 
			b.item_name as item_name,  
			d.name as project_name 
			');

        $this->db->from('issuance_items a'); 
        $this->db->join('inventory b', 'b.id=a.inventory_id', 'left'); 
        $this->db->join('projects d', 'd.id=a.project_id', 'left');    

        $module['iii'] = $this->db->get()->result();   
		
		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$this->load->view('admin/index',$module);
	}

	 

	public function view_ii(int $id,$from_confirm=0){

		$module = $this->system_menu;
  
		$module['module'] = "outgoing/view_ii";
		$module['map_link']   = "outgoing->view_ii";   
		$module['confirm'] = $from_confirm;
		
		$module['ii'] = $this->core->load_core_data('issuance',$id);

		$module['jo'] = $this->core->load_core_data('projects_job_order',$module['ii']->job_order_id);

		$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id);
		
		$module['user'] = $this->core->load_core_data('account',$module['ii']->user_id);  

		$module['project'] = $this->core->load_core_data('projects',$module['ii']->project_id); 

		$module['client'] = $this->core->load_core_data('clients',$module['ii']->client_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',$module['ii']->confirmed_by);  

		 
		$this->db->where('a.issuance_id',$module['ii']->id);
		$this->db->where('a.deleted',0);
		$this->db->select('a.*,
			b.item_code as item_code, 
			b.item_name as item_name,  
			d.name as project_name 
			');

        $this->db->from('issuance_items a'); 
        $this->db->join('inventory b', 'b.id=a.inventory_id', 'left'); 
        $this->db->join('projects d', 'd.id=a.project_id', 'left');    

        $module['iii'] = $this->db->get()->result();   
		
		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$this->load->view('admin/outgoing/view_ii',$module);
	}

	public function print_ii(int $id){

		$module['ii'] = $this->core->load_core_data('issuance',$id);
 
		$module['user'] = $this->core->load_core_data('account',$module['ii']->user_id);  

		$module['project'] = $this->core->load_core_data('projects',$module['ii']->project_id); 

		$module['iii'] = $this->core->load_core_data('issuance_items','','','issuance_id='.$module['ii']->id);

		$module['jo'] = $this->core->load_core_data('projects_job_order',$module['ii']->job_order_id);

		$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id);

		$module['client'] = $this->core->load_core_data('clients',$module['jo']->client_id);

		if(@$module['iii']){
			foreach ($module['iii'] as $rs) {
				if(@$ids){
					$ids.=' OR id='.$rs->inventory_id;
				}else{
					$ids=' id='.$rs->inventory_id;
				}
				
			}
		}

		if(@$ids){
			$module['inv'] = $this->core->load_core_data('inventory','','',$ids);
		}
		
		
		$this->load->view('admin/outgoing/print_ii',$module);

	}

	public function confirm_issuance(int $id){

		$r = $this->db->where('id',$id)->update('issuance',[
			'confirmed_by' => $this->session->user_id,
			'confirmed_date' => date('Y-m-d H:i'), 
			'confirmed' => 1
		]); 

		$ii = $this->core->load_core_data('issuance',$id);
		$iii = $this->db
		    ->select('
		    	ii.id as id,
		        ii.inventory_id,
		        ii.qty,
		        ii.unit_cost_price AS item_cost,
		        ii.customer_id,
		        ii.vehicle_id,
		        inv.qty AS inv_qty,
		        inv.issuance_history,
		        inv.unit_cost_price AS unit_cost_price,
		        ii.retail_price,
		    ')
		    ->from('issuance_items ii')
		    ->join('inventory inv', 'inv.id = ii.inventory_id', 'left')
		    ->where('ii.issuance_id', $id)
		    ->where('ii.deleted', 0)
		    ->get()
		    ->result();

		$i_id = $id;

		foreach ($iii as $rs) { 

			$has = 1;
  
			
 
			$issuance_history = [];

			if(@$rs->issuance_history){
				$issuance_history = json_decode($rs->issuance_history);
			}
			 
			$issuance_history[] = [
				'ii_id' => $i_id,
				'date'=>date('Y-m-d H:i'),
				'qty' => ($rs->inv_qty - $rs->qty),
				'ucp' => @$rs->unit_cost_price
			]; 
			
			$this->db->where('id', $rs->inventory_id); 
			$this->db->update('inventory',[
				'old_qty' => $rs->inv_qty, 
				'qty' => ($rs->inv_qty - $rs->qty), 
				'issuance_history'=>json_encode($issuance_history)
			] );
  
			$this->db->insert('inventory_movement',[
				'date_created' => date('Y-m-d H:i'),
				'user_id' => $this->session->user_id,
				'inventory_id' => $rs->inventory_id, 
				'ref_id' => $id, 
				'issuance_item_id'=>$rs->id,
				'vehicle_id' => $rs->vehicle_id, 
				'customer_id' => $rs->customer_id,  
				'qty' => $rs->qty,
				'qty_before' => $rs->inv_qty,
				'qty_after' => ($rs->inv_qty - $rs->qty), 
				'movement_from' => 'sales order',
				'addition' => 0,
				'unit_cost_price' => $rs->unit_cost_price,
				'retail_price' => $rs->retail_price,
			]);

		}

		if(@$has==1){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		redirect("outgoing/view_issuance/".$id,"refresh");

	}

	public function confirm_issuance_records(){
	
		$module = $this->system_menu; 

		$module['module'] = "outgoing/confirm_issuance_records";
		$module['map_link']   = "outgoing->confirm_issuance_records";   
 
	 
		$this->load->view('admin/index',$module);

	}

	public function load_jo(int $id){

		$module['jo'] = $this->core->load_core_data('projects_job_order',$id);

		$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id);

		$module['project'] = $this->core->load_core_data('projects',$module['jo']->project_id);

		$module['client'] = $this->core->load_core_data('clients',$module['jo']->client_id);

		die( json_encode([
		'jo'=>	$module['jo'],
		'quotation'=>	$module['quotation'],
			'project'  =>	$module['project'],
			'client'   =>	$module['client'],
			'quotation_id' => $module['jo']->quotation_id
		]) );

	}

	public function load_issued_items($jo_id=''){
		
		$json = [];
		$excluded_id = '';

		if(@$this->input->post('excluded_ids',TRUE)){
			foreach(explode('-',$this->input->post('excluded_ids',TRUE)) as $id){
				$id = str_replace('(', '', $id);
				$id = str_replace(')', '', $id);
				if($id){
					$excluded_id.=' AND a.id!='.$id;
				}
			}
		}

		if($excluded_id){
			$excluded_id = '('.$excluded_id.')';
			$excluded_id = str_replace('( AND','(',$excluded_id);
		}

		$search = @$this->input->post('searchTerm');
		$key = @$this->input->post('key');
		$job_order_id = $jo_id ? $jo_id : @$this->input->post('job_order_id');
  
		$this->db->group_start();
		$this->db->like('b.item_code', $search); 
		$this->db->or_like('b.item_name', $search);
		$this->db->group_end();

		$this->db->where(['a.deleted'=>0,'a.job_order_id'=>$job_order_id]); 

		if(@$excluded_id){
			$this->db->where($excluded_id);
		} 

		$this->db->select('
			a.id as id, 
			b.id as inventory_id, 
			b.item_code, 
			b.item_name, 
			a.qty, 
			a.issuance_id,
			e.issued_date
		');
        $this->db->from('issuance_items a');   
        $this->db->join('inventory b', 'b.id=a.inventory_id', 'left');
        //$this->db->join('inventory_returns_items c', 'c.issuance_item_id=a.id', 'left');
        $this->db->join('issuance e', 'a.issuance_id=e.id', 'left');

        $this->db->limit(15,0);

        $query = $this->db->get()->result();   
  
		foreach($query as $r){
 
			$json[] = [
				 'id'=>$r->id, 
				 'text'=>'SO'.sprintf("%06d",$r->issuance_id).' | '.$r->item_code.' | '.$r->item_name.' | Issued Quantity: '.$r->qty.' | Date Issued: '.date('d M Y',strtotime($r->issued_date)),
				 'find'=>$search, 
				 'item_code'=>$r->item_code ? $r->item_code : 'n/a',  
				 'item_name'=>$r->item_name ? $r->item_name : 'n/a',  
				 'qty'=>$r->qty,
				 'inventory_id'=>$r->inventory_id,
				 'sales_order_number'=>'SO'.sprintf("%06d",$r->issuance_id),
				 'issued_date'=>date('d M Y',strtotime($r->issued_date)),
				 'issuance_id'=>$r->issuance_id
			];
		} 	

		echo json_encode($json);

	}

	public function load_quotation_package(int $quotation_id){

		$module['suppliers'] = $this->core->load_core_data('suppliers');

		$module['qlocations'] = $this->core->load_core_data('quotations_locations','','','quotation_id='.$quotation_id);

		$module['packages'] = $this->core->load_core_data('quotations_package','','','quotation_id='.$quotation_id);

		//$module['qitems'] = $this->core->load_core_data('quotations_items','','','quotation_id='.$quotation_id);


		$this->db->select('b.*,a.package_id'); // Select all fields from table 'b' (inventory)
		$this->db->from('quotations_items a');
		$this->db->join('inventory b', 'b.id=a.inventory_id', 'right');
		$this->db->where(['a.deleted' => 0, 'a.quotation_id' => $quotation_id]);
		$module['qitems'] = $this->db->get()->result();

		$this->load->view('admin/outgoing/quotation_packages',$module);

	}
	
}