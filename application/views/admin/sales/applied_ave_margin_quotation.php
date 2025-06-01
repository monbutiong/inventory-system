<style type="text/css">
  input {
    border: 0;
  }
</style>
<form method="post" id="frm_lc" name="frm_lc">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Quotation <small>Applied Average Margin - Items List</small></h2> 

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        <style type="text/css">
          input {
            border: 0;
          }
        </style>
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <?php 

          if($suppliers){
            foreach ($suppliers as $rs) {
              $arr_supp[$rs->id] = $rs->name;
            }
          }

          if(@$qitems){
            foreach ($qitems as $rs) {
              $items[$rs->quotation_location_id][] = $rs;
            }
          }

          if($qlocations){
            foreach ($qlocations as $lrs) {
              $arr_loc[$lrs->id] = $lrs;
          }}

          if(@$qlocations){
            foreach ($qlocations as $rs) {
            	if(@$items[$rs->id]){
          ?>
            <tr style="font-size: 12px; background: #ccc;">
              <th colspan="7"><?=$rs->location_name?></th>   
            </tr>

            <tr>
              <td>Location</td>
              <td>Brand/Supplier</td>
              <td>Part Number</td>
              <td>Description</td>
              <td>Quantity</td>
              <td>FOB</td>
              <td>Margin</td>
            </tr>

            <?php 

            if(@$items[$rs->id]){
              foreach ($items[$rs->id] as $rsi) { 
            ?>
            <tr>
              <td><?=@$arr_loc[$rsi->quotation_location_id]->location_name;?></td>
              <td><?=@$arr_supp[$rsi->supplier]?></td>
              <td><?=$rsi->item_code?></td>
              <td><?=$rsi->item_name?></td>
              <td align="right"><?=$rsi->qty?></td>
              <td align="right"><?=number_format($rsi->unit_cost,2)?></td>
              <td align="right" width="100"><input type="hidden" name="" value="<?=$rsi->margin?>" style="width: 100%"><?=$rsi->margin?>%</td>
            </tr>
            <?php }}?> 
            <?php }}}?> 
            <?php if(!@$items){?>
            <tr>
            	<td colspan="7"><center><i>No Records Found</i></center></td>
            </tr>
        	<?php }?>
        </table>
 
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
             
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> 
              
             
          </div>
        </div>
    

      </div>
    </div>
  </div>  
</div>
</form>

<script type="text/javascript">
function save_lc(){
  reset(); 

  alertify.confirm("Save changes?", function (e) {
        if (e) {  
            alertify.success("saving...");

            var formData = $('#frm_lc').serialize(); // Serialize the form data

            console.log('formData',formData);

             $.post("<?=base_url('sales/update_lc/'.$qid)?>", formData, function(responseData) {
                
               console.log("Response from the API:", responseData);

             }, "json")
             .done(function() {

              <?php if(@$edit){?>
                location.href = "<?=base_url('sales/edit_quotation/'.$qid)?>";
              <?php }else{?>
              $('#load_quote_final').load('<?=base_url("sales/load_quotation_final/".$qid)?>', function (){
                  $('#global_modal').modal('hide');
              });
              <?php }?>
               
               console.log("Request successful");
             })
             .fail(function() {
               // This is called when the request fails
               console.log("Request failed");
             });
             
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

