<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Request For Approval <small>Purchase Request</small></h2> 
           

          <?php if(@$history){?>
            <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-warning  " href="<?php echo base_url('approval/pr');?>" >Go Back</a>
            </div>
          <?php }else{?>
            <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-primary" href="<?php echo base_url('approval/pr/history');?>" >View History</a>
            </div>
          <?php }?>
   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date Filed</th>
              <th>Requestor</th>  
              <th>Project</th>  
              <th>Remarks</th> 
              <th>Approver</th>
              <th>Form Status</th>   
              <th>P.O. </th>
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$type){
              foreach($type as $rs){
              $arr_type[$rs->id] = $rs->title;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_project[$rs->id] = $rs;
            }}

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

            $myid = $this->session->user_id;

            if(@$pr){
              foreach($pr as $rs){  
                if(

                      (($rs->a1_status == 0 && $rs->a1 == $myid) || 
                      ($rs->a1_status == 1 && $rs->a2_status == 0 && $rs->a2 == $myid) || 
                      ($rs->a2_status == 1 && $rs->a3_status == 0 && $rs->a3 == $myid)) 
                    ||
                      (@$history && (
                      ($rs->a1_status == 1 && $rs->a1 == $myid) || 
                      ($rs->a2_status == 1 && $rs->a2 == $myid) || 
                      ($rs->a3_status == 1 && $rs->a3 == $myid)))
                ){ 
            ?>
            <tr>
              <td><?=$rs->date_created?></td>
              <td><?=$arr_user[$rs->user_id]?></td>
              <td>
                <?=@$arr_project[$rs->project_id]->name?>
                <?=@$arr_project[$rs->project_id]->control_number ? '<br/><small>'.$arr_project[$rs->project_id]->control_number.'</small>' : ''?>

              </td>
              <td><?=$rs->remarks?></td>
              <td>
                <?=@$arr_user[$rs->a1] ? '<small>(1st) </small>'.$arr_user[$rs->a1].': '.fstat_($rs->a1_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a2] ? '<small>(2nd) </small>'.$arr_user[$rs->a2].': '.fstat_($rs->a2_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a3] ? '<small>(3rd) </small>'.$arr_user[$rs->a3].': '.fstat_($rs->a3_status).'<br/>' : '';?>
              </td>
              <td>
                <?php 
                if($rs->form_status == 1){ echo 'Approved'; 
                }elseif($rs->form_status == 2){ echo 'Rejected'; 
                }elseif($rs->form_status == 3){ echo 'Cancel'; 
                }elseif($rs->form_status == 0){ echo 'Pending'; } 
                ?>
              </td>
              <td>
                
              </td>
              <td>
                
                <a href="<?php echo base_url();?>pr/view_pr/<?=$rs->id;?>/0/1" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i><?php if(@$history){?> view <?php }else{?> manage <?php }?></a> 

              </td>
            </tr>
            <?php }}}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
function cancel_pr(id){
  reset(); 

  alertify.confirm("Cancel PR?", function (e) {
        if (e) {  
            alertify.log("cancelling...");
            location.href = "<?php echo base_url();?>pr/cancel_pr/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

