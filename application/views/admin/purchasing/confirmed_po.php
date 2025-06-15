<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      
         <div class="page-title-box">
             <div class="row align-items-center">
                 <div class="col-md-8"> 
                     <h6 class="page-title">Confirmed Purchase Order</h6>
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
        
        <table id="datatable_po_confirmed" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
          <thead>
            <tr>
              <th>Date</th>
              <th>Vehicle</th>
              <th>Customer</th>
              <th>P.O. Number</th>
              <th>Supplier</th>
              <th>Att. To</th>
              <th>Reference No.</th>
              <th>Created By</th>
              <th>Date Confirmed</th>
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

function revised(id){
  reset(); 

  alertify.confirm("Confirm the Revision of the Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url();?>sales/revise_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirmq(id){
  reset(); 

  alertify.confirm("Confirm Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>sales/confirm_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>