<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
       
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">System Users</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                    

                        <a class="btn btn-md btn-primary load_modal_details" href="<?=base_url('home/add_system_users_content');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New User</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">

        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Avatar</th> 
              <th>Name</th>  
              <th>Account Details</th> 
              <th>Date Created</th>
              <th>User Roles</th>
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php 
          if($user_roles){
          	foreach ($user_roles as $rs) { 
          		$arr_user_roles[$rs->user_id] = $rs->id;
          }}

          if($department){
            foreach ($department as $rs) { 
              $arr_department[$rs->id] = $rs->title;
          }}

          $count_users=0;
          if($system_users){
            foreach ($system_users as $rs) {
              $count_users+=1;
          }}

          if($system_users){
          	foreach ($system_users as $rs) {  
              if($rs->id!=$this->session->user_id || 1){ 
          ?>
            <tr id="tr<?=$rs->id?>">
              <td width="40">
                 <img src="<?php echo base_url(); if($rs->avatar){echo 'assets/uploads/avatar/'.$rs->avatar;}else{echo 'assets/images/img.png';}?>" class="avatar" alt="Avatar" style="height: 100px;">
              </td> 
              <td><?php echo $rs->name;?></td> 
              <td><?=$rs->account_details?></td>
              <td><?php echo date(dateformatc,strtotime($rs->dc));?></td>
              <td>
              <i class="fa fa-pencil"></i> 
              	<?php if(isset($arr_user_roles[$rs->id]) && $arr_user_roles[$rs->id]){?>
              		<?php if($rs->full_access){?>
              			<a href="<?php echo base_url();?>home/user_roles/<?php echo $rs->id;?>" class="text-success">Full Access</a>
              		<?php }else{?>
              			<a href="<?php echo base_url();?>home/user_roles/<?php echo $rs->id;?>" class="text-info">Manage</a>
              		<?php }?>
              	<?php }else{?>
              	<a href="<?php echo base_url();?>home/user_roles/<?php echo $rs->id;?>" class="text-danger">Manage</a>
              	<?php }?>
              	</td>
              <td>
               <a href="<?php echo base_url('home/edit_user/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-edit"></i> Edit</a>
              
              <?php if($count_users>1){?>
                |  
               
                <a href="Javascript:prompt_delete('Delete','Delete User?','<?php echo base_url('home/edit_user/'.$rs->id);?>','tr<?=$rs->id?>')" ><i class="fa fa-trash"></i> Delete</a>
              <?php }?>
              </td>
            </tr> 
           <?php }}}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>
  </div>

   
</div>
<script type="text/javascript">
function remove_account(str){
  reset(); 

  alertify.confirm("remove this account?", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>home/delete_account/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

