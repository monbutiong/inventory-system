<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receiving <small>GRV Records (Unconfirmed)</small></h2> 
 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>GRV Number</th> 
              <th>P.O. Number</th>
              <th>DR Number</th>
              <th>Invoice Number</th>  
              <td>Remarks</td>  
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

            if(@$po){
              foreach($po as $rs){
              $arr_po[$rs->id] = $rs->po_number;
            }}
  
            if(@$receiving){
              foreach($receiving as $rs){
                $show_po_id = 0;
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td>GV<?=sprintf("%06d",$rs->id)?></td> 
              <td><?php

              if(json_decode($rs->po_ids)){
                foreach (json_decode($rs->po_ids) as $po_id) {
                  if(!$show_po_id){
                    $show_po_id = 1;
                    echo  @$arr_po[$po_id];
                  }else{
                    echo  ', '.@$arr_po[$po_id];
                  } 
                }
              }
              ?></td>  
              <td><?=$rs->dr_number?></td> 
              <td><?=$rs->invoice_number?></td> 
              <td><?=$rs->remarks?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>

                <a href="<?php echo base_url('receiving/view_rr/'.$rs->id.'/1');?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-check"></i> Confirm</a>
                  |  
                <a href="<?php echo base_url('receiving/view_rr/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> View</a>
                  |  
                <a href="Javascript:edit_rr(<?=$rs->id?>)" ><i class="fa fa-edit"></i> Edit</a>
                  |  
                <a target="_blank" href="<?php echo base_url('receiving/print_rr/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                
                  
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