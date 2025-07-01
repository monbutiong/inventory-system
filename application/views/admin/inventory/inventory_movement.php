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
        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">Inventory Movement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">

        
        <div class="row">
          <div class="col-6">  

              <table border="0" style="width: 100%;">
                <tr>
                  <td style="padding: 10px;" nowrap><b>Item Code: </b></td>
                  <td style="padding: 10px;"><?=@$inv->item_code?></td>
                </tr>
                <tr>
                  <td style="padding: 10px;" valign="top"><b>Description: </b></td>
                  <td style="padding: 10px;"><?=@$inv->item_name?></td>
                </tr>
                <tr>
                  <td style="padding: 10px;" valign="top"><b>Qunatity on Hand: </b></td>
                  <td style="padding: 10px;"><div class="badge bg-success"><span style="font-size: 15px;"><?=@$inv->qty?></span></div></td>
                </tr>
                <tr>
                  <td style="padding: 10px;" valign="top"><b>Log Date: </b></td>
                  <td style="padding: 10px;"><?=date('d M Y H:i',strtotime(@$inv->date_created))?></td>
                </tr>
                <tr>
                  <td style="padding: 10px;" valign="top"><b>Transaction: </b></td>
                  <td style="padding: 10px;">
                    <select name="transaction_type" id="transaction_type" onchange="updateDtatable()" class="form-control">
                      <option value="">All</option>
                      <option>receiving</option>
                      <option>sales order</option>
                      <option>returns</option>
                      <option>adjustment</option>
                    </select>
                  </td>
                </tr>
              </table>

            </div>
            <div class="col-6" align="right">

              <img src="<?=$inv->picture_1 ? base_url('assets/uploads/inventory/' . $inv->picture_1) : base_url('assets/images/no-image.png');?>" style="width:140px; height:140px; object-fit:cover; border-radius:4px;" />

            </div>
          </div>

        <hr/>

        <br/>
         
        <table id="datatable_modal" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Date</th>
              <th>Logged By</th>
              <th>Module</th>
              <th>Transaction #</th> 
              <!-- <th>Unit Cost</th>   -->
              <th align="right" style="text-align: right;">Quantity</th>
              <!-- <th>Qty. Before</th> -->
              <th align="right" style="text-align: right;">Qty. After</th>   
            </tr>
            </thead> 
            <tbody>
              <?php 
              if(@$users){
                foreach ($users as $rs) {
                  $arr_user[$rs->id] = $rs->name;
                }
              }
 

              if(@$mv){
                foreach ($mv as $rs) { 
              ?>
              <tr>
                <td><?=date('M d, Y H:i', strtotime($rs->date_created))?></td>
                <td><?=@$arr_user[$rs->user_id]?></td>
                <td><?=$rs->movement_from?></td> 
                <td>
                  <?php 
                  $tran_link = '';
                  if($rs->movement_from == 'receiving'){
                    $tran_link = base_url('receiving/print_rr/'.$rs->ref_id);
                    $ref_number = 'GV'.sprintf("%06d",$rs->ref_id);
                  }elseif($rs->movement_from == 'sales order'){
                    $tran_link = base_url('outgoing//print_issuance/'.$rs->ref_id.'?with_partnumber=1');
                    $ref_number = 'SO'.sprintf("%06d",$rs->ref_id);
                  }elseif($rs->movement_from == 'returns'){
                    $tran_link = base_url('inventory/print_returns/'.$rs->ref_id);
                    $ref_number = 'IR'.sprintf("%06d",$rs->ref_id);
                  }elseif($rs->movement_from == 'adjustment'){
                    $tran_link = base_url('inventory/print_adjustments/'.$rs->ref_id);
                    $ref_number = 'SA'.sprintf("%06d",$rs->ref_id);
                  }

                  if($tran_link){
                  ?>
                  <a target="_blank" href="<?=$tran_link?>"><i class="fa fa-print"></i> #<?=$ref_number?></a><?php }?>
                </td>
                <!-- <td align="right"><?=number_format($rs->unit_cost_price,2)?></td> -->
                <td align="right">
                <?php if($rs->addition == 1){?>
                  <font style="color: green;">+<?=$rs->qty?></font>
                <?php }else{?>
                  <font style="color: red;">-<?=$rs->qty?></font>
                <?php }?>
                    
                </td>
                <!-- <td><?=$rs->qty_before?></td> -->
                <td align="right"><?=$rs->qty_after?></td>
              </tr>
              <?php }}?>
            </tbody>
          </table>

      </div>
    </div>
  </div>
</div> 

 
 
 
