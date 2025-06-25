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
            <h5 class="modal-title" id="mySmallModalLabel">Lost Sale</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="row">
          <div class="col-5">  
        
              <table border="0" style="width: 100%;">
                <tr>
                  <td nowrap><b>Item Code: </b></td>
                  <td><?=@$inv->item_code?></td>
                </tr>
                <tr>
                  <td valign="top"><b>Description: </b></td>
                  <td><?=@$inv->item_name?></td>
                </tr>
                <tr>
                  <td valign="top"><b>Qunatity on Hand: </b></td>
                  <td><div class="badge bg-success"><span style="font-size: 15px;"><?=@$inv->qty?></span></div></td>
                </tr>
                <tr>
                  <td valign="top"><b>Unit Cost Price: </b></td>
                  <td> <?=@$inv->unit_cost_price ? number_format(@$inv->unit_cost_price,2) : '0.00'?> </td>
                </tr>
                <tr>
                  <td valign="top"><b>Retail Price: </b></td>
                  <td> 
                    <?=@$inv->retail_price ? number_format(@$inv->retail_price,2) : '0.00'?>
                  </td>
                </tr>
                <tr>
                  <td valign="top"><b>Log Date: </b></td>
                  <td><?=date('d M Y H:i',strtotime(@$inv->date_created))?></td>
                </tr>
                
              </table>

            </div>
            <div class="col-5"> 

                 <table border="0" style="width: 100%;">
                  <tr>
                    <td valign="top"><b>Lost Sale Qty: </b></td>
                    <td> 
                        <input type="number" name="lost_sale_qty" id="lost_sale_qty" required class="form-control" > 
                    </td> 
                  </tr>
                  <tr>
                    <td valign="top"><b>Plate No: </b></td>
                    <td> 
                        <input type="text" name="lost_plate_no" id="lost_plate_no" class="form-control" > 
                    </td> 
                  </tr>
                  <tr>
                    <td valign="top"><b>VIN: </b></td>
                    <td> 
                        <input type="text" name="lost_vin" id="lost_vin" class="form-control" > 
                    </td> 
                  </tr>
                  <tr>
                    <td valign="top"><b>Remarks: </b></td>
                    <td> 
                        <input required type="text" name="lost_remarks" id="lost_remarks" class="form-control" > 
                    </td> 
                  </tr>

                  <tr>
                    <td align="right" colspan="2"> <button id="save_lost_sale" class="btn btn-primary">Save</button></td>
                  </tr>
                </table>

            </div>
            <div class="col-2" align="right">

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
              <th align="right" style="text-align: right;">Quantity</th> 
              <th >Plate No.</th>  
              <th >VIN</th>  
              <th >Remarks</th> 
              <th ></th>   
            </tr>
            </thead> 
            <tbody>
              <?php 
              if(@$users){
                foreach ($users as $rs) {
                  $arr_user[$rs->id] = $rs->name;
                }
              }
 

              if(@$lost_sale){
                foreach ($lost_sale as $rs) { 
              ?>
              <tr id="trx<?=$rs->id?>">
                <td><?=date('d M, Y H:i', strtotime($rs->date_created))?></td>
                <td><?=@$arr_user[$rs->user_id]?></td> 
                <td align="right"><?=$rs->qty?></td> 
                <td><?=$rs->plate_no?></td>
                <td><?=$rs->vin?></td>
                <td><?=$rs->remarks?></td>
                <td>
                  <a href="javascript:prompt_delete('Delete', 'Delete selected lost sale?', '<?=base_url('inventory/delete_lost_sale/' . $rs->id)?>', 'trx<?=$rs->id?>')" style="color:red;">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php }}?>
            </tbody>
          </table>

      </div>
    </div>
  </div>
</div> 

 
 
 
<script>
$(document).ready(function() {
  // Initialize DataTable (store globally if needed) 

  $('#save_lost_sale').on('click', function(e) {
    e.preventDefault();

    // Get values
    var qty = $('#lost_sale_qty').val();
    var plate_no = $('#lost_plate_no').val();
    var vin = $('#lost_vin').val();
    var remarks = $('#lost_remarks').val();

    // Simple validation
    if (!qty) {
       
      Swal.fire({
      title: "Error!",
      html: 'Quantity is required.',
      icon: "error",
      confirmButtonColor: "#556ee6", // OK button color
      showCancelButton: false // No Cancel button
      });

      return;
    }

    // Example POST data
    $.post('<?=base_url('inventory/save_lost_sale/'.$inv->id);?>', {
      qty: qty,
      plate_no: plate_no,
      vin: vin,
      remarks: remarks
    }, function(idx) {
      // Simulate values (replace with response data)
      var now = new Date();

      var formattedDate = now.toLocaleString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      }).replace(',', ''); // remove comma if needed
 

      var loggedBy = 'You'; // Replace with actual logged-in user
      // response = {qty:..., plate_no:..., etc...} from backend ideally

      // Prepend to DataTable
      var newRow = dt.row.add([
        formattedDate,
        loggedBy,
        qty,
        plate_no,
        vin,
        remarks,
        `<a href="javascript:prompt_delete('Delete', 'Delete selected lost sale?', '<?=base_url('inventory/delete_lost_sale')?>/${idx}', 'trx${idx}')" style="color:red;">
                    <i class="fa fa-trash"></i>
                  </a>`
      ]).draw(false).node();

      $(newRow).attr('id', 'trx' + idx);

      Swal.fire({
      title: "Success!",
      html: "Lost Sale Added",
      icon: "success",
      confirmButtonColor: "#556ee6", // OK button color
      showCancelButton: false // No Cancel button
      });

      // Optionally clear inputs
      $('#lost_sale_qty, #lost_plate_no, #lost_vin, #lost_remarks').val('');
    });
  });
});
</script>
