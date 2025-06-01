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
</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>clients<small>View clients</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="" data-bs-toggle="validator" class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Code
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" readonly name="code" value="<?php echo @$clients->code?>" class="form-control col-md-7 col-xs-12 rid_only">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">clients Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name" value="<?php echo @$clients->name?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="phone" value="<?php echo @$clients->phone?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_person_1" value="<?php echo @$clients->contact_person_1?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_person_2" value="<?php echo @$clients->contact_person_2?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_number_1" value="<?php echo @$clients->contact_number_1?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_number_2" value="<?php echo @$clients->contact_number_2?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" name="email" value="<?php echo @$clients->email?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="address" class="form-control col-md-7 col-xs-12 rid_only" row="3" readonly><?php echo @$clients->address?></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fax Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="fax_no" value="<?php echo @$clients->fax_no?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quotation Attension To
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="attension_to" value="<?php echo @$clients->attension_to?>" class="form-control col-md-7 col-xs-12 rid_only" readonly>
            </div>
          </div>  
        
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>  
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
