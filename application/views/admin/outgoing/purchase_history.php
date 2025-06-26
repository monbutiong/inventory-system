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
 
<form method="post" id="frm_validation" action="<?php echo base_url('outgoing/save_customer');?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Purchase History</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <br />
          
          

          <table id="datatable_modal" class="table table-striped table-bordered table-hover">
             
            <thead>
              <tr style="font-size: 12px;"> 
                <th>Date</th>
                <th>S.O.#</th>
                <th>Item Code</th> 
                <th>Item Name</th>  
                <th align="right" style="text-align: right;">Quantity</th> 
                <th align="right" style="text-align: right;">Return Qty.</th> 
                <th align="right" style="text-align: right;">Price</th><th align="right" style="text-align: right;">Line Total</th>   
                <th align="right" style="text-align: right;">Disc. %</th> 
                <th align="right" style="text-align: right;">Disc. Amt</th>  
                <th align="right" style="text-align: right;">Grand Total</th> 
                <th>Logged By</th>
              </tr>
              </thead> 
              <tbody>
                <?php 
                if(@$users){
                  foreach ($users as $rs) {
                    $arr_user[$rs->id] = $rs->name;
                  }
                }


                if(@$history){
                  foreach ($history as $rs) { 
                ?>
                <tr>
                  <td><?=date('d M, Y H:i', strtotime($rs->date_created))?></td>
                  
                  <td>SO<?=sprintf("%06d",$rs->issuance_id)?></td>  
                  <td><?=$rs->item_code?></td> 
                  <td><?=$rs->item_name?></td>
                  <td align="right"><?=$rs->qty?></td>
                  <td align="right"><?=$rs->return_qty?></td>
                  <td align="right"><?=$rs->retail_price?></td>
                  <td align="right"><?=number_format($line=($rs->qty-$rs->return_qty) * $rs->retail_price,2)?></td>
                  <td align="right"><?=$rs->discount_percentage?></td>
                  <td align="right"><?=$rs->discount_amount?></td>
                  <td align="right"><?=number_format($line-(($rs->discount_percentage/100) * $line),2)?></td>
                  <td><?=@$arr_user[$rs->user_id]?></td>
                </tr>
                <?php }}?>
              </tbody>
            </table>
 
          
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>  
        </div>

      </form>
    </div>
  </div>
</div> 
 
<script>
$(document).ready(function() {
  // Toggle QID and Business Reg # based on Customer Type selection
  const $customerType = $('select[name="customer_type"]');
  const $qidRow = $('input[name="qid"]').closest('.row');
  const $businessRegRow = $('input[name="business_registration_no"]').closest('.row');

  function updateVisibility() {
    if ($customerType.val() === '1') { // Business
      $qidRow.hide();
      $businessRegRow.show();
    } else { // Individual
      $qidRow.show();
      $businessRegRow.hide();
    }
  }
  $customerType.val('0');
  updateVisibility();
  $customerType.change(updateVisibility);

  // AJAX form submit
  $('#frm_validation').submit(function(e) {
    e.preventDefault(); // prevent default form submit

    var formData = new FormData(this);  // create FormData for file upload

    $.ajax({
      url: $(this).attr('action'), // crm/save_clients
      type: 'POST',
      data: formData,
      contentType: false, // important for file upload
      processData: false, // important for file upload
      dataType: 'json',
      beforeSend: function() {
        // Optional: disable submit button, show spinner, etc
        $('#frm_validation button[type="submit"]').prop('disabled', true).text('Saving...');
      },
      success: function(response) {
        // Assuming your server returns JSON with { success: true/false, message: '', ... }
        if(response == 1) {
          
          // Close the modal (Bootstrap 5 way)
          var modalEl = document.querySelector('#global_modal');
          var modal = bootstrap.Modal.getInstance(modalEl);
          modal.hide();
           
          
          // Optional: refresh a table or notify user 
          Swal.fire({
          title: "Success!",
          text: "Customer saved successfully!",
          icon: "success",
          confirmButtonColor: "#556ee6", // OK button color
          showCancelButton: false // No Cancel button
          });

          $('#frm_validation')[0].reset();
          updateVisibility(); // reset visibility logic
          // If inside a bootstrap modal, you can close it like this:
          // $('#yourModalId').modal('hide');
        } else {
          Swal.fire({
          title: "Error!",
          text: "An error occurred while saving!!!",
          icon: "error",
          confirmButtonColor: "#556ee6", // OK button color
          showCancelButton: false // No Cancel button
          });
        }
      },
      error: function(xhr, status, error) {
        Swal.fire({
        title: "Error!",
        text: "An error occurred while saving!!!",
        icon: "error",
        confirmButtonColor: "#556ee6", // OK button color
        showCancelButton: false // No Cancel button
        });
      },
      complete: function() {
        $('#frm_validation button[type="submit"]').prop('disabled', false).text('Submit');
      }
    });
  });
});
</script>
