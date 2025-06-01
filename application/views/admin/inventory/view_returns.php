<style type="text/css">
  input, textarea{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_issuance" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>View Inventory Returns</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 120px;">
            <?php if($confirm == 1){?>
            <a id="confirm_btn" class="btn btn-sm btn-success" href="Javascript:confirm_returns(<?=$returns->id?>)">Confirm</a>
            <?php }?>
                  <button class="btn btn-sm btn-danger" type="button" data-bs-dismiss="modal">Close</button>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
             
          <div class="row">

            <div class="col-md-2 col-sm-12 ">
              <label >Return Number</label>
              <input type="text" readonly class="form-control ridonly" value="RT<?=sprintf("%06d",$returns->id);?>">
            </div>
            
             <div class="col-md-2 col-sm-12 ">
               <label >Job Order </label>   
               <input type="text" id="project"  readonly value="<?=@$jo->job_order_number?>" class="form-control ridonly"> 
               
             </div>
             

             <div class="col-md-2 col-sm-12 ">
               <label >Project</label>
               <input type="text" id="project"  readonly value="<?=$project->name?>" class="form-control ridonly"> 
             </div>

             <div class="col-md-2 col-sm-12 ">
               <label >Client</label>
               <input type="text" id="client"  readonly value="<?=$client->name?>" class="form-control ridonly"> 
             </div>

             <div class="col-md-2 col-sm-12 ">
               <label >Return Date *</label>
               <input type="varchar" name="return_date" id="return_date" readonly value="<?=date('M d, Y',strtotime($returns->return_date))?>" class="form-control">
             </div>

             <div class="col-md-2 col-sm-12 ">
               <label >Reference Number</label>
               <input type="text" name="ref_no" id="ref_no" readonly value="<?=$returns->ref_no?>" class="form-control">
             </div>

              
            <div class="col-md-8 col-sm-12 ">
              <label >Remarks </label>
              <textarea  readonly class="form-control"><?=$returns->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($returns->date_created))?>" class="form-control">
            </div>

            <?php if(@$confirm_user->name){?>
            <div class="col-md-2 col-sm-12 ">
              <label >Confirmed By</label>
              <input type="text" readonly value="<?=@$confirm_user->name.' - '.date('M d, Y',strtotime($returns->confirmed_date))?>" class="form-control">
            </div>
            <?php }?>
   
 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>#</th>
              <th>Sales Invoice No.</th>
              <th>Part No.</th> 
              <th>Description</th>   
              <th>Stock Qty</th>
              <th>Return Qty</th>
              <th>New Qty</th> 
              <th>Remarks</th> 
            </tr>
            </thead> 
            <tbody>
              <?php 
              if(@$inv){
                foreach($inv as $rs){
                $arr_inv[$rs->id] = $rs;
              }}
 
              $row_count=0;
              $selected_ids='';
              if(@$return_items){
                foreach ($return_items as $rs) {  
              ?>
              <tr id="tr<?=$rs->inventory_id?>">
                <td><?=$row_count+=1;?></td>
                <td>SO<?=sprintf("%06d",$rs->issuance_id)?></td>
                <td><?=@$arr_inv[$rs->inventory_id]->item_code?> </td>
                <td><?=@$arr_inv[$rs->inventory_id]->item_name?></td> 
                <td align="center"> <?=@$arr_inv[$rs->inventory_id]->qty?>  </td>
                <td align="center"> <?=$rs->qty?>  </td>
                <td align="center"> <?=@$arr_inv[$rs->inventory_id]->qty+$rs->qty?>  </td>
                <td> <?=$rs->remarks?> </td> 
              </tr>
              <?php 
              }}
              ?>
             
            </tbody>
          </table>
          
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function confirm_returns(){
    reset(); 

    alertify.confirm("Confirm return inventory?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?=base_url('inventory/confirm_return_iventory/'.$returns->id)?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  $('#gmodal').addClass('modal-lg-mod'); 

</script>