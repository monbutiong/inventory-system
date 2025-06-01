<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

      <form method="post" id="frm_validation" action="<?php echo base_url();?>maintenance/add_new_table_data/<?php echo $table_name;?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
      
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Create New Record</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">

        

           
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                <?php if($table_name=='fm_currency_rate'){?>
                  Currency
                <?php }elseif($table_name=='fm_manpower'){?>
                  Designation
                <?php }else{?>
                  Title
                <?php }?>
             <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" autofocus>
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ds">
              <?php if($table_name=='fm_currency_rate'){?>
                Convertion rate to QAR
              <?php }elseif($table_name=='fm_manpower'){?>
                  Unit Price
              <?php }else{?>  
                Description
              <?php }?>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if($table_name=='fm_purchase_type'){?>

                <div class=" color_picker">
                  <input type="text" name="ds" value="#e01ab5" class="form-control" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              <?php }elseif($table_name=='fm_manpower'){?>
                 <input type="number" id="ds" name="ds" class="form-control col-md-7 col-xs-12">

              <?php }else{?>

              <input type="text" id="ds" name="ds" class="form-control col-md-7 col-xs-12">

              <?php }?>
              

            </div> 
          </div> 


          <?php if($table_name=='fm_inventory_accounts'){?>  

            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Overhead Cost <span class="required"> </span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="overhead_cost_id" name="overhead_cost_id" class="form-control col-md-7 col-xs-12" >
                  <option value="0"></option>
                  <?php 
                  if(@$oc_type){
                    foreach($oc_type as $rs){
                  ?>
                  <option value="<?=$rs->id?>" <?php if($rs->id==@$table_data->overhead_cost_id){echo 'selected';}?>><?=$rs->title?></option>
                  <?php }}?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Is in Inventory Monitoring <span class="required"> </span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="is_in_inventory" name="is_in_inventory" class="form-control col-md-7 col-xs-12" > 
                  <option value="1" <?php if(@$table_data->is_in_inventory == 1){echo 'selected';}?>>Yes</option>
                  <option value="0" <?php if(@$table_data->is_in_inventory == 0){echo 'selected';}?>>No</option> 
                </select>
              </div>
            </div>

          <?php }?>

          <?php if($table_name=='fm_issue_type'){?>
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Cost<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="is_project" name="is_project" class="form-control col-md-7 col-xs-12" >
               
                    <option value="1">Add to Project Cost</option>
                    <option value="0">Will Not Add to Project Cost</option>
                 
                </select>
              </div>
            </div>
          <?php }?>

          <?php if($table_name=='fm_currency_type'){?>
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Rate <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="vs_peso_rate" name="vs_peso_rate" required="required" class="form-control col-md-7 col-xs-12" autofocus>
              </div>
            </div>
          <?php }?>

          <?php if($table_name=='fm_models'){?>
            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Manufacturer <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select required name="manufacturer_id" class="form-control col-md-7 col-xs-12 select2">
                  <option value=""></option>
                  <?php 
                  if(@$manufacturers){
                    foreach($manufacturers as $rs){
                  ?>
                  <option value="<?=$rs->id?>"><?=$rs->title?></option>
                  <?php }}?>
                 </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Model Year <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="model_year" name="model_year" required="required" class="form-control col-md-7 col-xs-12" autofocus>
              </div>
            </div>
          <?php }?>

  
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save</button>
          </div>

          <input type="hidden" name="table_name" value="<?php echo $table_name;?>"></input>

        </form>
      </div>
    </div>
  </div>
</div> 
