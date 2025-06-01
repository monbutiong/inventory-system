<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase Request <small>History</small></h2> 
           
 
         
   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date Filed</th>
              <th>Request Type</th>  
              <th>Remarks</th> 
              <th>Approver</th>
              <th>Form Status</th>   
              <th>P.O. </th>
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$type){
              foreach($type as $rs){
              $arr_type[$rs->id] = $rs->title;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_project[$rs->id] = $rs->control_number;
            }}

            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }} 

            if(@$po){
              foreach($po as $rs){
              $arr_po[$rs->purchase_request_id][] = $rs;
            }} 

            function fstat_($v = ''){
              if($v == 0){
                $v = 'Pending';
              }elseif($v == 1){
                $v = 'Approved';
              }elseif($v == 2){
                $v = 'Rejected';
              }elseif($v == 3){
                $v = 'Cancel';
              }
              return $v;
            }

            if(@$pr){
              foreach($pr as $rs){
            ?>
            <tr>
              <td><?=$rs->date_created?></td>
              <td>
                <?=@$arr_type[$rs->request_type_id]?>
                <?=@$arr_project[$rs->project_id] ? '<br/><small>'.$arr_project[$rs->project_id].'</small>' : ''?>

              </td>
              <td><?=$rs->remarks?></td>
              <td>
                <?=@$arr_user[$rs->a1] ? '<small>(1st) </small>'.$arr_user[$rs->a1].': '.fstat_($rs->a1_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a2] ? '<small>(2nd) </small>'.$arr_user[$rs->a2].': '.fstat_($rs->a2_status).'<br/>' : '';?>
                <?=@$arr_user[$rs->a3] ? '<small>(3rd) </small>'.$arr_user[$rs->a3].': '.fstat_($rs->a3_status).'<br/>' : '';?>
              </td>
              <td>
                <?php 
                if($rs->form_status == 1){ echo 'Approved'; 
                }elseif($rs->form_status == 2){ echo 'Rejected'; 
                }elseif($rs->form_status == 3){ echo 'Cancel'; 
                }elseif($rs->form_status == 0){ echo 'Pending'; } 
                ?>
              </td>
              <td>
                <?php if(@$arr_po[$rs->id]){
                  foreach($arr_po[$rs->id] as $poo){
                    echo '<a target="_blank" href="'.base_url('vendor/print_po/'.$poo->id).'">'.$poo->po_number.': '.date('M d, Y',strtotime($poo->date_created)).'</a><br/>';
                  }
                }else{?>
                  <i>no record</i>
                <?php }?>
              </td>
              <td nowrap="nowrap">
                
                <a href="<?php echo base_url();?>pr/view_pr/<?=$rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i> view</a> 
               

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

  alertify.confirm("delete bib information? this will permanently delete selected bib records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>home/delete_bib/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

