<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Confirmed Return Inventory Records</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                         
                    </div>
                </div>
            </div>
        </div>
  
      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">
 
        
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
              <td>Confirmed By</td> 
              <td>Confirmed Date</td>    
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
              <td><?=date('d M, Y',strtotime($rs->return_date))?></td> 
              <td>IR<?=sprintf("%06d",$rs->issuance_id)?></td> 
              <td><?=@$rs->customer?></td>
              <td><?=$rs->phone?></td> 
              <td><?=$rs->remarks?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td> 
              <td><?=@$arr_user[$rs->confirmed_by]?></td>
              <td><?=date('d M, Y',strtotime($rs->confirmed_date))?></td>
              <td nowrap>

                <a target="_blank" href="<?php echo base_url('inventory/print_returns/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                  |  
                <a href="<?php echo base_url('inventory/view_returns/'.$rs->id);?>"  ><i class="fa fa-eye"></i> View</a>
                
               
              </td>
            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>
    </div>
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