<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {


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

	 
 

	public function masterlist(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "inventory/masterlist";
		$module['map_link']   = "inventory->masterlist";  
 
  
		$this->load->view('admin/index',$module);

	}

	public function get_inventory_ajax() {
	    $table = 'inventory i';

	    // Columns to order by (index matches DataTable column)
	    $column_order = ['i.picture_1', 'i.item_code', 'i.item_name', 'b.title', 'c.title', 't.title', 'i.qty', null, null, null];
	    $column_search = ['i.item_code', 'i.item_name'];
	    $order = ['i.item_name' => 'asc'];

	    $this->db->select('i.*, 
	        b.title as brand,
	        c.title as category,
	        t.title as type,
	        CONCAT(manu.title, " ", m.title, " - ", m.model_year) as primary_model
	    ');
	    $this->db->from($table);
	    $this->db->join('fm_item_brand b', 'b.id = i.item_brand_id', 'left');
	    $this->db->join('fm_item_category c', 'c.id = i.item_category_id', 'left');
	    $this->db->join('fm_item_type t', 't.id = i.item_type_id', 'left');
	    $this->db->join('fm_models m', 'm.id = i.primary_vehicle_model_id', 'left');
	    $this->db->join('fm_manufacturers manu', 'manu.id = m.manufacturer_id', 'left');

	    // Search filter
	    if (!empty($_POST['search']['value'])) {
	        $this->db->group_start();
	        foreach ($column_search as $i => $item) {
	            $method = $i == 0 ? 'like' : 'or_like';
	            $this->db->$method($item, $_POST['search']['value']);
	        }
	        $this->db->group_end();
	    }

	    // Ordering
	    if (isset($_POST['order'])) {
	        $col_index = $_POST['order']['0']['column'];
	        $col_dir = $_POST['order']['0']['dir'];
	        if (isset($column_order[$col_index])) {
	            $this->db->order_by($column_order[$col_index], $col_dir);
	        }
	    } else {
	        $this->db->order_by(key($order), $order[key($order)]);
	    }

	    // Paging
	    if ($_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }

	    $query = $this->db->get();
	    $data = [];
	    foreach ($query->result() as $rs) {
	        $item_image = $rs->picture_1 ? base_url('assets/uploads/inventory/' . $rs->picture_1) : base_url('assets/images/no-image.png');
	        $bin_location = trim($rs->bin_1 . ($rs->bin_2 ? ' | ' . $rs->bin_2 : '') . ($rs->bin_3 ? ' | ' . $rs->bin_3 : ''));

	        $data[] = [
	            'picture' => ($rs->picture_1 ? '<a href="' . base_url('inventory/view_item_images/'.$rs->id) . '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><img src="' . $item_image . '" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" /></a>' : '<img src="' . $item_image . '" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" />'),
	            'item_code' => $rs->item_code,
	            'item_name' => $rs->item_name,
	            'brand' => $rs->brand,
	            'category' => $rs->category,
	            'type' => $rs->type,
	            'qty' => $rs->qty,
	            'bin_location' => $bin_location,
	            'primary_model' => $rs->primary_model,
	            'options' => '
	                <a href="' . base_url('inventory/view_inventory/' . $rs->id) . '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><i class="fa fa-eye"></i> view</a> |
	                <a href="' . base_url('inventory/edit_inventory/' . $rs->id) . '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><i class="fa fa-edit"></i> edit</a> |
	                <a href="javascript:prompt(\'Delete\',\'Delete '.$rs->item_code.' item?\',\'' . base_url('inventory/delete_inventory/' . $rs->id) . '\')"><i class="fa fa-trash"></i> Delete</a> |
	                <a href="' . base_url('inventory/inventory_movement/' . $rs->id) . '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><i class="fa fa-edit"></i> movement</a>'

	        ];
	    }

	    // Count total
	    $this->db->reset_query();
	    $this->db->from($table);
	    $total_records = $this->db->count_all_results();

	    // Count filtered
	    $this->db->select('i.id');
	    $this->db->from($table);
	    $this->db->join('fm_item_brand b', 'b.id = i.item_brand_id', 'left');
	    $this->db->join('fm_item_category c', 'c.id = i.item_category_id', 'left');
	    $this->db->join('fm_item_type t', 't.id = i.item_type_id', 'left');
	    $this->db->join('fm_models m', 'm.id = i.primary_vehicle_model_id', 'left');
	    $this->db->join('fm_manufacturers manu', 'manu.id = m.manufacturer_id', 'left');
	    if (!empty($_POST['search']['value'])) {
	        $this->db->group_start();
	        foreach ($column_search as $i => $item) {
	            $method = $i == 0 ? 'like' : 'or_like';
	            $this->db->$method($item, $_POST['search']['value']);
	        }
	        $this->db->group_end();
	    }
	    $filtered_records = $this->db->count_all_results();

	    echo json_encode([
	        "draw" => intval($_POST['draw']),
	        "recordsTotal" => $total_records,
	        "recordsFiltered" => $filtered_records,
	        "data" => $data
	    ]);
	}

	public function view_item_images($id)
	{
		$module['item'] = $this->db->get_where('inventory', ['id' => $id])->row();

		$this->load->view('admin/inventory/view_item_images',$module);
	}

	public function delete_item_image($no, $id)
	{
		$item = $this->db->get_where('inventory', ['id' => $id])->row();

		$model = $this->core->global_query(2,'inventory', $id, ['picture_'.$no => null]); 

		if($model['result']){ 

			if(unlink('./assets/uploads/inventory/'.@$item->{'picture_'.$no})){ 
				 

				echo 1;  
				  
			}else{

				echo 0;

			}

		}else{

			echo 0;

		}

		die();
	}


	public function add_inventory(){

		$result = $this->admin_model->load_filemaintenance('fm_item_type');
		$module['item_types'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_item_category');
		$module['item_category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_item_brand');
		$module['item_brand'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
		
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];
  
		$this->load->view('admin/inventory/add_item',$module);

	}

	public function save_item(){

		$model = $this->core->global_query(1,'inventory'); 

		if($model['result']){ 

			$inv_id = $model['query_id'];

			$targetDir = "./assets/uploads/inventory/";
			if (!file_exists($targetDir)) {
			    mkdir($targetDir, 0755, true);
			} 

			$this->load->library('image_lib');
			$this->load->helper('string');

			for ($pic_count = 1; $pic_count <= 3; $pic_count++) {
			    $field_name = 'picture_' . $pic_count;

			    // Check if file exists and no upload error
			    if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
			        $fileTmp = $_FILES[$field_name]['tmp_name'];
			        $fileExt = pathinfo($_FILES[$field_name]['name'], PATHINFO_EXTENSION);
			        $random = random_string('alnum', 20) . '.' . strtolower($fileExt);
			        $fullPath = $targetDir . $random;

			        if (move_uploaded_file($fileTmp, $fullPath)) {
			            log_message('debug', 'File uploaded to: ' . $fullPath);

			            // Resize
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

			            // Save random filename to DB
			            $this->db->where('id', $inv_id)->update('inventory', [
			                $field_name => $random
			            ]);

			            $this->session->set_flashdata("error", "Saved to DB field `$field_name` with value `$random`");
			        } else {
			            log_message('error', "Failed to move uploaded file: $field_name");
			        }
			    }
			}


			$this->db->insert('inventory_movement',[
				'inventory_id'=>$model['query_id'],
				'movement_from'=>'new',
				'qty_before'=>0,
				'qty'=>$this->input->post('qty',TRUE),
				'qty_after'=>$this->input->post('qty',TRUE),
				'manufacturer_price'=>$this->input->post('manufacturer_price',TRUE),
				'user_id'=>$this->session->user_id,
				'date_created'=>date("Y-m-d H:i")
			]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/masterlist","refresh");

	}

	public function edit_inventory(int $id){

		$module['item'] = $this->db->get_where('inventory', ['id' => $id])->row();
	     
	    if (!$module['item']) {
	        show_404();
	        return;
	    }
 
	    // Load supporting dropdown data
	    $module['item_category'] = $this->db->get('fm_item_category')->result();
	    $module['item_types'] = $this->db->get('fm_item_type')->result();
	    $module['item_brand'] = $this->db->get('fm_item_brand')->result();

	    $module['manufacturers'] = $this->db->get('fm_manufacturers')->result();
	    $module['models'] = $this->db->get('fm_models')->result();
  
		$this->load->view('admin/inventory/edit_item',$module);

	}

	public function update_item(int $id){

		$model = $this->core->global_query(2,'inventory',$id); 

		if($model['result']){ 

			$inv_id = $id;

			$targetDir = "./assets/uploads/inventory/";
			if (!file_exists($targetDir)) {
			    mkdir($targetDir, 0755, true);
			} 

			$this->load->library('image_lib');
			$this->load->helper('string');

			for ($pic_count = 1; $pic_count <= 3; $pic_count++) {
			    $field_name = 'picture_' . $pic_count;

			    // Check if file exists and no upload error
			    if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
			        $fileTmp = $_FILES[$field_name]['tmp_name'];
			        $fileExt = pathinfo($_FILES[$field_name]['name'], PATHINFO_EXTENSION);
			        $random = random_string('alnum', 20) . '.' . strtolower($fileExt);
			        $fullPath = $targetDir . $random;

			        if (move_uploaded_file($fileTmp, $fullPath)) {
			            log_message('debug', 'File uploaded to: ' . $fullPath);

			            // Resize
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

			            // Save random filename to DB
			            $this->db->where('id', $inv_id)->update('inventory', [
			                $field_name => $random
			            ]);

			            $this->session->set_flashdata("error", "Saved to DB field `$field_name` with value `$random`");
			        } else {
			            log_message('error', "Failed to move uploaded file: $field_name");
			        }
			    }
			}

			$this->session->set_flashdata("success", $this->system_menu['clang'][$l = "successfuly saved."] ?? $l);

			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/masterlist","refresh");

	}

	public function view_inventory(int $id){

		$module['item'] = $this->db->get_where('inventory', ['id' => $id])->row();
	     
	    if (!$module['item']) {
	        show_404();
	        return;
	    }
	
	    // Load supporting dropdown data
	    $module['item_category'] = $this->db->get('fm_item_category')->result();
	    $module['item_types'] = $this->db->get('fm_item_type')->result();
	    $module['item_brand'] = $this->db->get('fm_item_brand')->result();

	    $module['manufacturers'] = $this->db->get('fm_manufacturers')->result();
	    $module['models'] = $this->db->get('fm_models')->result();
	 
		$this->load->view('admin/inventory/view_item',$module);

	}

	public function delete_item(int $id){

		$model = $this->core->global_query(3,'inventory',$id); 

		if($model['result']){ 
 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/masterlist","refresh");

	}

	public function check_item_code(){

		$item_code = $this->input->post('item_code',TRUE);

		$e_item_code = @$this->input->post('e_code',TRUE);

		$e = $this->db->select('id,item_code')->get_where('inventory',['item_code'=>$item_code])->row();

		if(@$e->id && strtolower($e_item_code) != strtolower(@$e->item_code)){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function inventory_movement(int $id){

		$module['mv'] = $this->core->load_core_data('inventory_movement','','','inventory_id='.$id);

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['vehicles'] = $this->core->load_core_data('vehicles');

		$module['inv'] = $this->core->load_core_data('inventory',$id);
		
		$this->load->view('admin/inventory/inventory_movement',$module);

	}

	//TRUNCATE `clients`; TRUNCATE `inventory`; TRUNCATE `inventory_movement`; TRUNCATE `issuance`; TRUNCATE `issuance_items`; TRUNCATE `projects`; TRUNCATE `projects_documents`; TRUNCATE `projects_job_order`; TRUNCATE `projects_job_order_labor`; TRUNCATE `projects_progress`; TRUNCATE `projects_recent`; TRUNCATE `purchase_order`; TRUNCATE `purchase_order_items`; TRUNCATE `quotations`; TRUNCATE `quotations_items`; TRUNCATE `quotations_landed_cost_rate`; TRUNCATE `quotations_legalization_fees`; TRUNCATE `quotations_locations`; TRUNCATE `quotations_others`; TRUNCATE `receiving`; TRUNCATE `receiving_fc`; TRUNCATE `receiving_items`; TRUNCATE `receiving_lc`; TRUNCATE `suppliers`; TRUNCATE `suppliers_po`;

	public function create_stock_adjustments(){
	
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "inventory/create_stock_adjustments";
		$module['map_link']   = "inventory->create_stock_adjustments";   
	
		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];
 
		$this->load->view('admin/index',$module);

	}

	public function save_adjustment(){

		$items = $this->input->post('items',TRUE);

		if($items){

			$r = $this->db->insert('inventory_adjustments',[
				'date_created' => date('Y-m-d H:i'),
				'user_id' => $this->session->user_id,
				'adjustment_type_id' => $this->input->post('adjustment_type_id',TRUE), 
				'covered_date' => $this->input->post('covered_date',TRUE), 
				'ref_no' => $this->input->post('ref_no',TRUE),  
				'remarks' => $this->input->post('remarks',TRUE),
				'confirmed' => 0 
			]); 

			$a_id = $this->db->insert_id();

			$targetDir = "./assets/uploads/adjustments/";
	 
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }
	 
		    foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name){
		       $file_name = $_FILES['attach']['name'][$key];
		       $file_tmp = $_FILES['attach']['tmp_name'][$key];
	 			
	 		   $fname = $a_id. '_'. uniqid() . '_' . $file_name;		
	 
	           $newFileName = $targetDir . $fname;

	           if(move_uploaded_file($file_tmp, $newFileName)){
	               //echo "File $file_name uploaded successfully.<br>";
	           		$files_uploaded[] = $fname;
	           }   
		    } 

		    if(@$files_uploaded){
		    	$this->db->where('id',$a_id)->update('inventory_adjustments',['attachments'=>json_encode($files_uploaded)]);
		    }

			if($r){ 

				foreach ($this->db->select('id,qty,unit_cost_price')->get_where('inventory',['deleted'=>0])->result() as $rs) {
					$arr_inv[$rs->id] = $rs;
				}

				foreach ($items as $key => $inventory_id) {

					$qty = str_replace('-', '', $this->input->post('adj_qty'.$inventory_id,TRUE));

					if($this->input->post('adj_qty'.$inventory_id,TRUE)>0){
						$new_qty = @$arr_inv[$inventory_id]->qty+$qty;
					}else{
						$new_qty = @$arr_inv[$inventory_id]->qty-$qty;
					}
				  
					$this->db->insert('inventory_adjustments_items',[ 
						'adjustment_id'=>$a_id,
						'inventory_id'=>$inventory_id,  
						'unit_cost_price'=>@$arr_inv[$inventory_id]->unit_cost_price,
						'adj_qty'=>$this->input->post('adj_qty'.$inventory_id,TRUE),
						'qty_before'=>@$arr_inv[$inventory_id]->qty,
						'qty_after'=>$new_qty,
						'remarks'=>$this->input->post('remarks'.$inventory_id,TRUE),
						'user_id'=>$this->session->user_id,
						'date_created'=>date("Y-m-d H:i"),
						'confirmed' => 0 
					]);

				}
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/create_stock_adjustments","refresh");

	}

	public function edit_adjustment(int $id){

		$module = $this->system_menu; 

		$module['module'] = "inventory/edit_stock_adjustments";
		$module['map_link']   = "inventory->edit_stock_adjustments";   
		
		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];

		$module['ia'] = $this->core->load_core_data('inventory_adjustments',$id);

		$module['ia_items'] = $this->core->load_core_data('inventory_adjustments_items','','','adjustment_id='.$id);

		$module['user'] = $this->core->load_core_data('account',$module['ia']->user_id,'id,name');

		$module['inv'] = $this->core->load_core_data('inventory','','id,item_code,item_name,qty');
		
		$this->load->view('admin/index',$module);

	}

	public function delete_adjustment_attachment(int $id,$fid){

		redirect("inventory/edit_adjustment/".$id,"refresh");

	}

	public function update_adjustment(int $id){

		$module['ia'] = $this->core->load_core_data('inventory_adjustments',$id);

		$items = $this->input->post('items',TRUE);

		if($items){

			$r = $this->db->where('id',$id)->update('inventory_adjustments',[
				'date_modified' => date('Y-m-d H:i'),
				'modified_by' => $this->session->user_id,
				'adjustment_type_id' => $this->input->post('adjustment_type_id',TRUE), 
				'covered_date' => $this->input->post('covered_date',TRUE), 
				'ref_no' => $this->input->post('ref_no',TRUE),  
				'remarks' => $this->input->post('remarks',TRUE)
			]); 

			$a_id = $this->db->insert_id();

			$targetDir = "./assets/uploads/adjustments/";
	 
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }

		    $files_uploaded = json_decode($module['ia']->attachments);
	 
		    foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name){
		       $file_name = $_FILES['attach']['name'][$key];
		       $file_tmp = $_FILES['attach']['tmp_name'][$key];
	 			
	 		   $fname = $a_id. '_'. uniqid() . '_' . $file_name;		
	 
	           $newFileName = $targetDir . $fname;

	           if(move_uploaded_file($file_tmp, $newFileName)){
	               //echo "File $file_name uploaded successfully.<br>";
	           		$files_uploaded[] = $fname;
	           }   
		    } 

		    if(@$files_uploaded){
		    	$this->db->where('id',$id)->update('inventory_adjustments',['attachments'=>json_encode($files_uploaded)]);
		    }

			if($r){ 

				foreach ($this->db->select('id,qty,unit_cost_price')->get_where('inventory',['deleted'=>0])->result() as $rs) {
					$arr_inv[$rs->id] = $rs;
				}

				$this->db->where('adjustment_id',$id)->update('inventory_adjustments_items',['deleted'=>1,'date_deleted'=>date('Y-m-d H:i')]);

				foreach ($items as $key => $inventory_id) {

					$qty = str_replace('-', '', $this->input->post('adj_qty'.$inventory_id,TRUE));

					if($this->input->post('adj_qty'.$inventory_id,TRUE)>0){
						$new_qty = @$arr_inv[$inventory_id]->qty+$qty;
					}else{
						$new_qty = @$arr_inv[$inventory_id]->qty-$qty;
					}

					if(@$this->input->post('existing'.$inventory_id,TRUE)){

						$this->db->where('id',$this->input->post('existing'.$inventory_id,TRUE))->update('inventory_adjustments_items',[ 
							'inventory_id'=>$inventory_id,  
							'unit_cost_price'=>@$arr_inv[$inventory_id]->unit_cost_price,
							'adj_qty'=>$this->input->post('adj_qty'.$inventory_id,TRUE),
							'qty_before'=>@$arr_inv[$inventory_id]->qty,
							'qty_after'=>$new_qty,
							'remarks'=>$this->input->post('remarks'.$inventory_id,TRUE),
							'modified_by'=>$this->session->user_id,
							'date_modified'=>date("Y-m-d H:i"),
							'deleted' => 0,
							'date_deleted' => '' 
						]);

					}else{
				  
						$this->db->insert('inventory_adjustments_items',[ 
							'adjustment_id'=>$id,
							'inventory_id'=>$inventory_id,  
							'unit_cost_price'=>@$arr_inv[$inventory_id]->unit_cost_price,
							'adj_qty'=>$this->input->post('adj_qty'.$inventory_id,TRUE),
							'qty_before'=>@$arr_inv[$inventory_id]->qty,
							'qty_after'=>$new_qty,
							'remarks'=>$this->input->post('remarks'.$inventory_id,TRUE),
							'user_id'=>$this->session->user_id,
							'date_created'=>date("Y-m-d H:i"),
							'confirmed' => 0 
						]);

					}

				}
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/edit_adjustment/".$id,"refresh");

	}

	public function stock_adjustments(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "inventory/stock_adjustments";
		$module['map_link']   = "inventory->stock_adjustments";   
		
		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];

		$module['ia'] = $this->core->load_core_data('inventory_adjustments','','','confirmed=0');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];
		
		$this->load->view('admin/index',$module);

	}

	public function delete_adjustments(int $id){

		$q = $this->core->global_query(3,'inventory_adjustments',$id);

		if($q['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/stock_adjustments","refresh");

	}

	public function view_adjustments(int $id,$confirm = ''){

		$module['confirm'] = $confirm;

		$module['inv'] = $this->core->load_core_data('inventory','','id,item_code,item_name');

		$module['ia'] = $this->core->load_core_data('inventory_adjustments',$id);

		$module['ia_items'] = $this->core->load_core_data('inventory_adjustments_items','','','adjustment_id='.$id);

		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types',$module['ia']->adjustment_type_id);
		$module['adj_type'] = $result['maintenance_data'];

		$module['user'] = $this->core->load_core_data('account',$module['ia']->user_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',$module['ia']->confirmed_by); 
		
		$this->load->view('admin/inventory/view_adjustments',$module);

	}	

	public function confirm_adjustment(int $id){

		$r = $this->db->where('id',$id)->update('inventory_adjustments',[
			'confirmed_by' => $this->session->user_id,
			'confirmed_date' => date('Y-m-d H:i'), 
			'confirmed' => 1
		]); 

		if($r){

			$inv = $this->core->load_core_data('inventory','','id,qty,unit_cost_price');
			if($inv){
				foreach ($inv as $rs) {
					$arr_inv[$rs->id] = $rs;
				}
			}

			$items = $this->core->load_core_data('inventory_adjustments_items','','','adjustment_id='.$id); 
			 
			if(@$items){
				foreach ($items as $rs) {
					
					$update_inventory = $this->db->where('id',$rs->inventory_id)->update('inventory',[
						'old_qty'=>@$arr_inv[$rs->inventory_id]->qty, 
						'qty'=>@$arr_inv[$rs->inventory_id]->qty + $rs->adj_qty
					]); 

					if($update_inventory){

						$this->db->insert('inventory_movement',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id,
							'inventory_id' => @$rs->inventory_id,
							'ref_id' => $id, 
							'project_id' => 0, 
							'quotation_id' => 0, 
							'inventory_quotation_id' => 0, 
							'qty' => $rs->adj_qty,
							'qty_before' => @$arr_inv[$rs->inventory_id]->qty,
							'qty_after' => @$arr_inv[$rs->inventory_id]->qty + $rs->adj_qty, 
							'movement_from' => 'adjustment',
							'addition' => ($rs->adj_qty>=0 ? 1 : 0),
							'unit_cost_price' => @$arr_inv[$rs->inventory_id]->unit_cost_price
						]);

					}

				}
			}

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/stock_adjustments","refresh");

	}

	public function confirmed_stock_adjustments(){
 
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "inventory/confirmed_stock_adjustments";
		$module['map_link']   = "inventory->confirmed_stock_adjustments";   
		
		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];

		$module['ia'] = $this->core->load_core_data('inventory_adjustments','','','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$result = $this->admin_model->load_filemaintenance('fm_adjustments_types');
		$module['adj_types'] = $result['maintenance_data'];
		
		$this->load->view('admin/index',$module);

	}

	public function create_returns(){
	
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "inventory/create_returns";
		$module['map_link']   = "inventory->create_returns";   
		
		$module['issuance'] = $this->core->load_core_data('issuance','','id,project_id,job_order_id,date_created,ref_no','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');
		
		$this->load->view('admin/index',$module);

	}

	public function save_return_inventory(){

		$jo_id = $this->input->post('job_order_id',TRUE);

		$jo = $this->db->select('project_id,client_id')->get_where('projects_job_order',['id'=>$jo_id])->row();

		$items = $this->input->post('items',TRUE);

		if($items){

			$r = $this->db->insert('inventory_returns',[
				'date_created' => date('Y-m-d H:i'),
				'user_id' => $this->session->user_id,
				'issuance_id' => $this->input->post('issuance_id',TRUE), 
				'return_date' => $this->input->post('return_date',TRUE), 
				'ref_no' => $this->input->post('ref_no',TRUE),  
				'remarks' => $this->input->post('remarks',TRUE),
				'confirmed' => 0,
				'project_id'=>@$jo->project_id,
				'job_order_id'=>$jo_id,
				'client_id'=>@$jo->client_id,
			]); 

			$r_id = $this->db->insert_id();
			$i_id = $this->input->post('issuance_id',TRUE);
 
			if($r){ 

				foreach ($this->db->select('id,qty')->get_where('inventory',['deleted'=>0])->result() as $rs) {
					$arr_inv[$rs->id] = $rs;
				}

				foreach ($items as $key => $ii_id) {

					$qty = $this->input->post('qty'.$ii_id,TRUE);
 
				    $new_qty = @$arr_inv[$ii_id]->qty+$qty;
					  
					$this->db->insert('inventory_returns_items',[ 
						'return_id'=>$r_id,
						'project_id'=>$jo->project_id,
						'job_order_id'=>$jo_id,
						'client_id'=>$jo->client_id,
						'issuance_id'=>$this->input->post('issuance_id'.$ii_id,TRUE),
						'issuance_item_id'=>$ii_id,
						'inventory_id'=>$this->input->post('inventory_id'.$ii_id,TRUE),  
						'qty'=>$this->input->post('qty'.$ii_id,TRUE),
						'qty_before'=>@$arr_inv[$ii_id]->qty,
						'qty_after'=>$new_qty,
						'remarks'=>$this->input->post('remarks'.$ii_id,TRUE),
						'date_issued'=>@$this->input->post('date_issued'.$ii_id,TRUE),
						'issued_qty'=>@$this->input->post('issued_qty'.$ii_id,TRUE),
						'user_id'=>$this->session->user_id,
						'date_created'=>date("Y-m-d H:i"),
						'confirmed' => 0 
					]);

				}
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/create_returns","refresh");

	}

	public function return_inventory(){

		$module = $this->system_menu; 

		$module['module'] = "inventory/return_inventory";
		$module['map_link']   = "inventory->return_inventory";   

		$module['ii'] = $this->core->load_core_data('issuance','','id,job_order_id','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');
 
		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');

		$module['returns'] = $this->core->load_core_data('inventory_returns','','','confirmed=0');
		
		$module['projects'] = $this->core->load_core_data('projects','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function view_returns(int $id,$confirm = ''){

		$module['confirm'] = $confirm;

		$module['inv'] = $this->core->load_core_data('inventory','','id,item_code,item_name,qty');

		$module['ii'] = $this->core->load_core_data('issuance','','id,job_order_id','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');
		 
		$module['returns'] = $this->core->load_core_data('inventory_returns',$id);

		$module['return_items'] = $this->core->load_core_data('inventory_returns_items','','','return_id='.$module['returns']->id);

		$module['ii'] = $this->core->load_core_data('issuance',$module['returns']->issuance_id);

		$module['jo'] = $this->core->load_core_data('projects_job_order',$module['returns']->job_order_id,'id,job_order_number,project_id,client_id');

		$module['project'] = $this->core->load_core_data('projects',$module['jo']->project_id);

		$module['client'] = $this->core->load_core_data('clients',$module['jo']->client_id);

		$module['user'] = $this->core->load_core_data('account',$module['returns']->user_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',$module['returns']->confirmed_by); 
		
		$this->load->view('admin/inventory/view_returns',$module);

	}	

	public function edit_returns(int $id){
	
		$module = $this->system_menu;
  
		$module['module'] = "inventory/edit_returns";
		$module['map_link']   = "inventory->edit_returns";   
		
		$module['inv'] = $this->core->load_core_data('inventory','','id,item_code,item_name,qty'); 

		$module['users'] = $this->core->load_core_data('account','','id,name');
		 
		$module['returns'] = $this->core->load_core_data('inventory_returns',$id);

		$module['return_items'] = $this->core->load_core_data('inventory_returns_items','','','return_id='.$module['returns']->id);

		$module['jo'] = $this->core->load_core_data('projects_job_order',$module['returns']->job_order_id,'id,job_order_number,project_id,client_id');

		$module['project'] = $this->core->load_core_data('projects',$module['jo']->project_id);

		$module['client'] = $this->core->load_core_data('clients',$module['jo']->client_id);

		$module['user'] = $this->core->load_core_data('account',$module['returns']->user_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',$module['returns']->confirmed_by); 
		
		$this->load->view('admin/index',$module);

	}

	public function update_return_inventory(int $id){
 
		$items = $this->input->post('items',TRUE);

		if($items){

			$r = $this->db->where('id',$id)->update('inventory_returns',[ 
				'return_date' => $this->input->post('return_date',TRUE), 
				'ref_no' => $this->input->post('ref_no',TRUE),  
				'remarks' => $this->input->post('remarks',TRUE)
			]); 

			 $this->db->where('return_id',$id)->update('inventory_returns_items',[ 
				'deleted' => 1,
				'date_deleted' => date('Y-m-d'),
				'deleted_by' => $this->session->user_id
			]); 
  
	
			if(@$r){ 

				foreach ($this->db->select('id,qty')->get_where('inventory',['deleted'=>0])->result() as $rs) {
					$arr_inv[$rs->id] = $rs;
				}

				foreach ($items as $key => $ii_id) {

					$qty = $this->input->post('qty'.$ii_id,TRUE);
	
				    $new_qty = @$arr_inv[$ii_id]->qty+$qty;
 
				    $update = $this->db->where([
				    	'return_id'=>$id,
				    	'issuance_item_id'=>$ii_id
				    ])->update('inventory_returns_items',[
				    	'qty'=>$this->input->post('qty'.$ii_id,TRUE), 
						'remarks'=>$this->input->post('remarks'.$ii_id,TRUE),
						'deleted'=>0,
						'date_deleted' => '',
						'deleted_by' => ''
				    ]); 

				    if($this->db->affected_rows() == 0){ 
					  
						$this->db->insert('inventory_returns_items',[ 
							'return_id'=>$r_id,
							'project_id'=>$jo->project_id,
							'job_order_id'=>$jo_id,
							'client_id'=>$jo->client_id,
							'issuance_id'=>$this->input->post('issuance_id'.$ii_id,TRUE),
							'issuance_item_id'=>$ii_id,
							'inventory_id'=>$this->input->post('inventory_id'.$ii_id,TRUE),  
							'qty'=>$this->input->post('qty'.$ii_id,TRUE),
							'qty_before'=>@$arr_inv[$ii_id]->qty,
							'qty_after'=>$new_qty,
							'remarks'=>$this->input->post('remarks'.$ii_id,TRUE),
							'date_issued'=>@$this->input->post('date_issued'.$ii_id,TRUE),
							'issued_qty'=>@$this->input->post('issued_qty'.$ii_id,TRUE),
							'user_id'=>$this->session->user_id,
							'date_created'=>date("Y-m-d H:i"),
							'confirmed' => 0 
						]);

					}

				}
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/edit_returns/".$id,"refresh");

	}

	public function confirm_return_iventory($id)
	{
		$r = $this->db->where('id',$id)->update('inventory_returns',[
			'confirmed_by' => $this->session->user_id,
			'confirmed_date' => date('Y-m-d H:i'), 
			'confirmed' => 1
		]); 

		if($r){

			$inv = $this->core->load_core_data('inventory','','id,qty,unit_cost_price');
			if($inv){
				foreach ($inv as $rs) {
					$arr_inv[$rs->id] = $rs;
				}
			}

			$items = $this->core->load_core_data('inventory_returns_items','','','return_id='.$id); 
			 
			if(@$items){
				foreach ($items as $rs) {
					
					$update_inventory = $this->db->where('id',$rs->inventory_id)->update('inventory',[
						'old_qty'=>@$arr_inv[$rs->inventory_id]->qty, 
						'qty'=>@$arr_inv[$rs->inventory_id]->qty + $rs->qty
					]); 

					if($update_inventory){

						$this->db->insert('inventory_movement',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id,
							'inventory_id' => @$rs->inventory_id,
							'ref_id' => $id, 
							'project_id' => 0, 
							'quotation_id' => 0, 
							'inventory_quotation_id' => 0, 
							'qty' => $rs->qty,
							'qty_before' => @$arr_inv[$rs->inventory_id]->qty,
							'qty_after' => @$arr_inv[$rs->inventory_id]->qty + $rs->qty, 
							'movement_from' => 'returns',
							'addition' => 1,
							'unit_cost_price' => @$arr_inv[$rs->inventory_id]->unit_cost_price
						]);

					}

				}
			}

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("inventory/return_inventory","refresh");
	}

	public function confirmed_return_inventory()
	{
		$module = $this->system_menu; 

		$module['module'] = "inventory/return_inventory_confirmed";
		$module['map_link']   = "inventory->return_inventory_confirmed";   

		$module['ii'] = $this->core->load_core_data('issuance','','id,job_order_id','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');
		
		$module['jo'] = $this->core->load_core_data('projects_job_order','','id,job_order_number');

		$module['returns'] = $this->core->load_core_data('inventory_returns','','','confirmed=1');
		
		$this->load->view('admin/index',$module);
	}
  
}	