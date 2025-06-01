<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>Return Inventory Records</small></h2> 
 
 
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>Return Number</th>
              <th>Job Order</th>
              <th>Project</th>
              <th>Return Date</th>
              <th>Reference Number</th>  
              <td>Remarks</td>  
              <td>Created By</td>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$ii){
              foreach($ii as $rs){
              $arr_ii[$rs->id] = $rs->job_order_id;
            }}

            if(@$jo){
              foreach($jo as $rs){
              $arr_jo[$rs->id] = $rs->job_order_number;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_pr[$rs->id] = $rs->name;
            }}
  
            if(@$returns){
              foreach($returns as $rs){ 
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td>RT<?=sprintf("%06d",$rs->id)?></td>
              <td><?=@$arr_jo[@$rs->job_order_id]?></td> 
              <td><?=@$arr_pr[@$rs->project_id]?></td> 
              <td><?=date('M d, Y',strtotime($rs->return_date))?></td> 
              <td><?=$rs->ref_no?></td> 
              <td><?=$rs->remarks?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>

                <a href="<?php echo base_url('inventory/view_returns/'.$rs->id.'/1');?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-check"></i> Confirm</a>
                  |  
                <a href="<?php echo base_url('inventory/view_returns/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-file-text-o"></i> View</a>
                  |  
                <a href="Javascript:edit_return(<?=$rs->id?>)" ><i class="fa fa-edit"></i> Edit</a>
                  |  
                <a href="Javascript:del_return(<?=$rs->id?>)" ><i class="fa fa-trash"></i> Delete</a>
               
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
function del_return(id){
  reset(); 

  alertify.confirm("Confirm deletion of return inventory? This action will permanently selected return inventory records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>inventory/delete_returns/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function edit_return(id){
  reset(); 

  alertify.confirm("Edit return inventory records?", function (e) {
        if (e) {  
            alertify.log("updating...");
            location.href = "<?php echo base_url('inventory/edit_returns');?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}


</script>