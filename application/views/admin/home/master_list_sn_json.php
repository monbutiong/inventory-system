<?php 
$totalRecords=($totaldata-$_REQUEST['length']);
$data=array();

if($bib_location){
	foreach ($bib_location as $rs) {
		$arr_loc[$rs->id] = $rs->title;
	}
}

if($bib_status){
	foreach ($bib_status as $rs) {
		$arr_sts[$rs->id] = $rs->title;
	}
}
 

if($inventory){
	foreach ($inventory as $row) { 
		
		 

		//$data[] = $row; standard fields only
		$data[] = array (  
			'<a class="dropdown-item load_modal_details" href="'.base_url().'bib/bib_history/'.$row->id.'" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><u>'.$row->bib_name.'<u></a>',
			$row->bib_sn,
			$row->customer_title,
			$row->package_type,
			$row->device_number,
			$row->bib_type_title,
			$row->socket_density,
			$row->good_socket,
			$row->defective_socket,
			round(($row->good_socket/$row->socket_density)*100,2).'%',
			@$arr_loc[$row->bib_location_id],
			@$arr_sts[$row->bib_status_id],
			'<a class="dropdown-item load_modal_details" href="'.base_url().'home/bib_edit/'.$row->id.'" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" title="edit"><i class="fa fa-edit"></i></a> | 
			<a class="dropdown-item load_modal_details" href="'.base_url().'home/bib_view/'.$row->id.'" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" title="view"><i class="fa fa-eye"></i></a> | 
			<a href="Javascript:delete_bib('.$row->id.')" title="delete"><i class="fa fa-trash"></i></a>'
			  );
		$totalRecords+=1; 
	}
}	

	$json_data = array(
			"draw"            => intval( $draw ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval( $totalRecords ),
			"data"            => $data   // total data array
	);

	echo json_encode($json_data);

?>