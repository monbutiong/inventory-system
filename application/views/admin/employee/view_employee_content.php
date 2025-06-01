<style>
.datepicker{z-index:1151 !important;}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Employee <small>View Employee Information</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       <form method="post" id="frm_validation" action="<?php echo base_url();?>employee/update_employee/<?php echo $employee->id;?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Employee Number <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="employee_number" name="employee_number" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $employee->employee_number;?>" readonly>
            </div>
          </div> 
           
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="last_name" name="last_name" value="<?php echo $employee->last_name;?>" readonly class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first_name" name="first_name" value="<?php echo $employee->first_name;?>" readonly class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Middle Name  
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="middle_name" name="middle_name" value="<?php echo $employee->middle_name;?>" readonly class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Department <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="department_id" name="department_id" required="required" readonly class="form-control col-md-7 col-xs-12">
                       
                      <?php 
                      if($department){
                        foreach($department as $rs){ if($employee->department_id== $rs->id){?>
                      <option value="<?php echo $rs->id;?>" <?php echo 'selected';?>><?php echo $rs->title;?></option>
                      <?php }}}?>
                  </select> 
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Designation <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="designation_id" name="designation_id" readonly class="form-control col-md-7 col-xs-12">
                       
                      <?php 
                      if($designation){
                        foreach($designation as $rs){if($employee->designation_id== $rs->id){?>
                      <option value="<?php echo $rs->id;?>" <?php echo 'selected';?>><?php echo $rs->title;?></option>
                      <?php }}}?>
                  </select> 
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Birth Date
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="bday" readonly value="<?php echo date(dateformatc,strtotime($employee->birth_date));?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gender 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="gender" name="gender" readonly class="form-control col-md-7 col-xs-12">
                      <option value=""><?php echo $employee->gender;?></option> 
                  </select>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email  
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" id="email" name="email" readonly value="<?php echo $employee->email_address;?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number  
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="contact_no" name="contact_no" readonly value="<?php echo $employee->contact_no;?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address  
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="address" name="address" readonly value="<?php echo $employee->address;?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>  
                </div>
              </div>

          </div>

          </form>
     
    </div>
  </div>
</div> 
<script type="text/javascript">
  $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true
    });
</script>


