<?php 
$totalRecords=($totaldata-$_REQUEST['length']);
$data=array();

//$inventory2 = [];

if($inventory){
	foreach ($inventory as $rs) { 
		$inventory2[$rs->bib_name] = $rs;
		@$arr_count[$rs->bib_name]+= 1;

		@$arr_socket_good[$rs->bib_name]+= $rs->good_socket;
		@$arr_socket_bad[$rs->bib_name]+= $rs->defective_socket;
		
		@$arr_socket_density[$rs->bib_name]+= $rs->socket_density;
		@$arr_socket_availability[$rs->bib_name]+= round(($rs->good_socket/$rs->socket_density)*100,2);
		@$arr_bib_loc[$rs->bib_name.'-x-'.$rs->bib_location_id]+=1;
	}
} 

if($customer){
	foreach ($customer as $rs) { 
		$arr_customer[$rs->id] = $rs->title;
	}
}

if($bib_type){
	foreach ($bib_type as $rs) { 
		$arr_bib_type[$rs->id] = $rs->title;
	}
}

if(@$inventory2){
	foreach ($inventory2 as $row) { 
		
		//$data[] = $row; standard fields only
		$data[] = array (  
			'<a class="dropdown-item load_modal_details" href="'.base_url().'bib/bib_history/'.$row->id.'" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><u>'.$row->bib_name.'<u></a>', 
			@$arr_customer[@$row->customer_id],
			@$row->package_type,
			@$row->device_number,
			$arr_bib_type[@$row->bib_type_id],
			@$row->socket_density,
			(@$arr_count[@$row->bib_name] ? $arr_count[$row->bib_name] : 0),
			(@$arr_socket_density[@$row->bib_name] ? $arr_socket_density[$row->bib_name] : 0),
			(@$arr_socket_good[@$row->bib_name] ? $arr_socket_good[$row->bib_name] : 0),
			(@$arr_socket_bad[@$row->bib_name] ? $arr_socket_bad[$row->bib_name] : 0),
			(@$arr_socket_availability[@$row->bib_name] ? round($arr_socket_availability[$row->bib_name]/$arr_count[$row->bib_name],2) : 0).'%',
			(@$arr_bib_loc[$row->bib_name.'-x-6'] ? @$arr_bib_loc[$row->bib_name.'-x-6'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-5'] ? @$arr_bib_loc[$row->bib_name.'-x-5'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-7'] ? @$arr_bib_loc[$row->bib_name.'-x-7'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-8'] ? @$arr_bib_loc[$row->bib_name.'-x-8'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-9'] ? @$arr_bib_loc[$row->bib_name.'-x-9'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-11'] ? @$arr_bib_loc[$row->bib_name.'-x-11'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-10'] ? @$arr_bib_loc[$row->bib_name.'-x-10'] : 0),
			(@$arr_bib_loc[$row->bib_name.'-x-12'] ? @$arr_bib_loc[$row->bib_name.'-x-12'] : 0) 
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