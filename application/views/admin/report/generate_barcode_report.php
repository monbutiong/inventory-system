<?php error_reporting(0); ?> 
<link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	td{
		font-size: 10px;
	}th{
		font-size: 11px;
		font-weight: bold;
	}
	.highlights{
		background-color: #2A3F54;
		color: #fff;
		word-wrap: break-word;
	}
	@media print
	{    
	    .no-print, .no-print *
	    {
	        display: none !important;
	    }
	}
</style>
 
	<?php  
	$count=0;

	$arr_brand_filter = array();
	$brand_filter = $this->input->post('brand',TRUE);
	if($brand_filter){
		foreach ($brand_filter as $rs) {
			if($rs){
				$arr_brand_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_brand_filter=1; 
	}

	$arr_group_filter = array();
	$group_filter = $this->input->post('group',TRUE);
	if($group_filter){
		foreach ($group_filter as $rs) {
			if($rs){
				$arr_group_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_group_filter=1; 
	}

	$arr_category_filter = array();
	$category_filter = $this->input->post('category',TRUE);
	if($category_filter){
		foreach ($category_filter as $rs) {
			if($rs){
				$arr_category_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_category_filter=1; 
	}


	$arr_type_filter = array();
	$type_filter = $this->input->post('type',TRUE);
	if($type_filter){
		foreach ($type_filter as $rs) {
			if($rs){
				$arr_type_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_type_filter=1; 
	}

	$arr_location_filter = array();
	$type_location = $this->input->post('location',TRUE);
	if($location_filter){
		foreach ($location_filter as $rs) {
			if($rs){
				$arr_location_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_location_filter=1; 
	}

	if($brand){
       foreach($brand as $rs){ 
       	$arr_brand[$rs->id] = $rs->title;
    }}

    if($group){
       foreach($group as $rs){ 
       	$arr_group[$rs->id] = $rs->title;
    }}

    if($category){
       foreach($category as $rs){ 
       	$arr_category[$rs->id] = $rs->title;
    }}

    if($type){
       foreach($type as $rs){ 
       	$arr_type[$rs->id] = $rs->title;
    }}

    if($location){
       foreach($location as $rs){ 
       	$arr_location[$rs->id] = $rs->title;
    }}

    if($employee){
       foreach($employee as $rs){ 
       	$arr_employee[$rs->id] = $rs->last_name.' '.$rs->first_name;
       	$arr_employee_dept[$rs->id] = $rs->department_id;
    }}

    if($department){
       foreach($department as $rs){ 
       	$arr_department[$rs->id] = $rs->title;
    }}

    $asset_status = $this->input->post('asset_status',TRUE);

	if($fa_data){
          foreach ($fa_data as $rs) {   
              if(
              	($arr_brand_filter[$rs->brand_id] || $no_brand_filter) && 
              	($arr_group_filter[$rs->group_id] || $no_group_filter) && 
              	($arr_category_filter[$rs->category_id] || $no_category_filter) && 
              	($arr_type_filter[$rs->type_id] || $no_type_filter) && 
              	($arr_location_filter[$rs->location_id] || $no_location_filter) &&
              	(($asset_status==1 && !$rs->remove_asset && !$rs->lost_asset) || ($asset_status==2 && $rs->remove_asset==1 && !$rs->lost_asset) || ($asset_status==3 && !$rs->remove_asset && $rs->lost_asset==1) || !$asset_status)  
              	){ 
             	  
	?> 
	<div class="col-md-1 col-sm-2 col-xs-3 "> 
	<p><br/>
	<img src="<?php echo base_url();?>report/set_barcode/<?php echo $rs->barcode;?>" alt="barcode : <?php echo $rs->barcode;?>" /> 
 	<br/>
 	</p>
 	</div>
	<?php   }}}?>
	
 

 