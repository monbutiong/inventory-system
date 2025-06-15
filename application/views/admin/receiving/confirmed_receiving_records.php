<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Confirmed GRV Records</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                         
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">

        
        
        <table id="grv_datatable_confirmed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Date</th>
              <th>GRV Number</th>
              <th>P.O. Number</th>
              <th>DR Number</th>
              <th>Invoice Number</th>
              <th>Remarks</th>
              <th>Created By</th>
              <th>Confirmed Date</th>
              <th>Confirmed By</th>
              <th>Options</th>
            </tr>
          </thead>
        </table>

      </div>
    </div>

    </div>
    </div>
    
  </div> 
   
</div>

<script type="text/javascript">
function delete_po(id){
  reset(); 

  alertify.confirm("Confirm Deletion of Purchase Order Information? This Action Will Permanently Remove the Selected P.O. Records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>purchasing/delete_po/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function edit_rr(id){
  reset(); 

  alertify.confirm("Edit Receiving Records?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url('receiving/edit_rr');?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirm_receiving(id){
  reset(); 

  alertify.confirm("Confirm selected receiving records?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>receiving/confirm_receiving/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>