<?php error_reporting(0);

if($this->input->post('export_to_excel')==1){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventory_movement_report.xls");
header("Pragma: no-cache"); 	
header("Expires: 0");
}?> 
<link href="<?=base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights">  
		<th>Account</th>
		<th>Category</th>
		<th>Rack no.</th>
		<th>Layer No.</th>
		<th>Item no.</th>
		<th>Inventory Tag No.</th>
		<th>Received date</th>
		<th>PO No.</th>
		<th>Invoice No.</th>
		<th>RS No.</th>
		<th>Item Name</th>
		<th>Description</th>
		<th>Beginning QTY</th>
		<th>Unit of Measure</th>
		<th>Unit Price (PHP)</th>
		<th>Total Amount (PHP)</th>
		<th>Unit Price (USD)</th>
		<th>Amount (USD)</th>
		<th>Unit Price (JPY)</th>
		<th>Total Amount (JPY)</th>
		<th>Rate at the date of Receipt</th>
		<th>Rate at the date of Receipt</th>
		<th>Freight charges (from Invoice)</th>
		<th>DHL/FedEx/TCL</th>
		<th>OR/InvoiceQuantity</th>
		<th>Unit of Measure</th>

		<th>Purchase Price in Orig Currency</th>
		<th>Column</th>
		<th>Freight In in Orig. Currency</th>
		<th>Rate at the date of Receipt  (PHP-JPY)</th>
		<th>Total Purchase in Orig. Currency</th>
		<th>Total Purchase Price (JPY)</th>
		<th>Quantity</th>
		<th>Quantity</th>
		<th>Quantity</th>
		<th>Quantity</th>
		<th>Quantity</th>
		<th>Quantity</th>
		<th>Total Quantity</th>
		<th>Total Unit Cost in Yen</th>
		<th>Control No.</th>
		<th>Ending Quantity</th>
		<th>Unit</th>
		<th>Total Unit Cost in Yen</th>
		<th>Total Unit Cost in PHP</th>
		 
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
		<td><?=@$rs->account_title;?></td>
		<td><?=@$rs->category_title;?></td> 
		<td><?=$rs->rack?></td>
		<td><?=$rs->layer?></td>
		<td><?=$rs->item_code?></td>
		<td><?=$rs->tag_no?></td>
		<td><?=@$rs->received_date?></td>
		<td><?=@$rs->po_number?></td>
		<td><?=@$rs->invoice_number?></td>
		<td><?=@$rs->rs_no?></td>
		<td><?=(@$rs->item_name ? $rs->item_name : $rs->name);?></td>
		<td><?=(@$rs->item_desc ? $rs->item_desc : $rs->short_description);?></td>
		<td><?=$rs->in_qty_rri+0;?></td> 
		<td><?=$rs->uom_title;?></td>
		<td align="right"><?=number_format(@$unit_amount_php,2)?></td>
		<td align="right"><?=number_format(@$total_amount_php,2)?></td>
		<td align="right"><?=number_format(@$unit_amount_usd,2)?></td>
		<td align="right"><?=number_format(@$total_amount_usd,2)?></td>
		<td align="right"><?=number_format(@$unit_amount_jpy,2)?></td>
		<td align="right"><?=number_format(@$total_amount_jpy,2)?></td>
		<td><?=@$rs->rate_jpy_to_php?></td>
		<td><?=@$rs->rate_usd_to_jpy?></td>
		<td align="right"><?=number_format(@$rs->freight_charge_amount,2);?></td> <!-- freight charge in invoice -->
		<td></td>
		<td><?=@$rs->or_invoice_qty?></td>
		<td><?=$rs->uom_title;?></td>

		<td align="right"><?=number_format(@$unit_amount_orig_currency,2)?></td>
		<td><?=@$rs->column?></td>
		<td align="right"><?=number_format(@$rs->freight_charge_amount,2);?></td>
		<td><?=@$rs->rate_at_the_day_of_receipt_php_jpy?></td>
		<td align="right"><?=number_format(@$rs->price * $ttlq),2);?></td>
		<td><?=@$rs->total_purchase_jpy?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?=number_format(@$unit_amount_jpy,2)?></td>
		<td><?=$rs->project_control_number?></td> 
		<td><?=($ttlq = (($rs->in_qty_rri - $rs->out_qty_rri) + 0));?></td>
		<td><?=$rs->uom_title;?></td>

		<td align="right"><?=number_format(@$total_amount_jpy_ending,2)?></td>
		<td align="right"><?=number_format(@$total_amount_php_ending,2)?></td>


 
		<!-- <td></td> 
		
		<td><?=@$rs->type_title;?></td> 
		<td><?=@$rs->classification_title;?></td> 
		<td><?=date('Y-m-d H:i', strtotime($rs->dc));?></td> 
	 
		<td><?=@$rs->dr_number?></td>
		<td><?=$rs->project_name?></td>
		
		<td><?=$rs->re_order_point_qty?></td> 
		 
		<td><?=$rs->out_qty_rri+0;?></td>   -->
 		
		
		 
	</tr>
	<?php   }}} ?>
	
	  
</table>

 