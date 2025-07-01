<style>
.datepicker{z-index:1151 !important;}
#datatable 
{    
  overflow-y:hidden; 
}
select, .text_input {
    border: 1px solid #fff;
    background-color: transparent;
} 
.vcc{
  border-bottom-color: #999;
}
</style>
 
<form method="post" id="frm_validation" action="<?php echo base_url('admin/update_password');?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <br />
         

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" name="p1" id="p1" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Re-Type New Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" name="p2" id="p2" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  
 
          
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Submit</button>
        </div>

      </form>
    </div>
  </div>
</div> 
 
<script>
$(document).ready(function() {
  $('#frm_validation').on('submit', function(e) {
    e.preventDefault();

    const p1 = $('#p1').val().trim();
    const p2 = $('#p2').val().trim();

    // Validate fields
    if (!p1 || !p2) {
      Swal.fire('Validation Error', 'Please fill in both password fields.', 'warning');
      return;
    }

    if (p1.length < 6) {
      Swal.fire('Validation Error', 'Password must be at least 6 characters.', 'warning');
      return;
    }

    if (p1 !== p2) {
      Swal.fire('Validation Error', 'Passwords do not match.', 'error');
      return;
    }

    // Submit via AJAX
    $.post("<?= base_url('admin/update_password'); ?>", { p1: p1, p2: p2 }, function(response) {
      try {
        const res = JSON.parse(response);

        if (res.status === 'success') {
          Swal.fire('Success', res.message, 'success').then(() => {
            location.reload(); // or close modal
          });
        } else {
          Swal.fire('Error', res.message || 'Password update failed.', 'error');
        }
      } catch (e) {
        Swal.fire('Error', 'An unexpected error occurred.', 'error');
      }
    });
  });
});
</script>
 