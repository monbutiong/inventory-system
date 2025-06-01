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
        <h2>Sales <small>Financial Charges</small></h2> 
        <?php if(!@$view){?>
        <div class="input-group-btn pull-right" style="padding-right: 100px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('sales/add_financial_charges');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New</a>
            </div>
           <?php }?>
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
           
          <thead>
            <tr style="font-size: 12px;">
     
              <th>Name</th> 
              <th>Description</th> 
              <!-- <th>Amount</th>   -->       
              <th>Options</th> 
            </tr>
            </thead> 
            <tbody>
            <?php  
            if(@$qothers){
              foreach($qothers as $rs){
            ?>
            <tr> 
              <td data-order="-<?=$rs->id?>"><?=$rs->title?></td> 
              <td><?=$rs->ds?></td> 
              <!-- <td align="right"><?=number_format($rs->amount ?? 0,2)?></td>     -->
              <td> 
                <a href="<?php echo base_url('sales/edit_financial_charges/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="Javascript:delete_fc(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a> 
              </td> 
            </tr>
            <?php }}?>
           </tbody>

        </table>

      

      </div>
    </div>
  </div>  
</div>
</form>

<script type="text/javascript">
function delete_fc(id){
  reset(); 

  alertify.confirm("Delete Financial Charges information? this will permanently delete selected financial charges records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>sales/delete_financial_charges/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

