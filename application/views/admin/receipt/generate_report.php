<?php error_reporting(0);

if($this->input->post('export_to_excel')==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=crv_report.xls");
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

<?php
$date_from = $this->input->post('date_from',TRUE);
$date_to = $this->input->post('date_to',TRUE);
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/i.ico" />
	<title>Collection Report</title>
</head>
<body>


<div style="margin: 10px;">
<?php if($this->input->post('export_to_excel')==0){?>
<img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2" style="height: 60px;"/> 	
<?php }?>
<h4>Collection Report  
<?php if($this->input->post('export_to_excel')==0){?> 	
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
Period Covered: <?=$date_from ? date('d/m/Y', strtotime($date_from)) : '--/--/----'?> to <?=$date_to ? date('d/m/Y', strtotime($date_to)) : '--/--/----'?>
<br/><br/>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>CRV Date</th>
		<th>CRV No.</th>
		<th>Type</th>
		<th>Project Name</th>
		<th>Amount</th> 
		<th>Client Code</th>
		<th>Client Name</th> 
		<th>Payment Type</th> 
	</tr>
	</thead>
	<tbody>
	<?php 

	if(@$users){
	  foreach($users as $rs){
	  $arr_user[$rs->id] = $rs->name;
	}}

	if(@$projects){
	  foreach($projects as $rs){
	  $arr_pro[$rs->id] = $rs;
	}}

	if(@$client){
	  foreach($client as $rs){
	  $arr_client[$rs->id] = $rs;
	}} 

	if(@$company){
	  foreach($company as $rs){
	    $arr_company[$rs->id] = $rs->name;
	  }
	}

	$pm[1] = 'Cash';
	$pm[2] = 'Cheque';
	$pm[3] = 'Credit Card';
	$pm[4] = 'Transfer';

	$ttl = 0;

	$payment_type = $this->input->post('payment_type',TRUE);
	if($payment_type){
		foreach($payment_type as $id){
			$arr_pt[$id] = 1;
		}
	}

	$projects = $this->input->post('projects',TRUE);
	if($projects){
		foreach($projects as $id){
			$arr_projects[$id] = 1;
		}
	}

	$company = $this->input->post('company',TRUE);
	if($company){
		foreach($company as $id){
			$arr_company[$id] = 1;
		}
	}

	$client = $this->input->post('client',TRUE);
	if($client){
		foreach($client as $id){
			$arr_client[$id] = 1;
		}
	}

	
	$df_filter = strtotime($date_from.' 00:00');
	$dt_filter = strtotime($date_to.' 23:59');
	
	if($crv){
       foreach ($crv as $rs) {    
       	$date = strtotime($rs->date_created);
 
         if(
         	(!$payment_type || $arr_pt[$rs->payment_mode]) && 
         	(!$projects || $arr_projects[$rs->project_id]) && 
         	(!$company || $arr_company[$rs->company]) && 
         	(!$client || $arr_client[$rs->client_id]) && 
         	(!$date_from || $df_filter<=$date) && 
         	(!$date_to || $dt_filter >= $date) 
         ){     	  
	?>
	<tr>
		<td><?php echo date('d/m/Y', strtotime($rs->date_created));?></td>
		<td><?php echo $rs->crv_code?></td>
		<td><?php echo $rs->project_id ? 'Project' : 'AR'?></td>
		<td><?=@$arr_pro[$rs->project_id]->name?></td> 
		<td align="right"><?=number_format($rs->amount_received,2); $ttl+=$rs->amount_received;?></td>
		<td><?=@$arr_client[$rs->client_id]->code?></td> 
        <td><?=@$arr_client[$rs->client_id]->name?></td>  
		<td><?=@$pm[$rs->payment_mode]; @$pm_ttl[@$pm[$rs->payment_mode]]+=$rs->amount_received?></td>  
	</tr>
	<?php   }} }?>
	<tr>
		<td colspan="4" align="right"><b>Total</b></td>
		<td align="right"><?=number_format($ttl,2)?></td>
		<td colspan="3"></td>
	</tr>
	<?php if(@$pm_ttl){?>
	<tr>
		<td colspan="8"><hr/></td>
	</tr> 
	<?php 
	
		foreach($pm_ttl as $ptitle => $rs){
	?>
	<tr>
		<td colspan="4" align="right"><b>Total <?=$ptitle?></b></td>
		<td align="right"><?=number_format($rs,2)?></td>
		<td colspan="3"></td>
	</tr>
	<?php }}?>
  
</table>

 </div>

 </body>
</html>