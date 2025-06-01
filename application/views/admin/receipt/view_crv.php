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
        <h2>Receipt<small>View CRV</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div>

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab1" id="recent-tab" role="tab" data-bs-toggle="tab" aria-expanded="true">CRV Details</a>
            </li>
            <li role="presentation">
                <a href="#tab2" role="tab" id="progress-tab" data-bs-toggle="tab" aria-expanded="false">Print Logs</a>
            </li>
             
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab1" aria-labelledby="recent-tab">

 
            <form method="post" id="frm_validation" action="#" data-bs-toggle="validator" class="form-horizontal form-label-left">
       
                          
                <div class="row">
                    <div class="col-md-6 col-sm-12 ">
                      <label >Company </label>
                      <input type="text" readonly class="form-control rid_only" value="<?=$company->name?>"> 
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-sm-12 ">
                      <label >CRV Number </label>
                      <input type="text" readonly class="form-control rid_only" value="<?=$crv->crv_code?>"> 
                    </div>
         
                    <div class="col-md-3 col-sm-12 ">
                      <label >CRV Date </label>
                      <input type="text" readonly  class="form-control rid_only" value="<?=date('d M Y', strtotime($crv->date_created))?>">
                      <input type="hidden" name="crv_date" value="<?=date('Y-m-d', strtotime($crv->date_created))?>">
                    </div>

                    <div class="col-md-3 col-sm-12 ">
                      <label >Loged By </label>
                      <input type="text" readonly  class="form-control rid_only" value="<?=$users->name?>"> 
                    </div>

              </div> 
              <br/>
              <div class="row">  
                    <div class="col-md-3 col-sm-12 ">
                      <label >Project</label>
                       <input type="text" readonly value="<?=@$project->name ?? 'None'?>" class="form-control rid_only" >
                    </div>
                    
                    <div class="col-md-3 col-sm-12 ">
                      <label >Account Code</label>
                      <input type="text" readonly value="<?=sprintf("%05d",@$client->id)?>" class="form-control rid_only" >
                      <input type="hidden" name="client_id" value="<?=@$client->id?>" >
                    </div>

                    <div class="col-md-4 col-sm-12 ">
                      <label >Client Name</label>
                      <input type="text" name="client_name" value="<?=@$client->name?>" readonly class="form-control rid_only">
                    </div>

                    <div class="col-md-2 col-sm-12 ">
                      <label >Date</label>
                      <input type="text" readonly value="<?=date('d M Y', strtotime($crv->date_created))?>" class="form-control rid_only" >
                    </div>
     
                    <div class="col-md-6 col-sm-12 ">
                      <br/>
                      <?php if($crv->payment_mode == 2){?>
                      <div class="row" id="ptf2">  
                        <div class="col-md-6 col-sm-12 ">
                          <label >Bank Name *</label>
                          <input type="text" name="bank_name" readonly value="<?=$crv->bank_name?>" id="bank_name" class="form-control rid_only">
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                          <label >Branch</label>
                          <input type="text" name="branch" readonly value="<?=$crv->branch?>" class="form-control rid_only">
                        </div>
                      </div>
                      <br/>
                       <div class="row" id="ptf2">  
                        <div class="col-md-6 col-sm-12 ">
                          <label >Cheque Number *</label>
                          <input type="text" name="cheque_no" readonly value="<?=$crv->cheque_no?>" id="cheque_no" class="form-control rid_only">
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                          <label >Account Number *</label>
                          <input type="text" name="account_no" readonly value="<?=$crv->account_no?>" id="account_no" class="form-control rid_only">
                        </div>
                      </div>
                      <br/>
                      <?php }?>

                      <?php if($crv->payment_mode == 3){?>
                      <div class="row" id="ptf3" style="display: none;">  
                        <div class="col-md-6 col-sm-12 ">
                          <label >Debit/Credit Card</label>
                           <input type="text"   readonly value="<?=$debit_credit_type->title?>"  class="form-control rid_only">
                        </div> 
                      </div> 
                      <?php }?>

                  </div>
                </div>
              <br/> 
            </form>

          </div>
          <div role="tabpanel" class="tab-pane" id="tab2" aria-labelledby="progress-tab">
            

            <table class="table">
              <tr>
                <th>Log Date</th>
                <th>Type</th>
                <th>Copy</th>
                <th>User</th>
              </tr>
              <?php 
              if(@$usersx){
                foreach($usersx as $rs){
                  $arr_user[$rs->id] = $rs->name;
                }
              }

              if(@$print_logs){
                foreach($print_logs as $rs){
              ?>
              <tr>
                <td><?=date("M d Y H:i:s")?></td>
                <td><?=$rs->type==2 ? 'Printed' : 'Preview'?></td>
                <td><?=$rs->print_copy==1 ? 'Yes' : 'No'?></td>
                <td><?=@$arr_user[$rs->user_id]?></td>
              </tr>
              <?php }}else{?>
              <tr>
                <td colspan="4">
                  <center>
                    <p>
                      <i>No Logs Found</i>
                    </p>
                  </center>
                </td>
              </tr>
              <?php }?>
            </table>

          </div>
        </div>

      




            <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                   
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>  
     
                </div>
              </div>
              <br/> 

      </div>
    </div>
  </div>
</div> 
 
