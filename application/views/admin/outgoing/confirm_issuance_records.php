<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Confirmed Sales Order</h6>
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
 
        
        <table id="issuance_confirmed_datatable" class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="font-size: 12px;">
                    <th>Date Filed</th>
                    <th>Pay Type</th>
                    <th>Sales Order #</th>
                    <th>Plate Number</th>
                    <th>VIN</th>
                    <th>Customer</th>
                    <th>Phone</th>
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
    function print_so(id) {
          Swal.fire({
              title: 'Print Quotation',
              text: "Print quotation with part number included?",
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#d33',          // Red confirm button
              cancelButtonColor: '#3085d6',        // Blue cancel button
              confirmButtonText: 'Yes',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.isConfirmed) {
                  // If Yes is clicked
                  window.open("<?php echo base_url('outgoing/print_issuance') ?>/"+id+'?with_partnumber=1', '_blank');
              } else {
                  // If No is clicked
                  window.open("<?php echo base_url('outgoing/print_issuance') ?>/"+id, '_blank');
              }
          });
    }
</script> 