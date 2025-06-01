<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Accounts <small>Projects List</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 90px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('admin/add_project');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Project</a>
            </div>

      
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Project Name</th>
              <th>Control Number</th>  
              <th>Status</th>  
              <th>Category</th> 
              <th>Selling Price</th> 
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php  
            if(@$project_status){
              foreach($project_status as $rs){
              $arr_ps[$rs->id] = $rs->title;
            }}

            if(@$project_category){
              foreach($project_category as $rs){
              $arr_pc[$rs->id] = $rs->title;
            }}

            if(@$projects){
              foreach($projects as $rs){
            ?>
            <tr>
              <td><?=$rs->name?></td>
              
              <td><?=$rs->control_number?></td>
              <td>
                 <?=@$arr_ps[$rs->project_status_id]?>
              </td>
              <td>
                 <?=@$arr_pc[$rs->project_category_id]?>
              </td>
              <td align="right"><?=$rs->selling_price>0 ? number_format($rs->selling_price,2) : 0?></td>
              <td>
                
                <a href="Javascript:delete_proj(<?=$rs->id?>)"><i class="fa fa-trash"></i> delete</a>
                 | 
                <a href="<?php echo base_url('admin/edit_project/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a> 
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
function delete_proj(id){
  reset(); 

  alertify.confirm("delete project information? this will permanently delete selected project records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>admin/delete_project/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

