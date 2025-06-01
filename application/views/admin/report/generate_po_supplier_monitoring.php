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
 

<h4>Purchase Order from Supplier Monitoring
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>Supplier Name</th> 
		<th>P.O. Number</th> 
		<th>Invoice Number</th> 
		<th>Amount</th>   
		<th>Control Number</th>
		<th>Remarks</th> 
		<th>Payment Terms</th> 
		<th>P.O. Date</th> 
		<th>D.R. Date</th>
		<th>Payments Status</th>  
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
 
	$date_from = $this->input->post('date_from',TRUE);
	$date_to = $this->input->post('date_to',TRUE);

	$arr_projects_filter = array();
	$projects_filter = $this->input->post('projects_control_number',TRUE);
	if($projects_filter){
		foreach ($projects_filter as $rs) {
			if($rs){
				$arr_projects_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_projects_filter=1; 
	}

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
	$dt_by = $this->input->post('date_by',TRUE); // == (1) P.O (2) D.R.
	$pay_status_filter = $this->input->post('pay_status',TRUE); // == (1) paid (2) unpaid
	   
	if(@$received_items){
      foreach ($received_items as $rs) {   

      	if($dt_by == 2){
			$date = strtotime($rs->date_created);
      	}else{
      		$date = strtotime(@$arr_po[@$rs->purchase_order_id]->date_created);
      	}
      	

      	if(
      		@$arr_supplier[@$arr_po[@$rs->purchase_order_id]->supplier_id]->name
      		&&
      		($arr_projects_filter[$rs->control_number_id] || @$no_projects_filter) && 
      		($arr_supplier_filter[$rs->supplier_id] || @$no_supplier_filter) &&
      		(!$df_filter || !$dt_filter || ($df_filter<=$date && $dt_filter >= $date)) && 
      		($pay_status_filter==0 || ($pay_status_filter==1 && $rs->closed_po==1) || ($pay_status_filter==2 && $rs->closed_po==0))
      	){
	?>
	<tr>
		<td><?=@$arr_supplier[@$arr_po[@$rs->purchase_order_id]->supplier_id]->name?></td>
		<td><?=@$arr_po[@$rs->purchase_order_id]->po_number?></td>
		<td><?=@$arr_rr[$rs->receiving_report_id]->invoice_number?></td> 
		<td align="right">
		  <?=number_format( $rs->price *  $rs->qty, 2)?> 
		</td>
 	    <td><?=@$arr_cn[$rs->control_number_id]?></td>
 	    <td></td>
 	    <td><?=@$arr_term[@$arr_po[@$rs->purchase_order_id]->terms_of_payment_type_id]?></td>
 	    <td><?=@$arr_po[@$rs->purchase_order_id]->date_created?></td>
 	    <td><?=@$rs->date_created?></td>
 	    <td><?=$rs->closed_po==1 ? 'Paid' : 'Unpaid'?></td>
	</tr>
	<?php   }}} ?>
	
	  
</table>

 