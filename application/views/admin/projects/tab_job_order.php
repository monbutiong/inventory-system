<table id="datatable" class="table table-striped table-bordered table-hover">
  <thead>
    <tr style="font-size: 12px;"> 
      <th>Job Order No.</th>  
      <th>Date Open</th>  
      <th>Options</th>
    </tr>
    </thead> 
    <tbody>
    <?php  

    if(@$job_order){
      foreach($job_order as $rs){
    ?>
    <tr> 
      <td><?=$rs->job_order_number?></td>   
      <td><?=date('M d, Y', strtotime($rs->date_created))?></td> 
      <td nowrap>
        
        <a href="<?php echo base_url('projects/view_job_order/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> view</a>
         
      </td>
    </tr>
    <?php }}?>
   </tbody>
</table>