<?php 
if(@$users){
  foreach($users as $rs){
  $arr_user[$rs->id] = $rs->name;
}}

if(@$accounts){
  foreach($accounts as $rs){
  $arr_account[$rs->id] = $rs->title;
}}

if(@$uom_type){
  foreach($uom_type as $rs){
  $arr_uom_type[$rs->id] = $rs->title;
}}

if(@$projects){
  foreach($projects as $rs){
  $arr_project[$rs->id] = $rs;
}}

if(@$projects_control_number){
  foreach($projects_control_number as $rs){
  $arr_cn[$rs->id] = $rs->control_number;
}}
 
if(@$items){
  foreach($items as $rs){
  $arr_item[$rs->id] = $rs;
}}
?>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase Request<small>Revised P.R. / P.O.</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" name="pr_form" action="<?php echo base_url('pr/save_revised_po/'.$pr->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
          
                <label for="remarks">Requestor </label> 
                <input type="text" disabled value="<?php echo @$arr_user[@$pr->user_id]?>" class="form-control"/> 

              </div>

              <div class="col-md-4">
          
                <label for="remarks">PR Number </label> 
                <input type="text" disabled value="<?php echo @$pr->pr_number; if(@$pr->rev>0){echo ' (rev '.@$pr->rev.')';}?>" class="form-control"/> 

              </div>

              <div class="col-md-4">
          
                <label for="remarks">Date File </label> 
                <input type="text" disabled value="<?php echo date('M d, Y H:i', strtotime(@$pr->date_created))?>" class="form-control"/> 

              </div>
              <!-- <div class="col-md-4">

                <label for="request_type_id">Request Type </label> 
                <input type="text" disabled value="<?php echo @$arr_type[@$pr->request_type_id]?>" class="form-control"/>

              </div> -->

              <?php if($pr->control_number_type == 1){?>

                <div class="col-md-4">

                  <label for="request_type_id">Accounts</label> 
                  <input type="text" disabled value="<?php echo @$pr->inventory_accounts_id ? @$arr_account[@$pr->inventory_accounts_id] : '-'?>" class="form-control"/>

                </div>

                <div class="col-md-4">

                  <label for="request_type_id">Purchasing Control Number </label> 
                  <input type="text" disabled value="<?php echo @$pr->pur_control_number?>" class="form-control"/>

                </div>

              <?php }else{?>  
              <div class="col-md-4">

                <label for="request_type_id">Project Name</label> 
                <input type="text" disabled value="<?php echo @$pr->project_id ? @$arr_project[@$pr->project_id]->name : 'new stock'?>" class="form-control"/>

              </div>

              <div class="col-md-4">

                <label for="request_type_id">Control Number </label> 
                <input type="text" disabled value="<?php echo @$pr->project_id ? @$arr_project[@$pr->project_id]->control_number : 'new stock'?>" class="form-control"/>

              </div>

              <?php }?>

              <div class="col-md-4">
         
                <label for="remarks">Remaks </label> 
                <input type="text" disabled value="<?php echo @$pr->remarks?>" class="form-control"/>

            </div>
          </div>
          
         </div>

          <div class="form-group">

            <label for="last-name">Request Item(s)
            </label> 

            <table id="item_table" class="table table-striped table-bordered table-hover">
              <tr>
                <th align="center"><center>Discount</center></th> 
                <th>Item Code</th> 
                <th>Item Name</th> 
                <th>Item Description</th> 
                <th align="center"><center>Request Qty.</center></th>
                <!-- <th align="center"><center>Control Number</center></th> -->
                <?php if(@$purchasing == 1){?>
                <th align="center"><center>P.O. Number</center></th>
                <th align="center"><center>P.O. Qty</center></th> 
                <th align="center"><center>P.O. Price</center></th>
                
                <th align="center"><center>Total</center></th>
                <?php }?>
              </tr>
              <?php 
              if(@$po_item){
              foreach($po_item as $rs){
                $arr_po[$rs->purchase_request_items_id] = $rs;
              }}

              if(@$po){
              foreach($po as $rs){ 
                $arr_po_num[$rs->id] = $rs->po_number;
              }}

              if(@$suppliers){
              foreach($suppliers as $rs){
                $arr_supplier[$rs->id] = $rs->name;
              }}

              if(@$pr->rev>0){
                $pr_rev = $this->db->get_where('purchase_request_items',[
                  'purchase_request_id'=>$pr->id,
                  'rev'=>($pr->rev-1)
                ])->result();
              }

              if(@$pr_item){
              foreach($pr_item as $rs){
           
              ?>
              <tr <?php if($rs->cancel){?>style="color: red;"<?php }?>>
                <td> 
                  <input type="text" name="discount<?=$rs->id?>" value="" style="border: 0px; text-align: center; width: 65px;">  
                </td>   

                <td><?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->item_code : $rs->item_details.' <span class="badge badge bg-green">new</span>'?> </td> 


                <td>
                  <input type="text" id="item_name<?=$rs->id?>" name="item_name<?=$rs->id?>" style="width: 100%; border: 0px;" placeholder="Insert item name" value="<?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->name : $rs->item_name?>">
                </td>

                <td>
                  <input type="text" id="item_desc<?=$rs->id?>" name="item_desc<?=$rs->id?>" style="width: 100%; border: 0px;" placeholder="Insert item description" value="<?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->short_description : $rs->item_desc?>">
                </td>
 
                <td><?=($rs->qty+0).' '.(@$arr_item[$rs->inventory_id]->uom_type_id ? @$arr_uom_type[$arr_item[$rs->inventory_id]->uom_type_id] : 'pcs')?></td> 
                
                <!-- <td><?=@$arr_cn[$rs->control_number_id]?></td> -->
                
                <?php if(@$purchasing == 1){?>
                <td>
                  <?php $newpo=''; if(@$arr_po_num[@$arr_po[$rs->id]->purchase_order_id]){?>
                    <?=@$arr_po_num[@$arr_po[$rs->id]->purchase_order_id]?>
                    <input type="hidden" name="po<?=$rs->id?>" value="<?=@$arr_po[$rs->id]->purchase_order_id?>">
                  <?php }else{ $newpo=1;?>  
                    <select name="po<?=$rs->id?>" class="select2_" style="border: 0px; text-align: center; width: 165px;">
                      <option value="">select P.O.</option>
                      <?php if(@$po){
                        foreach ($po as $rsp) { ?>
                      <option value="<?=$rsp->id?>"><?=$rsp->po_number?></option>
                    <?php }}?>
                    </select>
                  <?php }?>

                </td>
                    
                <td>
        
                  <input type="number" name="qty<?=$rs->id?>" value="<?=$qty = @$arr_po[$rs->id]->qty + 0?>" style="border: 0px; text-align: center; width: 65px;"> 

                  <?php if(!$newpo){?>
                    <?=@$arr_uom_type[@$arr_po[$rs->id]->uom_conversion_id]?>
                  <?php }else{?>
                    <select id="uom<?=$rs->id?>" name="uom<?=$rs->id?>" style="border: 0px; text-align: center;" onchange="compute()">  
                      <?php 
                      if(@$uom_conversions){
                        foreach($uom_conversions as $rs_uc){
                          if(!@$arr_item[$rs->inventory_id]->uom_type_id || $rs_uc->conversion_uom_id == @$arr_item[$rs->inventory_id]->uom_type_id){
                      ?>
                      <option value="<?=$rs_uc->id?>"><?=@$arr_uom_type[$rs_uc->base_uom_id]?> (<?=($rs_uc->factor + 0).' '.@$arr_uom_type[$rs_uc->conversion_uom_id]?>)</option>
                      <?php }}}?>
                    </select>
                  <?php }?>
                </td>  
                <td> 
                  <input type="text" name="price<?=$rs->id?>" value="<?=@$arr_po[$rs->id]->price ? round($arr_po[$rs->id]->price,2) : ''?>" style="border: 0px; text-align: center; width: 65px;">  
                </td>

                

                <td align="right"><span id="sub_total<?=$rs->id?>">
                  <?=number_format(@$total+=round($qty * ($arr_po[$rs->id]->price ? $arr_po[$rs->id]->price : 0), 2),2)?></span></td>
                <?php }?>

              </tr>
              <?php }}?>

              <?php if(@$purchasing == 1){?>
              <tr>
                <td colspan="8" align="right"><strong>Total : </strong></td>
                <td align="right"><strong id="total"><?=number_format(@$total,2)?></strong></td>
              </tr>
              <?php }?>
            </table>
          </div>


          <?php 
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

          if(@$users){
            foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
          }}
          ?>
          
          <div class="row">
            <center>
            <?php if(@$arr_user[$pr->a1]){ if($pr->a1_status==0){$app=$pr->a1; $appc=1;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">1st Approver</label> 
                <p><strong><?=fstat_($pr->a1_status);?></strong></p>
                <p><i><?=$pr->a1_date ? date('M d Y H:i',strtotime($pr->a1_date)) : '--/--/----';?></i></p>
                <p><u><?=@$arr_user[$pr->a1]?></u></p> 
              </center>
            </div>
            <?php $max = 1; }?>
            <?php if(@$arr_user[$pr->a2]){ if(!@$app && $pr->a2_status==0){$app=$pr->a2; $appc=2;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">2nd Approver</label> 
                <p><strong><?=fstat_($pr->a2_status);?></strong></p>
                <p><i><?=$pr->a2_date ? date('M d Y H:i',strtotime($pr->a2_date)) : '--/--/----';?></i></p>
                <p><u><?=@$arr_user[$pr->a2]?></u></p> 
              </center>
            </div>
            <?php $max = 2; }?>
            <?php if(@$arr_user[$pr->a3]){ if(!@$app && $pr->a3_status==0){$app=$pr->a3; $appc=3;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">3rd Approver</label>
                <p><strong><?=fstat_($pr->a3_status);?></strong></p>
                <p><i><?=$pr->a3_date ? date('M d Y H:i',strtotime($pr->a3_date)) : '--/--/----';?></i></p> 
                <p><u><?=@$arr_user[$pr->a3]?></u></p> 
              </center>
            </div>
            <?php $max = 3; }?>
             </center>
          </div>
  
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="pull-right">
 
                <a class="btn btn-success" href="javascript:savex()">Save Purchase Order (rev +1)</a>
          
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
  function savex(){
    reset(); 

    alertify.confirm("Save P.O. Changes?", function (e) {
          if (e) {  
              alertify.log("saving...");
              document.pr_form.submit();
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function approve(){
    reset(); 

    alertify.confirm("Approve PR?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?php echo base_url();?>approval/pr_update/<?=$pr->id?>/1/<?=@$appc?>/<?=@$max?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function reject(){
    reset(); 

    alertify.confirm("Reject PR?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?php echo base_url();?>approval/pr_update/<?=$pr->id?>/2/<?=@$appc?>//<?=@$max?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  $('#gmodal').addClass('modal-lg-mod'); 
</script>