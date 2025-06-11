<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Quotation Masterlist</h6>
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

        
        
        <table id="quotation_datatable" class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="font-size: 12px;">
                    <th>Date Filed</th>
                    <th>Valid Until</th>
                    <th>Quotation #</th>
                    <th>Plate Number</th>
                    <th>VIN</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Remarks</th>
                    <th>Created By</th>
                    <th>Options</th>
                </tr>
            </thead>
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