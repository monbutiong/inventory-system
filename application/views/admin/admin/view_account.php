<style>
  .ridonly {
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        

        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">Account Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

      </div>
      <div class="modal-body">
        <br />

          <div class="row mb-3">
          <center>
            <img src="<?php echo base_url(); if($user->avatar){echo 'assets/uploads/avatar/'.$user->avatar.'?'.time();}else{echo 'assets/images/img.png';}?>" class="rounded rounded-circle" alt="Avatar" style="height: 100px;">
          </center>
          </div>
         
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Update Avatar <span class="required"> </span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="avatar" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" name="name" value="<?=$user->name?>" readonly class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Account Details 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="account_details" value="<?=$user->account_details?>" name="account_details" readonly class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>

         
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="username" name="username" value="<?=$user->un?>" readonly class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>
 
           
           
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
          </div>
 
      </div>
    </div>
  </div>
</div> 
<script>
$(document).ready(function () {
  $('.btn-primary').on('click', function (e) {
    e.preventDefault();

    let formData = new FormData();
    const avatarInput = $('input[name="avatar"]')[0].files[0];

    if (!avatarInput) {
      Swal.fire('Validation', 'Please select an image to upload.', 'warning');
      return;
    }

    formData.append('avatar', avatarInput);

    $.ajax({
      url: "<?= base_url('admin/update_avatar') ?>",
      type: "POST",
      data: formData,
      processData: false, // prevent jQuery from converting the data
      contentType: false,
      dataType: 'json',
      success: function (res) {
        if (res.status === 'success') {
          Swal.fire('Success', res.message, 'success');
          
          // Dynamically update avatar image
          let newAvatarUrl = "<?= base_url('assets/uploads/avatar/') ?>" + res.filename + '?' + new Date().getTime();
          $('#avatarPreview').attr('src', newAvatarUrl);
          location.reload();
        } else {
          Swal.fire('Error', res.message, 'error');
        }
      },
      error: function () {
        Swal.fire('Error', 'Unexpected error occurred.', 'error');
      }
    });
  });
});
</script>

