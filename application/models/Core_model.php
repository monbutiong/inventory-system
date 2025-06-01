<?php  
class Core_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function load_core_data($table,$id='',$select='',$condition='', $if_one=''){
 		
 		if($select){
 			$this->db->select($select);
 		}
 		if($condition){
 			$this->db->where($condition);
 		}
		$this->db->from($table);
		if($id>0){ 
			$this->db->where(array('deleted'=>0, 'id'=>$id));
			$query = $this->db->get(); 
			return $query->row(); 
		}elseif($if_one){
			$query = $this->db->get(); 
			return $query->row();
		}else{
			$this->db->where(array('deleted'=>0));
			$query = $this->db->get(); 
			return $query->result();
		}
		 
	}

	public function load_core_data_all($table,$id='',$select='',$condition='', $if_one=''){
 		
 		if($select){
 			$this->db->select($select);
 		}
 		if($condition){
 			$this->db->where($condition);
 		}
		$this->db->from($table);
		if($id){  
			$query = $this->db->get(); 
			return $query->row(); 
		}elseif($if_one){
			$query = $this->db->get(); 
			return $query->row();
		}else{ 
			$query = $this->db->get(); 
			return $query->result();
		}
		 
	}

	 

	public function global_query($type,$table,$id = '',$additional_input='',$block_forms_fields=''){

		
		$user_id = $this->session->user_id; 

		$data = [];
		$sib = '';
		$visible_to = '';

		foreach ($this->db->list_fields($table) as $rs) {
			$arr_allow_field[$rs] = 1;
		}

		foreach($_POST as $key => $value){
			if(@$arr_allow_field[$key] && $key != 'images' && $key != 'bsp_rates' && $key != 'attacments'){
		    	$data[$key] = $this->input->post($key,TRUE);
			}elseif($key == 'bsp_rates'){
				$data['rate'] = json_encode($this->input->post($key,TRUE));
			}elseif($key == 'qprojects'){
				$data['projects'] = json_encode($this->input->post($key,TRUE));
			}  
		}

		if($additional_input){
			foreach ($additional_input as $key => $value) {
				$data[$key] = $value;
			}
		}

		if(@$_FILES['files']['name']){
			$files_name = '';
			$totalf = count(@$_FILES['files']['name']);
			for( $i=0 ; $i < $totalf ; $i++ ) {  
					if(@$_FILES['files']['tmp_name'][$i]){
						$dname = explode(".", $_FILES['files']['name'][$i]);
						$ext = end($dname);
						@$files_name.=$i.'-id-'.$_FILES['files']['name'][$i].',';
			}}
			$data['attached_files'] = $files_name;
		}

		if($block_forms_fields==1){
			$data = []; // clear form files
		}

		if($type == 1){

			$data['date_created'] = date("Y-m-d H:i:s");
		    $data['user_id'] = $user_id;

			$result = $this->db->insert($table, $data);
			$inserted_id = $this->db->insert_id();
			$result = ($this->db->affected_rows() != 1) ? false : true; 

			return array(
				'result'          => $result,
				'query_id'     => $inserted_id 
			);

		}elseif($type == 2){

			$data['date_modified'] = date("Y-m-d H:i:s");
		    $data['modified_by'] = $user_id;

		    $this->db->where('id',$id); 
			$result = $this->db->update($table, $data); 
			$result = ($this->db->affected_rows() != 1) ? false : true;

			return array(
				'result'          => $result,
				'query_id'     => $id 
			);

		}elseif($type == 3){

			$data['deleted'] = 1;
		    $data['date_deleted'] = date("Y-m-d H:i:s");
		    $data['deleted_by'] = $user_id;

			$this->db->where('id',$id); 
			$this->db->update($table,$data); 
			$result = ($this->db->affected_rows() != 1) ? false : true;

			return array(
				'result'          => $result,
				'query_id'        => $id 
			);

		}elseif($type == 4){

			$data = [];

			$data['date_created'] = date("Y-m-d H:i:s");
		    $data['user_id'] = $user_id; 
  
	    	 $data['inventory_id'] = $this->input->post('inventory_id',true);
	    	 $data['bbt_date'] = $this->input->post('bbt_date',true);
	    	 $data['remarks'] = $this->input->post('remarks',true);
	    	 
	    	 $c = 0;
	    	 $issue = '';

	    	 while($this->input->post('count_f',true)>$c){
	    	 	$c+=1;
	    	 	$issue.= $this->input->post('no_of_skt_failed'.$c,true).'-[and]-'.$this->input->post('issue'.$c,true).'-[end]-'; 
	    	 }

	    	 $data['issue'] = $issue;

	    	 $result = $this->db->insert($table, $data);
	    	 
	    	 $master_id = $this->db->insert_id();
		    	  
			$result = ($this->db->affected_rows() != 1) ? false : true; 

			return array(
				'result'          => $result,
				'query_id'     => $master_id
			);

		}

	}

	public function load_inventory_data(){ 
				
		$inventory  = array(); 
		$search_arr = array();
		$totaldata = 0;  
		$rs_employee = array(); 
		 

		
		/* search */  
		$search = $_POST['search']['value']; 
		$this->db->group_start();
		$this->db->like('a.name', $search); 
		$this->db->or_like('a.short_description', $search);
		$this->db->or_like('b.title', $search);
		$this->db->or_like('c.title', $search); 
		$this->db->or_like('d.title', $search); 
		$this->db->or_like('e.title', $search); 
		$this->db->group_end();

		$this->db->where(array('deleted'=>0)); 

		  
		$this->db->select('a.id');

        $this->db->from('inventory a'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left'); 
        $this->db->order_by('a.id', 'DESC');

        $fixed_assets = $this->db->get(); 
		$totaldata = $fixed_assets->num_rows();

		/* order by
		$column_order = array(null, 'name','department','designation','nationality'); //set column field database for datatable orderable
	    $column_search = array('name','department','designation','nationality'); //set column field database for datatable searchable 
		$order = array('id' => 'asc');
		 
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		} */
		
		/* search */  
		$search = $_POST['search']['value']; 
		$this->db->group_start();
		$this->db->like('a.name', $search); 
		$this->db->or_like('a.short_description', $search);
		$this->db->or_like('a.item_code', $search);
		$this->db->or_like('b.title', $search);
		$this->db->or_like('c.title', $search); 
		$this->db->or_like('d.title', $search); 
		$this->db->or_like('e.title', $search);
		//$this->db->or_like('g.name', $search); 
		//$this->db->or_like('g.control_number', $search);  
		$this->db->group_end();

		$this->db->where(array('deleted'=>0)); 

		/* limit table data */  
		if($_REQUEST['length']>=0){
		$this->db->limit($_REQUEST['length'],$_REQUEST['start']);
		}

		$this->db->select('a.*,
			b.title as type_title,
			c.title as category_title,
			d.title as uom_title,
			e.title as classification_title
			');

        $this->db->from('inventory a'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left'); 
        //$this->db->order_by('a.id', 'DESC');

        $query = $this->db->get()->result();  
		
		//$this->output->enable_profiler(TRUE);
		
		return array(
			'inventory'      => $query,
			'totaldata'      => $totaldata,
			'draw' 		     => $_POST['draw'] 
		);
 

	}


	public function load_inventory_breakdown_data($is_proj=''){ 
				
		$inventory  = array(); 
		$search_arr = array();
		$totaldata = 0;  
		$rs_employee = array(); 
		  
		/* search */  
		$search = @$_POST['search']['value']; 
		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('f.po_number', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search); 
			$this->db->group_end();
		}

		$this->db->where(array('rri.deleted'=>0)); 
		if($is_proj || @$_GET['is_project']==1){
			$this->db->where('rri.control_number_type=2'); 
		}else{
			$this->db->where('i.is_in_inventory=1'); 
			$this->db->where('rri.control_number_type=1'); 
		}

		if(@$_GET['filter_accounts']>0){
			$this->db->where(array('rri.inventory_accounts_id'=>$_GET['filter_accounts'])); 
		}
		if(@$_GET['project_id']>0){
			$this->db->where(array('rri.project_id'=>$_GET['project_id'])); 
		}
 
		$this->db->select('rri.id');

        $this->db->from('receiving_report_items rri');  
        $this->db->join('inventory a', 'a.id=rri.inventory_id', 'inner left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left'); 
        $this->db->join('receiving_report h', 'h.id=rri.receiving_report_id', 'left'); 
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id', 'left');
		/* count total */    
		$query = $this->db->get(); 
		$totaldata = $query->num_rows();

	 	// start 
 
		/* search */  
		$search = @$_POST['search']['value']; 

		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('f.po_number', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search);  
			$this->db->or_like('i.title', $search); 
			$this->db->group_end();
		}

		$this->db->where(array('rri.deleted'=>0)); 
		if($is_proj || @$_GET['is_project']==1){
			$this->db->where('rri.control_number_type=2'); 
		}else{
			$this->db->where('i.is_in_inventory=1'); 
			$this->db->where('rri.control_number_type=1'); 
		}

	 
		$this->db->order_by('i.title, CAST(a.item_code AS UNSIGNED)', 'ASC'); 
		  
		if(@$_GET['filter_accounts']>0){
			$this->db->where(array('rri.inventory_accounts_id'=>$_GET['filter_accounts'])); 
		}
		if(@$_GET['project_id']>0){
			$this->db->where(array('rri.project_id'=>$_GET['project_id'])); 
		}

		/* limit data */  
		if(@$_REQUEST['length']>=0){
		$this->db->limit($_REQUEST['length'],$_REQUEST['start']);
		}

		$this->db->select('rri.*,
			rri.id as rri_id,
			rri.date_created as dc,
			rri.in_qty as in_qty_rri,
			rri.out_qty as out_qty_rri,
			rri.qty as qty_rri,
			rri.date_modified as date_modified_rri,
			rri.item_name as po_item_name,
			rri.item_desc as po_item_desc,
			((rri.freight_charge_amount / rri.in_qty) * rri.qty) as freight_charge_amount,
			a.*, 
			b.title as type_title,
			c.title as category_title,
			d.title as uom_title,
			e.title as classification_title,
			f.project_id as project_id,
			f.po_number as po_number,
			g.id as project_id,
			g.name as project_name,
			g.control_number as project_control_number,
			h.invoice_number as invoice_number,
			h.dr_number as dr_number, 
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy,
			i.title as inventory_accounts_title,
			i.ds as inventory_accounts_code
			');

        $this->db->from('receiving_report_items rri');  
        $this->db->join('inventory a', 'a.id=rri.inventory_id', 'inner left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left'); 
        $this->db->join('receiving_report h', 'h.id=rri.receiving_report_id', 'left');  
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id', 'left');
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        //$this->db->order_by('rri.id', 'DESC'); 

     	$query = $this->db->get()->result();

		//$this->output->enable_profiler(TRUE);
		
		return array(
			'inventory'      => $query,
			'totaldata'      => $totaldata,
			'draw' 		     => $_POST['draw'] ,
			'query'			 => $this->db->last_query()
		);
 

	}


	public function load_inventory_project_data($is_proj=''){ 
				
		$inventory  = array(); 
		$search_arr = array();
		$totaldata = 0;  
		$rs_employee = array(); 
		  
		/* search */  
		$search = @$_POST['search']['value']; 
		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search);
			$this->db->or_like('h.title', $search);
			$this->db->group_end();
		}

		if(@$_GET['filter_accounts']>0){
			$this->db->where(array('rri.inventory_accounts_id'=>$_GET['filter_accounts'])); 
		}
		if(@$_GET['project_id']>0){
			$this->db->where(array('iii.project_id'=>$_GET['project_id'])); 
		}

		$this->db->where(array('rri.deleted'=>0));
		if($is_proj){
			$this->db->where('iii.project_id>0'); 
		}else{
			$this->db->where('rri.qty>0'); 
		}
		
  
		$this->db->select('iii.id');

        $this->db->from('issue_inventory_items iii');  
        $this->db->join('receiving_report_items rri', 'rri.id=iii.rri_id', 'inner left'); 
        $this->db->join('inventory a', 'a.id=iii.inventory_id', 'inner left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left'); 
        $this->db->join('fm_inventory_accounts h', 'h.id=rri.inventory_accounts_id', 'left');
		/* count total */    
		$query = $this->db->get(); 
		$totaldata = $query->num_rows();

	 	// start 
 
		/* search */  
		$search = @$_POST['search']['value']; 

		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search);  
			$this->db->or_like('i.title', $search); 
			$this->db->group_end();
		}

		$this->db->where(array('rri.deleted'=>0)); 
		if($is_proj){
			$this->db->where('iii.project_id>0'); 
		}else{
			$this->db->where('rri.qty>0'); 
		} 

		if(@$_GET['filter_accounts']>0){
			$this->db->where(array('rri.inventory_accounts_id'=>$_GET['filter_accounts'])); 
		}
		if(@$_GET['project_id']>0){
			$this->db->where(array('iii.project_id'=>$_GET['project_id'])); 
		}

		/* limit data */  
		if(@$_REQUEST['length']>=0){
		$this->db->limit($_REQUEST['length'],$_REQUEST['start']);
		}

		$this->db->select('
			iii.id as iii_id, 
			iii.qty as iii_qty, 
			iii.qty_return as iii_return,
			rri.*,
			rri.id as rri_id,
			rri.date_created as dc,
			rri.in_qty as in_qty_rri,
			rri.out_qty as out_qty_rri,
			rri.qty as qty_rri,
			rri.date_modified as date_modified_rri,
			rri.item_name as po_item_name,
			rri.item_desc as po_item_desc,
			a.*, 
			b.title as type_title,
			c.title as category_title,
			d.title as uom_title,
			e.title as classification_title,
			f.project_id as project_id,
			f.po_number as po_number,
			g.id as project_id,
			g.name as project_name,
			g.control_number as project_control_number,
			h.invoice_number as invoice_number,
			h.dr_number as dr_number, 
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy,
			i.title as inventory_accounts_title
			');

        $this->db->from('issue_inventory_items iii');  
        $this->db->join('receiving_report_items rri', 'rri.id=iii.rri_id', 'inner left');
        $this->db->join('inventory a', 'a.id=iii.inventory_id', 'inner left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=iii.project_id', 'left'); 
        $this->db->join('receiving_report h', 'h.id=rri.receiving_report_id', 'left');  
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id', 'left');
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        //$this->db->order_by('rri.id', 'DESC'); 

     	$query = $this->db->get()->result();

		//$this->output->enable_profiler(TRUE);
		
		return array(
			'inventory'      => $query,
			'totaldata'      => $totaldata,
			'draw' 		     => $_POST['draw'] 
		);
 

	}

	
	public function search_data($table, $select='', $fields='', $like_param='',$limit='', $excluded_ids='',$where = ''){
 		
 		if(@$limit){
 			$this->db->limit($limit, 0);	
 		}
 		if(@$select){
 			$this->db->select($select);
 		}
 		if(@$excluded_ids){
 			$this->db->where($excluded_ids);
 		}
 		if(@$where){
 			$this->db->where($where);
 		}
 		if(@$fields){
 			$this->db->group_start();
 			foreach($fields as $f){ 
 				$this->db->or_like($f, @$like_param, 'both'); 
 			}
 			$this->db->group_end();
 		}
		$this->db->from($table);
		 
		$this->db->where(array('deleted'=>0));
		$query = $this->db->get(); 
		return $query->result();

	}



	public function save_pr($approver = [])
	{
		$user_id = $this->session->user_id; 

		$rspr = $this->db->select('id')->get_where('purchase_request',[
			'year'=>date('Y') 
		])->num_rows();

		$data = [];
		$sib = '';
		$visible_to = '';
		$table = 'purchase_request';

		foreach ($this->db->list_fields($table) as $rs) {
			$arr_allow_field[$rs] = 1;
		}

		if(@$this->input->post('control_number_type',TRUE)==1){
			$iac = $this->db->get_where('fm_inventory_accounts',['id'=>@$this->input->post('inventory_accounts_id',TRUE)])->row();
			$pur_control_number = $iac->ds;
		}

		$data['date_created'] = date("Y-m-d H:i:s");
		$data['year'] = date("Y");
		$data['pr_number'] = 'PR'.date('y').'-'.sprintf("%04d",($rspr+317));
	    $data['user_id'] = $user_id;
	    $data['remarks'] = $this->input->post('remarks',TRUE);
	    //$data['request_type_id'] = @$this->input->post('request_type_id',TRUE);
	    $data['project_id'] = @$this->input->post('project_id',TRUE);
	    $data['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE); 
	    $data['pur_control_number'] = @$pur_control_number;
	    $data['control_number_type'] = @$this->input->post('control_number_type',TRUE);  

	    if(@$approver->pr1){
	    	$data['a1'] = $approver->pr1;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a1_status'] = 1;
	    		$data['a1_date'] = date('Y-m-d H:i');
	    	}
	    }
	    if(@$approver->pr2){
	    	$data['a2'] = $approver->pr2;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a2_status'] = 1;
	    		$data['a2_date'] = date('Y-m-d H:i');
	    	}
	    }
	    if(@$approver->pr3){
	    	$data['a3'] = $approver->pr3;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a3_status'] = 3;
	    		$data['a3_date'] = date('Y-m-d H:i');
	    	}
	    }

	    if(!@$has_approver || $approver->pr_auto_approved==1){
	    	$data['form_status'] = 1; // auto approved (1)
	    }

		$result = $this->db->insert($table, $data);
		$inserted_id = $this->db->insert_id();

		$row_counter = $this->input->post('row_counter',TRUE);
		$ccc = 0;

		while($row_counter>$ccc){

			$ccc+=1;

			if($this->input->post('qty'.$ccc,TRUE)>0){
 
	    	$item_data[] = [
	    		'inventory_id'=>$this->input->post('item'.$ccc,TRUE),
	    		'item_name'=>@$this->input->post('item_name'.$ccc,TRUE),
	    		'item_desc'=>@$this->input->post('item_desc'.$ccc,TRUE),
	    		'qty'=>$this->input->post('qty'.$ccc,TRUE),
	    		'new'=>$this->input->post('new'.$ccc,TRUE),
	    		'purchase_request_id'=>$inserted_id,
	    		'user_id'=>$user_id, 
	    		'date_created'=>date("Y-m-d H:i:s"),
	    	    'project_id'=>@$this->input->post('project_id',TRUE),
	    	    'inventory_accounts_id' => @$this->input->post('inventory_accounts_id',TRUE),
	    	    'pur_control_number' => @$pur_control_number
	    	    //'control_number_id'=>$this->input->post('cn'.$ccc,TRUE)
	    	];

	    	}
		 
		}

		if(@$new_item_data){
			$this->db->insert_batch('purchase_request_items', $new_item_data);
		}

		if(@$item_data){
			$this->db->insert_batch('purchase_request_items', $item_data);
		}

		return ['result'=>true];
	}

	 
	public function create_po($id, $approver = [])
	{
		$user_id = $this->session->user_id; 

		$rspo = $this->db->select('id')->get_where('purchase_order',[
			'year'=>date('Y'),
			'upload'=>0 
		])->num_rows();

		$rspr = $this->db->select('user_id,rev,po_ids')->get_where('purchase_request',[
			'id'=>$id 
		])->row();

		$pr_rev = $rspr->rev;
		$pr_po_ids = $rspr->po_ids ? json_decode($rspr->po_ids) : [];

		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}
  
		// 0001 validate if one of the items are successfuly be POéd
		$query = $this->db->get_where('purchase_request_items',['purchase_request_id'=>$id])->result();
		$pr_items_qty = 0;

		if(@$query){
		foreach($query as $rs){ 

			if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('po'.$rs->id,TRUE) != 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)>0){

 				$has_po_item = 1;

			}elseif($this->input->post('po'.$rs->id,TRUE) == 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('code'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0){

				$has_po_item = 1;

			}

		}}
		// 0001 end

		$data = []; 
		$table = 'purchase_order';

		$data['date_created'] = date("Y-m-d H:i:s");
	    $data['user_id'] = $user_id;
	    $data['requestor_id'] = $rspr->user_id;
	    $data['supplier_id'] = $this->input->post('supplier_id',TRUE);
	    $data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id',TRUE);
	    $data['delivery_date'] = $this->input->post('delivery_date',TRUE);
	    $data['currency_type_id'] = $this->input->post('currency_type_id',TRUE);
	    $data['purchase_type_id'] = $this->input->post('purchase_type_id',TRUE);
	    $data['purchase_request_id'] = $id;
	    $data['project_id'] = @$this->input->post('project_id',TRUE); //== null if for new stock
	    $data['request_type_id'] = @$this->input->post('request_type_id',TRUE); //=== hidden

	    $data['tax_type'] = $this->input->post('tax_type',TRUE);
	    $data['reference'] = $this->input->post('reference',TRUE);
	     
	    $data['delivery_place_id'] = $this->input->post('delivery_place_id',TRUE);
	    $data['terms_of_delivery_type_id'] = $this->input->post('terms_of_delivery_type_id',TRUE);
	    $data['year'] = date('Y');
	    $data['po_number'] = date('Y').'-'.sprintf("%04d",($rspo+395)); // format YYYY-####

	    $data['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE);
	    $data['pur_control_number'] = @$this->input->post('pur_control_number',TRUE);
	    $data['control_number_type'] = @$this->input->post('control_number_type',TRUE);
	    $data['pr_rev'] = $pr_rev;

	    $data['source'] = 0;

	    if(@$approver->po1){
	    	$data['a1'] = $approver->po1;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a1_status'] = 1;
	    		$data['a1_date'] = date('Y-m-d H:i');
	    	}
	    }
	    if(@$approver->po2){
	    	$data['a2'] = $approver->po2;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a2_status'] = 1;
	    		$data['a2_date'] = date('Y-m-d H:i');
	    	}
	    }
	    if(@$approver->po3){
	    	$data['a3'] = $approver->po3;
	    	$has_approver = 1;
	    	if($approver->pr_auto_approved==1){
	    		$data['a3_status'] = 1;
	    		$data['a3_date'] = date('Y-m-d H:i');
	    	}
	    }

	    if(!@$has_approver || $approver->po_auto_approved==1){
	    	$data['form_status'] = 1; // auto approved (1)
	    }

	    if(@$has_po_item){
	    	$result = $this->db->insert($table, $data);
	    	$po_id = $this->db->insert_id();
	    } 

	    if(!in_array($po_id,$pr_po_ids)){ 
	    	array_push($pr_po_ids, $po_id);
	    }
		  
		if(@$query && @$has_po_item){
		foreach($query as $rs){ 

			$pr_items_qty+=1;
			
			if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('po'.$rs->id,TRUE) != 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)>0){

				$data_old = [];
				$data_old['date_created'] = date("Y-m-d H:i:s");
			    $data_old['user_id'] = $user_id;

			    $data_old['purchase_order_id'] = $po_id;
			    $data_old['purchase_request_id'] = $rs->purchase_request_id;
			    $data_old['purchase_request_items_id'] = $rs->id;

			    $data_old['inventory_id'] = $rs->inventory_id;

			    $data_old['qty'] = $this->input->post('qty'.$rs->id,TRUE);
			    $data_old['price'] = $this->input->post('price'.$rs->id,TRUE);
			    $data_old['uom_conversion_id'] = $this->input->post('uom'.$rs->id,TRUE);

			    $data_old['item_name'] = $this->input->post('item_name'.$rs->id,TRUE);
			    $data_old['item_desc'] = $this->input->post('item_desc'.$rs->id,TRUE);

			    $data_old['control_number_type'] = @$this->input->post('control_number_type',TRUE); //== 1 PUR 2 SALES
			    $data_old['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE);
			    $data_old['pur_control_number'] = @$this->input->post('pur_control_number',TRUE);

			    $data_old['project_id'] = $rs->project_id;  
			    $data_old['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$rs->id,TRUE)]->factor; 
			    $data_old['pr_rev'] = $pr_rev; 

			    $batch_data_old[] = $data_old; 

			    $this->db->where('id',$rs->id)->update('purchase_request_items',['purchase_order_id'=>$po_id]);

			}elseif($this->input->post('po'.$rs->id,TRUE) == 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)>0){

				if($rs->item_name){
					$data_new = [];
					$data_new['date_created'] = date("Y-m-d H:i:s");
				    $data_new['user_id'] = $user_id; 
				    $data_new['source'] = 'purchase request';
				    $data_new['item_code'] = $this->input->post('code'.$rs->id,TRUE);
				    $data_new['name'] = $this->input->post('item_name'.$rs->id,TRUE);
				    $data_new['short_description'] = $this->input->post('item_desc'.$rs->id,TRUE);
				    $data_new['inventory_type_id'] = $this->input->post('type'.$rs->id,TRUE);
				    $data_new['inventory_category_id'] = $this->input->post('category'.$rs->id,TRUE);
				    $data_new['classification_id'] = $this->input->post('classification'.$rs->id,TRUE);
				    $data_new['uom_type_id'] = @$arr_uc[$this->input->post('uom'.$rs->id,TRUE)]->base_uom_id;
  
					$result = $this->db->insert('inventory', $data_new);
					$new_inv_id = $this->db->insert_id();
				}

				//============ Insert New Data
				if(@$new_inv_id > 0){
					$data_new = [];
					$data_new['date_created'] = date("Y-m-d H:i:s");
				    $data_new['user_id'] = $user_id;

				    $data_new['purchase_order_id'] = $po_id;
				    $data_new['purchase_request_id'] = $rs->purchase_request_id;
				    $data_new['purchase_request_items_id'] = $rs->id;

				    $data_new['inventory_id'] = $new_inv_id;

				    $data_new['qty'] = $this->input->post('qty'.$rs->id,TRUE);
				    $data_new['price'] = $this->input->post('price'.$rs->id,TRUE);
				    $data_new['uom_conversion_id'] = $this->input->post('uom'.$rs->id,TRUE);

				    $data_new['item_name'] = $this->input->post('item_name'.$rs->id,TRUE);
				    $data_new['item_desc'] = $this->input->post('item_desc'.$rs->id,TRUE);

				    $data_new['control_number_type'] = @$this->input->post('control_number_type',TRUE); //== 1 PUR 2 SALES
				    $data_new['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE);
				    $data_new['pur_control_number'] = @$this->input->post('pur_control_number',TRUE);

				    $data_new['project_id'] = $rs->project_id; 
				    $data_new['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$rs->id,TRUE)]->factor;
				    $data_new['pr_rev'] = $pr_rev; 

				    $batch_data_new[] = $data_new; 

				    $this->db->where('id',$rs->id)->update('purchase_request_items',['purchase_order_id'=>$po_id]);
				}

			}
		}}

		if(@$batch_data_old){
			$this->db->insert_batch('purchase_order_items', $batch_data_old);
		}
		if(@$batch_data_new){
			$this->db->insert_batch('purchase_order_items', $batch_data_new);
		}

		// if non of the item query insert is successful 
		if(!@$batch_data_old && !@$batch_data_new){
			$this->db->where('id',$po_id)->delete('purchase_order');
		}

		// update PR PO-status status
		$cuurent_po_item_count = $this->db->select('id')->get_where('purchase_order_items',[
			'purchase_request_id'=>$id
		])->num_rows();
 		
 		if($pr_items_qty>$cuurent_po_item_count){
 			$this->db->where('id',$id)->update('purchase_request',['po_status'=>2,'po_ids'=>json_encode($pr_po_ids)]); // partial status
 		}elseif($pr_items_qty == $cuurent_po_item_count){ 
 			$this->db->where('id',$id)->update('purchase_request',['po_status'=>1,'po_ids'=>json_encode($pr_po_ids)]); // completed status
 		}
 

 		if(@$has_po_item == 1){
			return ['result'=>true];
 		}else{
 			return ['result'=>false];
 		}
		 
	}


	public function create_po_multi_pr()
	{
		//NOTE!!! item count will be diffierent since it will be consolidated on PO
		//NOTE!!! item count will be diffierent since it will be consolidated on PO
		//NOTE!!! item count will be diffierent since it will be consolidated on PO
		$user_id = $this->session->user_id; 

		$rspo = $this->db->select('id')->get_where('purchase_order',[
			'year'=>date('Y'),
			'upload'=>0 
		])->num_rows();
 
		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}
		 
		if(@$this->input->post('pr_ids',TRUE)){  
			$pr_ids = explode(',',@$this->input->post('pr_ids',TRUE));
			
			foreach ($pr_ids as $id) {  
 
			$has_po_item = 0;

			$rspr = $this->db->select('user_id,rev,po_ids')->get_where('purchase_request',[
				'id'=>$id 
			])->row();

			$pr_rev = $rspr->rev; 
			$pr_po_ids = $rspr->po_ids ? json_decode($rspr->po_ids) : [];
		 
				// 0001 validate if one of the items are successfuly be POéd
				$query = $this->db->select('id,inventory_id,purchase_request_id,project_id,item_name,item_desc')->get_where('purchase_request_items',['purchase_request_id'=>$id])->result();
				$pr_items_qty = 0;

				if(@$query){
				foreach($query as $rs){   

					// echo $this->input->post('po'.$rs->id,TRUE)." == 'new' && ".$this->input->post('price'.$rs->id,TRUE).">0 && ".$this->input->post('code'.$rs->id,TRUE)." && ".$this->input->post('qty'.$rs->id,TRUE).">0<hr/>";
 
					if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('po'.$rs->id,TRUE) != 'new' && $this->input->post('price'.$rs->inventory_id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)>0){

		 				$has_po_item = 1;

					}elseif($this->input->post('po'.$rs->id,TRUE) == 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('code'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0){

						$has_po_item = 1;

					}

				}}
				// 0001 end

				$data = []; 
				$table = 'purchase_order';

				$data['date_created'] = date("Y-m-d H:i:s");
			    $data['user_id'] = $user_id;
			    $data['requestor_id'] = $rspr->user_id;
			    $data['supplier_id'] = $this->input->post('supplier_id',TRUE);
			    $data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id',TRUE);
			    $data['delivery_date'] = $this->input->post('delivery_date',TRUE);
			    $data['currency_type_id'] = $this->input->post('currency_type_id',TRUE);
			    $data['purchase_type_id'] = $this->input->post('purchase_type_id',TRUE);
			    $data['purchase_request_ids'] = $this->input->post('pr_ids',TRUE); // no need since its multi PR
			    $data['project_id'] = $this->input->post('project_id',TRUE);
			    $data['request_type_id'] = $this->input->post('request_type_id',TRUE);

			    $data['tax_type'] = $this->input->post('tax_type',TRUE);
			    $data['reference'] = $this->input->post('reference',TRUE);
			     
			    $data['delivery_place_id'] = $this->input->post('delivery_place_id',TRUE);
			    $data['terms_of_delivery_type_id'] = $this->input->post('terms_of_delivery_type_id',TRUE);
			    $data['year'] = date('Y');
			    $data['po_number'] = date('Y').'-'.sprintf("%04d",($rspo+395)); // format YYYY-####

			    $data['source'] = 1;

			    $data['project_ids'] = $this->input->post('project_ids',TRUE);

			    $data['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE);
			    $data['pur_control_number'] = @$this->input->post('pur_control_number',TRUE);
			    $data['control_number_type'] = @$this->input->post('control_number_type',TRUE);
			    $data['pr_rev'] = $pr_rev;

			    if(@$this->input->post('app1',TRUE)){
			    	$data['a1'] = $this->input->post('app1',TRUE);
			    	$data['am1'] = $this->input->post('app1s',TRUE); 
			    }
			    if(@$this->input->post('app2',TRUE)){
			    	$data['a2'] = $this->input->post('app2',TRUE);
			    	$data['am2'] = $this->input->post('app2s',TRUE); 
			    }
			    if(@$this->input->post('app3',TRUE)){
			    	$data['a3'] = $this->input->post('app3',TRUE);
			    	$data['am3'] = $this->input->post('app3s',TRUE); 
			    }

			    if($this->input->post('app_settings',TRUE)==2){ 
			    	$data['form_status'] = 1; // auto approved (1) 

			    	$data['a1_status'] = $data['a1'] ? 1 : 0;
			    	$data['a2_status'] = $data['a2'] ? 1 : 0;
			    	$data['a3_status'] = $data['a3'] ? 1 : 0;

			    	$data['a1_date'] = $data['a1'] ? date('Y-m-d H:i') : '';
			    	$data['a2_date'] = $data['a2'] ? date('Y-m-d H:i') : '';
			    	$data['a3_date'] = $data['a3'] ? date('Y-m-d H:i') : '';
			    }



			    if(@$has_po_item && !@$po_id){ 
			    	$result = $this->db->insert($table, $data);
			    	$po_id = $this->db->insert_id();
			    	//print_r($this->db->last_query());
			    } 

			    if(!in_array($po_id,$pr_po_ids)){ 
			    	array_push($pr_po_ids, $po_id);
			    }

			    $update_pr_items_poed = [];
				  
				if(@$query && @$has_po_item && @$po_id){
				foreach($query as $rs){ 
 					
					 //echo $this->input->post('po'.$rs->id,TRUE)." == 'new' && ".$this->input->post('price'.$rs->inventory_id,TRUE).">0 && ".$this->input->post('code'.$rs->id,TRUE)." && ".$this->input->post('qty'.$rs->id,TRUE).'<hr/>';

					$pr_items_qty+=1;
					
					@$arr_pri_qty[$id]+=1; 
 
					 
					if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('po'.$rs->id,TRUE) != 'new' && $this->input->post('price'.$rs->inventory_id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)>0){
  		
						$data_old = [];
						$data_old['date_created'] = date("Y-m-d H:i:s");
					    $data_old['user_id'] = $user_id;

					    $data_old['purchase_order_id'] = $po_id;
					    $data_old['purchase_request_id'] = $rs->purchase_request_id;
					    $data_old['purchase_request_items_id'] = $rs->id;

					    $data_old['inventory_id'] = $rs->inventory_id;

					    $data_old['qty'] = $this->input->post('qty'.$rs->id,TRUE);
					    $data_old['price'] = $this->input->post('price'.$rs->inventory_id,TRUE);
					    $data_old['uom_conversion_id'] = $this->input->post('uom'.$rs->inventory_id,TRUE);

					    $data_old['item_name'] = $this->input->post('item_name'.$rs->inventory_id,TRUE);
					    $data_old['item_desc'] = $this->input->post('item_desc'.$rs->inventory_id,TRUE);

					    //== 1 PUR 2 SALES
					    if(@$this->input->post('inventory_accounts_id'.$rs->id,TRUE)){
					    	$data_old['control_number_type'] = 1;
					    }else{
					    	$data_old['control_number_type'] = 2;
					    }
					    
					    $data_old['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id'.$rs->id,TRUE);
					    $data_old['pur_control_number'] = @$this->input->post('pur_control_number'.$rs->id,TRUE);

					    $data_old['control_number_id'] = @$this->input->post('project_id'.$rs->id,TRUE);
					    $data_old['project_id'] = @$this->input->post('project_id'.$rs->id,TRUE); 
					    $data_old['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$rs->id,TRUE)]->factor; 
					    $data_old['pr_rev'] = $pr_rev;

					    $batch_data_old[] = $data_old; 

					    $this->db->where('id',$rs->id)->update('purchase_request_items',['purchase_order_id'=>$po_id]);

					}elseif($this->input->post('po'.$rs->id,TRUE) == 'new' && $this->input->post('price'.$rs->id,TRUE)>0 && $this->input->post('code'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0){
					 
						if(@$rs->item_name){
 
							$data_new = [];
							$data_new['date_created'] = date("Y-m-d H:i:s");
						    $data_new['user_id'] = $user_id; 
						    $data_new['source'] = 'purchase request';
						    $data_new['item_code'] = $this->input->post('code'.$rs->id,TRUE);
						    $data_new['name'] = $this->input->post('item_name'.$rs->id,TRUE);
						    $data_new['short_description'] = $this->input->post('item_desc'.$rs->id,TRUE);
						    $data_new['inventory_type_id'] = $this->input->post('type'.$rs->id,TRUE);
						    $data_new['inventory_category_id'] = $this->input->post('category'.$rs->id,TRUE);
						    $data_new['classification_id'] = $this->input->post('classification'.$rs->id,TRUE);
						    $data_new['uom_type_id'] = @$arr_uc[$this->input->post('uom'.$rs->id,TRUE)]->base_uom_id;
		  
							$result = $this->db->insert('inventory', $data_new);
							$new_inv_id = $this->db->insert_id();
						}

						//============ Insert New Data
						if(@$new_inv_id > 0){
							$data_new = [];
							$data_new['date_created'] = date("Y-m-d H:i:s");
						    $data_new['user_id'] = $user_id;

						    $data_new['purchase_order_id'] = $po_id;
						    $data_new['purchase_request_id'] = $rs->purchase_request_id;
						    $data_new['purchase_request_items_id'] = $rs->id;

						    $data_new['inventory_id'] = $new_inv_id;

						    $data_new['qty'] = $this->input->post('qty'.$rs->id,TRUE);
						    $data_new['price'] = $this->input->post('price'.$rs->id,TRUE);
						    $data_new['uom_conversion_id'] = $this->input->post('uom'.$rs->id,TRUE);

						    $data_new['item_name'] = $this->input->post('item_name'.$rs->id,TRUE);
						    $data_new['item_desc'] = $this->input->post('item_desc'.$rs->id,TRUE);

						    //== 1 PUR 2 SALES
						    if(@$this->input->post('inventory_accounts_id'.$rs->id,TRUE)){
						    	$data_new['control_number_type'] = 1;
						    }else{
						    	$data_new['control_number_type'] = 2;
						    }

						    $data_new['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id'.$rs->id,TRUE);
						    $data_new['pur_control_number'] = @$this->input->post('pur_control_number'.$rs->id,TRUE);

						    $data_new['project_id'] = $rs->project_id; 
						    $data_new['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$rs->id,TRUE)]->factor; 
						    $data_new['pr_rev'] = $pr_rev;

						    $batch_data_new[] = $data_new; 

						    $this->db->where('id',$rs->id)->update('purchase_request_items',['purchase_order_id'=>$po_id]);

						}

					}
				}}

				if(@$batch_data_old){
					$query_old = $this->db->insert_batch('purchase_order_items', $batch_data_old);
				}
				if(@$batch_data_new){
					$query_new = $this->db->insert_batch('purchase_order_items', $batch_data_new);
				}

				// if non of the item query insert is successful 
				if(!@$query_old && !@$query_new && @$po_id){
					$this->db->where('purchase_order_id',$po_id)->delete('purchase_order_items');
					$this->db->where('id',$po_id)->delete('purchase_order'); 
				}
 
				
				// update PR item & PR-status (with po item id in BATCH MODE)
				$po_count = 0;
				$batch_prpo = [];

				foreach( $this->db->select('id,purchase_request_items_id')->get_where('purchase_order_items',[
					'purchase_request_id'=>$id
				])->result() as $prpo){ 
					$po_count+=1;
					if($prpo->purchase_request_items_id){
						$data_prpo = [];
						$data_prpo = array(
							'id' => $prpo->purchase_request_items_id,
							'purchase_order_items_id' => $prpo->id);
						$batch_prpo[] = $data_prpo; 
					}
				}
 

				if(@$batch_prpo){

					//$this->db->update_batch('purchase_request_items',$batch_prpo, 'id');  //BATCH

					foreach($batch_prpo as $brs){ 
						$this->db->where('id',$brs['id'])->update('purchase_request_items',[
							'purchase_order_items_id'=>$brs['purchase_order_items_id'],
							'date_modified'=>date('Y-m-d H:i')
						]); 
					}

				} 

				$cuurent_pr_item_count = $this->db->select('id')->get_where('purchase_request_items',[
					'purchase_request_id'=>$id
				])->num_rows();

				$cuurent_po_item_count = $this->db->select('id')->get_where('purchase_order_items',[
					'purchase_request_id'=>$id
				])->num_rows();
		 		
		 		if($cuurent_pr_item_count>$cuurent_po_item_count){ 
		 			$this->db->where('id',$id)->update('purchase_request',['po_status'=>2,'po_ids'=>json_encode($pr_po_ids)]); // partial status
		 		}elseif($cuurent_pr_item_count == $cuurent_po_item_count){ 
		 			$this->db->where('id',$id)->update('purchase_request',['po_status'=>1,'po_ids'=>json_encode($pr_po_ids)]); // completed status
		 		} 

		 		$batch_data_old = []; 
		 		$batch_data_new = []; 
		 	}
		 }

 		if(@$has_po_item == 1){
			return ['result'=>true];
 		}else{
 			return ['result'=>false];
 		}
		

	}


	public function create_direct_po()
	{
		$user_id = $this->session->user_id; 

		$rspo = $this->db->select('id')->get_where('purchase_order',[
			'year'=>date('Y'),
			'upload'=>0  
		])->num_rows();
 

		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}

		if(@$this->input->post('items',TRUE)){
		foreach($this->input->post('items',TRUE) as $k => $inventory_id){ 

			// echo @$this->input->post('qty'.$k,TRUE).' > 0 &&  '.@$this->input->post('price'.$k,TRUE).' > 0 && '.@$this->input->post('uom'.$k,TRUE).' && '.@$this->input->post('project_id'.$k,TRUE).'<hr/>';

			if( @$this->input->post('qty'.$k,TRUE) > 0 &&  @$this->input->post('price'.$k,TRUE) > 0 && @$this->input->post('uom'.$k,TRUE) && @$this->input->post('project_id'.$k,TRUE)){

				$prj_id = @$this->input->post('project_id'.$k,TRUE);

				if(!@$aprj[$inventory_id]){

					@$aprj[$inventory_id] = $prj_id;
					$project_ids = $prj_id;
					
				}else{
					@$project_ids.= ','.$prj_id;
				}

			}

		}}
 
		// 0001 end

		$data = []; 
		$table = 'purchase_order';

		$data['date_created'] = date("Y-m-d H:i:s");
	    $data['user_id'] = $user_id;
	    $data['requestor_id'] = 0;
	    $data['supplier_id'] = $this->input->post('supplier_id',TRUE);
	    $data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id',TRUE);
	    $data['delivery_date'] = $this->input->post('delivery_date',TRUE);
	    $data['currency_type_id'] = $this->input->post('currency_type_id',TRUE);
	    $data['purchase_type_id'] = $this->input->post('purchase_type_id',TRUE);
	    $data['purchase_request_id'] = 0;
	    $data['project_id'] = $this->input->post('project_id',TRUE);
	    //$data['request_type_id'] = $this->input->post('request_type_id',TRUE);
	    $data['delivery_place_id'] = $this->input->post('delivery_place_id',TRUE);
	    $data['terms_of_delivery_type_id'] = $this->input->post('terms_of_delivery_type_id',TRUE);
	    
	    $data['tax_type'] = $this->input->post('tax_type',TRUE); 
	    $data['reference'] = $this->input->post('reference',TRUE);

	    $data['project_ids'] = @$project_ids;

	    $data['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id',TRUE);
	    $data['pur_control_number'] = @$this->input->post('pur_control_number',TRUE);
	    $data['control_number_type'] = @$this->input->post('control_number_type',TRUE);

	    $data['year'] = date('Y');
	    $data['po_number'] = date('Y').'-'.sprintf("%04d",($rspo+395)); // format YYYY-####
	    $data['direct_po'] = 1;
	    $data['source'] = 2;

	    if(@$this->input->post('app1',TRUE)){
	    	$data['a1'] = $this->input->post('app1',TRUE);
	    	$data['am1'] = $this->input->post('app1s',TRUE); 
	    }
	    if(@$this->input->post('app2',TRUE)){
	    	$data['a2'] = $this->input->post('app2',TRUE);
	    	$data['am2'] = $this->input->post('app2s',TRUE); 
	    }
	    if(@$this->input->post('app3',TRUE)){
	    	$data['a3'] = $this->input->post('app3',TRUE);
	    	$data['am3'] = $this->input->post('app3s',TRUE); 
	    }

	    if($this->input->post('app_settings',TRUE)==2){ 
	    	$data['form_status'] = 1; // auto approved (1) 
	    	
	    	$data['a1_status'] = $data['a1'] ? 1 : 0;
	    	$data['a2_status'] = $data['a2'] ? 1 : 0;
	    	$data['a3_status'] = $data['a3'] ? 1 : 0;

	    	$data['a1_date'] = $data['a1'] ? date('Y-m-d H:i') : '';
	    	$data['a2_date'] = $data['a2'] ? date('Y-m-d H:i') : '';
	    	$data['a3_date'] = $data['a3'] ? date('Y-m-d H:i') : '';
	    }
 
    	$result = $this->db->insert($table, $data);
    	$po_id = $this->db->insert_id();
	  
 
		if(@$this->input->post('items',TRUE)){
		foreach($this->input->post('items',TRUE) as $k => $inventory_id){ 

			 // echo @$this->input->post('qty'.$k,TRUE).' > 0 &&  '.@$this->input->post('price'.$k,TRUE).' > 0 && '.@$this->input->post('uom'.$k,TRUE).' && '.@$this->input->post('control_number'.$k,TRUE).'<hr/>';

			if( @$this->input->post('qty'.$k,TRUE) > 0 &&  @$this->input->post('price'.$k,TRUE) > 0 && @$this->input->post('uom'.$k,TRUE) && @$this->input->post('control_number'.$k,TRUE)){

				list($pur_type,$control_number_id) = explode('-',@$this->input->post('control_number'.$k,TRUE));
 
				$data_old = [];
				$data_old['date_created'] = date("Y-m-d H:i:s");
			    $data_old['user_id'] = $user_id;

			    $data_old['purchase_order_id'] = $po_id;
			    $data_old['purchase_request_id'] = 0;
			    $data_old['purchase_request_items_id'] = 0;

			    $data_old['inventory_id'] = $inventory_id;

			    $data_old['qty'] = @$this->input->post('qty'.$k,TRUE);
			    $data_old['price'] = @$this->input->post('price'.$k,TRUE);
			    $data_old['uom_conversion_id'] = @$this->input->post('uom'.$k,TRUE);

			    $data_old['item_name'] = @$this->input->post('item_name'.$k,TRUE);
			    $data_old['item_desc'] = @$this->input->post('item_desc'.$k,TRUE);

			    //== 1 PUR 2 SALES
			    if($pur_type == 1){ //==puchasing
			    	$data_old['control_number_type'] = 1;
			    	$pur_control_number = $control_number_id;
			    	$control_number_id = '';
			    }else{ //==sales / projs
			    	$data_old['control_number_type'] = 2;
			    	$pur_control_number = '';
			    }
			    
			    $data_old['control_number_id'] = $control_number_id;
			    $data_old['inventory_accounts_id'] = @$this->input->post('inventory_accounts_id'.$k,TRUE);
			    $data_old['pur_control_number'] = $pur_control_number; 

			    $data_old['project_id'] = @$control_number_id;
			    $data_old['uom_conversion_factor'] = @$arr_uc[@$this->input->post('uom'.$k,TRUE)]->factor; 

			    $batch_data_old[] = $data_old; 

			}
 
		}}

		if(@$batch_data_old){
			$this->db->insert_batch('purchase_order_items', $batch_data_old);
		} 

		// if non of the item query insert is successful 
		if(!@$batch_data_old){
			$this->db->where('id',$po_id)->delete('purchase_order');
		}
 
 		if(@$batch_data_old){
			return ['result'=>true];
 		}else{
 			return ['result'=>false];
 		}
		

	}
 
	public function create_receiving($id)
	{
		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'receiving_report';
  
		$rsrr = $this->db->select('id')->get_where('receiving_report',[
			'year'=>date('Y') 
		])->num_rows();

		$po = $this->db->select('project_id,currency_type_id,supplier_id,tax_type')->get_where('purchase_order',['id'=>$id])->row();

		$currency_type_id = $po->currency_type_id;
		$project_id = $po->project_id;
		
		$rrdata['date_created'] = $date;
		$rrdata['user_id'] = $user_id;

		$rrdata['purchase_order_id'] = $id; 
		$rrdata['invoice_number'] = $this->input->post('invoice_number',TRUE);  
		$rrdata['dr_number'] = $this->input->post('dr_number',TRUE); 
		$rrdata['tax_type'] = $po->tax_type; 

		$rrdata['due_date'] = $this->input->post('due_date',TRUE); 
		$rrdata['received_by_id'] = $this->input->post('received_by_id',TRUE);  

		$rrdata['project_id'] = $project_id;  

		$rrdata['year'] = date('Y');
		$rrdata['rr_number'] = date('y').'-'.sprintf("%04d",($rsrr+1)); // format YYYY-####

		$data_iv['supplier_id'] = $po->supplier_id; 

		$this->db->insert('receiving_report', $rrdata);
		$rr_id = $this->db->insert_id();

		$rr_number = $rrdata['rr_number'];
		 

		$rr_qty = 0;

		$rr_items = $this->db->select('id,qty')->get_where('receiving_report_items',['purchase_order_id'=>$id])->result();
		if(@$rr_items){
			foreach($rr_items as $rs){
				$rr_qty+=$rs->qty;
			}
		}

		
		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}

		$po_items = $this->db->get_where('purchase_order_items',['purchase_order_id'=>$id])->result();
		
		$po_qty = 0;

		$ids = '';

		if(@$po_items){
		foreach($po_items as $rs){
			$ids.= ' OR id='.$rs->id;
		}}

		if($ids){

			$ids = '('.$ids;
			$ids = str_replace('( OR','',$ids);

			$inv = $this->db->select('id,qty,in_qty')->get_where('inventory',$ids)->result();
			if(@$inv){
				foreach($inv as $rs){  
					@$arr_cqty[$rs->id]=$rs->qty;
					@$arr_iqty[$rs->id]=$rs->in_qty;
				}
			}
		}

		if(@$po_items){
		foreach($po_items as $rs){
			
			$po_qty+=$rs->qty;

			if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)<=$rs->qty){

				$rr_qty+=$this->input->post('qty'.$rs->id,TRUE);

				$data_rr = [];
				$data_rr['date_created'] = $date;
			    $data_rr['user_id'] = $user_id;

			    $data_rr['receiving_report_id'] = $rr_id;
			    $data_rr['rr_number'] = $rr_number;

			    $data_rr['purchase_order_id'] = $id; 
			    $data_rr['purchase_order_items_id'] = $rs->id;

			    $data_rr['project_id'] = @$rs->project_id;
			    $data_rr['control_number_type'] = $rs->control_number_type;  //== 1 PUR 2 SALES
			    $data_rr['pur_control_number'] = $rs->pur_control_number;

			    $data_rr['inventory_id'] = $rs->inventory_id;
			    $data_rr['uom_conversion_id'] = $rs->uom_conversion_id; 
			    $data_rr['uom_conversion_factor'] = $rs->uom_conversion_factor;

			    $uom_factor = @$arr_uc[$rs->uom_conversion_id]->factor ? $arr_uc[$rs->uom_conversion_id]->factor : 1;

			    $data_rr['qty'] = $this->input->post('qty'.$rs->id,TRUE); // the initial quantity
				$data_rr['in_qty'] = ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor); 

			    $data_rr['uom_factor'] = $uom_factor;

			    $data_rr['remarks'] = $this->input->post('remarks'.$rs->inventory_id,TRUE);

			    $data_rr['inventory_accounts_id'] = @$this->input->post('inventory_accounts'.$rs->inventory_id,TRUE);
			    $data_rr['inventory_accounts_id_rr'] = @$this->input->post('inventory_accounts'.$rs->inventory_id,TRUE);

			    $data_rr['price'] = $rs->price; 
			    $data_rr['currency_type_id'] = @$currency_type_id; 

			    $data_rr['item_name'] = $rs->item_name; 
			    $data_rr['item_desc'] = $rs->item_desc; 

			    $data_rr['date_modified'] = date('Y-m-d H:i'); 
			    $data_rr['modified_by'] = $user_id;

			    //$batch_data_rr[] = $data_rr; 
			    $this->db->insert('receiving_report_items', $data_rr);
			    $rri_id = $this->db->insert_id();
			    $arr_po_rri[$rs->id] = $rri_id;

			    $this->db->where('id',$rs->inventory_id)->update('inventory', [
			    	'qty'=>(@$arr_cqty[$rs->inventory_id] ? $arr_cqty[$rs->inventory_id] : 0) + ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor),
			    	'in_qty'=>(@$arr_iqty[$rs->inventory_id] ? $arr_iqty[$rs->inventory_id] : 0) + ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor)
			    ]);

			    //== inventory movement history

			    $data_iv = [];
			    $data_iv['date_created'] = $date;
			    $data_iv['user_id'] = $user_id;

			    $data_iv['type'] = 1; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload

			    $data_iv['inventory_id'] =$rs->inventory_id;
			    $data_iv['rri_id'] = @$rri_id; 

			    $data_iv['qty'] = ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor);
			    $data_iv['uom_type_id'] = @$arr_uc[$rs->uom_conversion_id]->base_uom_id;

			    $data_iv['price'] = $rs->price;
			    $data_iv['currency_type_id'] = @$currency_type_id;  

			    $data_iv['reference_id'] = $rr_id; 
			    $data_iv['reference_id_type'] = 'receiving_report';  

			    $data_iv['uom_conversion_factor'] = $rs->uom_conversion_factor;
			    
			    $data_iv['project_id'] = $rs->project_id; 

			    $data_iv['supplier_id'] = $po->supplier_id; 

			    //$batch_data_iv[] = $data_iv;
				$this->db->insert('inventory_movement', $data_iv);

			}
		}}

		// ARCHIVED BATCH QUER SINCE INVENTORY MOVEMENT NEEDED ID FROM RRI
		// if(@$batch_data_rr){
		// 	$this->db->insert_batch('receiving_report_items', $batch_data_rr);
		// }

		// if(@$batch_data_iv){
		// 	$this->db->insert_batch('inventory_movement', $batch_data_iv);
		// }

		// update P.O. status
		if($rr_qty<$po_qty){ 
			$this->db->where('id',$id)->update('purchase_order',['rr_status'=>2]); // partial status
		}elseif($rr_qty == $po_qty){
			$this->db->where('id',$id)->update('purchase_order',['rr_status'=>1]); // completed status
		}
 

		return ['result'=>true];
	}

	public function update_approval($id)
	{

		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'fm_department';

		 
	    $data['pr1'] = $this->input->post('pr1',TRUE); 
	    $data['pr2'] = $this->input->post('pr2',TRUE); 
	    $data['pr3'] = $this->input->post('pr3',TRUE); 
	    $data['po1'] = $this->input->post('po1',TRUE); 
	    $data['po2'] = $this->input->post('po2',TRUE); 
	    $data['po3'] = $this->input->post('po3',TRUE); 

		$data['pr_auto_approved'] = $this->input->post('pr_auto_approved',TRUE); 
	    $data['po_auto_approved'] = $this->input->post('po_auto_approved',TRUE); 

	    $this->db->where('id',$id);
		$result = $this->db->update($table, $data); 

		return ['result'=>$result];

	}

	public function approval_pr_update($id, $status, $c, $max)
	{
			$user_id = $this->session->user_id; 

			$data = []; 
			$date = date("Y-m-d H:i:s");
			$table = 'purchase_request';
 
		    $data['a'.$c.'_status'] = $status; 
		    $data['a'.$c.'_date'] = $date;  

		    if($max == $c){ // reach max approver
		    	$data['form_status'] = 1;
		    	$data['date_done'] = $date;
		    }elseif($status == 2){ // rejected
		    	$data['form_status'] = 2;
		    	$data['date_done'] = $date;
		    }

		    $this->db->where('id',$id);
			$result = $this->db->update($table, $data); 

			return ['result'=>$result];
	}

	public function approval_po_update($id, $status, $c, $max)
	{
			$user_id = $this->session->user_id; 

			$data = []; 
			$date = date("Y-m-d H:i:s");
			$table = 'purchase_order';
 
		    $data['a'.$c.'_status'] = $status; 
		    $data['a'.$c.'_date'] = $date;  

		    if($max == $c){ // reach max approver
		    	$data['form_status'] = 1;
		    	$data['date_done'] = $date;
		    }elseif($status == 2){ // rejected
		    	$data['form_status'] = 2;
		    	$data['date_done'] = $date;
		    }

		    $this->db->where('id',$id);
			$result = $this->db->update($table, $data); 

			return ['result'=>$result];
	}

	public function rr_po_move_to_history($id)
	{
		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'purchase_order';
	
	    $data['rr_history'] = 1; 
	    $data['date_modified'] = $date;  
	    $data['modified_by'] = $user_id;
  
	    $this->db->where('id',$id);
		$result = $this->db->update($table, $data); 

		return ['result'=>$result];
	}

	public function create_issue_item()
	{
		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'receiving_report';

		$rsrr = $this->db->select('id')->get_where('issue_inventory',[
			'year'=>date('Y') 
		])->num_rows(); 
		
		$rrdata['date_created'] = $date;
		$rrdata['user_id'] = $user_id;
 
		$rrdata['remarks'] = $this->input->post('remarks',TRUE);  
		$rrdata['requestor_id'] = $this->input->post('requestor_id',TRUE);  
		$rrdata['issue_type_id'] = $this->input->post('issue_type_id',TRUE);  
		$rrdata['project_id'] = $this->input->post('project_id',TRUE); 

		$rrdata['year'] = date('Y');
		$rrdata['ii_number'] = date('y').'-'.sprintf("%04d",($rsrr+1)); // format YYYY-####

		$this->db->insert('issue_inventory', $rrdata);
		$ii_id = $this->db->insert_id();

		$ii_number = $rrdata['ii_number'];
	  	
	  	$rri_ids = '';
	  	$ids = '';

	  	if(@$this->input->post('items',TRUE)){
		foreach(@$this->input->post('items',TRUE) as $rrid){
			$rri_ids.= ' OR id='.$rrid;
		}}

		if($rri_ids){

			$rri_ids = '('.$rri_ids;
			$rri_ids = str_replace('( OR','',$rri_ids);

			$rri = $this->db->select('id,purchase_order_items_id,inventory_id,in_qty,out_qty,rate,currency_type_id,price,uom_conversion_id,qty')->get_where('receiving_report_items','('.$rri_ids.') AND status=1')->result();
			if(@$rri){
				foreach($rri as $rs){  
					@$arr_rri[$rs->id]=$rs;
					$ids.= ' OR id='.$rs->inventory_id;
				}
			}
		}

		if($ids){

			$ids = '('.$ids;
			$ids = str_replace('( OR','',$ids);

			$inv = $this->db->select('id,qty,out_qty')->get_where('inventory',$ids)->result();
			if(@$inv){
				foreach($inv as $rs){  
					@$arr_cqty[$rs->id]=$rs->qty;
					@$arr_oqty[$rs->id]=$rs->out_qty;
				}
			}
		}

		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}
   
		if(@$this->input->post('items',TRUE)){
		foreach(@$this->input->post('items',TRUE) as $rrid){	
		 	
		 	if($this->input->post('qty'.$rrid,TRUE) <= @$arr_rri[$rrid]->in_qty){

				$data_ii = [];
				$data_ii['date_created'] = $date;
			    $data_ii['user_id'] = $user_id;

			    $data_ii['project_id'] = $this->input->post('project_id',TRUE); 
			    $data_ii['issue_inventory_id'] = $ii_id; 

			    $data_ii['qty'] = $this->input->post('qty'.$rrid,TRUE); 
			    $data_ii['price'] = @$arr_rri[$rrid]->price; 
			    $data_ii['uom_id'] = @$arr_uc[@$arr_rri[$rrid]->uom_conversion_id]->base_uom_id; 
			    $data_ii['inventory_id'] = @$arr_rri[$rrid]->inventory_id; 
			    $data_ii['rri_id'] = $rrid; 
			     
			    $data_ii['rate'] = @$arr_rri[$rrid]->rate; 
			    $data_ii['currency_type_id'] = @$arr_rri[$rrid]->currency_type_id; 
 
			    //$batch_data_ii[] = $data_ii; 

			    $this->db->insert('issue_inventory_items', $data_ii);
			    $iii_id = $this->db->insert_id();

			    //== inventory movement history

			    $data_iv = [];
			    $data_iv['date_created'] = $date;
			    $data_iv['user_id'] = $user_id;

			    $data_iv['type'] = 2; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload

			    $data_iv['inventory_id'] = @$arr_rri[$rrid]->inventory_id; 
			    $data_iv['rri_id'] = @$rrid; 
			    $data_iv['iii_id'] = @$iii_id; 

			    $data_iv['qty'] = $this->input->post('qty'.$rrid,TRUE); 
			    $data_iv['uom_type_id'] = @$arr_uc[@$arr_rri[$rrid]->uom_conversion_id]->base_uom_id;
			    $data_iv['deduction'] = 1; 
			    $data_iv['qty_before'] = @$arr_rri[$rrid]->qty; 

			    $data_iv['price'] = @$arr_rri[$rrid]->price; 
			    $data_iv['currency_type_id'] = @$arr_rri[$rrid]->currency_type_id;
			    $data_iv['rate'] = @$arr_rri[$rrid]->rate; 

			    $data_iv['reference_id'] = $ii_id; 
			    $data_iv['reference_id_type'] = 'issue_inventory';  

			    $data_iv['uom_conversion_factor'] = 0;
			    $data_iv['project_id'] = $this->input->post('project_id',TRUE);

			    $batch_data_iv[] = $data_iv;

			    // update rr out qty
			    $rri_data = [];
			    $rri_data['out_qty'] = @$arr_rri[$rrid]->out_qty+$this->input->post('qty'.$rrid,TRUE);
			    $rri_data['qty'] = @$arr_rri[$rrid]->qty-$this->input->post('qty'.$rrid,TRUE);
			    if($rri_data['qty'] <= 0){
			    	$rri_data['status'] = 0;
			    }	
			    $rri_data['date_modified'] = date('Y-m-d H:i'); 

			    $this->db->where('id',$rrid)->update('receiving_report_items',$rri_data);

				// update inventory qty
			    $this->db->where('id',@$arr_rri[$rrid]->inventory_id)->update('inventory', 
			    	[
			    	'qty'=>(@$arr_cqty[@$arr_rri[$rrid]->inventory_id] ? $arr_cqty[@$arr_rri[$rrid]->inventory_id] : 0) - $this->input->post('qty'.$rrid,TRUE),
			    	'out_qty'=>(@$arr_oqty[@$arr_rri[$rrid]->inventory_id] ? $arr_oqty[@$arr_rri[$rrid]->inventory_id] : 0) + $this->input->post('qty'.$rrid,TRUE)
			    ]);

			}
 
			 
		}} 

		if(@$batch_data_iv){
			$this->db->insert_batch('inventory_movement', $batch_data_iv);
		}
	  
		return ['result'=>true];
	}

	public function save_freight_charges($id)
	{
		$data = [];

		$data['freight_charge_amount'] = $this->input->post('freight_charge_amount',TRUE);
		$data['rate'] = json_encode(@$this->input->post('rate',TRUE));
		$data['fc_status'] = 1;
		$data['fc_date'] = date('Y-m-d H:i');

		$this->db->where('id',$id)->update('purchase_order',$data);

		$rri = $this->db->select('id')->get_where('receiving_report_items',['purchase_order_id'=>$id])->result();
		if(@$rri){
			foreach($rri as $k => $rs){
				@$arr_count[$rs->id]+=1;
		}}

		$poi = $this->db->select('id')->get_where('receiving_report_items',['purchase_order_id'=>$id])->result();
		if(@$poi){
			foreach($poi as  $k => $rs){

				$data = [];

				if(@$arr_count[$rs->id] > 0){
 
					$item_name = $this->input->post('item_name'.$rs->id,TRUE);
					$item_desc = $this->input->post('item_desc'.$rs->id,TRUE);
					$item_name_orig = $this->input->post('item_name_orig'.$rs->id,TRUE);
					$item_desc_orig = $this->input->post('item_desc_orig'.$rs->id,TRUE);

					if($item_name != $item_name_orig && $item_name){
						$data['item_name'] = $this->input->post('item_name'.$rs->id,TRUE);
					}
					
					if($item_desc != $item_desc_orig && $item_desc){
						$data['item_desc'] = $this->input->post('item_desc'.$rs->id,TRUE);
					}
					
					$data['rate'] = json_encode($this->input->post('rate',TRUE));

					$data['inventory_accounts_id'] = $this->input->post('inventory_accounts'.$rs->id,TRUE);

					if(@$arr_count[$rs->id]==1){
						$data['freight_charge_amount'] = $this->input->post('freight_charge_amount'.$rs->id,TRUE);
					}else{
						$divided_fg_amt = $this->input->post('freight_charge_amount'.$rs->id,TRUE)/$arr_count[$rs->id];
						$data['freight_charge_amount'] = $divided_fg_amt;
					}

					$data['item_discount'] = $this->input->post('discount'.$rs->id,TRUE);
					 
					$q = $this->db->where('id',$rs->id)->update('receiving_report_items',$data); 
 
				}

			}
		} 

		return ['result'=>true];
	}

	public function generate_inventory_report($account_id = ''){ 
				
		$inventory  = array(); 
		$search_arr = array();
		$totaldata = 0;  
		$rs_employee = array(); 

		 
		/* count total */   
		$this->db->from("receiving_report_items");  
		$query = $this->db->get(); 
		$totaldata = $query->num_rows();

		/* order by
		$column_order = array(null, 'name','department','designation','nationality'); //set column field database for datatable orderable
	    $column_search = array('name','department','designation','nationality'); //set column field database for datatable searchable 
		$order = array('id' => 'asc');
		 
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		} */
		
		/* search */  
		$search = @$_POST['search']['value']; 

		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search);
			$this->db->group_end();
		}

		$this->db->where(array('rri.deleted'=>0)); 

		if($account_id){
			if(is_array($account_id)){
				foreach($account_id as $aid){
					$this->db->where(array('rri.inventory_accounts_id'=>$aid)); 
				}
			}else{
				$this->db->where(array('rri.inventory_accounts_id'=>$account_id)); 
			}
		}

		$this->db->select('rri.*,
			rri.id as rri_id,
			rri.date_created as dc,
			rri.in_qty as in_qty_rri,
			rri.out_qty as out_qty_rri,
			rri.item_name as po_item_name,
			rri.item_desc as po_item_desc,
			a.*, 
			b.title as type_title,
			c.title as category_title,
			d.title as uom_title,
			e.title as classification_title,
			f.project_id as project_id,
			f.po_number as po_number,
			g.id as project_id,
			g.name as project_name,
			g.control_number as project_control_number,
			h.invoice_number as invoice_number,
			h.dr_number as dr_number,
			i.id as account_id,
			i.title as account_title,
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy
			');

        $this->db->from('receiving_report_items rri');  
        $this->db->join('inventory a', 'a.id=rri.inventory_id', ' left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left'); 
        $this->db->join('receiving_report h', 'h.id=rri.receiving_report_id', 'left'); 
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id', 'left'); 
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        $this->db->order_by('rri.id', 'ASC');

        $query = $this->db->get()->result(); 
		
		//$this->output->enable_profiler(TRUE);
		
		return $query;
 

	}

	public function save_ap($rr_id)
	{
		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'accounts_payable';

		$counter = $this->input->post('counter',TRUE);

		if($counter){
			$count = 0;
			while($counter > $count){
				$count+=1;

				if(@$this->input->post('amount'.$count,TRUE)>0){

					if(@$this->input->post('id'.$count,TRUE)){
						
						$data = [];
						$data['receiving_report_id'] = $rr_id;

						$data['cheque_number'] = @$this->input->post('cheque_number'.$count,TRUE);
						$data['cheque_date'] = @$this->input->post('cheque_date'.$count,TRUE);
						$data['collection_date'] = @$this->input->post('collection_date'.$count,TRUE);

						$data['description'] = @$this->input->post('description'.$count,TRUE);
						$data['amount'] = @$this->input->post('amount'.$count,TRUE);
						$data['date_modified'] = @$date;
						$data['modified_by'] = @$user_id;
						$this->db->where('id',$this->input->post('id'.$count,TRUE));
						$this->db->update('accounts_payable',$data);

					}else{

						$data = [];
						$data['receiving_report_id'] = $rr_id;

						$data['cheque_number'] = @$this->input->post('cheque_number'.$count,TRUE);
						$data['cheque_date'] = @$this->input->post('cheque_date'.$count,TRUE);
						$data['collection_date'] = @$this->input->post('collection_date'.$count,TRUE);

						$data['description'] = @$this->input->post('description'.$count,TRUE);
						$data['amount'] = @$this->input->post('amount'.$count,TRUE);
						$data['date_created'] = @$date;
						$data['user_id'] = @$user_id;
						$this->db->insert('accounts_payable',$data);
						
					}
				}
			}
		}

		if($this->input->post('closed_po',TRUE) == 1){
			$data = [];
			$data['closed_po'] = 1;
			$data['closed_po_date'] = @$date;
			$data['closed_po_by'] = @$user_id;
			$this->db->where('id',$rr_id);
			$this->db->update('purchase_order',$data);

			$data = [];
			$data['closed_rr'] = 1;
			$data['closed_rr_date'] = @$date;
			$data['closed_rr_by'] = @$user_id;
			$this->db->where('id',$rr_id);
			$this->db->update('receiving_report',$data);
		}

		return true;
	}

	public function cancel_pr($pr_id)
	{
		$pri = $this->db->select('id,purchase_order_items_id')->get_where('purchase_request_items',['purchase_request_id'=>$pr_id])->result();
		if(@$pri){
			foreach($pri as $rs){
				@$all_pr_item+=1;  

				if($rs->purchase_order_items_id){
					@$all_po_pr+=1;
				}

				if(@$this->input->post('chk'.$rs->id,TRUE) == 1){
					$this->db->where('id',$rs->id)->update('purchase_request_items',[
						'cancel'=>1,
						'cancel_by'=>$this->session->user_id,
						'cancel_date'=>date('Y-m-d H:i')
					]);
				}
			}
		}

		$all_pr_cancel = $this->db->select('id')->get_where('purchase_request_items',['purchase_request_id'=>$pr_id,'cancel'=>1])->num_rows();

		$updated_item = (@$all_po_pr+$all_pr_cancel);

		if(@$all_pr_item>0 && @$all_pr_item==$all_pr_cancel){
			// set status to cancelled
			$this->db->where('id',$pr_id)->update('purchase_request',[
				'po_status'=>3 
			]); 
		}elseif($updated_item>0 && @$all_pr_item == $updated_item){
			// set status to completed ....with some cancel item
			$this->db->where('id',$pr_id)->update('purchase_request',[
				'po_status'=>1 
			]);
		}
	}

	public function create_retrun(){

		$user_id = $this->session->user_id; 
		$date = date("Y-m-d H:i:s");

	  	$iii_ids = '';
	  	$ids = '';
	  	$rri_ids = '';

	  	if(@$this->input->post('items',TRUE)){
		foreach(@$this->input->post('items',TRUE) as $rrid){
			if(strpos($rrid, 'n') !== true){
			$iii_ids.= ' OR id='.$rrid;
		}}}
 
		//================ III ARR
		if($iii_ids){

			$iii_ids = '('.$iii_ids;
			$iii_ids = str_replace('( OR','',$iii_ids);

			$rri = $this->db->get_where('issue_inventory_items','('.$iii_ids.')')->result();
			if(@$rri){
				foreach($rri as $rs){  
					@$arr_iii[$rs->id]=$rs;
					$ids.= ' OR id='.$rs->inventory_id;
					$rri_ids.= ' OR id='.$rs->rri_id;
				}
			}
		}
		//================= INVENTROY ARR
		if($ids){

			$ids = '('.$ids;
			$ids = str_replace('( OR','',$ids);

			$inv = $this->db->select('item_code,id,qty,out_qty')->get_where('inventory',$ids)->result();
			if(@$inv){
				foreach($inv as $rs){  
					@$arr_item_code[$rs->id]=$rs->item_code;
					@$arr_cqty[$rs->id]=$rs->qty;
					@$arr_oqty[$rs->id]=$rs->out_qty;
				}
			}
		}
		//================ RRI ARR
		if($rri_ids){

			$rri_ids = '('.$rri_ids;
			$rri_ids = str_replace('( OR','',$rri_ids);

			$inv = $this->db->get_where('receiving_report_items',$rri_ids)->result();
			if(@$inv){
				foreach($inv as $rs){   
					@$arr_rri_qty[$rs->id]=$rs->in_qty-$rs->out_qty; 
					@$arr_rri_out_qty[$rs->id]=$rs->out_qty; 
					@$arr_rri[$rs->id]=$rs;
				}
			}
		}

		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}

		if(@$this->input->post('items',TRUE)){
		foreach(@$this->input->post('items',TRUE) as $iiid){	

			// if(@$this->input->post('type'.$iiid,TRUE) == 0){ //====== FROM OLD PROJ.

			// 	$inventory_data = [];

			// 	$inventory_data['date_created'] = date('Y-m-d H:i'); 
 		// 		$inventory_data['user_id'] = $user_id;
 		// 		$inventory_data['name'] = $this->input->post('item_name'.$iiid,TRUE);
 		// 		$inventory_data['short_description'] = $this->input->post('item_desc'.$iiid,TRUE);
 		// 		$inventory_data['full_description'] = $this->input->post('item_desc'.$iiid,TRUE);
 		// 		$inventory_data['inventory_type_id'] = 0;
 		// 		$inventory_data['inventory_category_id'] = 0;
 		// 		$inventory_data['qty'] = $this->input->post('qty'.$iiid,TRUE);
 		// 		$inventory_data['uom_type_id'] = $this->input->post('uom'.$iiid,TRUE);
 		// 		$inventory_data['ceiling_qty'] = 0;
 		// 		$inventory_data['re_order_point_qty'] = 0;
 		// 		$inventory_data['po_lead_time'] = '';
 		// 		$inventory_data['barcode'] = @$barcode;
 		// 		$inventory_data['brand'] = @$brand;
 		// 		$inventory_data['manufacturer_id'] = @$manufacturer;
 		// 		$inventory_data['source'] = 'upload';
 		// 		$inventory_data['in_qty'] = $this->input->post('qty'.$iiid,TRUE);
 		// 		$inventory_data['out_qty'] = 0;
 		// 		$inventory_data['item_code'] = $this->input->post('code'.$iiid,TRUE);
 		// 		$inventory_data['classification_id'] = @$classification;
 		// 		$inventory_data['rack'] = $this->input->post('rack'.$iiid,TRUE);
 		// 		$inventory_data['layer'] = $this->input->post('layer'.$iiid,TRUE);
 		// 		$inventory_data['tag_no'] = $this->input->post('tag_no'.$iiid,TRUE);

 		// 		$i_exist = $this->db->select('id')->get_where('inventory',['item_code'=>$this->input->post('code'.$iiid,TRUE)])->row();
					 
 		// 		if(@$i_exist->id){ 
 		// 			$new_inv_id = $i_exist->id;
 		// 		}else{
 		// 			$this->db->insert('inventory',$inventory_data);
 		// 			$new_inv_id = $this->db->insert_id();
 		// 		}
 				 
			// 	// mali 2 query, mali un loop id, 

			// 	$data_rr = [];
			// 	$data_rr['date_created'] = $date;
			//     $data_rr['user_id'] = $user_id;

			//     $data_rr['receiving_report_id'] = 0;
			//     $data_rr['rr_number'] = 0;

			//     $data_rr['purchase_order_id'] = 0; 
			//     $data_rr['purchase_order_items_id'] = 0; 
 
			//     $data_rr['inventory_id'] = @$new_inv_id;
			//     $data_rr['uom_conversion_id'] = 0; 

			//     $data_rr['qty'] = $this->input->post('qty'.$iiid,TRUE); // this will not be use as quantity in movements ony for recording
			// 	    $data_rr['in_qty'] = $this->input->post('qty'.$iiid,TRUE); 
			//     $data_rr['uom_factor'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->uom_factor; 

			//     $data_rr['remarks'] = 'return inventory';
 
			//     // $data_rr['inventory_accounts_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->inventory_accounts_id; 
			//     // $data_rr['inventory_accounts_id_rr'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->inventory_accounts_id_rr;

			//     $data_rr['inventory_accounts_id'] = $this->input->post('account'.$iiid,TRUE);
			//     $data_rr['inventory_accounts_id_rr'] = $this->input->post('account'.$iiid,TRUE); 

			//     $data_rr['price'] = $this->input->post('price'.$iiid,TRUE);
			//     $data_rr['currency_type_id'] = 7;  
			//     $data_rr['item_name'] = $this->input->post('item_name'.$iiid,TRUE);
			//     $data_rr['item_desc'] = $this->input->post('item_desc'.$iiid,TRUE);

			//     $data_rr['freight_charge_amount'] = 0; 
			//     $data_rr['item_discount'] = 0;
			//     $data_rr['uom_conversion_factor'] = 0; 
			//     $data_rr['rate'] = json_encode(["jpy_to_php"=>(round($this->input->post('jpy'.$iiid,TRUE)/$this->input->post('price'.$iiid,TRUE),8)),"usd_to_jpy"=>0]); 
			//     $data_rr['return_inventory'] = 1;
			//     $data_rr['control_number_type'] = 1; // == as purchasing cn

			//     //$batch_data_rr[] = $data_rr; 
			//     $this->db->insert('receiving_report_items', $data_rr);
			//     $new_rri_id = $this->db->insert_id();

			//     //==== INSERT INVENTROY MOVEMNT HERE ==========================

			//     $data_iv = [];
			//     $data_iv['date_created'] = $date;
			//     $data_iv['user_id'] = $user_id;

			//     if(@$this->input->post('type'.$iiid,TRUE)==1){
			//     	$data_iv['type'] = 4; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload 7=return new code
			//     }elseif(@$this->input->post('type'.$iiid,TRUE)==2){
			//     	$data_iv['type'] = 7; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload 7=return new code
			//     }
			    
			//     $data_iv['inventory_id'] = @$new_inv_id; 
			//     $data_iv['rri_id'] = 0;  //== from RRI
			//     $data_iv['iii_id'] = 0;

			//     $data_iv['qty'] = $this->input->post('qty'.$iiid,TRUE); 
			//     $data_iv['uom_type_id'] = $this->input->post('uom'.$iiid,TRUE); 
			//     $data_iv['deduction'] = 0; 
			//     $data_iv['qty_before'] = 0; //== from RRI

			//     $data_iv['price'] = $this->input->post('price'.$iiid,TRUE);  
			//     $data_iv['currency_type_id'] = 7;
			//     $data_iv['rate'] = json_encode(["jpy_to_php"=>(round($this->input->post('jpy'.$iiid,TRUE)/$this->input->post('price'.$iiid,TRUE),8)),"usd_to_jpy"=>0]);

			//     $data_rr['inventory_accounts_id'] = $this->input->post('account'.$iiid,TRUE); 

			//     $data_iv['reference_id'] = 0; 
			//     $data_iv['reference_id_type'] = 'returns';  

			//     $data_iv['uom_conversion_factor'] = 0;
			//     $data_iv['project_id'] = 0;//$this->input->post('project_id',TRUE);

			//     $batch_data_iv[] = $data_iv;


			// }else{ //=========== NORMAL RETURN ITEM
		  		 
			 	if($this->input->post('qty'.$iiid,TRUE) <= @$arr_iii[$iiid]->qty){
	 
				    $new_rri_id = '';

				    //============================== UPDATE III QTY =======================================
				    $iii_data = [];
				    
				    $iii_data['qty_return'] = @$arr_iii[$iiid]->qty_return+$this->input->post('qty'.$iiid,TRUE);
				    
				    $iii_data['date_modified'] = date('Y-m-d H:i'); 
				    $this->db->where('id',$iiid)->update('issue_inventory_items',$iii_data);
				    //======================================================================================

				    //retrun to same RRI
				    if(@$this->input->post('type'.$iiid,TRUE) == 1){
	 
					    //============================== UPDATE RRI QTY =======================================
					    $rri_data = [];

					    $rri_data['out_qty'] = @$arr_rri_out_qty[@$arr_iii[$iiid]->rri_id]-$this->input->post('qty'.$iiid,TRUE);
					    $rri_data['qty'] = @$arr_rri_qty[@$arr_iii[$iiid]->rri_id]+$this->input->post('qty'.$iiid,TRUE);

					    if($rri_data['qty'] <= 0){
					    	$rri_data['status'] = 0;
					    }else{
					    	$rri_data['status'] = 1;
					    }	
	 
					    $rri_data['date_modified'] = date('Y-m-d H:i'); 
					    $rri_data['return_date'] = date('Y-m-d H:i');

					    $this->db->where('id',@$arr_iii[$iiid]->rri_id)->update('receiving_report_items',$rri_data);
					    //======================================================================================
	 

					//return as inventory or new itemcode
					}elseif(@$this->input->post('type'.$iiid,TRUE)==2){

						//============================== ADD RRI QTY =======================================
						$data_rr = [];
						$data_rr['date_created'] = $date;
						$data_rr['date_modified'] = date('Y-m-d H:i'); 
					    $data_rr['user_id'] = $user_id;

					    $data_rr['receiving_report_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->receiving_report_id;
					    $data_rr['rr_number'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->rr_number;

					    $data_rr['purchase_order_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->purchase_order_id; 
					    $data_rr['purchase_order_items_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->purchase_order_items_id; 
	 

					    $data_rr['inventory_id'] = @$arr_iii[$iiid]->inventory_id;
					    $data_rr['uom_conversion_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->uom_conversion_id; 
	  
					    $data_rr['qty'] = $this->input->post('qty'.$iiid,TRUE); // this will not be use as quantity in movements ony for recording
	 				    $data_rr['in_qty'] = $this->input->post('qty'.$iiid,TRUE); 
					    $data_rr['uom_factor'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->uom_factor; 

					    $data_rr['remarks'] = 'return inventory';


					    // $data_rr['inventory_accounts_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->inventory_accounts_id; 
					    // $data_rr['inventory_accounts_id_rr'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->inventory_accounts_id_rr;

					    $data_rr['inventory_accounts_id'] = $this->input->post('account'.$iiid,TRUE);
					    $data_rr['inventory_accounts_id_rr'] = $this->input->post('account'.$iiid,TRUE); 

					    $data_rr['price'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->price; 
					    $data_rr['currency_type_id'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->currency_type_id; 

					    $data_rr['item_name'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->item_name; 
					    $data_rr['item_desc'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->item_desc; 

					    $data_rr['freight_charge_amount'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->freight_charge_amount; 
					    $data_rr['item_discount'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->item_discount;
					    $data_rr['uom_conversion_factor'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->uom_conversion_factor; 
					    $data_rr['rate'] = @$arr_rri[@$arr_iii[$iiid]->rri_id]->rate;  
					    $data_rr['return_inventory'] = 1;
					    $data_rr['control_number_type'] = 1; // == as purchasing cn
	 					$data_rr['return_date'] = date('Y-m-d H:i');

					    //$batch_data_rr[] = $data_rr; 
					    $this->db->insert('receiving_report_items', $data_rr);
					    $new_rri_id = $this->db->insert_id();
					}


					//==== INSERT INVENTROY MOVEMNT HERE ==========================

					$data_iv = [];
					$data_iv['date_created'] = $date;
					$data_iv['user_id'] = $user_id;

					if(@$this->input->post('type'.$iiid,TRUE)==1){
						$data_iv['type'] = 4; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload 7=return new code
					}elseif(@$this->input->post('type'.$iiid,TRUE)==2){
						$data_iv['type'] = 7; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload 7=return new code
					}
					
					$data_iv['inventory_id'] = @$arr_iii[$iiid]->inventory_id; 
					$data_iv['rri_id'] = @$new_rri_id ? $new_rri_id : @$arr_iii[$iiid]->rri_id;  //== from RRI
					$data_iv['iii_id'] = @$iiid;

					$data_iv['qty'] = $this->input->post('qty'.$iiid,TRUE); 
					$data_iv['uom_type_id'] = @$arr_iii[$iiid]->uom_id;
					$data_iv['deduction'] = 0; 
					$data_iv['qty_before'] = @$arr_rri_qty[@$arr_iii[$iiid]->rri_id]; //== from RRI

					$data_iv['price'] = @$arr_iii[$iiid]->price; 
					$data_iv['currency_type_id'] = @$arr_iii[$iiid]->currency_type_id;
					$data_iv['rate'] = @$arr_iii[$iiid]->rate;

					$data_rr['inventory_accounts_id'] = $this->input->post('account'.$iiid,TRUE); 

					$data_iv['reference_id'] = $iiid; 
					$data_iv['reference_id_type'] = 'receiving_report_items';  

					$data_iv['uom_conversion_factor'] = 0;
					$data_iv['project_id'] = 0;//$this->input->post('project_id',TRUE);

					$batch_data_iv[] = $data_iv;
					
					// if($this->input->post('direct_project'.$iiid,TRUE) == 1){
	 
					// 	$data_iv['rri_id'] = @$arr_iii[$iiid]->rri_id;
					// 	$data_iv['project_id'] = @$arr_iii[$iiid]->project_id;
					// 	$data_iv['reference_id_type'] = 'receiving_report_itemsx';  

					// 	$batch_data_iv[] = $data_iv;
					// }

					//===============================================================================END IV

					if($this->input->post('code'.$iiid,TRUE) && @$arr_item_code[@$arr_iii[$iiid]->inventory_id]!=$this->input->post('code'.$iiid,TRUE)){
						//reserve if has new CODE!!!!
					}

					//=============================== UPDATE INVENTORY QTY ==================================
				    $this->db->where('id',@$arr_iii[$iiid]->inventory_id)->update('inventory', 
				    	[
				    	'qty'=>(@$arr_cqty[@$arr_iii[$iiid]->inventory_id] ? $arr_cqty[@$arr_iii[$iiid]->inventory_id] : 0) + $this->input->post('qty'.$iiid,TRUE),
				    	'out_qty'=>(@$arr_oqty[@$arr_iii[$iiid]->inventory_id] ? $arr_oqty[@$arr_iii[$iiid]->inventory_id] : 0) - $this->input->post('qty'.$iiid,TRUE)
				    ]);
				    //=======================================================================================
	  
				}

			//}
			 
		}}


		if(@$batch_data_iv){

			$this->db->insert_batch('inventory_movement', $batch_data_iv);
		}
		 
		return ['result'=>true];


	}

	public function create_receiving_with_auto_withdrawal($id)
	{
		/*
		$user_id = $this->session->user_id; 

		$data = []; 
		$date = date("Y-m-d H:i:s");
		$table = 'receiving_report';
	 
		$rsrr = $this->db->select('id')->get_where('receiving_report',[
			'year'=>date('Y') 
		])->num_rows();

		$po = $this->db->select('project_id,currency_type_id,supplier_id,tax_type')->get_where('purchase_order',['id'=>$id])->row();

		$currency_type_id = $po->currency_type_id;
		$project_id = $po->project_id;
		
		$rrdata['date_created'] = $date;
		$rrdata['user_id'] = $user_id;

		$rrdata['purchase_order_id'] = $id; 
		$rrdata['invoice_number'] = $this->input->post('invoice_number',TRUE);  
		$rrdata['dr_number'] = $this->input->post('dr_number',TRUE); 
		$rrdata['tax_type'] = $po->tax_type; 

		$rrdata['due_date'] = $this->input->post('due_date',TRUE); 
		$rrdata['received_by_id'] = $this->input->post('received_by_id',TRUE);  

		$rrdata['project_id'] = $project_id;  

		$rrdata['year'] = date('Y');
		$rrdata['rr_number'] = date('y').'-'.sprintf("%04d",($rsrr+1)); // format YYYY-####

		$data_iv['supplier_id'] = $po->supplier_id; 

		$this->db->insert('receiving_report', $rrdata);
		$rr_id = $this->db->insert_id();

		$rr_number = $rrdata['rr_number'];
		 

		$rr_qty = 0;

		$rr_items = $this->db->select('id,qty')->get_where('receiving_report_items',['purchase_order_id'=>$id])->result();
		if(@$rr_items){
			foreach($rr_items as $rs){
				$rr_qty+=$rs->qty;
			}
		}

		
		$uc = $this->db->get_where('uom_conversions',['deleted'=>0])->result();
		if(@$uc){
			foreach($uc as $rs){
				$arr_uc[$rs->id] = $rs;  
			}
		}

		$po_items = $this->db->select('id,inventory_id,uom_conversion_id,qty,price,project_id,control_number_id,item_name,item_desc')->get_where('purchase_order_items',['purchase_order_id'=>$id])->result();
		
		$po_qty = 0;

		$ids = '';

		if(@$po_items){
		foreach($po_items as $rs){
			$ids.= ' OR id='.$rs->id;
		}}

		if($ids){

			$ids = '('.$ids;
			$ids = str_replace('( OR','',$ids);

			$inv = $this->db->select('id,qty,in_qty')->get_where('inventory',$ids)->result();
			if(@$inv){
				foreach($inv as $rs){  
					@$arr_cqty[$rs->id]=$rs->qty;
					@$arr_iqty[$rs->id]=$rs->in_qty;
				}
			}
		}

		if(@$po_items){
		foreach($po_items as $rs){
			
			$po_qty+=$rs->qty;

			if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)<=$rs->qty){

				$rr_qty+=$this->input->post('qty'.$rs->id,TRUE);

				$data_rr = [];
				$data_rr['date_created'] = $date;
			    $data_rr['user_id'] = $user_id;

			    $data_rr['receiving_report_id'] = $rr_id;
			    $data_rr['rr_number'] = $rr_number;

			    $data_rr['purchase_order_id'] = $id; 
			    $data_rr['purchase_order_items_id'] = $rs->id;

			    $data_rr['project_id'] = $rs->project_id;
			    $data_rr['control_number_id'] = $rs->control_number_id;

			    $data_rr['inventory_id'] = $rs->inventory_id;
			    $data_rr['uom_conversion_id'] = $rs->uom_conversion_id; 

			    $uom_factor = @$arr_uc[$rs->uom_conversion_id]->factor ? $arr_uc[$rs->uom_conversion_id]->factor : 1;

			    $data_rr['qty'] = $this->input->post('qty'.$rs->id,TRUE); // this will not be use as quantity in movements only for recording
				    $data_rr['in_qty'] = ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor); 
			    
				    if(@$rs->project_id){
				    	$data_rr['out_qty'] = ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor); 
				    	$data_rr['qty'] = 0; //== will be overwite to 0 since it will go directly to project
				    }

			    $data_rr['uom_factor'] = $uom_factor;

			    $data_rr['remarks'] = $this->input->post('remarks'.$rs->inventory_id,TRUE);

			    $data_rr['inventory_accounts_id'] = @$this->input->post('inventory_accounts'.$rs->inventory_id,TRUE);
			    $data_rr['inventory_accounts_id_rr'] = @$this->input->post('inventory_accounts'.$rs->inventory_id,TRUE);

			    $data_rr['price'] = $rs->price; 
			    $data_rr['currency_type_id'] = @$currency_type_id; 

			    $data_rr['item_name'] = $rs->item_name; 
			    $data_rr['item_desc'] = $rs->item_desc; 

			    $data_rr['date_modified'] = date('Y-m-d H:i'); 
			    $data_rr['modified_by'] = $user_id;

			    //$batch_data_rr[] = $data_rr; 
			    $this->db->insert('receiving_report_items', $data_rr);
			    $rri_id = $this->db->insert_id();
			    $arr_po_rri[$rs->id] = $rri_id;

			    $this->db->where('id',$rs->inventory_id)->update('inventory', [
			    	'qty'=>(@$arr_cqty[$rs->inventory_id] ? $arr_cqty[$rs->inventory_id] : 0) + ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor),
			    	'in_qty'=>(@$arr_iqty[$rs->inventory_id] ? $arr_iqty[$rs->inventory_id] : 0) + ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor)
			    ]);

			    //== inventory movement history

			    $data_iv = [];
			    $data_iv['date_created'] = $date;
			    $data_iv['user_id'] = $user_id;

			    $data_iv['type'] = 1; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload

			    $data_iv['inventory_id'] =$rs->inventory_id;
			    $data_iv['rri_id'] = @$rri_id; 

			    $data_iv['qty'] = ($this->input->post('qty'.$rs->id,TRUE) * $uom_factor);
			    $data_iv['uom_type_id'] = @$arr_uc[$rs->uom_conversion_id]->base_uom_id;

			    $data_iv['price'] = $rs->price;
			    $data_iv['currency_type_id'] = @$currency_type_id;  

			    $data_iv['reference_id'] = $rr_id; 
			    $data_iv['reference_id_type'] = 'receiving_report';  

			    $data_iv['uom_conversion_factor'] = @$arr_uc[$rs->uom_conversion_id]->factor;
			    
			    $data_iv['project_id'] = $rs->project_id; 

			    $data_iv['supplier_id'] = $po->supplier_id; 

			    //$batch_data_iv[] = $data_iv;
				$this->db->insert('inventory_movement', $data_iv);

			}
		}}

		// ARCHIVED BATCH QUER SINCE INVENTORY MOVEMENT NEEDED ID FROM RRI
		// if(@$batch_data_rr){
		// 	$this->db->insert_batch('receiving_report_items', $batch_data_rr);
		// }

		// if(@$batch_data_iv){
		// 	$this->db->insert_batch('inventory_movement', $batch_data_iv);
		// }

		// update P.O. status
		if($rr_qty<$po_qty){ 
			$this->db->where('id',$id)->update('purchase_order',['rr_status'=>2]); // partial status
		}elseif($rr_qty == $po_qty){
			$this->db->where('id',$id)->update('purchase_order',['rr_status'=>1]); // completed status
		}

		// AUTO ISSUANCE IF HAS PROJECT ID - If dedicated to project it will be 0 on stock because it will directly use in project
		if(@$po_items){

			$rrdata = [];
			$rrdata['date_created'] = $date;
			$rrdata['user_id'] = $user_id;
			$rrdata['history'] = 1;
			
			$rrdata['remarks'] = 'Direct to project';  
			$rrdata['issue_type_id'] = 0;  

			$rrdata['project_id'] = 0; 

			$rrdata['year'] = date('Y');
			$rrdata['ii_number'] = date('y').'-D'.date('mdHi'); // format YYYY-####

			$this->db->insert('issue_inventory', $rrdata);
			$ii_id = $this->db->insert_id();

			foreach($po_items as $rs){
				if(@$rs->project_id){
					if($this->input->post('po'.$rs->id,TRUE) && $this->input->post('qty'.$rs->id,TRUE)>0 && $this->input->post('qty'.$rs->id,TRUE)<=$rs->qty){
						 
						$data_ii = [];
						$data_ii['date_created'] = $date;
					    $data_ii['user_id'] = $user_id;

					    $data_ii['project_id'] = $rs->project_id; 
					    $data_ii['issue_inventory_id'] = $ii_id; 

					    $data_ii['qty'] = $this->input->post('qty'.$rs->id,TRUE); 
					    $data_ii['price'] = @$rs->price; 
					    $data_ii['uom_id'] = @$arr_uc[@$rs->uom_conversion_id]->base_uom_id; 
					    $data_ii['inventory_id'] = $rs->inventory_id; 
					    $data_ii['rri_id'] = $arr_po_rri[$rs->id]; 
					     
					    $data_ii['rate'] = ''; 
					    $data_ii['currency_type_id'] = @$currency_type_id;
					
					    $batch_data_ii[] = $data_ii; 

					    //== inventory movement history

					    $data_iv = [];
					    $data_iv['date_created'] = $date;
					    $data_iv['user_id'] = $user_id;

					    $data_iv['type'] = 2; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload

					    $data_iv['inventory_id'] = @$arr_rri[$rrid]->inventory_id; 
					    $data_iv['rri_id'] = $arr_po_rri[$rs->id]; 

					    $data_iv['qty'] = $this->input->post('qty'.$rs->id,TRUE); 
					    $data_iv['uom_type_id'] = @$arr_uc[@$rs->uom_conversion_id]->base_uom_id; 
					    $data_iv['deduction'] = 1; 
					    $data_iv['qty_before'] = $this->input->post('qty'.$rs->id,TRUE); 

					    $data_iv['price'] = @$rs->price; 
					    $data_iv['currency_type_id'] = @$currency_type_id;
					    $data_iv['rate'] = ''; 

					    $data_iv['reference_id'] = $ii_id; 
					    $data_iv['reference_id_type'] = 'issue_inventory';  

					    $data_iv['uom_conversion_factor'] = 0;
					    $data_iv['project_id'] = $rs->project_id;

					    $batch_data_iv[] = $data_iv;
	 
					}
				}
			}
			if(@$batch_data_iv){
				$this->db->insert_batch('inventory_movement', $batch_data_iv);
			}
			if(@$batch_data_ii){
				$this->db->insert_batch('issue_inventory_items', $batch_data_ii);
			}
		} 

		return ['result'=>true]; */
	}

	public function search_item_rr($type, $excluded_ids = '')
	{
		/* search */  
		$search = @$this->input->post('searchTerm'); 

		if($search){
			$this->db->group_start();
			$this->db->like('a.name', $search); 
			$this->db->or_like('a.short_description', $search);
			$this->db->or_like('a.item_code', $search);
			$this->db->or_like('b.title', $search);
			$this->db->or_like('c.title', $search); 
			$this->db->or_like('d.title', $search); 
			$this->db->or_like('e.title', $search);
			$this->db->or_like('g.name', $search); 
			$this->db->or_like('g.control_number', $search);  
			$this->db->or_like('f.po_number', $search);  
			$this->db->or_like('i.title', $search); 
			$this->db->group_end();
		}

		if(@$excluded_ids){
 			$this->db->where($excluded_ids);
 		}
		$this->db->where(array('rri.deleted'=>0,'rri.qty_rri>0')); 

		// will based on selected issue type
		// $this->db->where('rri.control_number_type='.$type); 
		// if($type == 1){
		 	$this->db->where('(i.is_in_inventory=1 OR rri.control_number_type=2)');  
		// }
 

		// if(@$_GET['filter_accounts']>0){
		// 	$this->db->where(array('rri.inventory_accounts_id'=>$_GET['filter_accounts'])); 
		// }
		// if(@$_GET['project_id']>0){
		// 	$this->db->where(array('rri.project_id'=>$_GET['project_id'])); 
		// }

		/* limit data */  
		if(@$_REQUEST['length']>=0){
			$this->db->limit(20,0);
		}

		$this->db->order_by('a.item_code', 'ASC'); 

		$this->db->select('rri.*,
			rri.id as rri_id,
			rri.date_created as dc,
			rri.in_qty as in_qty_rri,
			rri.out_qty as out_qty_rri,
			rri.qty as qty_rri,
			rri.date_modified as date_modified_rri,
			rri.item_name as rr_item_name,
			rri.item_desc as rr_item_desc,
			a.*, 
			b.title as type_title,
			c.title as category_title,
			d.id as uom_id,
			d.title as uom_title,
			e.title as classification_title,
			f.project_id as project_id,
			f.po_number as po_number,
			g.id as project_id,
			g.name as project_name,
			g.control_number as project_control_number,
			h.invoice_number as invoice_number,
			h.dr_number as dr_number, 
			h.rr_number as rr_number, 
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy,
			i.title as inventory_accounts_title,
			i.ds as inventory_accounts_code
			');

        $this->db->from('receiving_report_items rri');  
        $this->db->join('inventory a', 'a.id=rri.inventory_id', 'inner left'); 
        $this->db->join('fm_inventory_type b', 'b.id=a.inventory_type_id', 'left');
        $this->db->join('fm_inventory_category c', 'c.id=a.inventory_category_id', 'left'); 
        $this->db->join('fm_uom d', 'd.id=a.uom_type_id', 'left'); 
        $this->db->join('fm_classification e', 'e.id=a.classification_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left'); 
        $this->db->join('receiving_report h', 'h.id=rri.receiving_report_id', 'left');  
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id_rr', 'left');
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        //$this->db->order_by('rri.id', 'DESC'); 

     	return $this->db->get()->result();

		 
	}

	public function item_rr_all()
	{
		 
		$this->db->where(array('rri.deleted'=>0));  
 		$this->db->where('i.is_in_inventory=1'); 
 		$this->db->where('rri.control_number_type=1'); 

		$this->db->select('rri.*,
			rri.id as rri_id, 
			rri.in_qty as in_qty_rri,
			rri.out_qty as out_qty_rri,
			rri.qty as qty_rri, 
			rri.rate as rate,  
			rri.uom_factor as uom_factor, 
			rri.price as price,  
			rri.freight_charge_amount as freight_charge_amount,
			rri.currency_type_id as currency_type_id,
			((rri.freight_charge_amount / rri.in_qty) * rri.qty) as freight_charge_amount,
			f.project_id as project_id,
			f.po_number as po_number, 
			g.control_number as project_control_number, 
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy, 
			i.id as accounts_id,
			i.title as accounts_title,
			i.title as project_status,
			i.overhead_cost_id as overhead_cost_id
			');

        $this->db->from('receiving_report_items rri');    
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left');   
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id_rr', 'left');
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        $this->db->join('fm_project_status k', 'k.id=f.project_id', 'left');
        //$this->db->order_by('rri.id', 'DESC'); 

     	return $this->db->get()->result();

		 
	}

	public function item_ii_all($project_id = '')
	{
		 
		$this->db->where(array('iii.deleted'=>0)); 
 		
 		if($project_id){
 			$additional_select = ',
 			rri.item_name as item_name,
 			rri.item_desc as item_desc,
 			rr.invoice_number as invoice_number,
 			rr.rr_number as rr_number,
 			d.title as uom_title,';
 			$this->db->where('iii.project_id',$project_id);
 		}

		$this->db->select('iii.*,
			iii.id as iii_id,  
			iii.qty_return as qty_return,
			iii.qty as qty_iii, 
			iii.rate as rate,   
			rri.uom_factor as uom_factor, 
			iii.price as price,  
			((rri.freight_charge_amount / rri.in_qty) * iii.qty) as freight_charge_amount,
			rri.currency_type_id as currency_type_id,
			iii.project_id as project_id,
			f.po_number as po_number, 
			g.control_number as project_control_number, 
			j.jpy_to_php as jpy_to_php,
			j.usd_to_jpy as usd_to_jpy, 
			i.title as accounts_title,
			i.title as project_status,
			i.overhead_cost_id as overhead_cost_id
			'.@$additional_select);

        $this->db->from('issue_inventory_items iii');    
        $this->db->join('receiving_report_items rri', 'rri.id=iii.rri_id', 'left');
        $this->db->join('receiving_report rr', 'rr.id=rri.receiving_report_id', 'left');
        $this->db->join('purchase_order f', 'f.id=rri.purchase_order_id', 'left'); 
        $this->db->join('projects g', 'g.id=f.project_id', 'left');   
        $this->db->join('fm_inventory_accounts i', 'i.id=rri.inventory_accounts_id_rr', 'left');
        $this->db->join('bsp_rate j', 'j.date_for=DATE_FORMAT(f.date_created, "%Y-%m-%d")', 'left');
        $this->db->join('fm_project_status k', 'k.id=f.project_id', 'left');
 		if($project_id){
 			$this->db->join('fm_uom d', 'd.id=iii.uom_id', 'left'); 
 		}

     	return $this->db->get()->result();

		 
	}

	public function save_adjustments()
	{

		$user_id = $this->session->user_id;  
		$date = date("Y-m-d H:i:s");

		$data_ii = [];
		$data_ii['date_created'] = $date;
	    $data_ii['user_id'] = $user_id;

	    $data_ii['check_by_id'] = $this->input->post('check_by_id',TRUE);  
	    $data_ii['remarks'] = $this->input->post('remarks',TRUE);  
	 
	    $this->db->insert('inventory_adjustments', $data_ii);
	    $ajdi_id = $this->db->insert_id();


		if(@$this->input->post('items',TRUE)){
		foreach(@$this->input->post('items',TRUE) as $rrid){

			if(@$this->input->post('qty'.$rrid,TRUE) > 0){

				$qty_before = $this->input->post('qty_before'.$rrid,TRUE);  
				$adj_qty = $this->input->post('qty'.$rrid,TRUE);  
				$adj_type = $this->input->post('adj_type'.$rrid,TRUE);  

				$adj_total = $qty_after - $qty_before;

				//================= CREATE ADJ HEADER
				$data_ii = [];
				$data_ii['date_created'] = $date;
			    $data_ii['user_id'] = $user_id;

			    $data_ii['rri_id'] = $rrid;  

			    $data_ii['adjustment_id'] = $ajdi_id;  

			    $data_ii['qty_before'] = $qty_before; 
			    $data_ii['adj_qty'] = $adj_qty; 
			    $data_ii['adj_type'] = $adj_type; 

			    $data_ii['inventory_id'] = $this->input->post('inv_id'.$rrid,TRUE);  
			 
			    $this->db->insert('inventory_adjustments_items', $data_ii);  
			    $ia_id = $this->db->insert_id();

			    //=================== UPDATE IIR
			    $iirdata = [];

			    if ($adj_type == 2) {
			        $this->db->set('qty', 'qty - ' . abs($adj_qty), false);
			    } else {
			        $this->db->set('qty', 'qty + ' . abs($adj_qty), false);
			    }

			    $this->db->where('id', $rrid)->update('receiving_report_items');

			    //=================== UPDATE INVENTORY
				$idata = [];
				$inventory_id = @$this->input->post('inv_id'.$rrid, TRUE);

				if ($adj_type == 2) { 
				    $idata = ['qty' => 'qty - ' . abs($adj_qty), 'out_qty' => 'out_qty + ' . abs($adj_qty)];
				} else {
				    $idata = ['qty' => 'qty + ' . abs($adj_qty), 'in_qty' => 'in_qty + ' . $adj_qty];
				} 

				$this->db->where('id', $inventory_id)->update('inventory', $idata);


				//==================== ADD OVEMENT HISTORY
				$data_iv = [];
				$data_iv['date_created'] = $date;
				$data_iv['user_id'] = $user_id;

				$data_iv['type'] = 5; // 1=in 2=out 3=transfer 4=retrun 5=adjustment 6=upload

				$data_iv['inventory_id'] = @$this->input->post('inv_id'.$rrid,TRUE);
				$data_iv['rri_id'] = @$rrid; 
				$data_iv['iii_id'] = @$ajdi_id; 

				$data_iv['qty'] = abs($adj_qty); 
				$data_iv['uom_type_id'] = $this->input->post('uom_id'.$rrid,TRUE); 
				$data_iv['deduction'] = ($adj_type==2 ? 1 : 0); 
				$data_iv['qty_before'] = $qty_before; 

				$data_iv['price'] = 0; 
				$data_iv['currency_type_id'] = 0;
				$data_iv['rate'] = ''; 

				$data_iv['reference_id'] = $ia_id; 
				$data_iv['reference_id_type'] = 'inventory_adjustments';  

				$data_iv['uom_conversion_factor'] = 0;
				$data_iv['project_id'] = 0;

				$this->db->insert('inventory_movement', $data_iv); 

				
			    $has = 1;

			}
		}}

		if(@$has == 1){
			return true;
		}else{
			return false;
		}

	}

		
}