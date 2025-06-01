<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Projects extends CI_Controller {


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

		$module['module'] = "projects/projects";
		$module['map_link']   = "projects->projects";  
 
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations');

		$module['clients'] = $this->core->load_core_data('clients');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function manage_project($id,$tab='',$client_id=''){

		$module = $this->system_menu;
 
		$module['module'] = "projects/manage_project";
		$module['map_link']   = "projects->manage_project";  
		
		$module['pid'] = $id;
		$module['client_id'] = $client_id;

		$module['project'] = $this->core->load_core_data('projects',$id);

		$module['quotation'] = $this->core->load_core_data('quotations','','id,date_created,user_id,quotation_number,version,confirmed_date,confirmed,quotation_date,att_to,date_modified,version','project_id='.@$module['project']->id);

		$module['po'] = $this->core->load_core_data('purchase_order','','id,date_created,user_id,po_number,date_confirmed','confirmed=1 AND project_id='.$module['project']->id);

		$module['receiving'] = $this->core->load_core_data('receiving','','id,date_created,user_id,dr_number,remarks,confirmed_date','confirmed=1 AND project_ids LIKE "%'.$module['project']->id.'%"');

		$module['issuance'] = $this->core->load_core_data('issuance','','id,date_created,user_id,remarks,confirmed_date,ref_no','confirmed=1 AND project_id='.$module['project']->id);

		$module['job_order'] = $this->core->load_core_data('projects_job_order','','id,job_order_number,date_created,user_id','project_id='.$module['project']->id);

		$module['client'] = $this->core->load_core_data('clients',@$module['project']->client_id);
		
		$module['users'] = $this->core->load_core_data('account','','id,name,avatar');

		if($module['project']->project_manager){
			$module['emp'] = $this->core->load_core_data('employee',$module['project']->project_manager);
		}
		 
		$result = $this->admin_model->load_filemaintenance('fm_client_document_type');
		$module['document_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_client_activity_type');
		$module['activity_type'] = $result['maintenance_data'];

		if($tab){
			$module['tab'] = $tab;

			if($tab == 'progress'){

				$module['progress_data'] = $this->core->load_core_data('projects_progress','','','project_id='.$id);

			}elseif($tab == 'documents'){

				$module['documents_data'] = $this->core->load_core_data('projects_documents','','','project_id='.$id); 

			}else{

				$module['progress_data'] = $this->core->load_core_data('projects_progress','','','project_id='.$id);

				$module['documents_data'] = $this->core->load_core_data('projects_documents','','','project_id='.$id); 
			}

		}else{

			$module['tab'] = 'recent';
		}

		$this->load->view('admin/index',$module);

	}

	public function add_progress($pid,$client_id=''){
 	
 		$module['pid'] = $pid;
 		$module['client_id'] = $client_id;

 		$result = $this->admin_model->load_filemaintenance('fm_client_activity_type');
		$module['activity_type'] = $result['maintenance_data'];
		
		$this->load->view('admin/projects/add_progress',$module);

	}

	public function save_progress($pid,$client_id=''){

		$project = $this->core->load_core_data('projects',$pid);

		$model = $this->core->global_query(1,'projects_progress','',['project_id'=>$pid,'client_id'=>$project->client_id]); 

		if($model){ 

			if(@$_FILES['attachments']['tmp_name']){

				$targetDir = "./assets/uploads/projects/".$pid."/";
		 
			    if (!file_exists($targetDir)) {
			       mkdir($targetDir, 0755, true);
			    }
		 		
			    foreach($_FILES['attachments']['tmp_name'] as $key => $tmp_name){

			       $file_name = $_FILES['attachments']['name'][$key];
			       $file_tmp = $_FILES['attachments']['tmp_name'][$key];
		 			
		 		   $fname = $model['query_id']. '_'. uniqid() . '_' . $file_name;		
		 
		           $newFileName = $targetDir . $fname;

		           if(move_uploaded_file($file_tmp, $newFileName)){
		               //echo "File $file_name uploaded successfully.<br>";
		           		$files_uploaded[] = $fname;
		           }   
			    } 

			    if(@$fname){
			    	$this->db->where('id',$model['query_id'])->update('projects_progress',[
			    		'attachments'=>json_encode($files_uploaded)
			    	]);
			    }

			}

		    $this->db->insert('projects_recent',[
		    	'date_created'=>date('Y-m-d H:i'),
		    	'user_id'=>$this->session->user_id,
		    	'table'=>'projects_progress',
		    	'ref_id'=>$model['query_id'],
		    	'date_cover'=>$this->input->post('date_cover',TRUE), 
		    	'client_id'=>$project->client_id,
		    	'project_id'=>$project->id
		    ]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
		     
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/manage_project/".$pid."/progress/".$client_id,"refresh");

	}

	public function add_documents($pid,$client_id=''){
 	
 		$module['pid'] = $pid;
 		$module['client_id'] = $client_id;

 		$result = $this->admin_model->load_filemaintenance('fm_client_document_type');
		$module['document_type'] = $result['maintenance_data'];
		
		$this->load->view('admin/projects/add_documents',$module);

	}

	public function save_documents($pid,$client_id=''){

		$project = $this->core->load_core_data('projects',$pid);

		$model = $this->core->global_query(1,'projects_progress','',['project_id'=>$pid,'title'=>'Attach Documents']); 

		if($model){ 

			$targetDir = "./assets/uploads/projects/".$pid."/";
	 
		    if (!file_exists($targetDir)) {
		       mkdir($targetDir, 0755, true);
		    }
	 
		    foreach($_FILES['attachments']['tmp_name'] as $key => $tmp_name){

		       $file_name = $_FILES['attachments']['name'][$key];
		       $file_tmp = $_FILES['attachments']['tmp_name'][$key];
	 			
	 		   $fname = $model['query_id']. '_'. uniqid() . '_' . $file_name;		
	 
	           $newFileName = $targetDir . $fname;

	           if(move_uploaded_file($file_tmp, $newFileName)){
	               //echo "File $file_name uploaded successfully.<br>";
	           		$files_uploaded[] = $fname;
	           }   
		    } 

		    if(@$fname){
		    	$this->db->where('id',$model['query_id'])->update('projects_progress',[
		    		'attachments'=>json_encode($files_uploaded)
		    	]);
		    }
		    
		    $this->db->insert('projects_recent',[
		    	'date_created'=>date('Y-m-d H:i'),
		    	'user_id'=>$this->session->user_id,
		    	'table'=>'projects_progress',
		    	'ref_id'=>$model['query_id'], 
		    	'project_id'=>$pid,
		    	'client_id'=>$project->client_id
		    ]);

		    $this->db->insert('projects_documents',[
		    	'date_created'=>date('Y-m-d H:i'),
		    	'user_id'=>$this->session->user_id, 
		    	'description'=>$this->input->post('description',TRUE),
		    	'document_type_id'=>$this->input->post('document_type_id',TRUE),
		    	'attachments'=>json_encode($files_uploaded),
		    	'project_id'=>$pid,
		    	'client_id'=>$project->client_id
		    ]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
		     
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/manage_project/".$pid."/documents/".$client_id,"refresh");

	}

	public function delete_project($id){
	 

		$q = $this->db->where('id',$id)->update('projects',['deleted'=>1,'deleted_by'=>$this->session->user_id]);

		if($q){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/masterlist","refresh");

	}

	public function add_project_quotation($client_id = ''){ 

		$module['client_id'] = $client_id;

		$module['quotation'] = 1;

		$module['clients'] = $this->core->load_core_data('clients'); 

		$this->load->view('admin/projects/add_project',$module);

	}

	public function add_project($client_id = ''){ 

		$module['client_id'] = $client_id;

		$module['clients'] = $this->core->load_core_data('clients');

		$module['users'] = $this->core->load_core_data('account','','id,name');

		$module['emp'] = $this->core->load_core_data('employee');
		
		$this->load->view('admin/projects/add_project',$module);

	}

	public function save_project($client_id = '',$new_client_id = ''){
	  	
	  	if(@$new_client_id){
	  		$model = $this->core->global_query(1,'projects','',['client_id'=>$new_client_id]);
	  	}else{
	  		$model = $this->core->global_query(1,'projects');
	  	} 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		if($client_id == 'from_new_quote'){
			echo $model['query_id'];
		}elseif($client_id){
			redirect("crm/manage_client/".$client_id."/project","refresh");
		}else{
			redirect("projects/masterlist","refresh");
		}
		

	}


	public function edit_project($id){ 

		$module['clients'] = $this->core->load_core_data('clients');
		
		$module['project'] = $this->core->load_core_data('projects',$id);

		$module['emp'] = $this->core->load_core_data('employee');

		$this->load->view('admin/projects/edit_project',$module);

	}

	public function update_project($id){
	  
		$model = $this->core->global_query(2,'projects',$id);

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/masterlist","refresh");

	}

	public function load_project_list()
	{
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations');

		$module['clients'] = $this->core->load_core_data('clients'); 

		$this->load->view('admin/projects/load_project_list',$module);
	}

	public function load_client_list()
	{  
		$module['clients'] = $this->core->load_core_data('clients'); 

		$this->load->view('admin/projects/load_client_list',$module);
	}

	public function load_job_order_list()
	{
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['job_order'] = $this->core->load_core_data('projects_job_order');

		$this->load->view('admin/projects/load_job_order_list',$module);
	}

	public function job_order(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "projects/job_order";
		$module['map_link']   = "projects->job_order";  
		
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['job_order'] = $this->core->load_core_data('projects_job_order');
		
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function add_job_order(){ 
		
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations','','','confirmed=1');

		$module['clients'] = $this->core->load_core_data('clients');

		$this->load->view('admin/projects/add_job_order',$module);

	}

	public function load_quote($id){
 
		$module['quotation'] = $this->core->load_core_data('quotations',$id);

		$module['project'] = $this->core->load_core_data('projects',$module['quotation']->project_id);

		$module['client'] = $this->core->load_core_data('clients',$module['quotation']->client_id);

		die( json_encode([
		'quotation'=>	$module['quotation'],
			'project'  =>	$module['project'],
			'client'   =>	$module['client']
		]) );

	}

	public function save_job_order()
	{
		
		$q = $this->db->get_where('quotations',['id'=>$this->input->post('quotation_id',TRUE)])->row();

		$model = $this->core->global_query(1,'projects_job_order','',[
			'client_id'=>$q->client_id,
			'project_id'=>$q->project_id
		]);

		if($model['result']){ 

			$this->db->insert('projects_recent',[
				'date_created'=>date('Y-m-d H:i'),
				'user_id'=>$this->session->user_id,
				'table'=>'projects_job_order',
				'ref_id'=>$model['query_id'], 
				'client_id'=>$q->client_id,
				'project_id'=>$q->project_id
			]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/job_order","refresh");


	}

	public function edit_job_order($id){ 
		
		$module['projects'] = $this->core->load_core_data('projects');

		$module['quotations'] = $this->core->load_core_data('quotations');

		$module['clients'] = $this->core->load_core_data('clients');

		$module['jo'] = $this->core->load_core_data('projects_job_order',$id);

		$this->load->view('admin/projects/edit_job_order',$module);

	}

	public function update_job_order($id)
	{
		
		$q = $this->db->get_where('quotations',['id'=>$this->input->post('quotation_id',TRUE)])->row();

		$model = $this->core->global_query(2,'projects_job_order',$id,[
			'client_id'=>$q->client_id,
			'project_id'=>$q->project_id
		]);

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/job_order","refresh");


	}

	public function job_order_labor($id){

			$module['jo'] = $this->core->load_core_data('projects_job_order',$id);
 
			$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id);

			$module['qi'] = $this->core->load_core_data('quotations_items','','','is_manpower=1 AND quotation_id='.$module['jo']->quotation_id);
 			
 			$module['labor'] = $this->core->load_core_data('projects_job_order_labor','','','job_order_id='.$module['jo']->id);

			$result = $this->admin_model->load_filemaintenance('fm_manpower');
			$module['manpower'] = $result['maintenance_data'];

			$this->load->view('admin/projects/job_order_labor',$module);
	}

	public function save_labor($jo_id){

		$status = $this->input->post('status',TRUE); 
		$qi_id = $this->input->post('qi_id',TRUE); 
		$qty = $this->input->post('qty',TRUE);
		$remarks = $this->input->post('remarks',TRUE); 

		$exist = $this->db->select('id')->get_where('projects_job_order_labor',[
			'quotation_item_id'=>$qi_id,
			'job_order_id'=>$jo_id
		])->row();

		if($qty > 0){

			if($status == 1){

				if(@$exist->id){
					$this->db->where('id',$exist->id);
					$this->db->update('projects_job_order_labor',[
						'modified_by' => $this->session->user_id,
						'date_modified' => date('Y-m-d'), 
						'qty' => $qty,
						'remarks' => $remarks,
						'deleted' => 0
					]);
				}else{
					$this->db->insert('projects_job_order_labor',[
						'user_id' => $this->session->user_id,
						'date_created' => date('Y-m-d'),
						'job_order_id' => $jo_id,
						'quotation_item_id' => $qi_id,
						'qty' => $qty,
						'remarks' => $remarks
					]);
				}
				

			}else{
				if(@$exist->id){
					$this->db->where('id',$exist->id);
					$this->db->update('projects_job_order_labor',[
						'deleted_by' => $this->session->user_id,
						'date_deleted' => date('Y-m-d') 
					]);
				} 
			}

			echo 1;

		}
	}

	public function job_order_clock_in($id){

		$module['jo'] = $this->core->load_core_data('projects_job_order',$id);
 
        $module['cio'] = $this->core->load_core_data('projects_job_order_clock_in','','','job_order_id='.$module['jo']->id); 

  		$module['emp'] = $this->db->select('id,employee_number,first_name,last_name')->get_where('employee',['deleted'=>0])->result();
  		
  		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/projects/job_order_clock_in',$module);

	}

	public function view_job_order($id){ 
		 

		$module['clients'] = $this->core->load_core_data('clients');

		$module['jo'] = $this->core->load_core_data('projects_job_order',$id);
 
			$this->db->where('a.job_order_id',$module['jo']->id);
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

		$module['quotation'] = $this->core->load_core_data('quotations',$module['jo']->quotation_id);
		
		$module['user'] = $this->core->load_core_data('account',$module['jo']->user_id);  

		$module['project'] = $this->core->load_core_data('projects',$module['jo']->project_id); 

		$module['client'] = $this->core->load_core_data('clients',$module['jo']->client_id); 

		$module['labor'] = $this->core->load_core_data('projects_job_order_labor','','','job_order_id='.$module['jo']->id);

		$module['qi'] = $this->core->load_core_data('quotations_items','','','is_manpower=1 AND quotation_id='.$module['jo']->quotation_id);

		$this->load->view('admin/projects/view_job_order',$module);

	}

	public function delete_job_order($id)
	{
		 
		$model = $this->core->global_query(3,'projects_job_order',$id);

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("projects/job_order","refresh");

	}

	public function clock_in_out(){

		$module = $this->system_menu;
 
		$module['module'] = "projects/clock_in_out";
		$module['map_link']   = "projects->clock_in_out";  
 
		$module['projects'] = $this->core->load_core_data('projects');

		$module['jo'] = $this->core->load_core_data('projects_job_order');

		$module['cio'] = $this->core->load_core_data('projects_job_order_clock_in');

		$module['emp'] = $this->db->select('id,employee_number,first_name,last_name')->get_where('employee',['deleted'=>0])->result();
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function download_clock_in_out_data(){

		// API Endpoint
		$apiUrl = api_url.'/api/download_data';

		// Data to be sent in the POST request
		$postData = [ 
		    'key' => 'Key@734791238'
		    // Add more key-value pairs as needed
		];

		// Initialize cURL session
		$ch = curl_init($apiUrl);

		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
		curl_setopt($ch, CURLOPT_POST, true); // Set as POST request
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Set POST data

		// Execute cURL session and get the response
		$response = curl_exec($ch);

		// Check for cURL errors
		if (curl_errno($ch)) {
			
			$this->session->set_flashdata("error","error saving information"); 

		    echo 'cURL error: ' . curl_error($ch);

		}else{
 
			
			$response = json_decode($response);

			if($response){

				foreach ($response as $rs) {
					$this->db->insert('projects_job_order_clock_in',[
						'job_order_id'=>$rs->job_order_id,
						'employee_id'=>$rs->employee_id,
						'date'=> $rs->log_date,
						'time_in'=> $rs->time_in,
						'time_out'=> $rs->time_out,
						'loc_in'=> $rs->in_loc,
						'loc_out'=> $rs->out_loc,
						'comment'=> $rs->comment,
						'date_created' => date('Y-m-d H:i')
					]);
					$updated[] = ['id'=>$rs->id];
				}

				//print_r($response);

	 			if($updated){

	 				$this->session->set_flashdata("success","employee information successfully updated");  
				 
					$apiUrl = 'http://localhost/ventum-time/api/update_downloaded_data';
		 
					$postData = [ 
					    'key' => 'Key@734791238',
					    'datas' => json_encode($updated)
					];

					// Initialize cURL session
					$ch = curl_init($apiUrl);

					// Set cURL options
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
					curl_setopt($ch, CURLOPT_POST, true); // Set as POST request
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Set POST data

					// Execute cURL session and get the response
					$response = curl_exec($ch);

				}

			}else{

				$this->session->set_flashdata("error","no data was pulled from Ventum web app.");

			}

		}

		// Close cURL session
		curl_close($ch);

		redirect("projects/clock_in_out","refresh");

	}
  
}	