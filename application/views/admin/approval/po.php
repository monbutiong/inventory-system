<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Approval <small>Purchase Order</small></h2> 

        <?php if(@$history){?>
          <div class="input-group-btn pull-right" style="padding-right: 80px;">
              <a class="btn btn-sm btn-warning  " href="<?php echo base_url('approval/po');?>" >Go Back</a>
          </div>
        <?php }else{?>
          <div class="input-group-btn pull-right" style="padding-right: 80px;">
              <a class="btn btn-sm btn-primary" href="<?php echo base_url('approval/po/history');?>" >View History</a>
          </div>
        <?php }?>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>
 
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date Filed</th>
              <th>Supplier Details</th>
              <th>P.O. Details</th>  
              <th>Approvals</th> 
              <th>Form Details</th> 
              <th>Item(s)</th>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$type){
              foreach($type as $rs){
              $arr_type[$rs->id] = $rs->title;
            }}

            if(@$suppliers){
              foreach($suppliers as $rs){
              $arr_supplier[$rs->id] = $rs;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_project[$rs->id] = $rs->control_number;
            }}

            if(@$po_items){
              foreach($po_items as $rs){
              @$arr_po_items[$rs->purchase_order_id]+= 1;
            }}

            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }} 

            if(@$terms_of_payment_type){
              foreach($terms_of_payment_type as $rs){
              $arr_terms_of_payment_type[$rs->id] = $rs->title;
            }}

            if(@$terms_of_delivery_type){
              foreach($terms_of_delivery_type as $rs){
              $arr_terms_of_delivery_type[$rs->id] = $rs->title;
            }}

            if(@$delivery_place){
              foreach($delivery_place as $rs){
              $arr_delivery_place[$rs->id] = $rs->title;
            }}

            function fstat_($v = ''){
              if($v == 0){
                $v = 'Pending';
              }elseif($v == 1){
                $v = 'Approved';
              }elseif($v == 2){
                $v = 'Rejected';
              }elseif($v == 3){
                $v = 'Cancel';
              }
              return $v;
            }

            function prstat_($v = ''){
              if($v == 0){
                $v = 'Pending';
              }elseif($v == 1){
                $v = 'Completed';
              }elseif($v == 2){
                $v = 'Partial P.O.';
              }elseif($v == 3){
                $v = 'Cancel';
              }
              return $v;
            }

            $myid = $this->session->user_id;
             
            if(@$po){
              foreach($po as $rs){

                if(

                      (($rs->a1_status == 0 && $rs->a1 == $myid) || 
                      ($rs->a1_status == 1 && $rs->a2_status == 0 && $rs->a2 == $myid) || 
                      ($rs->a2_status == 1 && $rs->a3_status == 0 && $rs->a3 == $myid)) 
                    ||
                      (@$history && (
                      ($rs->a1_status == 1 && $rs->a1 == $myid) || 
                      ($rs->a2_status == 1 && $rs->a2 == $myid) || 
                      ($rs->a3_status == 1 && $rs->a3 == $myid)))
                ){ 
            ?>
            <tr>
              <td>

                <?=$rs->date_created?>

              </td>
              <td nowrap="nowrap">
                <?=@$arr_supplier[$rs->supplier_id]->name?> <br/>
                <small>
                  <?=@$arr_supplier[$rs->supplier_id]->address?> <br/>
                  Tel Nos: <?=@$arr_supplier[$rs->supplier_id]->contact_number_1?> <br/>
                  Fax No: <?=@$arr_supplier[$rs->supplier_id]->fax_no?> <br/>
                  Attention: <?=@$arr_supplier[$rs->supplier_id]->po_attension_to?> <br/>
                </small>
              </td>
              <td nowrap="nowrap">
                <span class="badge bg-green"><?=$rs->po_number?></span> <br/>
                <small>
                  Terms Of Payment: <?=@$arr_terms_of_payment_type[$rs->terms_of_payment_type_id]?> <br/>
                  Terms Of Delivery: <?=@$arr_terms_of_delivery_type[$rs->terms_of_delivery_type_id]?> <br/>
                  Delivery Place: <?=@$arr_delivery_place[$rs->delivery_place_id]?> <br/>
                  Delivery Date: <?=$rs->delivery_date?> <br/>
                </small>
              </td>
              <td nowrap="nowrap">
                <?=@$arr_user[$rs->a1] ? '<small>(1st) </small>'.$arr_user[$rs->a1].': '.fstat_($rs->a1_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a2] ? '<small>(2nd) </small>'.$arr_user[$rs->a2].': '.fstat_($rs->a2_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a3] ? '<small>(3rd) </small>'.$arr_user[$rs->a3].': '.fstat_($rs->a3_status).'<br/>' : '';?>
              </td>
              <td>
                 <u><?=fstat_($rs->form_status)?></u>
                 <br/>
                 <small>
                  PR: <?=@$arr_user[$rs->requestor_id]?><br/>
                  <?=@$arr_project[$rs->project_id] ? $arr_project[$rs->project_id] : ''?> 
                 </small>
              </td> 
              <td>
                <center>
                <h3><?=@$arr_po_items[$rs->id]?></h3>
                </center>
              </td>
              
              <td nowrap="nowrap">
                <?php if(@$history){?>

                <a target="_blank" href="<?php echo base_url('vendor/print_po/'.$rs->id);?>" class="" ><i class="fa fa-print"></i> print preview </a>   
               
                <?php }else{?>

               <a target="_blank" href="<?php echo base_url('vendor/print_po/'.$rs->id);?>" class="" ><i class="fa fa-print"></i> print preview </a> |    
                
                <a href="<?php echo base_url('purchasing/po_view/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i>   manage </a> 

                <?php }?>

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

  alertify.confirm("Move Purchase Request to History?", function (e) {
        if (e) {  
            alertify.log("updating...");
            location.href = "<?php echo base_url();?>purchasing/pr_move_to_history/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

