<style>
.datepicker{z-index:1151 !important;}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Employee <small>Add New Employee</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>employee/add_new_employee" data-bs-toggle="validator" class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Employee Number <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="employee_number" name="employee_number" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
            </label>      
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Middle Name  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="middle_name" name="middle_name" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Department <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="department_id" name="department_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select department</option>
                  <?php 
                  if($department){
                    foreach($department as $rs){?>
                  <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Designation <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="designation_id" name="designation_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select designation</option>
                  <?php 
                  if($designation){
                    foreach($designation as $rs){?>
                  <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Birth Date
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="single_cal1" name="bday" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gender 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="gender" name="gender" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select gender</option>
                  <option>male</option>
                  <option>female</option>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="contact_no" name="contact_no" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <!-- <hr/>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Rate  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="rate" id="rate" required="required" class="select2_ form-control">
                 <option>Daily</option>
                 <option>Monthly</option>
             </select> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Basic Salary  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="basic_amount" name="basic_amount" class="form-control col-md-7 col-xs-12">
            </div>
          </div> -->
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true
    });
</script>


