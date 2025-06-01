<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchasing <small>Confirmed Purchase Order</small></h2> 
 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
              <td>Project</td>
              <td>Quotation</td>
              <th>P.O. Number</th>
              <th>Supplier</th>
              <th>Att. To</th>  
              <th>Reference No.</th>  
              <td>Created By</td>  
              <th>Date Confirmed</th>
              <td>Confirmed By</td>      
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$quotations){
              foreach($quotations as $rs){
                $arr_q[$rs->id] = $rs->quotation_number;
            }}

            if(@$projects){
              foreach($projects as $rs){
                $arr_p[$rs->id] = $rs->name;
            }}

            if(@$suppliers){
              foreach($suppliers as $rs){
                $arr_s[$rs->id] = $rs->name;
            }}

            if(@$purchase_order){
              foreach($purchase_order as $rs){
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td>
              <td><?=@$arr_p[$rs->project_id] ?? '<i>N/A</i>'?></td>
              <td><?=@$arr_q[$rs->quotation_id] ?? '<i>N/A</i>'?></td>
              <td><?=@$rs->po_number?></td>
              <td><?=@$arr_s[$rs->supplier_id] ?? '<i>Error Supplier Not Found!</i>'?></td> 
              <td><?=$rs->att_to?></td>  
              <td><?=$rs->reference_no ?? '<i>N/A</i>'?></td> 
              <td><?=@$arr_user[$rs->user_id] ?? '<i>Error User Not Found!</i>'?></td>
              <td><?=date('M d, Y',strtotime($rs->date_confirmed))?></td>
              <td><?=@$arr_user[$rs->confirmed_by] ?? '<i>Error User Not Found!</i>'?></td>
              <td nowrap>
               
                <a target="_blank" href="<?php echo base_url('vendor/print_po/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                <!--  |  
                <a href="Javascript:delete_po(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                   -->
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

function revised(id){
  reset(); 

  alertify.confirm("Confirm the Revision of the Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url();?>sales/revise_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirmq(id){
  reset(); 

  alertify.confirm("Confirm Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>sales/confirm_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>