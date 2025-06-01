<?php  
class Index_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function validate_login(){

		$result 	  = array(); 
		$account 	  = array();
		$user_id 	  = array();
		$name_of_user = array(); 
		$account_details = array();

		$password = $this->input->post("password",TRUE);
		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

		/* ADMIN LOGIN VALIDATION */

		$this->db->where('un',$this->input->post("username",TRUE));
		$admin_account = $this->db->get("account"); 

		if ($admin_account->num_rows() == 1) {  
			
			$rs = $admin_account->row();

			$getpwd = $rs->ps; 
			$result = $phppass->CheckPassword($password, $getpwd);

			$account = $rs->admin;

			$user_id = $rs->id; 
			$account_details = $rs->account_details;
			$name = $rs->name;
			$department_id = $rs->department_id;
 

		} 

		//return ($result === true) ? "login success" : "Error usernam/password " ;
		return array(
			'success'	      => $result,
			'account'         => @$account,
			'user_id'         => @$user_id,
			'name_of_user'    => @$name,
			'account_details' => @$account_details,
			'department_id' => @$department_id
			);

	}


}