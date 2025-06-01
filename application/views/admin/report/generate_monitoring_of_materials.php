<?php error_reporting(0);
header("Content-Type: text/html; charset=ISO-8859-1");

if(!@$clean){

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
	  
	<h4>Monitoring Of Material  
	<?php if($this->input->post('export_to_excel')==0){?>
	<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
	<?php }?>
	</h4>

<?php }else{?>
<style type="text/css">
	.blink_me {
	  animation: blinker 1s linear infinite;
	}

	@keyframes blinker {
	  50% {
	    opacity: 0;
	  }
	}
</style> 
<div class="row">
	<div class="col-md-12">
		 
		<?php 
		if(@$accounts){
			foreach($accounts as $rs){
		?>
		<a href="<?=base_url('inventory/inventory_monitoring/'.$rs->id)?>" class="btn btn-sm <?=$account==$rs->id ? 'btn-success' : 'btn-default'?>"><?=$rs->title?></a>
		<?php }}?>
	</div>
</div>

	<?php if(count($inventory_report)>0){?>
	<div id="table_loading_msg" class="blink_me" style="
		width:600px;
	   height:200px;
	   position: fixed; 
	   top: 50%;
	   left: 47%;
	   margin-top: -100px;
	   margin-left: -100px;
	">
		<center>
			<h2 id="loading_msg">Please Wait, <span id="ctr"></span>.</h2>
		</center>
	</div>
	<?php }?>
<?php }?>

