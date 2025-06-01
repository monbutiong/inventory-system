<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Issuance<small>Confimed Sales Order Records</small></h2> 
 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>Issuance Number</th>
              <th>Job Order</th> 
              <th>Project</th> 
              <td>Remarks</td>  
              <td>Created By</td>    
              <td>Confirmed Date</td>    
              <td>Confirmed By</td>    
              <th>Options</th>
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
              $arr_pr[$rs->id] = $rs->name;
            }}

            if(@$jo){
              foreach($jo as $rs){
              $arr_jo[$rs->id] = $rs;
            }}
              
            if(@$issuance){
              foreach($issuance as $rs){
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td>I-202309-<?=$rs->id?></td> 
              <td><?=@$arr_jo[$rs->job_order_id]->job_order_number?></td> 
              <td><?=@$arr_pr[$rs->project_id]?></td> 
              <td><?=$rs->remarks?></td>  
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td><?=date('M d, Y',strtotime($rs->confirmed_date))?></td>
              <td><?=@$arr_user[$rs->confirmed_by]?></td>
              <td nowrap>
 
                <a href="<?php echo base_url('outgoing/view_ii/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> View</a>
                  |  
                <a target="_blank" href="<?php echo base_url('outgoing/print_ii/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                 
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
function delete_ii(id){
  reset(); 

  alertify.confirm("Confirm Deletion of Issuance? This Action Will Permanently Remove the Selected Issuance Records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>outgoing/delete_ii/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function edit_ii(id){
  reset(); 

  alertify.confirm("Edit Issuance Records?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url('outgoing/edit_ii');?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirm_issuance(id){
  reset(); 

  alertify.confirm("Confirm selected issuance records?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>outgoing/confirm_issuance/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>