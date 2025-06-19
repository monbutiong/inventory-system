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
              <th>Return Date</th>
              <th>Sales Order #</th>
              <th>Customer</th>
              <th>Contact #</th>  
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
  
            if(@$returns){
              foreach($returns as $rs){ 
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td>IR<?=sprintf("%06d",$rs->id)?></td> 
              <td><?=date('M d, Y',strtotime($rs->return_date))?></td> 
              <td>IR<?=sprintf("%06d",$rs->issuance_id)?></td> 
              <td><?=@$rs->customer?></td>
              <td><?=$rs->phone?></td> 
              <td><?=$rs->remarks?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>

                <a href="#" ><i class="fa fa-eye"></i> Confirm</a>
                  |  
                <a href="<?php echo base_url('inventory/view_returns/'.$rs->id);?>"  ><i class="fa fa-file-text-o"></i> View</a>
                  |  
                <a href="<?php echo base_url('inventory/edit_returns/'.$rs->id);?>"><i class="fa fa-edit"></i> Edit</a>
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