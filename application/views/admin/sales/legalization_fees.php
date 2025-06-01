<style type="text/css">
  input {
    border: 0;
  }
</style>
<form method="post" id="frm_lp" name="frm_lp">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales <small>Legalization Fees</small></h2> 

        <?php if(!@$view){?>
        <!-- <div class="input-group-btn pull-right" style="padding-right: 100px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('sales/add_legal_fees');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New</a>
            </div> -->
          <?php }?> 
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
     
              <th>Invoice Value in QAR</th> 
              <th>Fees</th>     
              <?php if(!@$view){?><th>Options</th><?php }?>
            </tr>
            </thead> 
            <tbody>
            <?php 
  

            if(@$legalization_fees){
              foreach($legalization_fees as $rs){
            ?>
            <tr> 
              <?php if($qid && @$quotation->confirmed==0){?>
                <?php if($rs->percent_of_invoice_val  == 1){?>
                  <td><input type="number" name="amount_from<?=$rs->id?>" value="<?=$rs->amount_from?>"> to <input type="text" name="amount_to<?=$rs->id?>" value="<?=$rs->amount_to?>"/></td>
                  <td><input type="number" name="fees<?=$rs->id?>" value="<?=$rs->fees;?>"> % of Invoice value</td>  
                <?php }else{?> 
                  <td><input type="number" name="amount_from<?=$rs->id?>" value="<?=$rs->amount_from?>"> to <input type="text" name="amount_to<?=$rs->id?>" value="<?=$rs->amount_to?>"/></td>  
                  <td><input type="number" name="fees<?=$rs->id?>" value="<?=$rs->fees;?>"></td>
                <?php }?>
              <?php }else{?>
                <?php if($rs->percent_of_invoice_val  == 1){?>
                  <td><?=number_format($rs->amount_from,2).' to '.number_format($rs->amount_to,2)?></td>
                  <td><?=number_format($rs->fees,3).' % of Invoice value'?></td>  
                <?php }else{?> 
                  <td><?=number_format($rs->amount_from,2).' to '.number_format($rs->amount_to,2)?></td>  
                  <td><?=number_format($rs->fees,2)?></td>
                <?php }?>
              <?php }?>
                
              <?php if(!@$view){?>
              <td>
                
         
                <a href="<?php echo base_url('sales/edit_legal_fees/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="Javascript:delete_legal_fees(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                 
                 
              </td>
              <?php }?>
            </tr>
            <?php }}?>
           </tbody>

        </table>

        <?php if($qid && @$quotation->confirmed==0){?>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            
              <button type="button" onclick="save_lp()" class="btn btn-success">Save Chnages</button> 
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> 
              
             
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">
function save_lp(){
  reset(); 

  alertify.confirm("Save changes?", function (e) {
        if (e) {  
            alertify.success("saving...");

            var formData = $('#frm_lp').serialize(); // Serialize the form data

            console.log('formData',formData);

             $.post("<?=base_url('sales/update_lp/'.$qid)?>", formData, function(responseData) {
               

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
 