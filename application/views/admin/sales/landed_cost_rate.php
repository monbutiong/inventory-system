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
        <h2>Sales <small>Landed Cost Rate</small></h2> 
        <?php if(!@$view){?>
        <div class="input-group-btn pull-right" style="padding-right: 100px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('sales/add_landed_cost_rate');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New</a>
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
     
              <th>L/C Rate</th> 
              <th>Conversion Factor</th>    
              <th>Freight %</th>    
              <th>Custom %</th>    
              <th>L/C Factor</th>     
              <?php if(!@$view){?><th>Options</th><?php }?>
            </tr>
            </thead> 
            <tbody>
            <?php 
  

            if(@$landed_cost_rate){
              foreach($landed_cost_rate as $rs){
            ?>
            <tr> 
              <td><?=$rs->landed_cost_rate?></td> 
                <?php if($qid && @$quotation->confirmed==0){?>
                  <td nowrap><input type="number" name="conversion_factor<?=$rs->id?>" value="<?=$rs->conversion_factor?>"></td> 
                  <td nowrap><input type="number" name="freight_percent<?=$rs->id?>" value="<?=$rs->freight_percent?>">%</td> 
                  <td nowrap><input type="number" name="custom_percent<?=$rs->id?>" value="<?=$rs->custom_percent?>">%</td> 
                  <td nowrap><input type="number" name="landed_cost_factor<?=$rs->id?>" value="<?=$rs->landed_cost_factor?>"></td> 
                <?php }else{?>
                  <td><?=$rs->conversion_factor?></td> 
                  <td><?=$rs->freight_percent?>%</td> 
                  <td><?=$rs->custom_percent?>%</td> 
                  <td><?=$rs->landed_cost_factor?></td> 
                <?php }?>

                <?php if(!@$view){?>
                <td>
                   
                  <a href="<?php echo base_url('sales/edit_landed_cost_rate/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
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
            
              <button type="button" onclick="save_lc()" class="btn btn-success">Save Chnages</button> 
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
 

