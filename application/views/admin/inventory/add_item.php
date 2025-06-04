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
      <form method="post" id="frm_validation" action="<?=base_url('inventory/save_item')?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Part Number <font id="exist" style="display: none;" color="red">(exist)</font>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="item_code" name="item_code" required onkeyup="chk_item_code(this.value)" class="form-control col-md-7 col-xs-12">
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="item_name" name="item_name" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Initial Quantity
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" id="qty" name="qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <!-- <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Min-Max Quantity
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="min_qty" name="min_qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="max_qty" name="max_qty" value="0" class="form-control col-md-7 col-xs-12">
                  </div>
                </div> -->
       

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Manufacturer Price
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="manufacturer_price" name="manufacturer_price" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Price B2B
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="unit_price_b2b" name="unit_price_b2b" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Price B2C
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="unit_price_b2c" name="unit_price_b2c" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Cost Price
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="unit_cost_price" name="unit_cost_price" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Item Category
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_category_id" name="unit_cost_price" class="form-control col-md-7 col-xs-12 select2">
                      <option value=""></option>
                      <?php 
                      if(@$item_category){
                        foreach($item_category as $rs){
                      ?>
                      <option value="<?=$rs->id?>"><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Item Type
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_type_id" name="unit_cost_price" class="form-control col-md-7 col-xs-12 select2">
                      <option value=""></option>
                      <?php 
                      if(@$item_types){
                        foreach($item_types as $rs){
                      ?>
                      <option value="<?=$rs->id?>"><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>  

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Item Brand
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_brand_id" name="item_brand_id" class="form-control col-md-7 col-xs-12 select2">
                      <option value=""></option>
                      <?php 
                      if(@$item_brand){
                        foreach($item_brand as $rs){
                      ?>
                      <option value="<?=$rs->id?>"><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>  


          </div>
          <div class="col col-6">

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Bin Location 1
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_1" name="bin_1" placeholder="BIN 1" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Bin Location 2
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_2" name="bin_2" placeholder="BIN 2" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Bin Location 3
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_3" name="bin_3" placeholder="BIN 3" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Primary Car Models
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="primary_vehicle_model_id" name="primary_vehicle_model_id" class="form-control col-md-7 col-xs-12 select2">
                      <option value="">none</option>
                      <?php 
                      if(@$manufacturers){
                        foreach($manufacturers as $rs){
                          $arr_manu[$rs->id] = $rs->title;
                      }}
                      if(@$models){
                        foreach($models as $rs){
                      ?>
                      <option value="<?=$rs->id?>"><?=@$arr_manu[$rs->manufacturer_id].' '.$rs->title.' '.$rs->model_year?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Applicable Car Model
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="applicable_vehicle_model_ids[]" name="applicable_vehicle_model_ids[]" multiple class="form-control col-md-7 col-xs-12 select2item">
                      <option value="">none</option>
                      <?php  
                      if(@$models){
                        foreach($models as $rs){
                      ?>
                      <option 
                      data-item_code="<?=@$arr_manu[$rs->manufacturer_id]?>" 
                      data-item_name="<?=@$rs->title . ' ' . $rs->model_year?>" 
                      value="<?=$rs->id?>"><?=@$arr_manu[$rs->manufacturer_id].' '.$rs->title.' '.$rs->model_year?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cross-Compatible Parts
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="cross_compatible_part_ids[]" name="cross_compatible_part_ids[]" class="form-control col-md-7 col-xs-12 select2-ajax-modal" multiple>
                       
                    </select>
                  </div>
                </div> 

                  
                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Picture (main)
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="file" id="picture_1" name="picture_1" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Picture
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="file" id="picture_2" name="picture_2" class="form-control col-md-7 col-xs-12">
                  </div> 
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Picture
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


 </script>
