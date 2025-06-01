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
 

<h4>Overhead Cost Report 
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>Overhead Cost</th> 
		<th>Date</th> 
		<th>Month</th> 
		<th>Year</th>   
		<th>Amount (PHP)</th>
		<th>Amount (JPY)</th> 
		<th>Amount (USD)</th>  
	</tr>
	</thead>
	<tbody>
	<?php 
	 

	if(@$oc){
	  foreach ($oc as $rs) {
	    @$arr_oc[$rs->id]=$rs->title;
	}} 
 
	$date_from = $this->input->post('date_from',TRUE);
	$date_to = $this->input->post('date_to',TRUE);

 
	$arr_supplier_filter = array();
	$supplier_filter = $this->input->post('supplier',TRUE);
	if($supplier_filter){
		foreach ($supplier_filter as $rs) {
			if($rs){
				$arr_supplier_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_supplier_filter=1; 
	}

	$df_filter = strtotime($this->input->post('date_from',TRUE));
	$dt_filter = strtotime($this->input->post('date_to',TRUE)); 
	   
	if(@$overhead_cost){
      foreach ($overhead_cost as $rs) {   
 
	?>
	<tr>
		<td><?=@$arr_oc[$rs->overhead_cost_id]?></td>
		<td><?=date('Y-m-d',strtotime(@$rs->overhead_cost_date))?></td>
		<td><?php 
		$dateObj   = DateTime::createFromFormat('!m', $rs->month);
		echo $dateObj->format('F'); // March

	    ?></td> 
		<td><?=@$rs->year?></td>
		<td align="right"><?=number_format(@$rs->amount,2)?></td> 
		<td align="right">0.00</td>
		<td align="right">0.00</td>  
	</tr>
	<?php   }} ?>
	
	  
</table>

 