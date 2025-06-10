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

    <script type="text/javascript">
    	if ($('#global_modal .select2').length && $("#global_modal .select2-ajax").length == 0) {
    	    $('#global_modal .select2').select2({
    	        width: '100%',
    	        dropdownParent: $('#global_modal')
    	    });
    	}
    </script>