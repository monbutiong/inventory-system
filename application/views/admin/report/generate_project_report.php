<?php error_reporting(0);

if(@$_GET['excel']==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=project_".@$projects->control_number."_report.xls");
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
 
<h4><?=$projects->name?> | <?=$projects->control_number?>
<?php if($this->input->post('export_to_excel')==0){?> 
	<?php if(@$_GET['excel']!=1){?>
	<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
	<?php }?>
<?php }?>

<br/>
<small>GROSS INCOME: <?=number_format($projects->selling_price,2)?><br/>
<span title="(gross-ttl cost)">NET INCOME:  <span id="net_income"></span></span> <br/><br/>
<span style="color:#fff ; padding: 3px;" id="income_per_bg" title="(ttl cost / gross income) * 100% (green:45-100, yellow:20-44, 0-19:red)"> INCOME %: <span id="income_per" ></span></span> 
</small>
</h4>

 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights">  
		<th>P.O. Number</th> 
		<th>Invoice Number</th> 
		<th>RS Number</th>   
		<th>Item Name</th>
		<th>Description</th> 
		<th>Qty. Issued</th>
		<th>Qty. Returns</th>
		<th>Qty.</th> 
		<th>Unit</th> 
		
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

		<th>Freight Charges</th>

	</tr>
	</thead>
	<tbody>
	<?php 
	if(@$suppliers){
	  foreach($suppliers as $rs){
	  $arr_supplier[$rs->id] = $rs;
	}}

	if(@$projects_control_number){
	  foreach($projects_control_number as $rs){
	  $arr_cn[$rs->id] = $rs->control_number;
	}}
	
	if(@$receiving_report){
	  foreach($receiving_report as $rs){
	  $arr_rr[$rs->purchase_order_id] = $rs;
	}}

	if(@$terms_of_payment_type){
	  foreach($terms_of_payment_type as $rs){
	  $arr_term[$rs->id] = $rs->title;
	}}

	if(@$purchase_order){
	  foreach($purchase_order as $rs){
	  $arr_po[$rs->id] = $rs;
	}}

	if(@$po_items){
	  foreach ($po_items as $rs) {
	    @$arr_ttl[$rs->purchase_order_id]+=round($rs->qty * $rs->price,2);
	}} 
 
 	$net_inc_ttl = 0;
 
	if(@$ii_records){
      foreach ($ii_records as $rs) {    
     	
     	$rate = $rs->rate;

     	if(preg_match("/[a-z]/i", @$rate['jpy_to_php'])){$rate['jpy_to_php']=0;}
     	if(preg_match("/[a-z]/i", @$rate['usd_to_jpy'])){$rate['usd_to_jpy']=0;}
	?>
	<tr>
		<td><?=@$rs->po_number?></td> 
		<td><?=@$rs->invoice_number?></td> 
		<td><?=@$rs->rr_number?></td> 
		<td><?=@$rs->item_name?></td> 
		<td><?=@$rs->item_desc?></td> 
		<td><?=@$rs->qty_iii?></td> 
		<td><?=@$rs->qty_return?></td> 
		<td><?=$ttlq = @$rs->qty_iii-$rs->qty_return; $ttl_all+=$ttlq;?></td> 
		<td><?=@$rs->uom_title?></td>
		
		<?php
		if(@$currency){
			foreach($currency as $rsc){ 

				if($rs->rate){ //=============== from upload  / fix rate

					$fix_rate = json_decode($rs->rate,TRUE);
					if(preg_match("/[a-z]/i", @$fix_rate['jpy_to_php'])){$fix_rate['jpy_to_php']=0;}
					if(preg_match("/[a-z]/i", @$fix_rate['usd_to_jpy'])){$fix_rate['usd_to_jpy']=0;}

					$underline = 0;

					if(strtolower($rsc->title)=='php'){
 
						echo '<td>'.number_format($rs->price,2).'</td>';
						echo '<td>'.number_format(((
							(@$rs->price * round($ttlq/$rs->uom_factor)) 
							 ) 
							* 
							1)
						,2).'</td>';
 
					}elseif(strtolower($rsc->title)=='jpy'){
						
					 	echo '<td>'.number_format($rs->price / $fix_rate['jpy_to_php'],2).'</td>';
						echo '<td>'.number_format(((
							(@$rs->price / $fix_rate['jpy_to_php']) 
							 ) 
							* 
							round($ttlq/$rs->uom_factor))
						,2).'</td>';

						$net_inc_ttl+= ((
							(@$rs->price / $fix_rate['jpy_to_php']) 
							 ) 
							* 
							round($ttlq/$rs->uom_factor));
						

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

					}else{
						// jpy to php (php/jpy)
						if(strtolower($rsc->title)=='php'){

							if($rs->currency_type_id==9){ // JPY 
								$base_rate = $rs->jpy_to_php;

								$data_1st[] = '<font title="'.$rs->price.'*'.$base_rate.'">'.number_format($rs->price*$base_rate,2).'</font>';

							}elseif($rs->currency_type_id==8){ // USD
								$base_rate = $rs->usd_to_jpy;

								$data_1st[] = '<font title="('.$rs->price.'*'.$base_rate.')*'.$rs->jpy_to_php.'">'.number_format(($rs->price*$base_rate)*$rs->jpy_to_php,2).'</font>';
							}else{
								$data_1st[] = 0;
							}
						  
							
						
						}elseif(strtolower($rsc->title)=='jpy'){

							if($rs->currency_type_id==7){ // PHP
								$base_rate = $rs->jpy_to_php;

								$data_1st[] = '<font title="'.$rs->price.'/'.$base_rate.'">'.number_format($rs->price/$base_rate,2);

							}elseif($rs->currency_type_id==8){ // USD
								$base_rate = $rs->usd_to_jpy;

								$data_1st[] = '<font title="'.$rs->price.'*'.$base_rate.'">'.number_format($rs->price*$base_rate,2);
							}else{
								$data_1st[] = 0;
							}
						  
							
						
						}elseif(strtolower($rsc->title)=='usd'){

							if($rs->currency_type_id==7){ // PHP 
								$base_rate = $rs->jpy_to_php;

								$data_1st[] = '<font title="('.$rs->price.'/'.$rs->jpy_to_php.')/'. $rs->usd_to_jpy.'">'.number_format(($rs->price/$rs->jpy_to_php)/$rs->usd_to_jpy,2);

							}elseif($rs->currency_type_id==9){ // JPY
								$base_rate = $rs->usd_to_jpy;

								$data_1st[] = '<font title="'.$rs->price.'/'.$base_rate.'">'.number_format($rs->price/$base_rate,2);
							}else{
								$data_1st[] = 0;
							}
						   
						
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

				if(preg_match("/[a-z]/i", @$rate['jpy_to_php'])){$rate['jpy_to_php']=0;}
				if(preg_match("/[a-z]/i", @$rate['usd_to_jpy'])){$rate['usd_to_jpy']=0;}

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

		<td><?=number_format(@$rs->freight_charge_amount,2); @$net_inc_ttl+=round(@$rs->freight_charge_amount,2);?></td> 
	</tr>
	<?php   }}  ?>

	  
</table>
<script type="text/javascript">
 
	document.getElementById('net_income').innerHTML = '<?=number_format($net_inc_ttl,2)?>';

	document.getElementById('income_per').innerHTML = '<?=$per=round(($net_inc_ttl/$projects->selling_price) * 100)?>';

	document.getElementById('income_per_bg').style.backgroundColor = "<?php if($per>='45'){echo 'GREEN';}elseif($per>='20' && $per<='44'){echo 'YELLOW';}else{echo 'RED';}?>";

</script>
 