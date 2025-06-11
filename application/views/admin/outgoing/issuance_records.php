<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Unconfirmed Sales Order</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                         
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>Sales Order Number</th>
              <th>Job Order</th> 
              <th>Project</th> 
              <td>Remarks</td>  
              <td>Created By</td>    
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
              <td>SO<?=sprintf("%06d",$rs->id)?></td> 
              <td><?=@$arr_jo[$rs->job_order_id]->job_order_number?></td> 
              <td><?=@$arr_pr[$rs->project_id]?></td> 
              <td><?=$rs->remarks?></td>  
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>
 
                <a href="<?php echo base_url('outgoing/view_ii/'.$rs->id.'/1');?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-check"></i> Confirm</a>
                  |  
                <a href="<?php echo base_url('outgoing/view_ii/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> View</a>
                  | 
                <a href="Javascript:edit_ii(<?=$rs->id?>)" ><i class="fa fa-edit"></i> Edit</a>
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
            $('#confirm_btn').hide();
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>outgoing/confirm_issuance/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>