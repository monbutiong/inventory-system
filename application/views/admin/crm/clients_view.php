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
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">View Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <br />
         
          <div class="row mb-3">
            <div class="col-md-3 col-sm-3 col-xs-12">
            <img height="150" src="<?php 
              if(file_exists('./assets/images/clients/logo-'.$clients->id.'.png')){
                echo base_url('assets/images/clients/logo-'.$clients->id.'.png?'.time());
                }else{
                echo base_url('assets/images/img.png'); }?>">
              </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer Code
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" readonly value="<?php echo @$clients->code?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">QID
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="qid" value="<?php echo @$clients->qid?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="name" value="<?php echo @$clients->name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="phone" value="<?php echo @$clients->phone?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="contact_person_1" value="<?php echo @$clients->contact_person_1?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="contact_person_2" value="<?php echo @$clients->contact_person_2?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="contact_number_1" value="<?php echo @$clients->contact_number_1?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 2
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="contact_number_2" value="<?php echo @$clients->contact_number_2?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="email" name="email" value="<?php echo @$clients->email?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea readonly name="address" class="form-control col-md-7 col-xs-12" row="3"><?php echo @$clients->address?></textarea>
            </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fax Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="fax_no" value="<?php echo @$clients->fax_no?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Website
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly type="text" name="website" value="<?php echo @$clients->website?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 
        
           
          </div>
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Submit</button>
          </div>

        
      </div>
    </div>
  </div>
</div> 
 
