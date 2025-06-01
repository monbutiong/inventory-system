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
 

<h4>Inventory Report  
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>Accounts</th> 
		<th>Date</th> 
		<th>Invoice Number</th> 
		<th>DR Number</th>  
		<th>Project Name</th>
		<th>Project Control Number</th>
		<th>Item Code</th>
		<th>Item Name</th>
		<th>Description</th> 
		<th>Barcode</th>
		<th>Category</th> 
		<th>Type</th>
		<th>Classification</th> 
		<th>Qty</th>
		<th>UOM</th>
		<th>In</th>
		<th>Out</th>
		<?php 
		if(@$currency){
		  foreach($currency as $rs){
		?>
		<th>Total Price<br/><small>(<?=$rs->title?>)</small></th>
		<?php }}?> 

		<?php 
		if(@$currency){
		  foreach($currency as $rs){
		?>
		<th>Unit Price<br/><small>(<?=$rs->title?>)</small></th>
		<?php }}?>  

		<?php 
		if(@$currency){
		  foreach($currency as $rs){
		  	if(strtolower($rs->title) != 'php'){
		?>
		<th>Rate<br/><small>(<?=$rs->title?>)</small></th>
		<?php }}}?> 
		<th>Freight charges (from Invoice)</th>
	</tr>
	</thead>
	<tbody>
	<?php 

	$arr_projects_filter = array();
	$projects_filter = $this->input->post('projects',TRUE);
	if($projects_filter){
		foreach ($projects_filter as $rs) {
			if($rs){
				$arr_projects_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_projects_filter=1; 
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

	$arr_classification_filter = array();
	$classification_filter = $this->input->post('classification',TRUE);
	if($classification_filter){
		foreach ($classification_filter as $rs) {
			if($rs){
				$arr_classification_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_classification_filter=1; 
	}

	$arr_account_filter = array();
	$account_filter = $this->input->post('accounts',TRUE);
	if($account_filter){
		foreach ($account_filter as $rs) {
			if($rs){
				$arr_account_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_account_filter=1; 
	}
  
	if($inventory_report){
          foreach ($inventory_report as $rs) {  

          if(
          	($arr_type_filter[$rs->inventory_type_id] || @$no_type_filter) && 
          	($arr_projects_filter[$rs->project_id] || @$no_projects_filter) && 
          	($arr_category_filter[$rs->inventory_category_id] || @$no_category_filter) && 
          	($arr_classification_filter[$rs->classification_id] || @$no_classification_filter) && 
          	($arr_account_filter[$rs->account_id] || @$no_account_filter)   
          	){  
              	  
	?>
	<tr>
		<td><?php echo @$rs->account_title;?></td> 
		<td><?php echo date('Y-m-d H:i', strtotime($rs->dc));?></td> 
		<td><?=@$rs->invoice_number?></td>
		<td><?=@$rs->dr_number?></td>
		<td><?php echo $rs->project_name?></td>
		<td><?php echo $rs->project_control_number?></td>
		<td><?php echo $rs->item_code?></td>
		<td><?php echo (@$rs->item_name ? $rs->item_name : $rs->name);?></td>
		<td><?php echo (@$rs->item_desc ? $rs->item_desc : $rs->short_description);?></td>
		<td><?php echo @$rs->barcode;?></td>
		<td><?php echo @$rs->category_title;?></td> 
		<td><?php echo @$rs->type_title;?></td> 
		<td><?php echo @$rs->classification_title;?></td>  
		<td><?php echo ($ttlq = (($rs->in_qty_rri - $rs->out_qty_rri) + 0));?></td>
		<td><?php echo $rs->uom_title;?></td>
		<td><?php echo $rs->in_qty_rri+0;?></td> 
		<td><?php echo $rs->out_qty_rri+0;?></td>  

		<?php 
		// total price
		if(@$currency){
			foreach($currency as $rsc){ 

				$rate = (array)  json_decode($rs->rate);
				$underline = 0;

				if($rs->currency_type_id == $rsc->id){
					$recorded_rate = 1;
					$underline = 1;
				}else{
					$curr_rate = @$rate[$rs->currency_type_id] ? $rate[$rs->currency_type_id] : 0;
					$recorded_rate = @$rate[$rsc->id] ? $curr_rate/$rate[$rsc->id] : 0;
				}

				

				echo '<td align="right">'.($underline ? '<b>' : '').number_format((((@$rs->price * $ttlq) + (@$rs->freight_charge_amount ? $rs->freight_charge_amount : 0)) * $recorded_rate),2).($underline ? '</b>' : '').'</td>';
		}}
		?> 

		<?php 
		// unit price
		if(@$currency){
			foreach($currency as $rsc){ 

				$rate = (array)  json_decode($rs->rate);
				$underline = 0;

				if($rs->currency_type_id == $rsc->id){
					$recorded_rate = 1;
					$underline = 1;
				}else{
					$curr_rate = @$rate[$rs->currency_type_id] ? $rate[$rs->currency_type_id] : 0;
					$recorded_rate = @$rate[$rsc->id] ? $curr_rate/$rate[$rsc->id] : 0;
				}

				
				if($underline || 1){
					echo '<td align="right">'.($underline ? '<b>' : '').number_format((((@$rs->price) + (@$rs->freight_charge_amount ? $rs->freight_charge_amount : 0)) * $recorded_rate),2).($underline ? '</b>' : '').'</td>';
				}else{
					echo '<td></td>';
				}
		}}
		?> 

		<?php 
		// rate per currency
		if(@$currency){
			foreach($currency as $rsc){ 

				$rate = (array)  json_decode($rs->rate);
				$underline = 0;
				$curr_rate = 0;

				if($rs->currency_type_id == $rsc->id){
					$recorded_rate = 1;
					$underline = 1;
				}else{
					$curr_rate = @$rate[$rs->currency_type_id] ? $rate[$rs->currency_type_id] : 0;
					$recorded_rate = @$rate[$rsc->id] ? $curr_rate/$rate[$rsc->id] : 0;
				}

				if(strtolower($rsc->title) != 'php'){

					echo '<td align="right">'.$rate[$rsc->id].'</td>';

				}
		}}
		?> 

		<td><?php echo $rs->freight_charge_amount;?></td>
		 
	</tr>
	<?php   }}} ?>
	
	  
</table>

 