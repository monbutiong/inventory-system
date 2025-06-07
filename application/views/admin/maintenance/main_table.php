<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
 


        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title"><?php echo $table_name;?></h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url();?>maintenance/add_table_data_content/<?php echo $table_name_sql;?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Record</a>
                    </div>
                </div>
            </div>
        </div>

        
      </div>
      <div class="x_content">
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
            <!--   <th>Maintenance ID</th> -->
               
              <?php if($table_name_sql=='fm_currency_rate'){?>
                <th>Currency</th>
                <th>Convertion Rate to QAR</th> 
              <?php }elseif($table_name_sql=='fm_manpower'){?>
                <th>Designation</th>
                <th>Unit Price</th>     
              <?php }else{?>
                <th>Title</th>
                <th>Description</th> 
              <?php }?> 

              <?php if($table_name_sql=='fm_currency_type'){?>
                <th>Default Rate (if no BSP rate)</th>
              <?php }elseif($table_name_sql=='fm_issue_type'){?>
                <th>Cost To Project</th>
              <?php }elseif($table_name_sql=='fm_models'){

                if(@$manufacturers){
                  foreach($manufacturers as $rs){
                    $arr_manu[$rs->id] = $rs->title;
                  }
                }

                ?>
                <th>Manufacturer</th>
                <th>Model Year</th>
              <?php }?>
              <th>Option</th>
            </tr>
          </thead>

          <tbody>
          <?php 
          if(@$oc_type){
            foreach($oc_type as $rs){
              $arr_oc[$rs->id] = $rs->title;
            }
          }

          if($table_data){
          	foreach ($table_data as $rs) { 
          ?>
            <tr id="tr<?=$rs->id?>">
             <!--  <td><?php echo sprintf("%05d",$rs->id);?></td> -->
              <td><?php echo $rs->title;?></td>
              <?php if($table_name_sql=='fm_manpower'){?>
              <td align="right"><?php echo number_format($rs->ds,2);?></td>  
              <?php }else{?>  
              <td style="background-color: <?php echo $rs->ds;?>"><?php echo $rs->ds;?></td> 
              <?php }?>
              <?php if($table_name_sql=='fm_asset_group'){?>
              <td><?php if($rs->life_in_years){ echo $rs->life_in_years; if($rs->life_in_years>1){echo ' years';}else{echo ' year';}}?></td>
              <td><?php if($rs->depriciation_process==1){echo 'yes';}else{echo 'no';}?></td> 
              <?php }?>

              <?php if($table_name_sql=='fm_currency_type'){?>
                <td><?=$rs->vs_peso_rate?></td>
              <?php }elseif($table_name_sql=='fm_issue_type'){?>
                <td><?=$rs->is_project==1 ? 'Yes' : 'No'?></td>
              <?php }elseif($table_name_sql=='fm_models'){?>
                <td><?=@$arr_manu[$rs->manufacturer_id]?></td>
                <td><?=$rs->model_year?></td>
              <?php }?>
              <th>
                <a href="<?php echo base_url();?>maintenance/edit_table_data_content/<?php echo $table_name_sql;?>/<?php echo $rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                | 
                <a href="Javascript:prompt_delete('Delete','Delete <?php echo $rs->title;?> data?','<?=base_url('maintenance/delete_data/'.$table_name_sql.'/'.$rs->id)?>','tr<?=$rs->id?>')"><i class="fa fa-trash"></i> remove</a>
               
              </th>
            </tr> 
           <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function remove_data(str){
  reset(); 

  alertify.confirm("delete id : "+str+"?", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>maintenance/delete_data/<?php echo $table_name_sql;?>/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

