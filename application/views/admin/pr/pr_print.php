<?php error_reporting(0);

if(@$this->input->post('export_to_excel')==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=bib_record_report.xls");
header("Pragma: no-cache"); 	
header("Expires: 0");
}?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Print P.R. Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	td{
		font-size: 11px;
	}th{
		font-size: 12px;
		font-weight: bold;
	}
	th{
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
	th, td{
		margin: 2px;
		padding: 5px;
	}
	body {
	  -webkit-print-color-adjust: exact !important;
	}
</style>
<style type="text/css" media="print">
  @page { size: portrait; }
</style>
</head>

<body style="padding: 10px;">
<?php if($this->input->post('export_to_excel')==0 && !@$view){?>
	<span style="float: right;" class="no-print">
				<a class="no-print" href="Javascript:self.print();" ><small><i class="fa fa-print"></i>Print </small></a> | 
				<a class="no-print" href="Javascript:self.close();" ><small><i class="fa fa-print"></i> Close </small></a>
			</span>
<?php }?>

<?php 
if(@$accounts){
  foreach($accounts as $rs){
  $arr_account[$rs->id] = $rs->title;
}}

if(@$projects){
  foreach($projects as $rs){
  $arr_project[$rs->id] = $rs;
}}
?>

<center>
	
	<table border="0" width="100%">
		<tr>
			<td width="20%" valign="top">
				<?=date('l, M d,Y', strtotime($pr->date_created))?><br/>
				<?=date('h:i:s a', strtotime($pr->date_created))?>
			</td>
			<td align="center" width="60%">
					
					<h1 style="color: #2A3F54 !important;"><?=company_name?>   
					</h1>
					EZP Bldg 5 Blk 2 Laguna Technopark Annex Binan Laguna <br/>
					TEL: +63 921 4251 628

			</td>
			<?php 
			$po_nos = '';
			if(@$po){
				foreach($po as $rs){ 
					if($rs->purchase_request_ids){
						$pos = explode(',',$rs->purchase_request_ids); 
						foreach($pos as $prid){
							if($prid == $pr->id){
								$po_nos.=($po_nos ? ', ' : '').$rs->po_number;
							}
						}
					}elseif($rs->purchase_request_id == $pr->id){
						$po_nos.=$rs->po_number;
					}
				}
			}
			?>
			<td width="20%" valign="top" align="right">
				<b>PO Number: <?=$po_nos?></b>
			</td>
		</tr>
	</table>

 
	<h2>PURCHASE REQUEST</h2>
	<br/>
</center>


	<table border="0" width="100%">
		<tr>
			<td nowrap="nowrap" width="10">
				  

				<?php if($pr->control_number_type == 1){?>
				  Accounts:
				<?php }else{?>  
				  Project Name:
				<?php }?>: <br/>
				Ctrl #: <br/> 

			</td>
			<td nowrap="nowrap" width="60%">

				<?php if($pr->control_number_type == 1){?>
				  <?=@$arr_account[$pr->inventory_accounts_id]?> 
				<?php }else{?>  
				  <?=@$arr_project[$pr->project_id]->name?> 
				<?php }?><br/>
				<?=date('y',strtotime($pr->date_created)).'-'.$pr->id?><br/> 
 

			</td>
			<td nowrap="nowrap" width="10">
				 
				PR Number: <br/>
				Date: <br/> 

			</td>
			<td nowrap="nowrap">
				
				<?=$pr->pr_number?><br/>
				<?=$pr->date_created?><br/> 
				  
			</td>
		</tr>
	</table>

	<table border="1" cellpadding="1" cellspacing="1"  style="border-style: solid; width: 100% !important;">
	<thead>
	<tr style="background-color: #2A3F54 !important; " >  
		<th style="color: white !important;">Item Name</th> 
		<th style="color: white !important;">Description</th>
		<th style="color: white !important;">Qty</th> 
		<th style="color: white !important;">UOM</th> 
		<th style="color: white !important;">Remarks</th>
	</tr>
	</thead>
	<tbody>
	<?php  

	if(@$items){
	  foreach($items as $rs){
	  $arr_item[$rs->id] = $rs;
	}}

	if(@$uom_conversions){
	  foreach($uom_conversions as $rs){
	  $arr_uom_c[$rs->id] = $rs;
	}}

	if(@$uom_type){
	  foreach($uom_type as $rs){
	  $arr_uom_type[$rs->id] = $rs->title;
	}}

	if(@$projects_control_number){
	  foreach(@$projects_control_number as $rs){
	    $arr_cn[$rs->id] = $rs->control_number;
	  }
	}
	  
	$ttl = 0;

	if(@$pr_item){
      foreach($pr_item as $rs){  
              	  
	?>
	<tr> 
		<td><?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->name : $rs->item_name?> </td>

		<td><?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->short_description : $rs->item_desc?> </td>
		<td><?php echo $rs->qty;?></td>
		<td><?php echo@$arr_uom_type[$arr_item[$rs->inventory_id]->uom_type_id];?></td>  
  
		<td> </td>
	</tr>
	<?php   }} ?>
 
	 
</table>

<table width="100%" border="0" style="width: 100% !important;">
	<tr>
		 
		<?php 
		if(@$users){
		  foreach($users as $rs){
		  $arr_user[$rs->id] = $rs->name;
		}}

		function fstat_($v = ''){
		  if($v == 0){
		    $v = 'Pending';
		  }elseif($v == 1){
		    $v = 'Approved';
		  }elseif($v == 2){
		    $v = 'Rejected';
		  }elseif($v == 3){
		    $v = 'Cancel';
		  }
		  return $v;
		}
		?>
		<td width="20%" style="padding: 30px;">
			<strong>Person In-charge</strong> 
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<hr/>
			<center><p></p></center>
		</td>
		<td width="20%" style="padding: 30px;">
								<?php if($pr->a1){?>
								<strong>Approved By</strong> 
								<p>&nbsp;</p>
								<center><p><?=fstat_($pr->a1_status)?> <small><?=$pr->a1_date ? date('M d, Y',strtotime($pr->a1_date)) : ''?></small></p>
								<hr/>
								<p><?=@$arr_user[$pr->a1]?></p>
								<small><i><?=@$arr_userd[$pr->a1]?></i></small>
								</center> 
								<?php }?>
							</td>
							<td width="20%" style="padding: 30px;">
								<?php if($pr->a2){?>
								<strong>Approved By</strong>
								<p>&nbsp;</p> 
								<center><p><?=fstat_($pr->a2_status)?> <small><?=$pr->a2_date ? date('M d, Y',strtotime($pr->a2_date)) : ''?></small></p>
								<hr/>
								<p><?=@$arr_user[$pr->a2]?></p>
								<small><i><?=@$arr_userd[$pr->a2]?></i></small>
								</center> 
								<?php }?>
							</td>
							<td width="20%" style="padding: 30px;">
								<?php if($pr->a3){?>
								<strong>Approved By</strong>
								<p>&nbsp;</p> 
								<center><p><?=fstat_($pr->a3_status)?> <small><?=$pr->a3_date ? date('M d, Y',strtotime($pr->a3_date)) : ''?></small></p>
								<hr/>
								<p><?=@$arr_user[$pr->a3]?></p>
								<small><i><?=@$arr_userd[$pr->a3]?></i></small>
								</center> 
								<?php }?>
							</td>
	 
		 
	</tr>
</table>

 

</body>

</html>