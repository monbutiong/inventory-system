<?php  
class Employee_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function load_employee_list(){

		$rs_employee      = array();  

		/* employee master */ 
		$employee = $this->db->get("employee");
		if($employee->num_rows()>0){
			foreach($employee->result() as $data){
				$rs_employee[] = $data; 
			}
		}  

		return array(
			'employee'  =>	 $rs_employee 
			);

	}

	public function load_employee($id){

		$rs_employee      = array();  

		/* employee master */ 
		$this->db->select("*");
		$this->db->from("employee");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get(); 
		$rs_employee = $query->row();    

		return array(
			'employee'  =>	 $rs_employee 
			);

	}

	public function add_employee(){
 

		$data = array( 
		'employee_number'=> $this->input->post('employee_number',TRUE),
		'last_name' 	 => $this->input->post('last_name',TRUE),
		'first_name' 	 => $this->input->post('first_name',TRUE),
		'middle_name'	 => $this->input->post('middle_name',TRUE),
		'department_id'	 => $this->input->post('department_id',TRUE),
		'designation_id' => $this->input->post('designation_id',TRUE),
		'birth_date'	 => date(datedb,strtotime($this->input->post('bday',TRUE))),
		'gender'		 => $this->input->post('gender',TRUE),
		'email_address'	 => $this->input->post('email',TRUE),
		'contact_no'	 => $this->input->post('contact_no',TRUE),
		'address'		 => $this->input->post('address',TRUE),
		'dc' 			 => datedb,
		'user_id' 		 => $this->session->user_id,
		'rate' 		     => $this->input->post('rate',TRUE),
		'basic_amount'   => $this->input->post('basic_amount',TRUE)
		 );

		$result = $this->db->insert('employee',$data);
		//$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true;
		$employee_id = $this->db->insert_id(); 

		return array(
			'result'       =>  $result,
			'employee_id'  => $employee_id
			);

	}

	public function delete_employee($id){

		$this->db->delete('employee', array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function select_employee($id){

		$rs_employee      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("employee");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get(); 
		$rs_employee = $query->row(); 

		return array(
			'employee'  =>	 $rs_employee
			);

	}

	public function update_employee($id){

		$this->db->set('employee_number',$this->input->post('employee_number',TRUE));  
		$this->db->set('last_name',$this->input->post('last_name',TRUE));   
		$this->db->set('first_name',$this->input->post('first_name',TRUE));
		$this->db->set('middle_name',$this->input->post('middle_name',TRUE));
		$this->db->set('department_id',$this->input->post('department_id',TRUE));
		$this->db->set('designation_id',$this->input->post('designation_id',TRUE));
		$this->db->set('birth_date',date(datedb,strtotime($this->input->post('bday',TRUE))));
		$this->db->set('gender',$this->input->post('gender',TRUE));
		$this->db->set('email_address',$this->input->post('email',TRUE));
		$this->db->set('contact_no',$this->input->post('contact_no',TRUE));
		$this->db->set('address',$this->input->post('address',TRUE));

		$this->db->set('rate',$this->input->post('rate',TRUE));
		$this->db->set('basic_amount',$this->input->post('basic_amount',TRUE));
	  
		$this->db->where('id', $id);
		$this->db->update('employee'); 

		//return ($this->db->affected_rows() != 1) ? false : true;
		return ($this->db->affected_rows() != 1) ? false : true;

	}

}