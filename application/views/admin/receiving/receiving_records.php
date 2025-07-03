<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Unconfirmed GRV Records</h6>
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

        <table id="grv_datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Date</th>
              <th>GRV Number</th>
              <th>P.O. Number</th>
              <th>DR Number</th>
              <th>Invoice Number</th>
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
  </div> 
   
</div>

<script type="text/javascript">
 
  function confirm_receiving(id,grv) {
    Swal.fire({
      title: 'Confirm GRV?',
      text: "Are you sure you want to confirm GRV# "+grv+"?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#aaa',
      confirmButtonText: 'Continue',
      cancelButtonText: 'No, cancel'
    }).then((result) => {
      if (result.isConfirmed) {
         
        location.href = "<?=base_url('receiving/confirm_receiving')?>/"+id;
      }  
    });
  }

</script>