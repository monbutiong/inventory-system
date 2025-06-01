<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Accounts <small>Accounts Payable</small></h2> 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date Received</th> 
              <th>P.O. Details</th>    
              <th>Receiving Report</th>   
              <th>Amount</th> 
              <th>Status</th>
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}
 
            if(@$suppliers){
              foreach($suppliers as $rs){
              $arr_supplier[$rs->id] = $rs;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_project[$rs->id] = $rs->name;
            }}
 
            if(@$accounts_payable){
              foreach ($accounts_payable as $rs) {
                @$arr_ap_ttl[$rs->receiving_report_id]+=round($rs->amount,2);
            }} 

            if(@$po){
              foreach ($po as $rs) {
                @$arr_po[$rs->id]=$rs->po_number;
                @$arr_po_terms_of_payment[$rs->id]=$rs->terms_of_payment_type_id;
            }} 

            if(@$terms_of_payment_type){
              foreach($terms_of_payment_type as $rs){
                @$arr_top[$rs->id]=$rs->cod;
              }
            }

            if(@$rr_items){
              foreach ($rr_items as $rs) {
                 @$arr_rr[$rs->receiving_report_id]+=round(($rs->qty * $rs->price),2);
              }
            }

            if(@$rr){
              foreach($rr as $rs){
                if(@$arr_top[@$arr_po[$rs->id]->terms_of_payment_type_id] == 0){
            ?>
            <tr>
              <td><?=date('Y-m-d H:i', strtotime(@$rs->date_created))?></td>
              <td>
                P.O. Number: <a style="text-decoration: underline;" target="_blank" href="<?php echo base_url('vendor/print_po/'.$rs->purchase_order_id);?>" class="" ><?=@$arr_po[$rs->purchase_order_id]?></a><br/>
                <i><?=$rs->tax_type==1 ? 'Vatable sales' : 'Non-vat sales' ?></i><br/>
                Supplier: <?=@$arr_supplier[$rs->supplier_id]->name?><br/> 
                Project: <?=@$arr_project[$rs->project_id]?>
              </td>
              <td>
                Invoice Number: <a style="text-decoration: underline;" target="_blank" href="<?php echo base_url('receiving/rr_print/'.$rs->id.'/'.strtotime($rs->date_created));?>" class="" ><?=$rs->invoice_number?></a><br/>
                DR Number: <?=$rs->dr_number?><br/>
                RR Number: <?=$rs->rr_number?><br/>
                <?php
                  $now = time(); // or your date as well
                  $your_date = strtotime($rs->due_date);
                  $datediff = $your_date - $now;

                  $days = round($datediff / (60 * 60 * 24));
                ?>
                Due Date: 
                <?php if(@$arr_rr[$rs->id]==@$arr_ap_ttl[$rs->id]){?>
                  <?php echo date('M d, Y', strtotime($rs->due_date));?>
                <?php }else{?>  
                  <span class="badge bg-<?=($days>0) ? 'green' : 'red'?>"><?=date('M d, Y', strtotime($rs->due_date))?> (<?=@$days ?> Days)</span>
                <?php }?>
              </td>
              <td align="right"> 
                <table border="0" width="100%">
                  <tr>
                    <td>Received Amount:</td>
                    <td align="right"><?=number_format(@$arr_rr[$rs->id],2) ?></td>
                  </tr>
                  <tr>
                    <td>Payment:</td>
                    <td align="right"><?=number_format(@$arr_ap_ttl[$rs->id],2)?></td>
                  </tr>
                  <tr>
                    <td><b>Total Balance</b></td>
                    <td align="right"><b><?=number_format($bal = (@$arr_rr[$rs->id]-@$arr_ap_ttl[$rs->id]))?></b></td>
                  </tr>
                </table>
              </td>
              <td><?=($bal == 0) ? 'Complete' : 'Unpaid'?></td>
              <td>
               
                  <a href="<?php echo base_url('accounts/manage_payable/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Manage </a>
               

              </td>
            </tr>
            <?php }}}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
function move_to_history(id){
  reset(); 

  alertify.confirm("Move P.O. Details to history?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>receiving/move_to_history/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

