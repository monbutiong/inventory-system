<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase Request <small>Masterlist</small></h2> 
           

            <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('pr/add_pr');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Request</a>
            </div>

         
   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date Filed</th>
              <th>Control/PR Number</th> 
              <th>Project/Account</th>  
              <th>Remarks</th> 
              <th>Approver</th>
              <th>Form Status</th>   
              <th>P.O. </th>
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$accounts){
              foreach($accounts as $rs){
              $arr_account[$rs->id] = $rs->title;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_project[$rs->id] = $rs;
            }}

            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }} 

            
 
            if(@$po){
              foreach($po as $rs){ 
                $arr_po[$rs->id]=$rs;  
              }
            }

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

            if(@$pr){
              foreach($pr as $rs){
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=$rs->date_created?></td>
              <td>
                #<?=date('y',strtotime($rs->date_created)).'-'.$rs->id?><br/>
                <?=$rs->pr_number?>
                <?php if($rs->rev>0){echo '(rev '.$rs->rev.')';}?>
              </td>
              <td>
                <?php if($rs->control_number_type == 1){?>
                  <?=@$arr_account[$rs->inventory_accounts_id]?>
                  <?='<br/><small>'.@$rs->pur_control_number.'</small>'?>
                <?php }else{?>  
                  <?=@$arr_project[$rs->project_id]->name?>
                  <?='<br/><small>'.@$arr_project[$rs->project_id]->control_number.'</small>'?>
                <?php }?>

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
                <?php if(@$rs->po_ids){
                  foreach(json_decode($rs->po_ids) as $poid){
                    echo '<small><a target="_blank" href="'.base_url('vendor/print_po/'.$poid).'">'.@$arr_po[$poid]->po_number.': '.date('M d, Y',strtotime(@$arr_po[$poid]->date_created)).'</a></small><br/>';
                  }
                }else{?>
                  <i>no record</i>
                <?php }?>
              </td>
              <td nowrap="nowrap">
                
                <a href="<?php echo base_url();?>pr/revise_pr/<?=$rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file"></i> Revise</a> | 

                <a href="<?php echo base_url();?>pr/view_pr/<?=$rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i> view</a>  

                <br/>

                <a target="_blank" href="<?php echo base_url();?>pr/print_pr/<?=$rs->id;?>"> <i class="fa fa-print"></i> Print</a> 

                 | 
                  <a href="Javascript:cancel_pr(<?=$rs->id;?>);"><i class="fa fa-trash-o"></i> cancel</a>
                <?php if(@$arr_po[$rs->id]){?>  | 
                  <a href="Javascript:move_to_history_pr(<?=$rs->id;?>);"><i class="fa fa-folder"></i> move to history</a>
                <?php }?>

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


function move_to_history_pr(id){
  reset(); 

  alertify.confirm("Move to history?", function (e) {
        if (e) {  
            alertify.log("cancelling...");
            location.href = "<?php echo base_url();?>pr/move_to_history_pr/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

