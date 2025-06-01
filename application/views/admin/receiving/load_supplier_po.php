<select name="po_ids" id="pos_id" multiple class="form-control select2_" onchange="load_items()"> 
	<?php   
	if($po){
	  foreach ($po as $rs) {
	?>
	<option  value="<?=$rs->id?>"><?=$rs->po_number?></option>
	<?php }}?>
</select>