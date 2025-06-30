<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
       
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Confirmed Stock Adjustments Records</h6> 
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

        <p class="text-muted font-13 m-b-30"> 
        </p>
         
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th> 
              <th>Adjustment Number</th>
              <th>Adjustment Type</th>
              <th>Date Covered</th>
              <th>Reference Number</th>  
              <td>Remarks</td>  
              <td>Created By</td>
              <td>Date Confirmed</td>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$adj_types){
              foreach($adj_types as $rs){
              $arr_at[$rs->id] = $rs->title;
            }}
  
            if(@$ia){
              foreach($ia as $rs){
                $show_po_id = 0;
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td> 
              <td>AJ<?=sprintf("%06d",$rs->id)?></td>
              <td><?=@$arr_at[$rs->adjustment_type_id] ?></td> 
              <td><?=date('M d, Y',strtotime($rs->covered_date))?></td> 
              <td><?=$rs->ref_no?></td> 
              <td><?=$rs->remarks?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td><?=date('M d, Y H:i',strtotime($rs->confirmed_date))?></td> 
              <td nowrap>

                <a target="_blank" href="<?=base_url('inventory/print_adjustments/'.$rs->id)?>" ><i class="fa fa-print"></i> Print</a> | 
 
                <a href="<?php echo base_url('inventory/view_adjustments/'.$rs->id);?>"><i class="fa fa-eye"></i> View</a> 
                <!--   |  
                <a target="_blank" href="<?php echo base_url('inventory/print_adjustment/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                  -->
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
function del_stock_adj(id){
  reset(); 

  alertify.confirm("Confirm Deletion of stock adjustments? This action will permanently selected stock adjustments records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>inventory/delete_adjustments/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function edit_stock_adj(id){
  reset(); 

  alertify.confirm("Edit Receiving Records?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url('inventory/edit_adjustment');?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}


</script>