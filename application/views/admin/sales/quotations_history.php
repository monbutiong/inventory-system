<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales <small> Quotation History</small></h2> 

       <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('sales/confirmed_quotation');?>" >Go Back</a>
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
              <th>Quotation No.</th>
              <th>Revision</th>
              <th>Project</th>
              <th>Client</th>
              <th>Att. To</th> 
              
              <!-- <th>Status</th>   -->
              <td>Confimed Date</td>   
              <th>Created By</th>
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
            <tr <?php if($rs->confirmed_date){?>style="font-weight: bold;"<?php }?>>
              <td data-order="-<?=strtotime($rs->confirmed_date)?>"><?=date('M d, Y',strtotime($rs->quotation_date))?></td>
              <td><?=@$rs->quotation_number?></td>
              <td><?=$rs->version?></td>
              <td><?=@$arr_p[$rs->project_id]?></td>
              <td><?=@$arr_client[$rs->client_id]?></td> 
              <td><?=$rs->att_to?></td>   
              <!-- <td><?=$rs->draft==1 ? 'Draft' : 'In-Progress'?></td> -->
              <td><?=$rs->confirmed_date ? date('M d, Y',strtotime($rs->confirmed_date)) : ''?></td>
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>
                   
                 <a href="<?php echo base_url('sales/view_quotation/'.$rs->id.'/'.$quotation_id);?>" ><i class="fa fa-file-text-o"></i> View</a>
               
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

  alertify.confirm("Confirm the Revision of the Selected Quotation?", function (e) {
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
 

