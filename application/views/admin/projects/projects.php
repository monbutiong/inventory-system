<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Projects <small>Masterist</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('projects/add_project');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Project</a>
            </div>  
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Name</th>
              <th>Client</th>    
              <th>Date Created</th> 
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$clients){
              foreach($clients as $rs){
              $arr_c[$rs->id] = $rs->name;
            }}
 

            if(@$projects){
              foreach($projects as $rs){
            ?>
            <tr> 
              <td><?=$rs->name?></td> 
              <td><?=@$arr_c[$rs->client_id]?></td>
              <td><?=date('M d, Y', strtotime($rs->date_created))?></td>
              <td>
                
                <a href="<?php echo base_url('projects/manage_project/'.$rs->id);?>" ><i class="fa fa-file-text-o"></i> Manage</a>
                 | 
                <a href="<?php echo base_url('projects/edit_project/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="Javascript:delete_bib(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                 
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

  alertify.confirm("Delete project information? this will permanently delete selected project records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>projects/delete_project/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

