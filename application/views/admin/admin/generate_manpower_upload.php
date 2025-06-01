<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/uploaded_files/company_files/favicon.png" />

    <title><?php echo system_name;?> | <?php echo company_name;?></title>

</head>
<body style="margin: 5px;">

 
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
 

<h4>Upload Project Manpower 
</h4>

No of Read Data : <span id="all_data">0/</span>
<br/>
No of Error Data : <span id="error_data">0</span>
<br/>
<?php $upload_type=$this->input->post('uplaod_type',true);  if(@$upload_type == 1){?>
	No of Saved Data : <span id="complete_data">0</span>
<?php }else{?>
  No of Complete Data : <span id="complete_data">0</span>
<?php }?>

<hr/>
	 

<table class="table table-striped table-bordered table-hover" border="1">
	<thead>
	<tr class="highlights"> 
		<th>#</th>
		<th>Date</th>
		<th>Employee Number</th>
		<th>Name</th> 
		<th>Time In</th>
		<th>Time Out</th>
		<th>Regular Hours Worked</th>
		<th>Regular OT Hours (125%)</th>
		<th>Pay Type</th>
		<th>Basic Pay</th> 
		<th>Hourly Rate</th> 
		<th>Total Cost (PHP)</th>  
		<th>Total Cost (JPY)</th>  
		<th>Total Cost (USD)</th>  
		<th>Workload</th>  
		<th>Upload Remarks</th>

	</tr> 
	</thead>
	<tbody>
	<?php    
 	function tl($title){
 		
 		if(@$title){
 			return strtolower(ltrim($title));
 		}else{
 			return '';
 		}
 		
 	}

 	if(@$pm){
 		foreach($pm as $rs){
 			$arr_ex[$rs->employee_id.'-'.$rs->work_date] = 1;
 		}
 	}

 	if(@$bsp_rate){
 		foreach($bsp_rate as $rs){
 			$arr_bsp_rate[$rs->date_for] = $rs;
 		}
 	}


  if(@$_FILES['file_template']['tmp_name'] && tl(substr($_FILES['file_template']['name'], -3)) == 'csv'){

  				if(@$employee){
  					foreach($employee as $rs){
  						$arr_emp[$rs->employee_number+0] = $rs;
  					}
  				}

  				$csv = $_FILES['file_template']['tmp_name'];
  				
  				$count = 0;
  				$error_count = 0;
  				$complete = 0;
 

  				$handle = fopen($csv,"r");
  				while (($r = fgetcsv($handle, 30000, ",")) != FALSE){//get row values
 
  				@$real_count+=1;
  				$has_error = 0;

  				if($real_count > 1 && $r[0] ){
					
					$count+=1;
  				 	
  				$error_msg = '';	
  	?> 
	<tr>
		 
		 <td><?php echo $count;?></td>
		 <td><?php 
		 $date = date('Y-m-d', strtotime($r[0]));
		 echo date('M d, Y (Y-m-d)', strtotime($r[0])); ?></td>
		 <td><?php echo $employee_number = trim($r[1]); ?></td>
		 <td><?=@$arr_emp[$employee_number]->last_name ? @$arr_emp[$employee_number]->last_name.' '.@$arr_emp[$employee_number]->first_name : '<font color="red"><i>not found</i></font>' ?></td>
		 <td><?php echo $time_in = trim($r[3]); ?></td>
		 <td><?php echo $time_out = trim($r[4]); ?></td>
		 <td><?php 

		 			$work_hours = round((strtotime($date.' '.$time_out) - strtotime($date.' '.$time_in)) / 3600);

		 			$datetime1 = new DateTime('2023-01-01 '.$time_in.':00'); // First date
		 			$datetime2 = new DateTime('2023-01-01 '.$time_out.':00'); // Second date

		 			$interval = $datetime1->diff($datetime2); // Calculate the difference between the two dates

		 			// Extract the number of hours and minutes from the difference
		 			$hours = $interval->format('%h'); // Number of hours
		 			$minutes = $interval->format('%i'); // Number of minutes

		 			// Convert the total number of minutes to hours
		 			$work_hours = round($hours + ($minutes / 60),2);
 
 					$reg_hours = 0;
 					$ot_hours = 0;

		 			if($work_hours>4 && $work_hours<=9){
		 				$work_hours-=1;
		 				$reg_hours=$work_hours;
		 			}elseif($work_hours>9){
		 				$reg_hours=8;
		 				$ot_hours =  round($work_hours - 9,2);
		 			}else{
		 				$reg_hours=$work_hours;
		 			}

		 			echo $reg_hours;
		 ?></td>
		 <td><?=$ot_hours?></td>
		 <td><?=$rate = @$arr_emp[$employee_number]->rate?></td>
		 <td align="right"><?=number_format($basic = @$arr_emp[$employee_number]->basic_amount,2)?></td>
		 <td><?php 
		 $hourly = 0;

		 		if($rate == 'Daily'){
		 			$hourly = round($basic /8, 2);
		 		}else{
		 			$hourly = round($basic*12/313/8, 2);
		 		}
		 echo $hourly;
		 ?></td>
		 <td align="right"><?=number_format($php_amt = ($hourly*$reg_hours)+(($hourly*$ot_hours)*1.25),2)?></td>

		 <td align="right"><?php 

		 	echo number_Format($jpy_amt = $php_amt*@$arr_bsp_rate[$date]->jpy_to_php,2);

		 ?></td>

		 <td align="right"><?php 

		 	echo number_Format($usd_amt = $jpy_amt/@$arr_bsp_rate[$date]->usd_to_jpy,2);

		 ?></td>

		 <td><?php echo $workload = trim($r[5]); ?></td>
		  
		 <td>  
		 		<?php if(!@$arr_emp[$employee_number]->id){
		 			
		 			$error_count+=1;

		 			echo '<span class="text-danger">Employee number not found</span>
		 			<script>
		 			document.getElementById("error_data").innerHTML = "'.$error_count.'";
		 			</script>
		 			';
		 		}elseif(!@$rate){
		 			
		 			$error_count+=1;

		 			echo '<span class="text-danger">Error Pay Type</span>
		 			<script>
		 			document.getElementById("error_data").innerHTML = "'.$error_count.'";
		 			</script>
		 			';
		 		}elseif(@$arr_ex[@$arr_emp[$employee_number]->id.'-'.$date]){
		 			
		 			$error_count+=1;

		 			echo '<span class="text-danger">Error: employee Work date already exist</span>
		 			<script>
		 			document.getElementById("error_data").innerHTML = "'.$error_count.'";
		 			</script>
		 			';

		 		}elseif($upload_type == 1){ 

		 		 
		 		  $adata['work_date'] = date('Y-m-d',strtotime($date));
		 			$adata['date_created'] = date('Y-m-d');
		 			$adata['user_id'] = $this->session->user_id;
		 			$adata['employee_id'] = @$arr_emp[$employee_number]->id;

		 			$adata['time_in'] = $time_in;
		 			$adata['time_out'] = $time_out;

		 			$adata['regular_hours'] = $reg_hours;
		 			$adata['ot_hours'] = $ot_hours;
		 			$adata['pay_type'] = $rate;
		 			
		 			$adata['basic_pay'] = $basic;
		 			
		 			$adata['workload'] = $workload;
		 			$adata['project_id'] = $project_id; 
		  
		 			$batch_data[] = $adata; 

		 			$adata = [];

		 			$complete+=1;

		 			echo 'Uploaded
		 			<script>
		 			document.getElementById("complete_data").innerHTML = "'.$complete.'";
		 			</script>
		 			';
		 		}else{

		 			$complete+=1;

		 			echo 'Complete
		 			<script>
		 			document.getElementById("complete_data").innerHTML = "'.$complete.'";
		 			</script>
		 			';
		 		}

		 		echo '
		 		<script>
		 			document.getElementById("all_data").innerHTML = "'.$count.'";
		 			</script>
		 		'; 
		 		echo '<hr/>';
		 		?>  
		 </td> 
	</tr>
	<?php  }}}?>
	
	  </tbody>
</table>  

<?php
if($upload_type == 1 && @$batch_data){
	$this->db->insert_batch('project_manpower',$batch_data); 
}
  
?>
 
</body>
</html>

		  