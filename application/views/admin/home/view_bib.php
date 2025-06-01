<style>
.datepicker{z-index:1151 !important;}
 
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>View BIB</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" data-bs-toggle="validator" class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="customer_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($customer){
                    foreach($customer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->customer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>
           
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  id="myInput" name="bib_name" value="<?php echo $bib->bib_name;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB S/N <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="bib_sn" value="<?php echo $bib->bib_sn;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Device Number  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="device_number" value="<?php echo $bib->device_number;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Package Type and Lead Count 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="package_type" value="<?php echo $bib->package_type;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Type  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="bib_type_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_type){
                    foreach($bib_type as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_type_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">PM date (WWMM) <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input disabled type="number" name="pm_date"  value="<?php echo $bib->pm_date;?>" required="required" class="form-control col-md-7 col-xs-12" maxlength="4">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Part Number 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="socket_part_number"  value="<?php echo $bib->socket_part_number;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Manufacturer 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="socket_manufacturer_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($socket_manufacturer){
                    foreach($socket_manufacturer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->socket_manufacturer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Type  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="socket_type_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($socket_type){
                    foreach($socket_type as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->socket_type_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Manufacturer  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="bib_manufacturer_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_manufacturer){
                    foreach($bib_manufacturer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_manufacturer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Density 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" disabled  name="socket_density"  value="<?php echo $bib->socket_density;?>" class="form-control col-md-3">
                </div> 
                <div class="col-sm-3">
                  <input type="number" disabled name="socket_row" value="<?php echo $bib->socket_row;?>" class="form-control col-md-3" placeholder="row">
                </div> 
                <div class="col-sm-3">
                  <input type="number" disabled name="socket_column" value="<?php echo $bib->socket_column;?>" class="form-control col-md-3" placeholder="column">
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Good Socket <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="good_socket" value="<?php echo $bib->good_socket;?>" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Defective Socket <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="defective_socket" value="<?php echo $bib->defective_socket;?>" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Status <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="bib_status_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_status){
                    foreach($bib_status as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_status_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Location <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select disabled name="bib_location_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_location){
                    foreach($bib_location as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_location_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled  name="remarks"  value="<?php echo $bib->remarks;?>" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Uploaded <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled name="date_uploaded" value="<?php echo @$bib->date_uploaded ? date('M d, Y',strtotime($bib->date_uploaded)) : '';?>" required="required"  class="form-control col-md-7 col-xs-12" >
            </div>
          </div>
 
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
              <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" >Close</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 