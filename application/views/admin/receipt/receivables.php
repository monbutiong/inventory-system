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
        <h2>Receipt<small>Payment Records</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('sales/savea/'.@$project->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
  
       
            <div class="row">
              
      
              <?php if(@$project->id){?>
              <div class="col-md-3 col-sm-12 ">
                <label >Quotation</label>
                <input type="text" id="quotation" value="<?=@$quotation->quotation_number?>" readonly class="form-control ridonly"> 
              </div>

              <div class="col-md-3 col-sm-12 ">
                <label >Project</label>
                <input type="text" id="project" value="<?=@$project->name?>" readonly class="form-control ridonly"> 
              </div>
              <?php }?>

              <div class="col-md-3 col-sm-12 ">
                <label >Client Code</label>
                <input type="text" id="client" value="<?=@$client->code?>" readonly class="form-control ridonly"> 
              </div> 

              <div class="col-md-3 col-sm-12 ">
                <label >Client</label>
                <input type="text" id="client" value="<?=@$client->name?>" readonly class="form-control ridonly"> 
              </div> 

            </div>
      
          <br/>

          <table class="table table-striped table-bordered table-hover">
            <tr> 
              <th>Date</th>
              <th>CRV Code</th>
              <th>Description</th>
              <th width="10%">Debit</th>
              <th width="10%">Credit</th> 
            </tr>
            <?php 
            $debit = 0;
            if(@$project->id){
            $pr = $this->db->get_where('quotations',['confirmed'=>1,'project_id'=>@$project->id])->row();
            ?>
            <tr>
              <td></td>
              <td></td>
              <td><?=@$project->name?></td>
              <td align="right"><?=number_format(@$pr->quotation_amount ?? 0,2); $debit=(@$pr->quotation_amount ?? 0)?></td>
              <td></td>
            </tr>
            <?php }
            
            $pm[1] = 'Cash';
            $pm[2] = 'Cheque';
            $pm[3] = 'Credit Card';
            $pm[4] = 'Transfer';

            $credit = 0;

            if($crv){
              foreach($crv as $rs){?>
            <tr>
              <td><?=date('d M Y',strtotime($rs->date_created))?></td>
              <td><?=$rs->crv_code?></td>
              <td><?=@$pm[$rs->payment_mode]?></td>
              <td></td>
              <td align="right"><?=number_format($rs->amount_received,2); $credit+=$rs->amount_received?></td>
            </tr>
            <?php }}?>
            <tr> 
              <td colspan="3" align="right"><b>Total: </b></td>
              <td align="right"><?=number_format($debit,2)?></td>
              <td align="right"><?=number_format($credit,2)?></td>
            </tr>
            <tr>
              <td colspan="3" align="right"><b>Balance: </b></td>
              <td colspan="2" align="right"><?=number_format($credit-$debit,2)?></td>
            </tr>
          </table>  
  
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>  
 
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
