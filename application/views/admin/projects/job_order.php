<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Projects <small>Job Order</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 120px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('projects/add_job_order');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Job Order</a>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Job Order No.</th>
              <th>Project Name</th>    
              <th>Client</th> 
              <th>Quotation No.</th>
              <th>Date Open</th> 
              <th>Status</th> 
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            
            if(@$clients){
              foreach($clients as $rs){
              $arr_c[$rs->id] = $rs;
            }}

            if(@$quotations){
              foreach($quotations as $rs){
              $arr_q[$rs->id] = @$rs;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_p[$rs->id] = @$rs;
            }}

            if(@$job_order){
              foreach($job_order as $rs){
            ?>
            <tr> 
              <td><?=$rs->job_order_number?></td> 
              <td><?=@$arr_p[$rs->project_id]->name?></td>
              <td><?=@$arr_c[$rs->client_id]->name?></td>
              <td><?=@$arr_q[$rs->quotation_id]->quotation_number?></td>
              <td><?=date('M d, Y', strtotime($rs->date_created))?></td>
              <td><?=$rs->status == 1 ? 'Open' : 'Closed'?></td>
              <td nowrap>
                
                <a href="<?php echo base_url('projects/view_job_order/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> view</a>
                 | 
                <a href="<?php echo base_url('projects/edit_job_order/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="<?php echo base_url('projects/job_order_labor/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-users"></i> Labor</a>
                 | 
                <a href="<?php echo base_url('projects/job_order_clock_in/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-history"></i> Clock-In</a>
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

  alertify.confirm("delete job order information? this will permanently delete selected job order records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>projects/delete_job_order/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