<table <?=@$clean==1 ? 'id="mtable"' : ''?> class="table table-striped table-bordered table-hover" border="1" style="width:100%; background-color: #fff; ">
	<thead>
	<tr class="highlights"> 
		<?php if(!@$clean){?><th nowrap="nowrap">Account</th><?php }?>
		<th nowrap="nowrap">Item Code</th> 
		<th nowrap="nowrap">Item Name</th>
		<th nowrap="nowrap">Description</th> 
		<th nowrap="nowrap">Remarks</th>
		<th nowrap="nowrap">Arrived Or Used</th>
		<th nowrap="nowrap">Barcode</th>
		<th nowrap="nowrap">Category</th> 
		<th nowrap="nowrap">Type</th>
		<th nowrap="nowrap">Classification</th> 
		<th nowrap="nowrap">Date</th> 
		<th nowrap="nowrap">Invoice Number</th> 
		<th nowrap="nowrap">DR Number</th>  
		<th nowrap="nowrap">Project Name</th>
		<th nowrap="nowrap">Project Control Number</th>
		<th nowrap="nowrap">Re-Order Point</th>
		<th nowrap="nowrap">Qty</th>
		<th nowrap="nowrap">UOM</th>
		<th nowrap="nowrap">In</th>
		<th nowrap="nowrap">Out</th>
		<?php 
		if(@$currency){
		  foreach($currency as $rs){
		?>
		<th nowrap="nowrap">Unit Price<br/><small>(<?=$rs->title?>)</small></th>
		<th nowrap="nowrap">Total Price<br/><small>(<?=$rs->title?>)</small></th>
		<?php }}?> 

		<?php 
		if(@$currency){
		  foreach($currency as $rs){
		  	if(strtolower($rs->title) != 'php'){
		?>
		<th nowrap="nowrap">Rate<br/><small>(<?=$rs->title?>)</small></th>
		<?php }}}?> 
		<th nowrap="nowrap">Freight charges (from Invoice)</th>
		<th nowrap="nowrap">Unit Price<br/><small>(JPY)</small></th>
		<th nowrap="nowrap">Total Price<br/><small>(JPY)</small></th>
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
  	
	$ttl_count = count($inventory_report);

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
		<?php if(!@$clean){?><td><?php echo @$rs->account_title;?></td><?php }?>
		<td nowrap="nowrap" title="ID is <?=$rs->rri_id?>" ><?php echo $rs->item_code?></td>
		<td nowrap="nowrap"><?php echo (@$rs->po_item_name ? $rs->po_item_name : $rs->item_name);?></td>
		<td nowrap="nowrap"><?php echo (@$rs->po_item_desc ? $rs->po_item_desc : $rs->item_desc);?></td>
		<td nowrap="nowrap"><?php echo @$rs->remarks;?></td>
		<td nowrap="nowrap"><?php echo $rs->out_qty_rri>0 ? 'used' : 'new'?></td>
		<td nowrap="nowrap"><?php echo @$rs->barcode;?></td>
		<td nowrap="nowrap"><?php echo @$rs->category_title;?></td> 
		<td nowrap="nowrap"><?php echo @$rs->type_title;?></td> 
		<td nowrap="nowrap"><?php echo @$rs->classification_title;?></td> 
		<td nowrap="nowrap"><?php echo date('Y-m-d', strtotime($rs->dc));?></td> 
		<td nowrap="nowrap"><?=@$rs->invoice_number?></td>
		<td nowrap="nowrap"><?=@$rs->dr_number?></td>
		<td nowrap="nowrap"><?php echo $rs->project_name?></td>
		<td nowrap="nowrap"><?php echo $rs->project_control_number?></td> 
		<td nowrap="nowrap"><?php echo $rs->re_order_point_qty?></td>
		<td nowrap="nowrap"><?php echo ($ttlq = (($rs->in_qty_rri - $rs->out_qty_rri) + 0));?></td>
		<td nowrap="nowrap"><?php echo $rs->uom_title;?></td>
		<td nowrap="nowrap"><?php echo $rs->in_qty_rri+0;?></td> 
		<td nowrap="nowrap"><?php echo $rs->out_qty_rri+0;?></td>  
 
		<?php
		if(@$currency){
			foreach($currency as $rsc){ 

				if($rs->rate){ //=============== from upload  / fix rate

					$fix_rate = json_decode($rs->rate,TRUE);

					$underline = 0;

					if(strtolower($rsc->title)=='php'){
					 	
					 	echo '<td>'.number_format($rs->price * $fix_rate['jpy_to_php'],2).'</td>';
						echo '<td>'.number_format(((
							(@$rs->price * round($ttlq/$rs->uom_factor)) 
							 ) 
							* 
							$fix_rate['jpy_to_php'])
						,2).'</td>';

					}elseif(strtolower($rsc->title)=='jpy'){
						
						echo $last_tr1 = '<td>zxz'.number_format($rs->price,2).'</td>';
						echo '<td>'.number_format(@$rs->price * $ttlq,2).'</td>';

						$last_tr2 = '<td>'.number_format(
							(@$rs->price * $ttlq)+$rs->freight_charge_amount
						,2).'</td>';

					}elseif(strtolower($rsc->title)=='usd' && $fix_rate['usd_to_jpy']>0){
						 
						 
					 	echo '<td>'.number_format($rs->price/$fix_rate['usd_to_jpy'],2).'</td>';
						echo '<td>'.number_format(((
							(@$rs->price * round($ttlq/$rs->uom_factor)) 
							 ) 
							/ 
							$fix_rate['usd_to_jpy'])
						,2).'</td>';

					}else{
						echo '<td></td><td></td>';
					}

				}else{ //===================== based on BSP Rates
		
					$underline = 0;

					if($rs->currency_type_id == $rsc->id){
		
						$underline = 1;
						$base_rate = 1; //Current base rate * by 1

						echo '<td>'.number_format(((
							(@$rs->price * round($ttlq/$rs->uom_factor)) 
							+ 
							(@$rs->freight_charge_amount ? $rs->freight_charge_amount : 0)) 
							* 
							$base_rate)
						,2).'</td>';
						echo '<td></td>';

					}else{
						// jpy to php (php/jpy)
						if(strtolower($rsc->title)=='php'){

							if($rs->currency_type_id==9){ // JPY 
								$base_rate = $rs->jpy_to_php;

								echo '<td title="'.$rs->price.'*'.$base_rate.'">'.number_format($rs->price*$base_rate,2).'</td>';

							}elseif($rs->currency_type_id==8){ // USD
								$base_rate = $rs->usd_to_jpy;

								echo '<td title="('.$rs->price.'*'.$base_rate.')*'.$rs->jpy_to_php.'">'.number_format(($rs->price*$base_rate)*$rs->jpy_to_php,2).'</td>';
							}else{
								echo '<td>0</td>';
							}
						  	echo '<td></td>';
							
						
						}elseif(strtolower($rsc->title)=='jpy'){

							if($rs->currency_type_id==7){ // PHP
								$base_rate = $rs->jpy_to_php;

								echo '<td title="'.$rs->price.'/'.$base_rate.'">'.number_format($rs->price/$base_rate,2).'</td>';

							}elseif($rs->currency_type_id==8){ // USD
								$base_rate = $rs->usd_to_jpy;

								echo '<td title="'.$rs->price.'*'.$base_rate.'">'.number_format($rs->price*$base_rate,2).'</td>';
							}else{
								echo '<td>0</td>';
							}
						  	echo '<td></td>';
							
						
						}elseif(strtolower($rsc->title)=='usd'){

							if($rs->currency_type_id==7){ // PHP 
								$base_rate = $rs->jpy_to_php;

								echo '<td title="('.$rs->price.'/'.$rs->jpy_to_php.')/'. $rs->usd_to_jpy.'">'.number_format(($rs->price/$rs->jpy_to_php)/$rs->usd_to_jpy,2).'</td>';

							}elseif($rs->currency_type_id==9){ // JPY
								$base_rate = $rs->usd_to_jpy;

								echo '<td title="'.$rs->price.'/'.$base_rate.'">'.number_format($rs->price/$base_rate,2).'</td>';
							}else{
								echo '<td>0</td>';
							}
						    echo '<td></td>';
						
						}
						   
					}

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

				if(strtolower($rsc->title) == 'jpy'){

					echo '<td align="right">'.$rate['jpy_to_php'].'</td>';

				}elseif(strtolower($rsc->title) == 'usd'){

					echo '<td align="right">'.$rate['usd_to_jpy'].'</td>';

				}
		}}
		?> 

		<td><?php echo $rs->freight_charge_amount;?>
			<script type="text/javascript">
				document.getElementById('ctr').innerHTML = 'Loading inventory data <?=@$counteru+=1;?>/<?=$ttl_count?>';
			</script>
		</td>
		<?=@$last_tr1?>
		<?=@$last_tr2?>
		 
	</tr>
	<?php   }} ?>
	<script type="text/javascript">
		document.getElementById('ctr').innerHTML = 'Loading table format.';
	</script>
	<?php } ?>
	
</table>
