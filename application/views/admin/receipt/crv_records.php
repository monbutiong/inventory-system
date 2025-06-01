<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receipt <small>CRV Records</small></h2> 
 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>Company</th>
              <th>CRV Number</th>
              <th>Project</th>
              <th>Account Code</th>
              <th>Name</th>  
              <td>Mode of Payment</td>   
              <td>Received Amount</td> 
              <td>Created By</td>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$project){
              foreach($project as $rs){
              $arr_pro[$rs->id] = $rs;
            }}

            if(@$client){
              foreach($client as $rs){
              $arr_client[$rs->id] = $rs;
            }} 

            if(@$company){
              foreach($company as $rs){
                $arr_company[$rs->id] = $rs->name;
              }
            }

            $pm[1] = 'Cash';
            $pm[2] = 'Cheque';
            $pm[3] = 'Credit Card';
            $pm[4] = 'Transfer';
  
            if(@$crv){
              foreach($crv as $rs){
                $show_po_id = 0;
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td><?=@$arr_company[$rs->company]?></td>
              <td><?=$rs->crv_code?></td> 
              <td><?=@$arr_pro[$rs->project_id]->name?></td> 
              <td><?=@$arr_client[$rs->client_id]->code?></td> 
              <td><?=@$arr_client[$rs->client_id]->name?></td>  
              <td><?=@$pm[$rs->payment_mode]?></td>
              <td align="right"><?=number_format($rs->amount_received,2)?></td>
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>

                
                <a href="<?php echo base_url('receipt/view_crv/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> View</a> 
                  |  
                <a target="_blank" href="<?php echo base_url('receipt_print/print_receipt/'.$rs->id.'/'.$rs->crv_code);?>" ><i class="fa fa-print"></i> Print Receipt</a> 
                  |  
                <a target="_blank" href="<?php echo base_url('receipt_print/print_receipt/'.$rs->id.'/'.$rs->crv_code.'/1');?>" ><i class="fa fa-print"></i> Print Copy</a> 
                  
              </td>
            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
function delete_po(id){
  reset(); 

  alertify.confirm("Confirm Deletion of Purchase Order Information? This Action Will Permanently Remove the Selected P.O. Records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>purchasing/delete_po/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function edit_rr(id){
  reset(); 

  alertify.confirm("Edit Receiving Records?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url('receiving/edit_rr');?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}


</script>