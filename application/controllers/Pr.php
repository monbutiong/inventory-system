<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {


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

	public function check_access($url, $sub_menu = [], $index_user_roles = []){

		$granted = 0;

		foreach($sub_menu as $rs){
			if($url == $rs->url_link){
				$sub_menu_id = $rs->id;
			}
		}

		foreach($index_user_roles as $rs){
			if(@$sub_menu_id == @$rs->sub_menu_id){
				$granted = 1;
			}
		} 

		if($granted==0){ die('access denied'); }

	}

	public function pr_masterlist(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "pr/pr_masterlist";
		$module['map_link']   = "pr->pr_masterlist";  

		$module['pr'] = $this->core->load_core_data('purchase_request','','','user_id='.$this->session->user_id.' AND history=0');

		if($module['pr']){
			$selected_po = '(';
			foreach ($module['pr'] as $prs) {
				if($prs->po_ids){
					foreach (json_decode($prs->po_ids) as $poid) {
						$selected_po.='id='.$poid.' OR '; 
						$has_po=1;
					} 
				}
			}
			$selected_po = str_replace(' OR )',')',$selected_po.')');
			if(@$has_po){
				$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,date_created',$selected_po);
			}
		}
		

		// $selected_pr = '(';

		// foreach($module['pr'] as $rs){
		// 	$selected_pr.='purchase_request_id='.$rs->id.' OR ';
		// }
 
		// if($selected_pr != '('){

		// 	$selected_pr = str_replace(' OR )',')',$selected_pr.')');

		// 	$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,date_created,purchase_request_id,purchase_request_ids',$selected_pr);
		// }
 
 
		$module['projects'] = $this->core->load_core_data('projects');

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

  
		$this->load->view('admin/index',$module);

	}
 
 	public function add_pr(){

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_department', $this->session->department_id);
		$module['approver'] = $result['maintenance_data'];

		$module['projects'] = $this->core->load_core_data('projects');

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number');

		$module['users'] = $this->core->load_core_data('account','','id,name');
  
		$this->load->view('admin/pr/pr_add',$module);

	}

	public function save_pr()
	{

		if(!fpost('control_number_type') || (!fpost('inventory_accounts_id') && !fpost('project_id')) ){
			$this->session->set_flashdata("error","Some fields are required.");
			redirect("pr/pr_masterlist","refresh"); 
		}

		$result = $this->admin_model->load_filemaintenance('fm_department', $this->session->department_id);
		$approver = $result['maintenance_data'];

		$model = $this->core->save_pr($approver); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("pr/pr_masterlist","refresh"); 
	}

	public function history(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "pr/history";
		$module['map_link']   = "pr->history";  

		$module['pr'] = $this->core->load_core_data('purchase_request','','','user_id='.$this->session->user_id.' AND history=1');

		$selected_pr = '(';

		foreach($module['pr'] as $rs){
			$selected_pr.='purchase_request_id='.$rs->id.' OR ';
		}
 
		if($selected_pr != '('){

			$selected_pr = str_replace(' OR )',')',$selected_pr.')');

			$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,date_created,purchase_request_id', $selected_pr); 
		}

		$module['projects'] = $this->core->load_core_data('projects');

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

  
		$this->load->view('admin/index',$module);

	}

	public function view_pr($id, $purchasing = '', $approval = '')
	{

		$module['purchasing'] = $purchasing;
		$module['approval'] = $approval;

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['pr'] = $this->core->load_core_data('purchase_request',$id);

		$module['pr_item'] = $this->core->load_core_data('purchase_request_items','','','purchase_request_id='.$module['pr']->id);
 
		$module['po_item'] = $this->core->load_core_data('purchase_order_items','','','purchase_request_id='.$module['pr']->id);

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];
		
		$selected_item = '(';
		$selected_po = '(';

		foreach($module['pr_item'] as $rs){
			$selected_item.='id="'.$rs->inventory_id.'" OR '; 
		}

		foreach($module['po_item'] as $rs){ 
			$selected_po.='id="'.$rs->purchase_order_id.'" OR ';
		}
 
		if($selected_item != '('){

			$selected_item = str_replace(' OR )',')',$selected_item.')');
			$selected_po = str_replace(' OR )',')',$selected_po.')');

			$module['items'] = $this->core->load_core_data('inventory','','id,name,short_description,uom_type_id,item_code', $selected_item); 

			if($module['po_item']){
				$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number',$selected_po);
			}
			
		}

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['uom_conversions'] = $this->core->load_core_data('uom_conversions');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects');

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number','','id,control_number');
  
		$this->load->view('admin/pr/pr_view',$module);
	}


	public function revise_pr($id, $purchasing = '', $approval = '')
	{

		$module['purchasing'] = $purchasing;
		$module['approval'] = $approval;

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['pr'] = $this->core->load_core_data('purchase_request',$id);

		$module['pr_item'] = $this->core->load_core_data('purchase_request_items','','','purchase_request_id='.$module['pr']->id);
	
		$module['po_item'] = $this->core->load_core_data('purchase_order_items','','','purchase_request_id='.$module['pr']->id);

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];
		
		$selected_item = '(';
		$selected_po = '(';

		foreach($module['pr_item'] as $rs){
			$selected_item.='id="'.$rs->inventory_id.'" OR '; 
		}

		foreach($module['po_item'] as $rs){ 
			$selected_po.='id="'.$rs->purchase_order_id.'" OR ';
		}
	
		if($selected_item != '('){

			$selected_item = str_replace(' OR )',')',$selected_item.')');
			$selected_po = str_replace(' OR )',')',$selected_po.')');

			$module['items'] = $this->core->load_core_data('inventory','','id,name,short_description,uom_type_id,item_code', $selected_item); 

			if($module['po_item']){
				$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number',$selected_po);
			}
			
		}

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['uom_conversions'] = $this->core->load_core_data('uom_conversions');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects');

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number','','id,control_number');
	 
		$this->load->view('admin/pr/pr_revised',$module);
	}

	public function save_revised_pr($pr_id)
	{
		$pr_data = $this->core->load_core_data('purchase_request',$pr_id);
		 
		$rev = $pr_data->rev;
		  
		$row_counter = $this->input->post('row_counter',TRUE);
		$ccc = 0;
 
		while($row_counter>$ccc){

			$ccc+=1;

			if($this->input->post('qty'.$ccc,TRUE)>0){

				if(@$this->input->post('existing_pr'.$ccc,TRUE)>0){

					$pri_id = @$this->input->post('existing_pr'.$ccc,TRUE);

			    	$this->db->where('id',$pri_id)->update('purchase_request_items',[
			    		'item_name'=>@$this->input->post('item_name'.$ccc,TRUE),
			    		'item_desc'=>@$this->input->post('item_desc'.$ccc,TRUE),
			    		'qty'=>$this->input->post('qty'.$ccc,TRUE),
			    		'rev'=>($rev+1)
			    	]);

			    }else{

			    	$item_data[] = [
			    		'inventory_id'=>$this->input->post('item'.$ccc,TRUE),
			    		'item_name'=>@$this->input->post('item_name'.$ccc,TRUE),
			    		'item_desc'=>@$this->input->post('item_desc'.$ccc,TRUE),
			    		'qty'=>$this->input->post('qty'.$ccc,TRUE),
			    		'new'=>$this->input->post('new'.$ccc,TRUE),
			    		'purchase_request_id'=>$pr_id,
			    		'user_id'=>$this->session->user_id, 
			    		'date_created'=>date("Y-m-d H:i:s"),
			    	    'project_id'=>@$pr_data->project_id,
			    	    'inventory_accounts_id' => @$pr_data->inventory_accounts_id,
			    	    'pur_control_number' => @$pr_data->pur_control_number,
			    	    'rev'=>($rev+1)
			    	];

			    }

	    	}
		 
		}

		if(@$item_data){

			$this->db->insert_batch('purchase_request_items', $item_data);

			$this->db->where('id',$pr_id)->update('purchase_request',[
				'rev'=>$rev+1, 
				'rev_date'=>date("Y-m-d H:i:s")
			]); 

			// $this->db->where([
			// 	'purchase_request_id'=>$pr_id,
			// 	'rev'=>$rev
			// ])->update('purchase_request_items',[
			// 	'deleted'=>1 
			// ]);
		}

		if(@$item_data || @$pri_id){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}
  
		redirect("pr/pr_masterlist","refresh"); 
 
	}

	public function revise_pr_po($id, $purchasing = '', $approval = '')
	{

		$module['purchasing'] = $purchasing;
		$module['approval'] = $approval;

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['pr'] = $this->core->load_core_data('purchase_request',$id);

		$module['pr_item'] = $this->core->load_core_data('purchase_request_items','','','purchase_request_id='.$module['pr']->id);
	
		$module['po_item'] = $this->core->load_core_data('purchase_order_items','','','purchase_request_id='.$module['pr']->id);

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];
		
		$selected_item = '(';
		$selected_po = '(';

		foreach($module['pr_item'] as $rs){
			$selected_item.='id="'.$rs->inventory_id.'" OR '; 
		}

		foreach($module['po_item'] as $rs){ 
			$selected_po.='id="'.$rs->purchase_order_id.'" OR ';
		}
	
		if($selected_item != '('){

			$selected_item = str_replace(' OR )',')',$selected_item.')');
			$selected_po = str_replace(' OR )',')',$selected_po.')');

			$module['items'] = $this->core->load_core_data('inventory','','id,name,short_description,uom_type_id,item_code', $selected_item); 

			if($module['po_item']){
				$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number',$selected_po);
			}
			
		}

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['uom_conversions'] = $this->core->load_core_data('uom_conversions');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects');

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number','','id,control_number');

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number');
	 
		$this->load->view('admin/pr/pr_revise_po',$module);
	}


	public function print_pr($id, $purchasing = '', $approval = '')
	{

		$module['purchasing'] = $purchasing;
		$module['approval'] = $approval;

		$result = $this->admin_model->load_filemaintenance('fm_uom');
		$module['uom_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_request_type');
		$module['type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_inventory_category');
		$module['category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_manufacturer');
		$module['manufacturer'] = $result['maintenance_data'];

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['pr'] = $this->core->load_core_data('purchase_request',$id);

		$module['pr_item'] = $this->core->load_core_data('purchase_request_items','','','purchase_request_id='.$module['pr']->id);

		$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number,purchase_request_id,purchase_request_ids');
 
		$module['po_item'] = $this->core->load_core_data('purchase_order_items','','','purchase_request_id='.$module['pr']->id);

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];
		
		$selected_item = '(';
		$selected_po = '(';

		foreach($module['pr_item'] as $rs){
			$selected_item.='id="'.$rs->inventory_id.'" OR '; 
		}

		foreach($module['po_item'] as $rs){ 
			$selected_po.='id="'.$rs->purchase_order_id.'" OR ';
		}
 
		if($selected_item != '('){

			$selected_item = str_replace(' OR )',')',$selected_item.')');
			$selected_po = str_replace(' OR )',')',$selected_po.')');

			$module['items'] = $this->core->load_core_data('inventory','','id,name,short_description,uom_type_id,item_code', $selected_item); 

			// if($module['po_item']){
			// 	$module['po'] = $this->core->load_core_data('purchase_order','','id,po_number',$selected_po);
			// }
			
		}

		$module['suppliers'] = $this->core->load_core_data('suppliers','','id,name');

		$module['uom_conversions'] = $this->core->load_core_data('uom_conversions');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['projects'] = $this->core->load_core_data('projects');

		$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
		$module['accounts'] = $result['maintenance_data'];

		$module['projects_control_number'] = $this->core->load_core_data('projects_control_number','','id,control_number');
  
		$this->load->view('admin/pr/pr_print',$module);
	}

	public function cancel_pr($id)
	{
		$model = $this->db->where('id',$id)->update('purchase_request',['form_status'=>3]); 

		if($model){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("pr/pr_masterlist","refresh");
	}

	public function move_to_history_pr($id)
	{
		$model = $this->db->where('id',$id)->update('purchase_request',['history'=>1]); 

		if($model){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("pr/pr_masterlist","refresh");
	}

	public function load_cn($type)
	{
		if($type ==	 1){
			$result = $this->admin_model->load_filemaintenance('fm_inventory_accounts');
			$module['accounts'] = $result['maintenance_data'];
		}else{
			$module['projects'] = $this->core->load_core_data('projects');
		}
		

		$module['type'] = $type;

		$this->load->view('admin/pr/load_cn',$module);

	}

	public function load_account($id)
	{
		$rs = $this->db->get_where('fm_inventory_accounts',['id'=>$id])->row();
		echo $rs->title;
	}

	public function save_revised_po($id)
	{
		$pr = $this->core->load_core_data('purchase_request',$id);

		$pr_po_ids = $pr->po_ids ? json_decode($pr->po_ids) : [];
 
		$module['pr_item'] = $this->core->load_core_data('purchase_request_items','','','purchase_request_id='.$pr->id);

		$po_items = $this->core->load_core_data('purchase_order_items','','purchase_order_id, purchase_request_items_id','purchase_request_id='.$pr->id);

		if($po_items){
			foreach($po_items as $rs){
				$arr_poi[$rs->purchase_request_items_id] = $rs->purchase_order_id;
			}
		}

		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}

		foreach($module['pr_item'] as $rs){
			
			$new_item_name = $this->input->post('item_name'.$rs->id,TRUE);
			$new_item_desc = $this->input->post('item_desc'.$rs->id,TRUE);
			$new_po = $this->input->post('po'.$rs->id,TRUE);
			$new_qty = $this->input->post('qty'.$rs->id,TRUE);
			$new_price = $this->input->post('price'.$rs->id,TRUE);
			$new_discount = $this->input->post('new_discount'.$rs->id,TRUE);


			if($new_qty<=0){

				$this->db->where('purchase_request_items_id',$rs->id)->update('purchase_order_items',['deleted'=>1]);

			}elseif(
				$new_item_name!=$rs->item_name || 
				$new_item_desc!=$rs->item_desc || 
				$new_po!=@$arr_poi[$rs->id] || 
				round($new_qty,2)!=round($rs->qty) || 
				round($new_price,2)!=round($rs->price,2))
			{

				
 
				if($new_po && !@$arr_poi[$rs->id]){

					$pohead = $this->db->get_where('purchase_order',['id'=>$new_po])->row();

					$data_old = [];
					$data_old['date_created'] = date("Y-m-d H:i:s");
				    $data_old['user_id'] = $this->session->user_id;

				    $data_old['purchase_order_id'] = $new_po;
				    $data_old['purchase_request_id'] = $rs->purchase_request_id;
				    $data_old['purchase_request_items_id'] = $rs->id;

				    $data_old['inventory_id'] = $rs->inventory_id;

				    $data_old['qty'] = $this->input->post('qty'.$rs->id,TRUE);
				    $data_old['price'] = $this->input->post('price'.$rs->id,TRUE);
				    $data_old['uom_conversion_id'] = $this->input->post('uom'.$rs->id,TRUE);

				    $data_old['item_name'] = $this->input->post('item_name'.$rs->id,TRUE);
				    $data_old['item_desc'] = $this->input->post('item_desc'.$rs->id,TRUE);

				    $data_old['control_number_type'] = @$pohead->control_number_type; //== 1 PUR 2 SALES
				    $data_old['inventory_accounts_id'] = @$pohead->inventory_accounts_id;
				    $data_old['pur_control_number'] = @$pohead->pur_control_number;

				    $data_old['project_id'] = $rs->project_id; 
				    $data_old['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$rs->id,TRUE)]->factor; 

				    $this->db->insert('purchase_order_items',$data_old);

				    $this->db->where('id',$rs->id)->update('purchase_request_items',['purchase_order_id'=>$new_po]);

				    if(!in_array($new_po,$pr_po_ids)){ 
				    	array_push($pr_po_ids, $new_po);
				    }

				}else{

					$this->db->where([
						'purchase_request_items_id'=>$rs->id,
						'deleted'=>1
					])->update('purchase_order_items',[
						'item_name'=>$new_item_name,
						'item_desc'=>$new_item_desc,
						'qty'=>$new_qty,
						'price'=>$new_price 
					]);

					
				}

				$update_po[$new_po] = $new_po;
				
			}
		}

		if(@$update_po){
			foreach(@$update_po as $poid){
				$po = $this->db->select('po_rev')->get_where('purchase_order',['id'=>$poid])->row();
				$this->db->where(['id'=>$poid])->update('purchase_order',[
					'po_rev'=>($po->po_rev+1)
				]);
			}
		}

		if(@$update_po){

			$this->db->where('id',$id)->update('purchase_request',['po_ids'=>json_encode($pr_po_ids)]);

			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
		}else{
			$this->session->set_flashdata("error","error saving. no changes from P.O. was saved.");
		}

		redirect("purchasing/purchase_request","refresh");

	}
	
}	