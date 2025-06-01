<?php  
class Bib_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	 public function save_logs($log_type){

	 	$user_id = $this->session->user_id;
	 	$batch_data = [];
	 	$batch_update = [];

	 	foreach ($this->input->post('inv') as $id) {
	 		$data = [];
	 		$data['inventory_id'] = $id; 
	 		$data['bib_location_id_from'] = $this->input->post('bib_location_id_orig'.$id);
	 		$data['rack_from'] = $this->input->post('rack_orig'.$id);
	 		$data['bib_location_id_to'] = $this->input->post('bib_location_id'.$id);
	 		$data['rack_to'] = $this->input->post('rack'.$id);
	 		$data['remarks'] = $this->input->post('remarks'.$id);
	 		$data['log_type'] = $log_type;
	 		$data['user_id'] = $user_id;
	 		$data['date_created'] =date("Y-m-d G:i");

	 		$batch_data[] = $data;

	 		$data = [];

	 		$update = array( 
	 			'bib_location_id' => $this->input->post('bib_location_id'.$id),
	 			'rack' => $this->input->post('rack'.$id),
	 			'date_modified' => date("Y-m-d G:i"),
	 			'modified_by' => $user_id
	 		);
	 		$this->db->update('inventory', $update, ['id'=>$id]);
	 	}

	 	$this->db->insert_batch('inventory_logs', $batch_data); 

	 	return array(
	 		'result'          => true,
	 		'query_id'     => 0 
	 	);

	 }


	 public function save_repair_logs($id){

	 	$user_id = $this->session->user_id;
	 	$batch_data = [];
	 	$batch_update = [];
 
 		$data = [];
 		$data['inventory_id'] = $id; 
 		$data['bib_location_id_from'] = $this->input->post('bib_location_id_orig');
 		$data['bib_location_id_to'] = $this->input->post('bib_location_id');
 		$data['remarks'] = $this->input->post('remarks');
 		$data['log_type'] = 'BIB for Repair OUT';
 		$data['user_id'] = $user_id;
 		$data['date_created'] =date("Y-m-d G:i"); 
  
 		$update = array( 
 			'bib_location_id' => $this->input->post('bib_location_id'),
 			'date_modified' => date("Y-m-d G:i"),
 			'modified_by' => $user_id
 		);
 		$this->db->update('inventory', $update, ['id'=>$id]);
 

	 	$this->db->insert('inventory_logs', $data); 

	 	return array(
	 		'result'          => true,
	 		'query_id'     => 0 
	 	);

	 }

}