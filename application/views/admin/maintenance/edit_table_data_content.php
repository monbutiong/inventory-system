<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Filemaintenance <small>Edit Record</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>maintenance/update_table_data/<?php echo $table_name;?>/<?php echo $table_data->id;?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

           
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
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
              <input type="text" id="title" name="title" required="required" value="<?php echo htmlentities($table_data->title);?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          

            <div class="form-group">
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
                    <input type="text" name="ds" value="<?=$table_data->ds?>" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                  </div> 
                <?php }elseif($table_name=='fm_manpower'){?>
                 <input type="number" id="ds" name="ds" value="<?=$table_data->ds?>" class="form-control col-md-7 col-xs-12">


                <?php }else{?>

                <input type="text" id="ds" name="ds" value="<?=$table_data->ds?>" class="form-control col-md-7 col-xs-12">

                <?php }?>
                

              </div>
            </div> 
          <?php if($table_name=='fm_inventory_accounts'){?>  

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Overhead Cost <span class="required"> </span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="overhead_cost_id" name="overhead_cost_id" class="form-control col-md-7 col-xs-12" >
                  <option value="0"></option>
                  <?php 
                  if(@$oc_type){
                    foreach($oc_type as $rs){
                  ?>
                  <option value="<?=$rs->id?>" <?php if($rs->id==$table_data->overhead_cost_id){echo 'selected';}?>><?=$rs->title?></option>
                  <?php }}?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Is in Inventory Monitoring <span class="required"> </span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="is_in_inventory" name="is_in_inventory" class="form-control col-md-7 col-xs-12" > 
                  <option value="1" <?php if($table_data->is_in_inventory == 1){echo 'selected';}?>>Yes</option>
                  <option value="0" <?php if($table_data->is_in_inventory == 0){echo 'selected';}?>>No</option> 
                </select>
              </div>
            </div>

          <?php } ?>

          <?php if($table_name=='fm_issue_type'){?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Cost<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="is_project" name="is_project" class="form-control col-md-7 col-xs-12" >
                  <?php if(@$table_data->is_project == 1){?>
                    <option value="1">Add to Project Cost</option>
                    <option value="0">Will Not Add to Project Cost</option>
                  <?php }else{?>
                    <option value="0">Will Not Add to Project Cost</option>
                    <option value="1">Add to Project Cost</option>
                  <?php }?>
                </select>
              </div>
            </div>
          <?php }?>

          <?php if($table_name=='fm_currency_type'){?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Rate <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="vs_peso_rate" name="vs_peso_rate" required="required" class="form-control col-md-7 col-xs-12" autofocus value="<?=$table_data->vs_peso_rate?>">
              </div>
            </div>
          <?php }?>
 
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </div>

          <input type="hidden" name="table_name" value="<?php echo $table_name;?>"></input>

        </form>
      </div>
    </div>
  </div>
</div> 

