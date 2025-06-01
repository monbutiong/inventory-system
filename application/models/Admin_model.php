<?php  
class Admin_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function audit_trail_logging($module,$log_description){ 

		$data = array( 
		'module' 	 	 => $module,
		'description' 	 => $log_description, 
		'dc' 			 => datetimedb,
		'user_id' 		 => $this->session->user_id
		 );

		$result = $this->db->insert('audit_trail',$data);
		//$inserted_id = $this->db->insert_id();
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function load_audit_trail(){

		$rs_audit_trail      = array();   

		$this->db->order_by("id", "desc");
		$this->db->where(array('user_id'=>$this->session->user_id));
		$audit_trail = $this->db->get("audit_trail");
		if($audit_trail->num_rows()>0){
			foreach($audit_trail->result() as $data){
				$rs_audit_trail[] = $data; 
			}
		} 

		return array(
			'audit_trail'  =>	 $rs_audit_trail 
			);

	}

	public function load_index_data(){

		$rs_main_menu  = array(); 
		$rs_sub_menu   = array(); 
		$rs_user_roles = array();
		$rs_settings   = array();
		$rs_notif = array();
		$sql_selected_asset = array();
		$sql_selected_assets = '';
		$rs_selected_assets = array();
		$pr_request = [];
		$po_request = [];

		/* account info */
		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$this->session->user_id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row(); 
		$emp_id = @$rs_system_user->emp_id;
		$avatar = @$rs_system_user->avatar;


		/* main menu */
		$this->db->order_by("pri", "asc");
		$this->db->where('act', 1);
		$main_menu = $this->db->get("menu_main");
		if($main_menu->num_rows()>0){
			foreach($main_menu->result() as $data){
				$rs_main_menu[] = $data; 
			}
		} 

		/* sub menu */
		$this->db->order_by("pri", "asc");
		$this->db->where('act', 1);
		$sub_menu = $this->db->get("menu_sub");
		if($sub_menu->num_rows()>0){
			foreach($sub_menu->result() as $data){
				$rs_sub_menu[] = $data; 
			}
		} 

		/* user roles */
		$this->db->where('user_id', $this->session->user_id);
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		} 

		/* settings */
		$this->db->select("*");
		$this->db->from("settings"); 
		$query = $this->db->get(); 
		$rs_settings = $query->row(); 

		if($rs_settings->timezone){
			 date_default_timezone_set($rs_settings->timezone);
		}   
 
		 

		return array(
			'main_menu'          =>	 $rs_main_menu,
			'sub_menu'	         =>	 $rs_sub_menu,
			'index_user_roles'   =>	 $rs_user_roles,
			'settings' 		     =>  $rs_settings, 
			'avatar'			 =>  $avatar
			);
	}

	public function load_system_users(){

		$rs_system_users      = array();  

		/* user list */
		$this->db->where('act', 1);
		$system_users = $this->db->get("account");
		if($system_users->num_rows()>0){
			foreach($system_users->result() as $data){
				$rs_system_users[] = $data; 
			}
		}  

		return array(
			'system_users'  =>	 $rs_system_users 
			);

	}

	public function load_system_user($id){

		$rs_system_user      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row(); 
		$emp_id = $rs_system_user->emp_id;

		return array(
			'system_user'  =>	 $rs_system_user,
			'emp_id' 		=> $emp_id
			);

	}

	public function load_user_roles($id){

		$rs_user_roles  = array();  

		/* user roles */
		$this->db->where('user_id', $id);
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		}  

		return array(
			'user_roles'  =>	 $rs_user_roles 
			);

	}

	public function load_user_roles_all(){

		$rs_user_roles  = array();  

		/* user roles */ 
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		}  

		return array(
			'user_roles'  =>	 $rs_user_roles 
			);

	}

	public function load_filemaintenance($table_name, $id = ''){
		
		$table_data  = array();  

		/* user roles */ 
		if($id){
			$table_data = $this->db->get_where($table_name,['id'=>$id])->row();
		}else{
			$table_data = $this->db->get($table_name)->result();
		} 
 
		return array(
			'maintenance_data'  =>	 $table_data 
			);

	}

	public function system_user_info(){

		$rs_system_user      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$this->session->user_id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row(); 
		$emp_id = $rs_system_user->emp_id;
		$avatar = $rs_system_user->avatar;

		return array( 
			'emp_id' 		=> $emp_id,
			'avatar'        => $avatar
			);

	}

}