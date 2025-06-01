<?php error_reporting(0);

if($this->input->post('export_to_excel')==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventory_movement_report.xls");
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
 

<h4>Inventory Movement Report  
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>Date</th>
		<th>Transaction</th>
		<th>Project</th>
		<th>Item Name</th>
		<th>Description</th> 
		<th>Barcode</th>
		<th>Category</th> 
		<th>Type</th>
		<th>Brand</th> 
		<th>Manufacturer</th> 
		<th>Qty</th>
		<th>UOM</th>
		<th>In</th>
		<th>Out</th>
		<th>Currency</th>
		<th>Unit Price</th>
		<th>Total Price</th>
	</tr>
	</thead>
	<tbody>
	<?php 

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

	if(@$currency){
	  foreach($currency as $rs){
	  $arr_curr[$rs->id] = $rs->title;
	}}  
	
	if($inventory){
          foreach ($inventory as $rs) {
          $arr_inv[$rs->id] = $rs; 
    }}   

    if($projects){
          foreach ($projects as $rs) {
          $arr_proj[$rs->id] = $rs; 
    }}  

    $arr_tran[1] = 'IN';
    $arr_tran[2] = 'OUT';
    $arr_tran[3] = 'RETURN';
    $arr_tran[4] = 'ADJUST';
	
	if($inventory_movement){
          foreach ($inventory_movement as $rs) {    
              	  
	?>
	<tr>
		<td><?php echo date('Y-m-d H:i', strtotime($rs->date_created));?></td>
		<td><?php echo $arr_tran[$rs->type]?></td>
		<td><?php echo @$arr_proj[$rs->project_id]->name?></td>
		<td><?php echo @$arr_inv[$rs->inventory_id]->name;?></td>
		<td><?php echo @$arr_inv[$rs->inventory_id]->short_description;?></td>
		<td><?php echo @$arr_inv[$rs->inventory_id]->barcode;?></td>
		<td><?php echo @$arr_cat[@$arr_inv[$rs->inventory_id]->inventory_category_id];?></td> 
		<td><?php echo @$arr_type[@$arr_inv[$rs->inventory_id]->inventory_type_id];?></td> 
		<td><?php echo @$arr_inv[$rs->inventory_id]->brand;?></td>
		<td><?php echo @$arr_man[@$arr_inv[$rs->inventory_id]->manufacturer_id];?></td> 
		<td><?php echo $rs->qty+0;?></td>
		<td><?php echo @$arr_uom[$rs->uom_type_id];?></td>
		<td><?php echo $rs->in_qty+0;?></td> 
		<td><?php echo $rs->out_qty+0;?></td>
		<td><?php echo @$arr_curr[$rs->currency_type_id];?></td> 
		<td align="right"><?php echo number_format($rs->price,2);?></td> 
		<td align="right"><?php echo number_format($rs->price * $rs->qty,2);?></td> 
		 
	</tr>
	<?php   }} ?>
	
	  
</table>

 