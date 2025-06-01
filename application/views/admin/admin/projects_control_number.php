<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?=$project->name?> <small>Manage Control Number</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 120px;">

              <a class="btn btn-sm btn-warning" href="<?php echo base_url('admin/projects');?>" >Go Back</a>
 
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('admin/pcn_add/'.$project->id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add</a>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
              <th>Control Number</th> 
              <th>Details</th> 
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php  
 
            if(@$projects_control_number){
              foreach($projects_control_number as $rs){ 
            ?>
            <tr>
              <td><?=date('Y-m-d H:i', strtotime($rs->date_created))?></td>
              <td><?=@$rs->control_number?></td> 
              <td><?=@$rs->details?></td> 
              <td>
                
                <a href="Javascript:del_m(<?=$rs->id?>)" ><i class="fa fa-trash"></i> delete</a>
                  | 
                <a href="<?php echo base_url('admin/pcn_edit/'.$id.'/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                  | 
                <a href="<?php echo base_url('admin/project_overhead_cost/'.$rs->id);?>" ><i class="fa fa-users"></i> Overhead Cost </a>
                  | 
                <a href="<?php echo base_url('admin/project_manpower/'.$rs->id);?>" ><i class="fa fa-users"></i> Manpower </a>
                 
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
function del_m(id){
  reset(); 

  alertify.confirm("delete control number information? this will permanently delete selected records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>admin/delete_pcn/<?=$id?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

