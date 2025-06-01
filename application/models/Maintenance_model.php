<?php  
class Maintenance_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function load_table_data($table_name){

		$rs_table  = array();  

		/* main menu */ 
		$table_data = $this->db->get($table_name);
		if($table_data->num_rows()>0){
			foreach($table_data->result() as $data){
				$rs_table[] = $data; 
			}
		}  

		return array(
			'table_data'        =>	 $rs_table
			);

	}

	public function add_table_data($table_name){

		if($table_name=='fm_asset_group'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'life_in_years' 	   => $this->input->post('life_in_years',TRUE),
			'depriciation_process' => $this->input->post('depriciation_process',TRUE),
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => date("Y-m-d G:i")
			 );
		}elseif($table_name=='fm_classification_type'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'vs_peso_rate' 	       => $this->input->post('vs_peso_rate',TRUE),
			'depriciation_process' => $this->input->post('depriciation_process',TRUE),
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => date("Y-m-d G:i")
			 );

	    }elseif($table_name=='fm_inventory_accounts'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'overhead_cost_id' 	   => $this->input->post('overhead_cost_id',TRUE),
			'is_in_inventory'      => $this->input->post('is_in_inventory',TRUE),
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => date("Y-m-d G:i")
			 );

		}elseif($table_name=='fm_issue_type'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'is_project' 	       => $this->input->post('is_project',TRUE), 
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => date("Y-m-d G:i")
			 );

		}elseif($table_name=='fm_models'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'manufacturer_id'      => $this->input->post('manufacturer_id',TRUE), 
			'model_year'           => $this->input->post('model_year',TRUE), 
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => date("Y-m-d G:i")
			 );

		}else{

			$data = array( 
			'title' 		  => $this->input->post('title',TRUE),
			'ds' 			  => $this->input->post('ds',TRUE),
			'user_id'	      => $this->session->user_id,
			'dc' 	 		  => date("Y-m-d G:i")
			 );

		}

		$result = $this->db->insert($table_name,$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'  	   =>   $result,
			'inserted_id'  =>   $inserted_id
			);

	}	

	public function delete_table_data($table_name,$id){

		$this->db->delete($table_name, array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function load_table_data_one($table_name,$id){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->where(array('id'=>$id));
		$query = $this->db->get(); 
		$rs_table_data = $query->row();  

		return array(
			'table_data'  =>   $rs_table_data
			);

	}

	public function update_table_data($table_name,$id){

		$this->db->set('title',$this->input->post('title',TRUE));  
		$this->db->set('ds',$this->input->post('ds',TRUE)); 
		if($table_name=='fm_asset_group'){
		$this->db->set('life_in_years',$this->input->post('life_in_years',TRUE));
		$this->db->set('depriciation_process',$this->input->post('depriciation_process',TRUE));
		}
		
		if($table_name=='fm_inventory_accounts'){
			$this->db->set('overhead_cost_id',$this->input->post('overhead_cost_id',TRUE)); 
			$this->db->set('is_in_inventory',$this->input->post('is_in_inventory',TRUE)); 
		}
		
		if($table_name=='fm_currency_type'){
		$this->db->set('vs_peso_rate',$this->input->post('vs_peso_rate',TRUE)); 
		}	
		if($table_name=='fm_issue_type'){
		$this->db->set('is_project',$this->input->post('is_project',TRUE)); 
		}	
		if($table_name=='fm_models'){
		$this->db->set('manufacturer_id',$this->input->post('manufacturer_id',TRUE)); 
		$this->db->set('model_year',$this->input->post('model_year',TRUE)); 
		}	
		$this->db->set('user_id',$this->session->user_id);  
		$this->db->set('dc',date("Y-m-d G:i"));   
	  
		$this->db->where('id', $id);
		$this->db->update($table_name); 

		return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function check_title_duplication_validation(){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("id");
		$this->db->from($this->input->post('table_name',TRUE));
		$this->db->where(array('title'=>$this->input->post('title',TRUE)));
		$query = $this->db->get();   

		if($query->num_rows() == 1){
			return  false;
		}else{
			return  true;
		}

	}

	public function check_title_duplication_validation_update($table_name,$id){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("id");
		$this->db->from($table_name);
		$this->db->where(array('title'=>$this->input->post('title',TRUE),'id !='=>$id));
		$query = $this->db->get();   

		//$this->output->enable_profiler(TRUE);

		if($query->num_rows() == 1){
			return  false;
		}else{
			return  true;
		}

	}



}