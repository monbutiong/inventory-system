<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Vehicles extends CI_Controller {


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

		if (!$this->session->userdata('user_id')) {
		    $remember_token = $_COOKIE['remember_token'] ?? null;

		    if ($remember_token) {
		        $user = $this->db->get_where('account', ['remember_token' => $remember_token])->row();

		        if ($user) {
		            $this->session->set_userdata([
		                'user_id'       => $user->id,
		                'name_of_user'  => $user->name,
		                'account'       => $user->account,
		                'department_id' => $user->department_id,
		                'username'      => $user->username,
		                'datetime'      => sdatetime,
		                'logged_in'     => TRUE
		            ]);
		        } else {
		            redirect(base_url(),"refresh");
		        }
		    } else {
		        redirect(base_url(),"refresh");
		    }
		}

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

		$module['module'] = "vehicles/masterlist";
		$module['map_link']   = "vehicles->masterlist";  
 
		$module['vehicles'] = $this->core->load_core_data('vehicles');
 
		$result = $this->admin_model->load_filemaintenance('fm_models');
		$module['models'] = $result['maintenance_data'];
 
		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
		$module['manufacturers'] = $result['maintenance_data'];

		$module['customers'] = $this->core->load_core_data('clients');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}
 
	public function add_vehicle(){
 	 
 		$result = $this->admin_model->load_filemaintenance('fm_models');
 		$module['models'] = $result['maintenance_data'];
 		
 		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
 		$module['manufacturers'] = $result['maintenance_data'];

 		$module['customers'] = $this->core->load_core_data('clients');
		
		$this->load->view('admin/vehicles/add_vehicle',$module);

	}

	public function load_model($id)
	{
		$manu = $this->db->get_where('fm_models',['manufacturer_id' => $id])->result();
		echo '<select name="vehicle_model_id" id="vehicle_model_id" class="form-control col-md-7 col-xs-12 select2">
              	<option value="">Select</option>';
        if($manu){
		foreach($manu as $rs){
		echo '<option value="'.$rs->id.'">'.$rs->title.' - '.$rs->model_year.'</option>';
		}}
		echo '</select>
            </div>
          </div> ';	
        echo "<script>
        			     $('#vehicle_model_id').select2({
        		            dropdownParent: $('#global_modal') 
        		         });
        	</script>";
          die();
	}

	public function save_vehicle() {
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

	        $this->session->set_flashdata("success", $this->system_menu['clang']["successfuly saved."] ?? "Successfully saved.");
	    } else {
	        $this->session->set_flashdata("error", "Error saving.");
	    }

	    redirect("vehicles/masterlist/", "refresh");
	}

  public function check_plate_no()
  {
  	if(@$this->input->post('plate_no',TRUE)){
  		$q = $this->db->select('id')->get_where('vehicles',['plate_no'=>$this->input->post('plate_no',TRUE)]);
  		if($q->id){
  			echo $q->id;
  		}
  		die();
  	}
  }

  public function check_vin()
  {
  	if(@$this->input->post('vin',TRUE)){
  		$q = $this->db->select('id')->get_where('vehicles',['vin'=>$this->input->post('vin',TRUE)]);
  		if($q->id){
  			echo $q->id;
  		}
  		die();
  	}
  }

  public function edit_vehicle(int $id)
  {
	 		$result = $this->admin_model->load_filemaintenance('fm_models');
	 		$module['models'] = $result['maintenance_data'];
	 		
	 		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
	 		$module['manufacturers'] = $result['maintenance_data'];

	 		$module['customers'] = $this->core->load_core_data('clients');

	 		$module['vehicle'] = $this->core->load_core_data('vehicles',$id);
			
			$this->load->view('admin/vehicles/edit_vehicle',$module);
  }


  public function update_vehicle(int $id) {

      $model = $this->core->global_query(2, 'vehicles', $id);

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

          $this->session->set_flashdata("success", $this->system_menu['clang']["successfuly saved."] ?? "Successfully updated.");
      } else {
          $this->session->set_flashdata("error", "Error saving.");
      }

      redirect("vehicles/masterlist/", "refresh");
  }

  public function view_vehicle(int $id)
  {
	 		$result = $this->admin_model->load_filemaintenance('fm_models');
	 		$module['models'] = $result['maintenance_data'];
	 		
	 		$result = $this->admin_model->load_filemaintenance('fm_manufacturers');
	 		$module['manufacturers'] = $result['maintenance_data'];

	 		$module['customers'] = $this->core->load_core_data('clients');

	 		$module['vehicle'] = $this->core->load_core_data('vehicles',$id);
			
			$this->load->view('admin/vehicles/view_vehicle',$module);
  }
 
	public function delete_vehicle($id){
	 

		$model = $this->core->global_query(3, 'vehicles', $id);

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

	public function delete_vehicle_image($no, $id)
	{
		$item = $this->db->get_where('vehicles', ['id' => $id])->row();

		$model = $this->core->global_query(2,'vehicles', $id, ['picture_'.$no => null]); 

		if($model['result']){ 

			if(unlink('./assets/uploads/vehicles/'.@$item->{'picture_'.$no})){ 
				 

				echo 1;  
				  
			}else{

				echo 0;

			}

		}else{

			echo 0;

		}

		die();
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