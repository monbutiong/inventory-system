<?php error_reporting(0);

if($this->input->post('export_to_excel')==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventory_masterlist_report.xls");
header("Pragma: no-cache"); 	
header("Expires: 0");
}?> 
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
 

<h4>Inventory Masterlist Report  
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>#</th>
		<th>Item Name</th>
		<th>Description</th> 
		<th>Barcode</th>
		<th>Category</th> 
		<th>Type</th>
		<th>Brand</th> 
		<th>Manufacturer</th> 
		<th>Ceiling Inventory</th>
		<th>Ordering Point</th>
		<th>Qty</th>
		<th>UOM</th>
		<th>In</th>
		<th>Out</th>
	</tr>
	</thead>
	<tbody>
	<?php 

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

	if(@$category){
	  foreach($category as $rs){
	  $arr_cat[$rs->id] = $rs->title;
	}}

	if(@$type){
	  foreach($type as $rs){
	  $arr_type[$rs->id] = $rs->title;
	}}

	if(@$manufacturer){
	  foreach($manufacturer as $rs){
	  $arr_man[$rs->id] = $rs->title;
	}} 

	if(@$uom){
	  foreach($uom as $rs){
	  $arr_uom[$rs->id] = $rs->title;
	}} 
	   
	if($inventory){
          foreach ($inventory as $rs) {    

          	if(
          		($arr_type_filter[$rs->inventory_type_id] || $no_type_filter) && 
          		($arr_category_filter[$rs->inventory_category_id] || $no_category_filter)   
          		){
              	  
	?>
	<tr>
		<td><?php echo @$count+=1;?></td>
		<td><?php echo $rs->name;?></td>
		<td><?php echo $rs->short_description;?></td>
		<td><?php echo $rs->barcode;?></td>
		<td><?php echo @$arr_cat[$rs->inventory_category_id];?></td> 
		<td><?php echo @$arr_type[$rs->inventory_type_id];?></td> 
		<td><?php echo $rs->brand;?></td>
		<td><?php echo @$arr_man[$rs->manufacturer_id];?></td>
		<td><?php echo $rs->ceiling_qty;?></td> 
		<td><?php echo $rs->reorder_point;?></td> 
		<td><?php echo $rs->qty+0;?></td>
		<td><?php echo @$arr_uom[$rs->uom_type_id];?></td>
		<td><?php echo $rs->in_qty+0;?></td> 
		<td><?php echo $rs->out_qty+0;?></td> 
		 
	</tr>
	<?php   }}} ?>
	
	  
</table>

 