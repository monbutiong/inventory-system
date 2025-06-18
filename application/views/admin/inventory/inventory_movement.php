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

        
        <table border="0" style="width: 50%;">
          <tr>
            <td style="padding: 10px;" nowrap><b>Item Code: </b></td>
            <td style="padding: 10px;"><?=@$inv->item_code?></td>
          </tr>
          <tr>
            <td style="padding: 10px;" valign="top"><b>Description: </b></td>
            <td style="padding: 10px;"><?=@$inv->item_name?></td>
          </tr>
          <tr>
            <td style="padding: 10px;" valign="top"><b>Stock Qunatity: </b></td>
            <td style="padding: 10px;"><div class="badge bg-success"><span style="font-size: 15px;"><?=@$inv->qty?></span></div></td>
          </tr>
          <tr>
            <td style="padding: 10px;" valign="top"><b>Log Date: </b></td>
            <td style="padding: 10px;"><?=date('d M Y H:i',strtotime(@$inv->date_created))?></td>
          </tr>
        </table>

        <hr/>

        <br/>
         
        <table id="datatable_modal" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Date</th>
              <th>Logged By</th>
              <th>Module</th> 
              <th>Unit Cost</th>  
              <th>Quantity</th>
              <th>Qty. Before</th>
              <th>Qty. After</th>   
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
                <td align="right"><?=number_format($rs->unit_cost_price,2)?></td>
                <td><?=$rs->qty?></td>
                <td><?=$rs->qty_before?></td>
                <td><?=$rs->qty_after?></td>
              </tr>
              <?php }}?>
            </tbody>
          </table>

      </div>
    </div>
  </div>
</div> 
 
 
