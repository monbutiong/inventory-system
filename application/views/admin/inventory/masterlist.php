<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>Masterlist</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('inventory/add_inventory');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Item</a>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>
 
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Item Code</th>
              <th>Desription</th>
              <th>Qty</th> 
              <th>Unit Cost price</th> 
              <th>Manufacturer price</th>      
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php  
            if(@$inventory){
              foreach($inventory as $rs){
            ?>
            <tr>
              <td><?=$rs->item_code?></td>
              <td><?=$rs->item_name?></td>
              <td><?=$rs->qty?> </td>
              <td align="right"><?=number_format($rs->unit_cost_price,2)?> </td> 
              <td align="right"><?=$rs->manufacturer_price>0 ? number_format($rs->manufacturer_price,2) : '0.00'?> </td> 
              <td nowrap>
                
                <!-- <a href="<?php echo base_url('inventory/view_inventory/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i> view</a>
                 |  -->
                <a href="<?php echo base_url('inventory/edit_inventory/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="Javascript:delete_bib(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                 | 
                <a href="<?php echo base_url('inventory/inventory_movement/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> movement</a>
                  
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
function delete_bib(id){

  reset(); 

  alertify.confirm("delete inventory information? this will permanently delete selected inventory records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>sales/delete_item/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

