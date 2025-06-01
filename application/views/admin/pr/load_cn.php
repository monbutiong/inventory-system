<?php if($type==1){?>
<label for="project_id">Purchasing Control Number *
</label> 
     <select onchange="enable_add_item(this.value,1)" name="inventory_accounts_id" id="inventory_accounts_id"  class="select2x form-control">
      <option value="">Select Control Number</option>
      <?php 
      if(@$accounts){
        foreach($accounts as $rs){?>
      <option value="<?php echo $rs->id;?>"><?=$rs->ds?></option>
      <?php }}?>
  </select>  
<?php }else{?>
<label for="project_id">Sales Control Number *
</label> 
     <select onchange="enable_add_item(this.value,2)" name="project_id" id="project_id"  class="select2x form-control">
      <option value="">Select Control Number</option>
      <?php 
      if(@$projects){
        foreach($projects as $rs){?>
      <option value="<?php echo $rs->id;?>"><?=$rs->control_number?></option>
      <?php }}?>
  </select> 
<?php }?>