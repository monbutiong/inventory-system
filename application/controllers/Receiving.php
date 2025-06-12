<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving extends CI_Controller {


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
 

	public function create_receiving(){
 
		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receiving/create_receiving";
		$module['map_link']   = "receiving->create_receiving";   

		$module['suppliers'] = $this->core->load_core_data('suppliers_po');

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];

		$module['po'] = $this->core->load_core_data('purchase_order','','','confirmed=1');

		$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
		$module['fc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_local_charges');
		$module['lc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_grv_transport');
		$module['grv_transport'] = $result['maintenance_data'];
		
		$this->load->view('admin/index',$module);

	}

	public function load_supplier_po($supplier_id){

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number','supplier_id='.$supplier_id.' AND confirmed=1');

		$this->load->view('admin/receiving/load_supplier_po',$module);

	}

	public function load_items($id,$edit_rr_id = ''){

		$module['rr_id'] = $edit_rr_id;

		if($edit_rr_id){
			$module['e_rri'] = $this->core->load_core_data('receiving_items','','id,qty,po_item_id,remarks','receiving_id='.$edit_rr_id);

			$module['e_fc'] = $this->core->load_core_data('receiving_fc','','','receiving_id='.$edit_rr_id);

			$module['e_lc'] = $this->core->load_core_data('receiving_lc','','','receiving_id='.$edit_rr_id);

			$not_equal = ' AND receiving_id<>'.$edit_rr_id;
		}


		$module['po'] = $this->core->load_core_data('purchase_order',$id);

		$module['po_items'] = $this->core->load_core_data('purchase_order_items','','','po_id='.$id);

		$module['rri'] = $this->core->load_core_data('receiving_items','','id,qty,po_item_id','po_id='.$id.@$not_equal);

		// $module['receiving'] = $this->core->load_core_data('receiving','','','po_ids='.$id,1);

		$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
		$module['fc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_local_charges');
		$module['lc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['cr'] = $result['maintenance_data'];
 
		$module['lcr'] = $this->core->load_core_data('quotations_landed_cost_rate','','','quotation_id='.$module['po']->quotation_id);
		
		$this->load->view('admin/receiving/load_items',$module);

	}

	public function load_supplier_po_items($po_ids = '',$rr_id=0){

		if(!@$po_ids){

			echo '<p>
			<center>
			<font color="red">
			SUPPLIER AND P.O. NUMBER REQUIRED
			</font>
			</center>
			</p>';

		}else{

			$po_ids_q = '';
			$po_ids_q_po = '';

			if(strpos('-', $po_ids) !== false){
	 
				$po_ids_q = 'po_id='.$po_ids;
				$po_ids_q_po = 'id='.$po_ids;

			}elseif($po_ids){

				$po_ids = explode('-', $po_ids);
				foreach ($po_ids as $id) {
					if($id>0){
						if(@$po_ids_q){
							$po_ids_q_po.=' OR id='.$id;
							$po_ids_q.=' OR po_id='.$id;
						}else{
							$po_ids_q_po.=' id='.$id;
							$po_ids_q.='po_id='.$id;
						}
						
					}
				} 

				$po_ids_q_po = '('.$po_ids_q_po.')';
				$po_ids_q = '('.$po_ids_q.')';

			}

			if(!@$po_ids){ die('<p>No purchase order number was selected</p>'); }

			if($rr_id){
				$edit_rr_id = ' AND receiving_id<>'.$rr_id;
			}

			$module['po'] = $this->core->load_core_data('purchase_order','','',$po_ids_q_po);

			$module['po_items'] = $this->core->load_core_data('purchase_order_items','','',$po_ids_q);

			$module['rri'] = $this->core->load_core_data('receiving_items','','id,qty,po_item_id',$po_ids_q.@$edit_rr_id); 

			$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
			$module['fc'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_local_charges');
			$module['lc'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
			$module['cr'] = $result['maintenance_data'];

			$quo_ids_q = '';

			 

			$this->load->view('admin/receiving/load_supplier_po_items',$module);

		}
	}

	public function save_receiving(){

		$po_ids = [];
		$quotation_ids = [];
		$project_ids = [];

		if(@$this->input->post('items',TRUE)){

			foreach ($this->input->post('items',TRUE) as $iid => $val) { 
				if($iid){

					 
					if(!@$arr_po_ids[$this->input->post('po_id'.$iid,TRUE)]){
						$po_ids[] = $this->input->post('po_id'.$iid,TRUE);
						$arr_po_ids[$this->input->post('po_id'.$iid,TRUE)] = 1;
					}
					
					if(!@$arr_qou_ids[$this->input->post('quotation_id'.$iid,TRUE)]){
						$quotation_ids[] = $this->input->post('quotation_id'.$iid,TRUE);
						$arr_qou_ids[$this->input->post('quotation_id'.$iid,TRUE)] = 1;
					}
					
					if(!@$arr_proj_id[$this->input->post('project_id'.$iid,TRUE)]){
						$project_ids[] = $this->input->post('project_id'.$iid,TRUE);
						$arr_proj_id[$this->input->post('project_id'.$iid,TRUE)] = 1;
					}
					
			}} 

			$lc_factor = $this->input->post('lc_factor',TRUE);

			$r = $this->db->insert('receiving',[
				'date_created' => date('Y-m-d H:i'),
				'user_id' => $this->session->user_id,
				'supplier_id' => $this->input->post('supplier_id',TRUE), 
				'po_ids' => json_encode($po_ids,TRUE),
				'dr_number' => $this->input->post('dr_number',TRUE), 
				'invoice_number' => $this->input->post('invoice_number',TRUE), 
				'delivery_date' => $this->input->post('delivery_date',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'lc_factor' => $lc_factor,
				'exchange_rate' => $this->input->post('exchange_rate',TRUE),
				'currency' => $this->input->post('currency',TRUE),
				'remarks' => $this->input->post('remarks',TRUE),
				'grv_transport_id' => $this->input->post('grv_transport_id',TRUE),
				'confirmed' => 0 
			]); 

			$r_id = $this->db->insert_id();

			$targetDir = "./assets/uploads/receiving/";
	 
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }
	 
		    foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name){
		       $file_name = $_FILES['attach']['name'][$key];
		       $file_tmp = $_FILES['attach']['tmp_name'][$key];
	 			
	 		   $fname = $r_id. '_'. uniqid() . '_' . $file_name;		
	 
	           $newFileName = $targetDir . $fname;

	           if(move_uploaded_file($file_tmp, $newFileName)){
	               //echo "File $file_name uploaded successfully.<br>";
	           		$files_uploaded[] = $fname;
	           }   
		    } 

		    if(@$files_uploaded){
		    	$this->db->where('id',$r_id)->update('receiving',['attachments'=>json_encode($files_uploaded)]);
		    }

	    	foreach ($this->input->post('items',TRUE) as $iid => $val) {

	    		$has = 1;

	    		if($iid){

			    	$this->db->insert('receiving_items',[
						'date_created' => date('Y-m-d H:i'),
						'user_id' => $this->session->user_id,
						'receiving_id' => $r_id,
						'po_id' => $this->input->post('po_id'.$iid,TRUE),
						'po_item_id' => $iid, 
						'vehicle_id' => $this->input->post('vehicle_id'.$iid,TRUE),   
						'qty' => $this->input->post('qty'.$iid,TRUE),
						'bad_qty' => $this->input->post('bad_qty'.$iid,TRUE),
						'price' => $this->input->post('price'.$iid,TRUE),  
						'inventory_id' => $this->input->post('inv_id'.$iid,TRUE),   
						'remarks' => $this->input->post('remrks'.$iid,TRUE),
						'unit_cost_price' => round($lc_factor * $this->input->post('price'.$iid,TRUE),12)
					]);
 
					// $inv = $this->db->select('qty')->get_where('inventory',['id' => $this->input->post('inv_id' . $iid, TRUE)])->row();

					// $this->db->where('id', $this->input->post('inv_id' . $iid, TRUE)); 
					// $this->db->update('inventory',['qty' => ( $inv->qty + $this->input->post('rec_qty' . $iid, TRUE) )] );

					// $this->db->insert('inventory_movement',[
					// 	'date_created' => date('Y-m-d H:i'),
					// 	'user_id' => $this->session->user_id,
					// 	'ref_id' => $r_id, 
					// 	'project_id' => $this->input->post('project_id',TRUE), 
					// 	'quotation_id' => $this->input->post('quotation_id',TRUE), 
					// 	'quotation_item_id' => $this->input->post('quotation_item_id'.$iid,TRUE), 
					// 	'qty' => $this->input->post('rec_qty'.$iid,TRUE),
					// 	'qty_before' => $inv->qty,
					// 	'qty_after' => $inv->qty + $this->input->post('rec_qty'.$iid,TRUE), 
					// 	'movement_from' => 'receiving',
					// 	'addition' => 1, 
					// ]);

			    }

	    	}

	    }

	    if(@$has == 1){

	    	$fc_count = $this->input->post('fc_count',TRUE);

	    	if($fc_count>0){
	    		$counter = 1;
	    		while($fc_count>=$counter){
	    			if($this->input->post('fc'.$counter,TRUE) && $this->input->post('fc_amt'.$counter,TRUE)>0){

	    				$this->db->insert('receiving_fc',[
	    					'deleted'=>0,
	    					'user_id'=>$this->session->user_id,
	    					'date_created'=>date('Y-m-d H:i'),
	    					'fc_id'=>$this->input->post('fc'.$counter,TRUE),
	    					'amt'=>$this->input->post('fc_amt'.$counter,TRUE),
	    					'remarks'=>$this->input->post('fc_remarks'.$counter,TRUE),
	    					'receiving_id'=>$r_id
	    				]);
	    			}
	    			$counter+=1;
	    		}
	    	}

	    	$lc_count = $this->input->post('lc_count',TRUE);

	    	if($lc_count>0){
	    		$counter = 1;
	    		while($lc_count>=$counter){
	    			if($this->input->post('lc'.$counter,TRUE) && $this->input->post('lc_amt'.$counter,TRUE)>0){
	    				$this->db->insert('receiving_lc',[
	    					'deleted'=>0,
	    					'user_id'=>$this->session->user_id,
	    					'date_created'=>date('Y-m-d H:i'),
	    					'lc_id'=>$this->input->post('lc'.$counter,TRUE),
	    					'amt'=>$this->input->post('lc_amt'.$counter,TRUE),
	    					'remarks'=>$this->input->post('lc_remarks'.$counter,TRUE),
	    					'receiving_id'=>$r_id
	    				]);
	    			}
	    			$counter+=1;
	    		}
	    	}


	    	$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
	    	  
	    }else{

	    	$this->session->set_flashdata("error","error saving.");
	    	 
	    }

	    redirect("receiving/edit_rr/".$r_id,"refresh");

	}

	public function receiving_records(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receiving/receiving_records";
		$module['map_link']   = "receiving->receiving_records";   

		$module['receiving'] = $this->core->load_core_data('receiving','', '','confirmed=0');

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['suppliers'] = $this->core->load_core_data('suppliers_po');
		
		$this->load->view('admin/index',$module);

	}

	public function delete_rr($id){
	 

		$model = $this->core->global_query(3, 'receiving', $id);

		if($model){ 
			
			echo 1;
			//$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			echo 0;
			//$this->session->set_flashdata("error","error saving.");

		}

		die();
		//redirect("vehicles/masterlist/", "refresh");

	}

	public function view_rr($id,$confirm=0){

		$module = $this->system_menu; 

		$module['module'] = "receiving/view_rr"; 
		$module['map_link']   = "receiving->view_rr"; 
		$module['confirm'] = $confirm;  

		$module['rr'] = $this->core->load_core_data('receiving',$id);

		$po_ids_q = '';
		$pos_ids_q = '';
		$proj_ids_q = ''; 

		if(json_decode(@$module['rr']->po_ids)){
			foreach (json_decode($module['rr']->po_ids) as $po_id) {
				if(@$po_ids_q){ 
					$po_ids_q.=' OR id='.$po_id;
					$pos_ids_q.=' OR po_id='.$po_id; 
				}else{ 
					$po_ids_q.='id='.$po_id;
					$pos_ids_q.='po_id='.$po_id; 
				}
			}
			$po_ids_q = '('.$po_ids_q.')';
			$pos_ids_q = '('.$pos_ids_q.')'; 
		}

		if(json_decode(@$module['rr']->project_ids)){
			foreach (json_decode($module['rr']->project_ids) as $project_id) {
				if(@$proj_ids_q){  
					$proj_ids_q.=' OR id='.$project_id; 
				}else{  
					$proj_ids_q.='id='.$project_id;
				}
			} 
			$proj_ids_q = '('.$proj_ids_q.')';
		}

		$module['supplier'] = $this->core->load_core_data('suppliers_po',$module['rr']->supplier_id); 

		$module['po'] = $this->core->load_core_data('purchase_order','','',$po_ids_q); 

		$module['user'] = $this->core->load_core_data('account',$module['rr']->user_id); 

		if($module['rr']->confirmed==1){
			$module['user_confirmed'] = $this->core->load_core_data('account',$module['rr']->confirmed_by); 
		}

		$module['confirm_user'] = $this->core->load_core_data('account',@$module['rr']->confirmed_by); 

		$module['poi'] = $this->core->load_core_data('purchase_order_items','','',$pos_ids_q); 
 
		$module['rri'] = $this->core->load_core_data('receiving_items','','','receiving_id='.$module['rr']->id);

		$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
		$module['fc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_local_charges');
		$module['lc'] = $result['maintenance_data'];

		$module['fc_used'] = $this->core->load_core_data('receiving_fc','','','receiving_id='.$module['rr']->id);

		$module['lc_used'] = $this->core->load_core_data('receiving_lc','','','receiving_id='.$module['rr']->id); 

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_grv_transport');
		$module['grv_transport'] = $result['maintenance_data'];
		 
		$this->load->view('admin/index',$module);	 

	}

	public function edit_rr($id){
	
		$module = $this->system_menu; 

		$module['module'] = "receiving/edit_rr";
		$module['map_link']   = "receiving->edit_rr";   

		$module['suppliers'] = $this->core->load_core_data('suppliers_po');

		$result = $this->admin_model->load_filemaintenance('fm_currency_rate');
		$module['rates'] = $result['maintenance_data'];

		$module['rr'] = $this->core->load_core_data('receiving',$id);

		$po_ids_q = '';
		$pos_ids_q = '';

		if(json_decode(@$module['rr']->po_ids)){
			foreach (json_decode($module['rr']->po_ids) as $po_id) {
				if(@$po_ids_q){ 
					$po_ids_q.=' OR id='.$po_id;
					$pos_ids_q.=' OR po_id='.$po_id; 
				}else{ 
					$po_ids_q.='id='.$po_id;
					$pos_ids_q.='po_id='.$po_id; 
				}
			}
			$po_ids_q = '('.$po_ids_q.')';
			$pos_ids_q = '('.$pos_ids_q.')'; 
		}
 

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number',$po_ids_q);

		$module['poi'] = $this->core->load_core_data('purchase_order_items','','',$pos_ids_q);

		$module['rri'] = $this->core->load_core_data('receiving_items','','','receiving_id='.$id);

		$module['prev_rri'] = $this->core->load_core_data('receiving_items','','id,qty,po_item_id',$pos_ids_q); 

		$module['user'] = $this->core->load_core_data('account',$module['rr']->user_id); 

		$module['confirm_user'] = $this->core->load_core_data('account',@$module['rr']->confirmed_by); 

		$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
		$module['fc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_local_charges');
		$module['lc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_grv_transport');
		$module['grv_transport'] = $result['maintenance_data'];

		$module['fc_used'] = $this->core->load_core_data('receiving_fc','','','receiving_id='.$id);

		$module['lc_used'] = $this->core->load_core_data('receiving_lc','','','receiving_id='.$id); 
		
		$this->load->view('admin/index',$module);

	}

	public function update_receiving(int $r_id){

		$po_ids = [];
		$quotation_ids = [];
		$project_ids = [];

		if(@$this->input->post('items',TRUE)){

			foreach ($this->input->post('items',TRUE) as $iid => $val) { 
				if($iid){

					 
					if(!@$arr_po_ids[$this->input->post('po_id'.$iid,TRUE)]){
						$po_ids[] = $this->input->post('po_id'.$iid,TRUE);
						$arr_po_ids[$this->input->post('po_id'.$iid,TRUE)] = 1;
					}
					
					if(!@$arr_qou_ids[$this->input->post('quotation_id'.$iid,TRUE)]){
						$quotation_ids[] = $this->input->post('quotation_id'.$iid,TRUE);
						$arr_qou_ids[$this->input->post('quotation_id'.$iid,TRUE)] = 1;
					}
					
					if(!@$arr_proj_id[$this->input->post('project_id'.$iid,TRUE)]){
						$project_ids[] = $this->input->post('project_id'.$iid,TRUE);
						$arr_proj_id[$this->input->post('project_id'.$iid,TRUE)] = 1;
					}
					
			}} 

			$lc_factor = $this->input->post('lc_factor',TRUE);

			$r = $this->db->where('id',$r_id)->update('receiving',[
				'date_modified' => date('Y-m-d H:i'),
				'modified_by' => $this->session->user_id,
				'supplier_id' => $this->input->post('supplier_id',TRUE), 
				'po_ids' => json_encode($po_ids,TRUE), 
				'dr_number' => $this->input->post('dr_number',TRUE), 
				'invoice_number' => $this->input->post('invoice_number',TRUE), 
				'delivery_date' => $this->input->post('delivery_date',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'lc_factor' => $lc_factor,
				'exchange_rate' => $this->input->post('exchange_rate',TRUE),
				'currency' => $this->input->post('currency',TRUE),
				'remarks' => $this->input->post('remarks',TRUE),
				'grv_transport_id' => $this->input->post('grv_transport_id',TRUE),
				'confirmed' => 0 
			]);  

			$targetDir = "./assets/uploads/receiving/";
	 
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }

		    if($this->input->post('attach',TRUE)){
		    	$files_uploaded = $this->input->post('attach',TRUE);
		    }
	 
		    foreach($_FILES['attach']['tmp_name'] as $key => $tmp_name){
		       $file_name = $_FILES['attach']['name'][$key];
		       $file_tmp = $_FILES['attach']['tmp_name'][$key];
	 			
	 		   $fname = $r_id. '_'. uniqid() . '_' . $file_name;		
	 
	           $newFileName = $targetDir . $fname;

	           if(move_uploaded_file($file_tmp, $newFileName)){
	               //echo "File $file_name uploaded successfully.<br>";
	           		$files_uploaded[] = $fname;
	           }   
		    } 

		    if(@$files_uploaded){
		    	$this->db->where('id',$r_id)->update('receiving',['attachments'=>json_encode($files_uploaded)]);
		    }

		    $this->db->where('receiving_id',$r_id)->update('receiving_items',[
		    	'deleted'=>1,
				'date_deleted' => date('Y-m-d H:i'),
				'deleted_by' => $this->session->user_id
			]);

			$this->db->where('receiving_id',$r_id)->update('receiving_fc',[
		    	'deleted'=>1,
				'date_deleted' => date('Y-m-d H:i'),
				'deleted_by' => $this->session->user_id
			]);

			$this->db->where('receiving_id',$r_id)->update('receiving_lc',[
		    	'deleted'=>1,
				'date_deleted' => date('Y-m-d H:i'),
				'deleted_by' => $this->session->user_id
			]);

	    	foreach ($this->input->post('items',TRUE) as $iid => $val) {
	     
	    			 
	    			$update = $this->db->where([
	    				'receiving_id'=>$r_id,
	    				'po_item_id' => $val
	    			])->update('receiving_items',[
						'date_modified' => date('Y-m-d H:i'),
						'modified_by' => $this->session->user_id,   
						'vehicle_id' => $this->input->post('vehicle_id'.$iid,TRUE),  
						'qty' => $this->input->post('qty'.$iid,TRUE),
						'bad_qty' => $this->input->post('bad_qty'.$iid,TRUE),
						'price' => $this->input->post('price'.$iid,TRUE),  
						'inventory_id' => $this->input->post('inv_id'.$iid,TRUE),   
						'remarks' => $this->input->post('remrks'.$iid,TRUE),
						'unit_cost_price' => round($lc_factor * $this->input->post('price'.$iid,TRUE),12),
				    	'deleted'=>0,
						'date_deleted' => '',
						'deleted_by' => ''
					]);  

					if($this->db->affected_rows() == 0){  
						
				    	$this->db->insert('receiving_items',[
							'date_created' => date('Y-m-d H:i'),
							'user_id' => $this->session->user_id,
							'date_modified' => date('Y-m-d H:i'),
							'modified_by' => $this->session->user_id,  
							'receiving_id' => $r_id,
							'po_id' => $this->input->post('po_id'.$iid,TRUE),
							'po_item_id' => $iid, 
							'vehicle_id' => $this->input->post('vehicle_id'.$iid,TRUE),  
							'qty' => $this->input->post('qty'.$iid,TRUE),
							'bad_qty' => $this->input->post('bad_qty'.$iid,TRUE),
							'price' => $this->input->post('price'.$iid,TRUE),  
							'inventory_id' => $this->input->post('inv_id'.$iid,TRUE),   
							'remarks' => $this->input->post('remrks'.$iid,TRUE),
							'unit_cost_price' => round($lc_factor * $this->input->post('price'.$iid,TRUE),12)
						]); 
					}
	  				
	  				$has = 1;
			   
	    	}

	    }

	    if(@$has == 1){

	    	$fc_count = $this->input->post('fc_count',TRUE);

	    	if($fc_count>0){
	    		$counter = 1;
	    		while($fc_count>=$counter){
	    			if($this->input->post('fc'.$counter,TRUE) && $this->input->post('fc_amt'.$counter,TRUE)>0){
	    				$this->db->insert('receiving_fc',[
	    					'deleted'=>0,
	    					'user_id'=>$this->session->user_id,
	    					'date_created'=>date('Y-m-d H:i'),
	    					'fc_id'=>$this->input->post('fc'.$counter,TRUE),
	    					'amt'=>$this->input->post('fc_amt'.$counter,TRUE),
	    					'remarks'=>$this->input->post('fc_remarks'.$counter,TRUE),
	    					'receiving_id'=>$r_id
	    				]);
	    			}
	    			$counter+=1;
	    		}
	    	}

	    	$lc_count = $this->input->post('lc_count',TRUE);

	    	if($lc_count>0){
	    		$counter = 1;
	    		while($lc_count>=$counter){
	    			if($this->input->post('lc'.$counter,TRUE) && $this->input->post('lc_amt'.$counter,TRUE)>0){
	    				$this->db->insert('receiving_lc',[
	    					'deleted'=>0,
	    					'user_id'=>$this->session->user_id,
	    					'date_created'=>date('Y-m-d H:i'),
	    					'lc_id'=>$this->input->post('lc'.$counter,TRUE),
	    					'amt'=>$this->input->post('lc_amt'.$counter,TRUE),
	    					'remarks'=>$this->input->post('lc_remarks'.$counter,TRUE),
	    					'receiving_id'=>$r_id
	    				]);
	    			}
	    			$counter+=1;
	    		}
	    	}


	    	$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
	    	  
	    }else{

	    	$this->session->set_flashdata("error","error saving.");
	    	 
	    }

	    redirect("receiving/edit_rr/".$r_id,"refresh");

	}

	public function print_rr($id){ 

		$module['rr'] = $this->core->load_core_data('receiving',$id);

		$po_ids_q = '';
		$pos_ids_q = '';
		$proj_ids_q = ''; 

		if(json_decode(@$module['rr']->po_ids)){
			foreach (json_decode($module['rr']->po_ids) as $po_id) {
				if(@$po_ids_q){ 
					$po_ids_q.=' OR id='.$po_id;
					$pos_ids_q.=' OR po_id='.$po_id; 
				}else{ 
					$po_ids_q.='id='.$po_id;
					$pos_ids_q.='po_id='.$po_id; 
				}
			}
			$po_ids_q = '('.$po_ids_q.')';
			$pos_ids_q = '('.$pos_ids_q.')'; 
		}

		if(json_decode(@$module['rr']->project_ids)){
			foreach (json_decode($module['rr']->project_ids) as $project_id) {
				if(@$proj_ids_q){  
					$proj_ids_q.=' OR id='.$project_id; 
				}else{  
					$proj_ids_q.='id='.$project_id;
				}
			} 
			$proj_ids_q = '('.$proj_ids_q.')';
		}

		$module['pos'] = $this->core->load_core_data('purchase_order','','',$po_ids_q); 

		$module['user'] = $this->core->load_core_data('account',$module['rr']->user_id); 

		$module['poi'] = $this->core->load_core_data('purchase_order_items','','',$pos_ids_q); 
 
		$module['supplier'] = $this->core->load_core_data('suppliers_po',$module['rr']->supplier_id); 

		$module['rri'] = $this->core->load_core_data('receiving_items','','','receiving_id='.$module['rr']->id);

		$module['fc_used'] = $this->core->load_core_data('receiving_fc','','','receiving_id='.$module['rr']->id);

		$module['lc_used'] = $this->core->load_core_data('receiving_lc','','','receiving_id='.$module['rr']->id); 

		$result = $this->admin_model->load_filemaintenance('fm_foreign_charges');
		$module['fc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_local_charges');
		$module['lc'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_grv_transport');
		$module['grv_transport'] = $result['maintenance_data'];
		
		$this->load->view('admin/receiving/print_rr',$module);
	} 

	public function confirm_receiving($id){

		$r = $this->db->where('id',$id)->update('receiving',[
			'confirmed_by' => $this->session->user_id,
			'confirmed_date' => date('Y-m-d H:i'), 
			'confirmed' => 1
		]); 

		$rr = $this->core->load_core_data('receiving',$id);
		$rri = $this->db->select('inventory_id, po_item_id, qty, unit_cost_price, vehicle_id, price')->get_where('receiving_items',['receiving_id'=>$id,'deleted'=>0])->result();

		foreach ($rri as $rs) { 

			$rs->po_item_id;
			$receiving_history = [];
 
			$inv = $this->db->select('id,qty,unit_cost_price,receiving_history')->get_where('inventory',['id' => $rs->inventory_id])->row();

			$unit_cost_price = (($inv->unit_cost_price * $inv->qty) + ($rs->unit_cost_price * $rs->qty)) / ($inv->qty + $rs->qty);

			$supplier_price = $rs->price;

			if($inv->receiving_history){
				$receiving_history = json_decode($inv->receiving_history);
			}
			 
			$receiving_history[] = [
				'rr_id' => $id,
				'date'=>date('Y-m-d H:i'),
				'qty' => ($inv->qty + $rs->qty),
				'ucp' => round($unit_cost_price,2)
			];

			$this->db->where('id', @$rs->inventory_id); 
			$this->db->update('inventory',[
				'old_qty' => $inv->qty,
				'old_unit_cost_price' => round($inv->unit_cost_price,2),
				'qty' => ($inv->qty + $rs->qty),
				'unit_cost_price' => round($unit_cost_price,2),
				'receiving_history'=>json_encode($receiving_history),
				'supplier_price'=>$supplier_price
			] );

			$this->db->insert('inventory_movement',[
				'date_created' => date('Y-m-d H:i'),
				'user_id' => $this->session->user_id,
				'inventory_id' => @$rs->inventory_id,
				'ref_id' => $id, 
				'vehicle_id' => $rs->vehicle_id,   
				'qty' => $rs->qty,
				'qty_before' => $inv->qty,
				'qty_after' => ($inv->qty + $rs->qty), 
				'movement_from' => 'receiving',
				'addition' => 1,
				'unit_cost_price' => round($unit_cost_price,2)
			]);

		}

		if(@$rri){

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");
			 
		}

		redirect("receiving/view_rr/".$id,"refresh");

	}

	public function confirmed_receiving_records(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "receiving/confirmed_receiving_records";
		$module['map_link']   = "receiving->confirmed_receiving_records";   

		$module['receiving'] = $this->core->load_core_data('receiving','', '','confirmed=1');

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number','confirmed=1');

		$module['users'] = $this->core->load_core_data('account','','id,name');
		
		$this->load->view('admin/index',$module);

	}

 
}	