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
 

<h4>Manpower Report  
<?php if($this->input->post('export_to_excel')==0){?>
<a class="no-print" href="Javascript:self.print();"><small><i> print here </i></small></a>
<?php }?>
</h4>
 
<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>#</th>
		<th>Date</th>
		<th>Control Number</th> 
		<th>Project</th> 

		<th>Employee ID</th> 
		<th>Employee Name</th> 
		<th>Time In</th> 
		<th>Time Out</th> 
		<th>Regular Hours</th> 
		<th>OT Hours</th> 
		<th>Pay Type</th>
		<th>Basic Pay</th>
		<th>Hourly Rate</th>
		<th>Total Cost (PHP)</th> 
		<th>Total Cost (JPY)</th> 
		<th>Total Cost (USD)</th>
		<td>Workload</td>
	</tr>
	</thead>
	<tbody>
	<?php 

	$arr_project_filter = array();
	$projects_filter = $this->input->post('projects',TRUE);
	if($projects_filter){
		foreach ($projects_filter as $rs) {
			if($rs){
				$arr_project_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_project_filter=1; 
	}


	$arr_employee_filter = array();
	$employees_filter = $this->input->post('employees',TRUE);
	if($employees_filter){
		foreach ($employees_filter as $rs) {
			if($rs){
				$arr_employee_filter[$rs] = 1;
			}
		}
	}else{ 
		$no_employee_filter=1; 
	}

	if(@$employees){
	  foreach($employees as $rs){
	    $arr_emp[$rs->id] = $rs;
	  }
	}

	if(@$projects){
	  foreach($projects as $rs){
	    $arr_project[$rs->id] = $rs;
	  }
	}

	if(@$bsp_rate){
	  foreach($bsp_rate as $rs){
	    $arr_bsp_rate[$rs->date_for] = $rs;
	  }
	}

	$date_from = $this->input->post('date_from',TRUE);
	$date_to = $this->input->post('date_to',TRUE);

	if(@$project_manpower){
	  foreach($project_manpower as $rs){

	    $rate = json_decode($rs->rate, true);  

          	if(
          		($arr_project_filter[$rs->project_id] || $no_project_filter) && 
          		($arr_employee_filter[$rs->employee_id] || $no_employee_filter) && 
          		((strtotime($rs->work_date)>=strtotime($date_from)) || !$date_from) && 
          		((strtotime($rs->work_date)>=strtotime($date_to)) || !$date_to) 
          		){
              	  
	?>
	<tr>
	              <td><?=@$ccc+=1?></td>
	              <td><?=$date=$rs->work_date?></td>
	              <td><?=@$arr_project[$rs->project_id]->control_number?></td>
	              <td><?=@$arr_project[$rs->project_id]->name?></td>
	              <td><?=@$arr_emp[$rs->employee_id]->employee_number?></td>
	              <td><?=@$arr_emp[$rs->employee_id]->last_name.' '.@$arr_emp[$rs->employee_id]->first_name?></td>
	              <td><?=$time_in = $rs->time_in?></td>
	              <td><?=$time_out = $rs->time_out?></td>
	              <td><?=$reg_hrs = $rs->regular_hours?></td>
	              <td><?=$ot_hrs = $rs->ot_hours?></td> 
	              <td><?=$rs->pay_type==1 ? 'Daily' : 'Monthly'?></td> 
	              <td><?=number_format($basic = $rs->basic_pay,2)?></td>
	              <td><?php 
	              if($rs->pay_type=='Daily'){
	                $hourly = round($basic /8, 7);
	              }else{
	                $hourly = round($basic*12/313/8, 7);
	              }
	              echo @$hourly;
	              ?></td>
	              <td align="right"><?=@number_format($php_amt = ($hourly * $reg_hrs) + (($hourly * $ot_hrs)*1.25), 2); ?></td> 
	              <td align="right"><?php 

	                echo number_Format($jpy_amt = $php_amt*@$arr_bsp_rate[$date]->jpy_to_php,2);

	              ?></td> 
	              <td align="right"><?php 

	                echo number_Format($usd_amt = $jpy_amt/@$arr_bsp_rate[$date]->usd_to_jpy,2);

	              ?></td> 
	              <td><?=$rs->workload?></td>
	           
	            </tr>
	<?php   }}} ?>
	
	  
</table>

 