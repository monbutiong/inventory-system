<form method="post" id="frm_lc" name="frm_lc">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales <small>Terms and Condition</small></h2> 
        <?php if(!@$view){?>
        <div class="input-group-btn pull-right" style="padding-right: 100px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('purchasing/add_tnc');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New</a>
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
     
              <th>Ttile</th> 
              <th>Template</th>             
              <th>Options</th> 
            </tr>
            </thead> 
            <tbody>
            <?php 
  

            if(@$tnc){
              foreach($tnc as $rs){
            ?>
            <tr> 
              <td><?=$rs->title?></td>   
              <td><?=$rs->description?></td>     
              <td>
                
         
                <a href="<?php echo base_url('purchasing/edit_tnc/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="Javascript:delete_tnc(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                 
                 
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
function delete_tnc(id){
  reset(); 

  alertify.confirm("Delete Template?", function (e) {
        if (e) {  
            alertify.success("deleting...");

            location.href = "<?=base_url('purchasing/delete_tnc')?>/"+id;
             
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

