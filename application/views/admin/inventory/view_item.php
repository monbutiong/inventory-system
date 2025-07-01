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
.auto-expand {
  overflow-y: hidden;
  resize: none; /* optional */
}
</style>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <form method="post" id="frm_inv_view" name="frm_inv_view" action="#" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
      <div class="x_title">

        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">Item #: <?=htmlspecialchars($item->item_code)?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <br />
          
          <div class="row">
            <div class="col col-6">

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_code">Part Number <font id="exist" style="display: none;" color="red">(exist)</font></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="item_code" name="item_code" required onkeyup="chk_item_code(this.value)" class="form-control col-md-7 col-xs-12" value="<?=htmlspecialchars($item->item_code)?>">
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_name">Description</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="item_name" name="item_name" required class="form-control col-md-7 col-xs-12" value="<?=htmlspecialchars($item->item_name)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Arabic Description 
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="item_name_arabic" name="item_name_arabic" required class="form-control col-md-7 col-xs-12" value="<?=($item->item_name_arabic)?>" style="text-align: right;" dir="rtl">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Quantity on Hand</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" id="qty" name="qty" value="<?=htmlspecialchars($item->qty)?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_price">Manufacturer Price</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="supplier_price" name="supplier_price" required class="form-control col-md-7 col-xs-12" style="text-align: right;" value="<?=number_format($item->supplier_price,2)?>">
                  </div>
                </div> 

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_cost_price">Unit Cost Price</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="unit_cost_price" name="unit_cost_price" required class="form-control col-md-7 col-xs-12" style="text-align: right;" value="<?=number_format($item->unit_cost_price,2)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price_b2b">Retail Price</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="number" step="any" min="0" id="retail_price" name="retail_price" required class="form-control col-md-7 col-xs-12" style="text-align: right;" value="<?=number_format($item->retail_price,2)?>">
                  </div>
                </div> 

                 
                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bin_1">Bin Location 1</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_1" name="bin_1" class="form-control col-md-7 col-xs-12" value="<?=htmlspecialchars($item->bin_1)?>">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bin_2">Bin Location 2</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_2" name="bin_2" class="form-control col-md-7 col-xs-12" value="<?=htmlspecialchars($item->bin_2)?>">
                  </div> 
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bin_3">Bin Location 3</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="bin_3" name="bin_3" class="form-control col-md-7 col-xs-12" value="<?=htmlspecialchars($item->bin_3)?>">
                  </div> 
                </div>

                <?php if($item->picture_1 || $item->picture_2 || $item->picture_3){?>
                <div class="row mb-3">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                       Pictures
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                        <!-- Image Previews -->
                        <div class="row mb-2">
                            <?php if (!empty($item->picture_1)) : ?>
                                <div class="col-4 mb-2">
                                    <a target="_blank" href="<?= base_url('assets/uploads/inventory/' . $item->picture_1) ?>">
                                        <img src="<?= base_url('assets/uploads/inventory/' . $item->picture_1) ?>" class="img-fluid rounded border" alt="Item Picture 1">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($item->picture_2)) : ?>
                                <div class="col-4 mb-2">
                                    <a target="_blank" href="<?= base_url('assets/uploads/inventory/' . $item->picture_2) ?>">
                                        <img src="<?= base_url('assets/uploads/inventory/' . $item->picture_2) ?>" class="img-fluid rounded border" alt="Item Picture 2">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($item->picture_3)) : ?>
                                <div class="col-4 mb-2">
                                    <a target="_blank" href="<?= base_url('assets/uploads/vehicles/' . $item->picture_3) ?>">
                                        <img src="<?= base_url('assets/uploads/inventory/' . $item->picture_3) ?>" class="img-fluid rounded border" alt="Item Picture 3">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                         
                    </div>
                </div>
                <?php }?>

          </div>

          <div class="col col-6">

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_category_id">Item Category</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_category_id" name="item_category_id" class="form-control col-md-7 col-xs-12 select2">
                
                      <?php 
                      if(@$item_category){
                        foreach($item_category as $rs){
                          $selected = ($rs->id == $item->item_category_id) ? 'selected' : '';
                      ?>
                      <option value="<?=$rs->id?>" <?=$selected?>><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_type_id">Item Type</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_type_id" name="item_type_id" class="form-control col-md-7 col-xs-12 select2">
                   
                      <?php 
                      if(@$item_types){
                        foreach($item_types as $rs){
                          $selected = ($rs->id == $item->item_type_id) ? 'selected' : '';
                      ?>
                      <option value="<?=$rs->id?>" <?=$selected?>><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>  

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_brand_id">Item Brand</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="item_brand_id" name="item_brand_id" class="form-control col-md-7 col-xs-12 select2"> 
                      <?php 
                      if(@$item_brand){
                        foreach($item_brand as $rs){
                          $selected = ($rs->id == $item->item_brand_id) ? 'selected' : '';
                      ?>
                      <option value="<?=$rs->id?>" <?=$selected?>><?=$rs->title?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>  

                <div class="row mb-3">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Applicable Car Models
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea id="applicable_vehicle_model" name="applicable_vehicle_model" placeholder="" class="form-control col-md-7 col-xs-12 auto-expand"><?=$item->applicable_vehicle_model?></textarea>
                  </div>
                </div> 

                <div class="row mb-3">
                  <?php 
                  $preload_avm = '';
                  if($item->cross_compatible_part_ids){
                    foreach(json_decode($item->cross_compatible_part_ids) as $ccp_id){
                       if(@$preload_avm){
                         $preload_avm.=(','.$ccp_id);
                       }else{
                         $preload_avm=$ccp_id;
                       }
                    }
                  }
                  ?>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cross-Compatible Parts
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="cross_compatible_part_ids[]" name="cross_compatible_part_ids[]" class="form-control col-md-7 col-xs-12 select2-ajax-modal" multiple>
                       
                    </select>
                  </div>
                </div> 

                  
                 

              </div>
            </div>
          </div>
          <br />
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    const $form = $('#frm_inv_view'); // Replace with your form ID or class

    // Disable all input, textarea, select, button
    $form.find('input, textarea, select').prop('disabled', true);

    // Handle Select2 specifically
    $form.find('select.select2').each(function() {
      $(this).select2('destroy'); // Destroy Select2 to show native disabled look
      $(this).prop('disabled', true);
    });

    // Add dashed border to all fields
    $form.find('input, textarea, select').css({
      'border': '1px dashed #999',
      'background-color': '#f9f9f9' // optional for visual cue
    });
  });

  $(document).ready(function () {
    function autoResize($textarea) {
      $textarea.height(0); // Reset height
      $textarea.height($textarea[0].scrollHeight);
    }

    const $textareas = $('.auto-expand');

    $textareas.each(function () {
      autoResize($(this)); // Expand on page load
    });

    $textareas.on('input', function () {
      autoResize($(this)); // Expand as user types
    });
  });

  preselectedIds = [<?=$preload_avm?>];
</script>