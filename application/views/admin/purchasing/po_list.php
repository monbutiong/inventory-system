<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Unconfirmed Purchase Order</h6>
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
 
        <table id="datatable_po" class="table table-striped table-bordered table-hover" style="font-size: 12px;">
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
 

function confirm_po(id) {

     
      Swal.fire({
        title: 'Confirm Purchase Order?',
        text: "Are you sure you want to confirm this purchase order?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, save it',
        cancelButtonText: 'No, cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Swal.fire({
          //   icon: 'success',
          //   title: 'Saving...',
          //   text: 'Your purchase order is being saved.',
          //   showConfirmButton: false,
          //   timer: 1000
          // });
          location.href = "<?=base_url('purchasing/save_confirm_po')?>/"+id;
        }  
      });


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