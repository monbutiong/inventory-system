<?php  
class Home_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function add_system_user(){

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$password = $phppass->HashPassword($this->input->post("password",TRUE));

		$data = array( 
		'name' 		  => $this->input->post('name',TRUE),
		'account_details' => $this->input->post('account_details',TRUE),
		'department_id' => @$this->input->post('department_id',TRUE),
		'un'	      	  => $this->input->post('username',TRUE),
		'ps'	          => $password,
		'dc' 	 		  => date("Y-m-d G:i"),
		'act'			  => 1
		 );

		$result = $this->db->insert('account',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function update_system_user($id){

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$password = $phppass->HashPassword($this->input->post("password",TRUE));

		$data = array( 
		'name' 		  => $this->input->post('name',TRUE),
		'account_details' => $this->input->post('account_details',TRUE),
		'department_id' => @$this->input->post('department_id',TRUE),
		'un'	      	  => $this->input->post('username',TRUE),
		'ps'	          => $password 
		 );

		$this->db->where('id',$id);
		$result = $this->db->update('account',$data); 
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result,
			'inserted_id'     => $id 
		);

	}

	public function delete_system_user($id){

		$this->db->delete('account', array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function update_user_roles($id){

		$limited = 1;
		$result  = false;

		$this->db->delete('user_roles', array('user_id' => $id));

		$menu_sub = $this->db->get("menu_sub");
		if($menu_sub->num_rows()>0){
			foreach($menu_sub->result() as $data){
				
				if($this->input->post('user_role'.$data->id ,TRUE)){
					$data = array( 
					'user_id' 	   => $id,
					'sub_menu_id'  => $data->id,
					'main_menu_id' => $this->input->post('user_role'.$data->id ,TRUE)
					 );

					$result = $this->db->insert('user_roles',$data);
				}else{
					$limited=0;
				}
			}
		}   

		$this->db->set('full_access',$limited);  
	  
		$this->db->where('id', $id);
		$this->db->update('account'); 

		//return ($this->db->affected_rows() != 1) ? false : true;
		return ($result != true) ? false : true;

	}

	public function settings_update(){

		$this->db->set('timezone',$this->input->post('timezone',TRUE));  
		$this->db->set('currency',$this->input->post('currency',TRUE));  
		$this->db->set('depriciation_cutoff',$this->input->post('depriciation_cutoff',TRUE)); 
	  
		$this->db->update('settings'); 

		//$this->output->enable_profiler(TRUE);

		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function update_avatar(){ 

		$name_file = $_FILES['profile_pic']['name'];
		$ext = $this->get_file_extension($name_file); 

		$this->db->set('avatar',"profile-".$this->session->user_id.".".$ext);      
	    
	    $this->db->where('id', $this->session->user_id);
		$this->db->update('account'); 

		//$this->output->enable_profiler(TRUE);

		return ($this->db->affected_rows() != 1) ? false : true;


	}

	public function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}


	public function change_password(){

		$result = '';

		$password = $this->input->post("current_password",TRUE);
		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$new_password = $phppass->HashPassword($this->input->post("new_password",TRUE));

		$this->db->where('id',$this->session->user_id);
		$my_account = $this->db->get("account"); 
		$rs = $my_account->row();

		$getpwd = $rs->ps; 
		$result_pass = $phppass->CheckPassword($password, $getpwd);

		if ($result_pass == true) {  

			$this->db->set('ps',$new_password); 

			$this->db->where('id', $this->session->user_id);
			$this->db->update('account'); 

			$result = ($this->db->affected_rows() != 1) ? false : true;

		}

		return $result;

	}



}