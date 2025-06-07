<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once FCPATH . 'vendor/autoload.php';

//use PhpOffice\PhpSpreadsheet\IOFactory;

//use TNkemdilim\MoneyToWords\Converter;

class Crm extends CI_Controller {


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
		                'name_of_user'  => $user->name_of_user,
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

	public function clients(){

		$module = $this->system_menu;

		$url = $this->router->class.'/'.$this->router->method; 
		$this->check_access($url, $module['sub_menu'], $module['index_user_roles']);

		$module['module'] = "crm/clients";
		$module['map_link']   = "crm->clients";  
 
		$module['clients'] = $this->core->load_core_data('clients');
  
		$module['users'] = $this->core->load_core_data('account','','id,name');

		$this->load->view('admin/index',$module);

	}

	public function add_clients(){
  		
		$module['clients_code'] = count($this->core->load_core_data('clients','','id','code LIKE "%CNO%"'))+1;

		$this->load->view('admin/crm/clients_add',$module);

	}

	public function edit_clients($id){

		$module['clients'] = $this->core->load_core_data('clients', $id);
  
		$this->load->view('admin/crm/clients_edit', $module);

	}

	public function view_clients($id){

		$module['clients'] = $this->core->load_core_data('clients', $id);
  
		$this->load->view('admin/crm/clients_view', $module);

	}

	 

	public function save_clients($modal = '')
	{
		$model = $this->core->global_query(1,'clients'); 

 		if($_FILES["logo"]){
			move_uploaded_file($_FILES["logo"]["tmp_name"], './assets/images/clients/logo-'.$model['query_id'].'.png');
		}
		
		if($modal == 1){

			echo $model['query_id'];

		}else{
		
			if($model['result']){ 
				 
				$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
				  
			}else{

				$this->session->set_flashdata("error","error saving.");

			}

		
			redirect("crm/clients","refresh");
		}
		
	}

	public function update_clients($id)
	{

		if($_FILES["logo"]){
			move_uploaded_file($_FILES["logo"]["tmp_name"], './assets/images/clients/logo-'.$id.'.png');
		}

		$model = $this->core->global_query(2,'clients', $id); 

		if($model['result']){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("crm/clients","refresh");
	}

	public function delete_clients($id)
	{
		$model = $this->core->global_query(3,'clients', $id); 

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

	public function delete_client_image($id)
	{
 
		if(unlink('./assets/images/clients/logo-'.$id.'.png')){ 
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="Picture successfuly removed."] ?? $l); 
			  
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("crm/clients","refresh");
	}

	public function add_documents($cid){
 	
 		$module['cid'] = $cid;

 		$result = $this->admin_model->load_filemaintenance('fm_client_document_type');
		$module['document_type'] = $result['maintenance_data'];
		
		$this->load->view('admin/crm/add_documents',$module);

	}

 

	public function save_documents($cid){ 

		$model = $this->core->global_query(1,'clients_documents','',['client_id'=>$cid]); 

		if($model){ 

			$targetDir = "./assets/uploads/clients/".$cid."/";
	 
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
		    	$this->db->where('id',$model['query_id'])->update('clients_documents',[
		    		'attachments'=>json_encode($files_uploaded)
		    	]);
		    }
		    
		    $this->db->insert('projects_recent',[
		    	'date_created'=>date('Y-m-d H:i'),
		    	'user_id'=>$this->session->user_id,
		    	'table'=>'clients_documents',
		    	'ref_id'=>$model['query_id'], 
		    	'client_id'=>$cid
		    ]);

		    if(@$fname){
		    	$this->db->where('id',$model['query_id'])->update('clients_documents',[
		    		'attachments'=>json_encode($files_uploaded),
		    	]);
		    }

		    // $this->db->insert('clients_documents',[
		    // 	'date_created'=>date('Y-m-d H:i'),
		    // 	'user_id'=>$this->session->user_id, 
		    // 	'description'=>$this->input->post('description',TRUE),
		    // 	'document_type_id'=>$this->input->post('document_type_id',TRUE),
		    // 	'attachments'=>json_encode($files_uploaded),
		    // 	'project_id'=>$pid
		    // ]);
			 
			$this->session->set_flashdata("success",$this->system_menu['clang'][$l="successfuly saved."] ?? $l); 
		     
		}else{

			$this->session->set_flashdata("error","error saving.");

		}

		redirect("crm/manage_client/".$cid."/documents","refresh");

	}


 
	
}	