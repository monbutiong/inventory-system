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
        <h2>Supplier<small>Add Supplier</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('purchasing/save_supplier/'.@$supplier->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Supplier Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name" value="<?php echo @$supplier->name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_person_1" value="<?php echo @$supplier->contact_person_1?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_person_2" value="<?php echo @$supplier->contact_person_2?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_number_1" value="<?php echo @$supplier->contact_number_1?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_number_2" value="<?php echo @$supplier->contact_number_2?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" name="email" value="<?php echo @$supplier->email?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="address" class="form-control col-md-7 col-xs-12" row="3"><?php echo @$supplier->address?></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fax Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="fax_no" value="<?php echo @$supplier->fax_no?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">P.O. Attention To
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="po_attension_to" value="<?php echo @$supplier->po_attension_to?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  
        
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Submit</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
