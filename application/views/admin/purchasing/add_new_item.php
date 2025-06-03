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

      <form method="post" id="frm_validation" action="#" data-bs-toggle="validator" class="form-horizontal form-label-left">
        
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Create New Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <br />
        
 
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Part Number 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="item_code" onblur="check_ex(this.value)" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="item_name"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="qty" value="1" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Cost
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="unit_cost"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="button" onclick="add_item_line()" class="btn btn-success">Add</button>
          </div>

            

        
      </div>
    </form>
    </div>
  </div>
</div> 
 
 <script type="text/javascript">
   
   function check_ex(v){
      var formData = new FormData();  
      formData.append("item_code", v); 

      $.ajax({
        url: "<?=base_url('purchasing/check_item_code_name')?>", // Replace with your actual API endpoint URL
        type: "POST",
        data: formData,
        contentType: false, // Set to false for FormData
        processData: false, // Set to false for FormData
        success: function(response) {
          if(response==1){ 
            alertify.error("item code already exist");  
          }
          
          console.log(response); // Optional: Log the response data
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alertify.error("error checking");
        }
      });
   }

   function add_item_line() {
     var id = 9999999999 + $('#row_counter').val();
     var part_no = $('#item_code').val();
     var desc = $('#item_name').val();
     var qty = $('#qty').val();
     var unit_cost = $('#unit_cost').val();
     var cur_val = $('#curr_val option:selected').text();

     if (cur_val == 'Select') cur_val = '';

     var ttl = qty * unit_cost;
     var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

     var newRowHtml = `
       <tr id="irow${id}" class="all_po_itm">
         <td>
           <input type="hidden" name="items[${id}]" value="${id}">
           ${part_no}
           <input type="hidden" name="item_code${id}" value="${part_no}">
           <input type="hidden" name="lcr${id}" value="0">
           <input type="hidden" name="inv_id${id}" value="0">
         </td>
         <td>
           ${desc}
           <input type="hidden" name="item_name${id}" value="${desc}">
           <input type="hidden" name="quotation_id${id}" value="0">
         </td>
         <td>
           <input type="number" id="i_qty${id}" name="i_qty${id}" onkeyup="comp(${id})" value="${qty}" style="border: 0; width: 70px;">
         </td>
         <td align="right" nowrap>
           <font class="rater">${cur_val}</font>
           <input type="number" name="i_unit_cost${id}" id="i_unit_cost${id}" onkeyup="comp(${id})" value="${unit_cost}" style="border: 0; text-align: right;">
         </td>
         <td align="right">
           <input type="hidden" class="all_ttl" id="i_ttl${id}" value="${ttl}">
           <span id="ttl${id}">${ttl_nf}</span>
         </td>
         <td>
           <a href="javascript:idel(${id})"><i class="fa fa-trash" style="color: red;"></i></a>
         </td>
       </tr>
     `;

     $('#last_row').before(newRowHtml);

     // Close modal properly
     $('#newItemModal').modal('hide'); // if using Bootstrap modal
     // or fallback
     $('#close_new').click();

     // Reset select2 dropdown input inside modal
     setTimeout(function() {
       $('#item_code').val(null).trigger('change');
       $('#item_name').val('');
       $('#qty').val('');
       $('#unit_cost').val('');
     }, 300);
   }


 </script>
