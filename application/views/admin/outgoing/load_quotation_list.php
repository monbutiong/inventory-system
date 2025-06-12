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
 
 

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Quotation List</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">

      	<table id="quotation_datatable_modal" class="table table-striped table-bordered table-hover">
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
<script>
	function select_quotatation(id) {
		Swal.fire({
		    title: "Load Quotation Data?",
		    text: "Do you want to load this quotation data to new sales order form?",
		    icon: "question",
		    showCancelButton: true,
		    confirmButtonText: "Continue",
		    cancelButtonText: "No, cancel",
		    reverseButtons: true
		}).then((result) => {
		    if (result.isConfirmed) {
		     
		        location.href = "<?=base_url('outgoing/create_issuance')?>/"+id;
		    } 
		});	
	}
	
</script>