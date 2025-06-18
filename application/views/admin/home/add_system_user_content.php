<form method="post" id="frm_validation" action="<?php echo base_url();?>home/add_new_system_user" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <form method="post" id="frm_validation"  enctype="multipart/form-data">
      <div class="x_title">

        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">Add New user</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <br />

        <br />
        
           
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Avatar <span class="required"> </span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="avatar" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Account Details <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="account_details" name="account_details" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

         
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="cpassword" name="cpassword" data-match="#password" data-match-error="Whoops, these don't match" class="form-control col-md-7 col-xs-12" required="required">
            </div>
          </div>

           
           
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
 
      </div>
    </div>
  </div>
</div>  
        </form>
