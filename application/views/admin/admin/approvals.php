<form method="post" id="frm_validation" name="approval_form" action="<?php echo base_url('admin/update_approvals/'.@$edit_id);?>" >
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Admin <small>Approval Settings</small></h2> 
            
   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Department</th>
              <th>Purchase Request Approver</th> 
              <th>Purchase Request Auto Approved</th>  
              <th>Purchase Order Approver</th> 
              <th>Purchase Order Auto Approved</th>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }} 

            if(@$dp){
              foreach($dp as $rs){
                if(@$edit_id == $rs->id){
            ?> 

            <tr>
              <td><?=$rs->title?></td> 
              <td>

                <select name="pr1" class="form-control">
                  <option>select 1st approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->pr1){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>
                <br/>
                <select name="pr2" class="form-control">
                  <option>select 2nd approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->pr2){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>
                <br/>
                <select name="pr3" class="form-control">
                  <option>select 3rd approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->pr3){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>

              </td>
              <td>
                <select name="pr_auto_approved" class="form-control">
                  <?php if($rs->pr_auto_approved==1){?>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  <?php }else{?>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  <?php }?>
                </select>
              </td>
              <td>

                <select name="po1" class="form-control">
                  <option>select 1st approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->po1){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>
                <br/>
                <select name="po2" class="form-control">
                  <option>select 2nd approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->po2){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>
                <br/>
                <select name="po3" class="form-control">
                  <option>select 3rd approver</option>
                  <?php 
                  if(@$users){
                    foreach($users as $urs){
                  ?>
                  <option value="<?=$urs->id?>" <?php if($urs->id==$rs->po3){echo 'selected';}?>><?=$urs->name?></option>
                <?php }}?>
                </select>
                
              </td>
              <td>
                <select name="po_auto_approved" class="form-control">
                  <?php if($rs->po_auto_approved==1){?>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  <?php }else{?>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  <?php }?>
                </select>
              </td>
              <td>
                 
                <a href="Javascript:save_form()"><i class="fa fa-save"></i> save</a> | 
                <a href="<?=base_url('admin/approvals');?>"><i class="fa fa-close"></i> cancel</a>

              </td>
            </tr>
         
          <?php }elseif(!@$edit_id){?>
            <tr>
              <td><?=$rs->title?></td> 
              <td> 
                <?=@$arr_user[$rs->pr1] ? '<small>(1st) </small>'.$arr_user[$rs->pr1].'<br/>' : '';?>
                <?=@$arr_user[$rs->pr2] ? '<small>(2nd) </small>'.$arr_user[$rs->pr2].'<br/>' : '';?>
                <?=@$arr_user[$rs->pr3] ? '<small>(3rd) </small>'.$arr_user[$rs->pr3].'<br/>' : '';?>
              </td>
              <td><?=@$rs->pr_auto_approved==1 ? 'Yes' : 'No'?></td>
              <td> 
                <?=@$arr_user[$rs->po1] ? '<small>(1st) </small>'.$arr_user[$rs->po1].'<br/>' : '';?>
                <?=@$arr_user[$rs->po2] ? '<small>(2nd) </small>'.$arr_user[$rs->po2].'<br/>' : '';?>
                <?=@$arr_user[$rs->po3] ? '<small>(3rd) </small>'.$arr_user[$rs->po3].'<br/>' : '';?>
              </td>
              <td><?=@$rs->po_auto_approved==1 ? 'Yes' : 'No'?></td>
              <td>
                 
                <a href="<?=base_url('admin/approvals/'.$rs->id);?>"><i class="fa fa-edit"></i> edit</a>

              </td>
            </tr>
            <?php }}}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>
 </form>
<script type="text/javascript">
function edit(id){
  reset(); 

  alertify.confirm("delete bib information? this will permanently delete selected bib records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>home/delete_bib/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function save_form(){
  document.approval_form.submit();
}
</script>
 

