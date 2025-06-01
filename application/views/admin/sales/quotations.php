<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales <small>Quotation List</small></h2> 

      
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
              <th>Quotation No.</th>
              <th>Revision</th>
              <th>Project</th>
              <th>Client</th>
              <th>Att. To</th> 
              
              <!-- <th>Status</th>   -->
              <td>Last Update</td> 
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

            if(@$clients){
              foreach($clients as $rs){
                $arr_client[$rs->id] = $rs->name;
            }}

            if(@$projects){
              foreach($projects as $rs){
                $arr_p[$rs->id] = $rs->name;
            }}
  
            if(@$quotations){
              foreach($quotations as $rs){
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->quotation_date))?></td>
              <td><?=@$rs->quotation_number?></td>
              <td><?=$rs->version?></td>
              <td title="Project ID: <?=$rs->project_id?>"><?=@$arr_p[$rs->project_id]?></td>
              <td title="Client ID: <?=$rs->client_id?>"><?=@$arr_client[$rs->client_id]?></td> 
              <td><?=$rs->att_to?></td>  
             
              <!-- <td><?=$rs->draft==1 ? 'Draft' : 'In-Progress'?></td> -->
              <td><?=$rs->date_modified ? date('M d, Y',strtotime($rs->date_modified)) : ''?></td>
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>
                <a href="Javascript:confirmq(<?=$rs->id?>)" ><i class="fa fa-check"></i> Confirm</a>
                 |
                <!-- <a target="_blank" href="<?php echo base_url('vendor/print_quotation/'.$rs->id);?>" ><i class="fa fa-print"></i> Quotation</a>
                 |  -->  
                <a href="Javascript:revised(<?=$rs->id?>)"><i class="fa fa-copy"></i> Revise</a>
                 |  
                <a href="<?php echo base_url('sales/view_quotation/'.$rs->id);?>" ><i class="fa fa-file-text-o"></i> View</a>
                 | 
                <a href="<?php echo base_url('sales/edit_quotation/'.$rs->id);?>" ><i class="fa fa-edit"></i> Edit</a>
                 | 
                <a href="<?php echo base_url('sales/print_logs_quotation/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-print"></i> Logs</a>
                <!--  |   
                <a href="Javascript:delete_bib(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
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

<script type="text/javascript">
function delete_bib(id){
  reset(); 

  alertify.confirm("Confirm Deletion of Quotation Information? This Action Will Permanently Remove the Selected Quotation Records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>sales/delete_quotations/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function revised(id){
  reset(); 

  alertify.confirm("Revise Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("copying...");
            location.href = "<?php echo base_url();?>sales/revise_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirmq(id){
  reset(); 

  alertify.confirm("Confirm Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>sales/confirm_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

