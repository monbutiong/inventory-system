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

/* Make each selected item in the multiple select take full width */
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
  display: block !important;
  padding: 5;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
  display: block !important;
  width: 100% !important;
  margin: 4px 0 !important;
  background-color: #f0f0f0;
  border: none;
  padding: 8px 10px;
  border-radius: 6px;
  white-space: normal;
} 


</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <form method="post" id="frm_validation"  enctype="multipart/form-data">
      <div class="x_title">


        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">Add New Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <br />
          
          <div class="row">
            <div class="col col-6">
          
                

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number *<font id="exist" style="display: none;" color="red">(exist!)</font>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input required type="text" id="item_code" name="item_code" required onkeyup="chk_item_code(this.value)" class="form-control col-md-7 col-xs-12">
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Description *
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input required type="text" id="item_name" name="item_name" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity on Hand
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" id="qty" name="qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <!-- <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Min-Max Quantity
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="min_qty" name="min_qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="max_qty" name="max_qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                </div> -->
       

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier Price
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="supplier_price" name="supplier_price" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div> 
  
                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Cost Price
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="unit_cost_price" name="unit_cost_price" class="form-control col-md-7 col-xs-12" value="0">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Retail Price
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="retail_price" name="retail_price" class="form-control col-md-7 col-xs-12" value="0">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bin Location 1
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_1" name="bin_1" placeholder="" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bin Location 2
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_2" name="bin_2" placeholder="" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bin Location 3
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_3" name="bin_3" placeholder="" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>



          </div>
          <div id="reload_data" class="col col-6">

            <!-- Category -->
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                Category &nbsp;
                <a href="javascript:void(0);" onclick="toggleInput(this)" data-target="category">
                  (<i class="fa fa-plus"></i>)
                </a>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="new_item_category" class="form-control toggle-input category" style="display:none;">
                <select id="item_category_id" name="item_category_id" class="form-control select2 category">
                  <option value=""></option>
                  <?php if (@$item_category) { foreach ($item_category as $rs) { ?>
                    <option value="<?= $rs->id ?>"><?= $rs->title ?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>

            <!-- Item Type -->
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                Item Type &nbsp;
                <a href="javascript:void(0);" onclick="toggleInput(this)" data-target="type">
                  (<i class="fa fa-plus"></i>)
                </a>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="new_item_type" class="form-control toggle-input type" style="display:none;">
                <select id="item_type_id" name="item_type_id" class="form-control select2 type">
                  <option value=""></option>
                  <?php if (@$item_types) { foreach ($item_types as $rs) { ?>
                    <option value="<?= $rs->id ?>"><?= $rs->title ?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>

            <!-- Item Brand -->
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                Item Brand &nbsp;
                <a href="javascript:void(0);" onclick="toggleInput(this)" data-target="brand">
                  (<i class="fa fa-plus"></i>)
                </a>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="new_item_brand" class="form-control toggle-input brand" style="display:none;">
                <select id="item_brand_id" name="item_brand_id" class="form-control select2 brand">
                  <option value=""></option>
                  <?php if (@$item_brand) { foreach ($item_brand as $rs) { ?>
                    <option value="<?= $rs->id ?>"><?= $rs->title ?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>


 
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Applicable Car Models
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea id="applicable_vehicle_model" name="applicable_vehicle_model" placeholder="" class="form-control col-md-7 col-xs-12"></textarea>
              </div>
            </div>  

            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Cross-Compatible Parts
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select id="cross_compatible_part_ids[]" name="cross_compatible_part_ids[]" class="form-control col-md-7 col-xs-12 select2-ajax-modal" multiple>
                   
                </select>
              </div>
            </div> 

                  
                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Picture (main)
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="file" id="picture_1" name="picture_1" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Picture
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="file" id="picture_2" name="picture_2" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Picture
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="file" id="picture_3" name="picture_3" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div> 

              </div>
            </div>

 
 
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
 <script type="text/javascript">
 
  $('#supplier_price, #unit_cost_price, #retail_price').on('blur', function () {
      let val = parseFloat($(this).val());
      
      if (!isNaN(val)) {
        $(this).val(val.toFixed(2));
      } else {
        $(this).val('0.00');
      }
    });

  function toggleInput(el) {
    const $icon = $(el).find('i');
    const type = el.dataset ? el.dataset.target : $(el).attr('data-target');

    const $input = $('.toggle-input.' + type);
    const $select = $('select.' + type);

    if ($input.is(':visible')) {
      // Show Select2, hide input
      $input.hide().val('');
      $select.next('.select2-container').show(); // show select2 UI
      $icon.removeClass('fa-minus').addClass('fa-plus');
    } else {
      // Hide Select2, show input
      $select.next('.select2-container').hide(); // hide select2 UI only
      $input.show().focus();
      $icon.removeClass('fa-plus').addClass('fa-minus');
    }
  }



  $('#frm_validation').on('submit', function(e) {
      e.preventDefault(); // Prevent default form submission

      let form = $(this)[0];
      let formData = new FormData(form); // Create FormData object

      $.ajax({
        url: "<?=base_url('inventory/save_item')?>", // Adjust if needed
        type: "POST",
        data: formData,
        contentType: false,
        processData: false, 
        success: function(response) {
          
          if(response == 1){ 
            Swal.fire({
            title: "Success!",
            text: "Successfuly saved.",
            icon: "success",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });

            // Reset the form
            $('#frm_validation')[0].reset();

            // Clear select2 selections
            $('.select2, .select2item, .select2-ajax-modal').val(null).trigger('change');

            // Hide error indicators
            $('#exist').hide();

            $('#reload_data').load('<?=base_url("inventory/reload_form_data")?>');

            refresh_inv_table();

          }else if(response == 3){
            Swal.fire({
            title: "Error!",
            text: "Part number and item description required!",
            icon: "error",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          }else if(response == 2){
            Swal.fire({
            title: "Error!",
            text: "Item code already exist in the inventory masterlist!",
            icon: "error",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          }else{
            Swal.fire({
            title: "Error!",
            text: "An error occurred!",
            icon: "error",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          }
        },
        error: function(xhr, status, error) { 
 
          Swal.fire({
          title: "Error!",
          text: xhr.responseText ? "An error occurred: " + xhr.responseText : 'Error on saving data!',
          icon: "error",
          confirmButtonColor: "#556ee6", // OK button color
          showCancelButton: false // No Cancel button
          }); 

        }
      });
    });
   
  function chk_item_code(val){

      $.post("<?=base_url('inventory/check_item_code')?>", {item_code: val}, function(result){
        if(result==1){
          $('#exist').show();
        }else{
          $('#exist').hide();
        }
      });

  }

  $(document).ready(function () {
      $('#picture_2').prop('disabled', true);
      $('#picture_3').prop('disabled', true);

      $('#picture_1').on('change', function () {
        if (this.files.length > 0) {
          $('#picture_2').prop('disabled', false);
        } else {
          $('#picture_2').val('').prop('disabled', true);
          $('#picture_3').val('').prop('disabled', true);
        }
      });

      $('#picture_2').on('change', function () {
        if (this.files.length > 0) {
          $('#picture_3').prop('disabled', false);
        } else {
          $('#picture_3').val('').prop('disabled', true);
        }
      });
    });

    preselectedIds = [];
 </script>
