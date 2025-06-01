<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?=$project->name?> <small>Control Number <?=$project->control_number?> | Manpower</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 290px;">

              <a class="btn btn-sm btn-warning" href="<?php echo base_url('admin/projects');?>" >Go Back</a>

                <a download class="btn btn-sm btn-info" href="<?php echo base_url('assets/downloadables/project_manpower.csv');?>" >Download Template (.csv)</a>

                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('admin/upload_manpower/'.$project->id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Upload</a>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
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
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php  

            if(@$employee){
              foreach($employee as $rs){
                $arr_emp[$rs->id] = $rs;
              }
            }

            if(@$bsp_rate){
              foreach($bsp_rate as $rs){
                $arr_bsp_rate[$rs->date_for] = $rs;
              }
            }

            if(@$project_manpower){
              foreach($project_manpower as $rs){

                $rate = json_decode($rs->rate, true);
            ?>
            <tr>
              <td><?=$date=$rs->work_date?></td>
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
              <td>
                
                <a href="<?php echo base_url();?>admin/edit_project_manpower/<?php echo $project->id;?>/<?php echo $rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i> edit</a>
                | 
                <a href="Javascript:del_m(<?=$rs->id?>)" ><i class="fa fa-trash"></i> delete</a>
                 
              </td>
            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
function del_m(id){
  reset(); 

  alertify.confirm("delete manpower information? this will permanently delete selected records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>admin/delete_manpower/<?=$project->id?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

