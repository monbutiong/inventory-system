<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Accounts <small>BSP Currency Rate (PHIL. PESO EQUIVALENT)</small></h2> 
 
            <div class="input-group-btn pull-right" style="padding-right: 80px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('accounts/bsp_rate_add');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add Record</a>
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
              <?php 
              if(@$currency_type){
                foreach($currency_type as $rs){
                  if(strtolower($rs->title) != 'php'){
                    $curr[] = $rs->id;
              ?> 
              <th><?=$rs->title?></th>
              <?php }}}?>
              <th>Option</th>
            </tr>
            </thead> 
            <tbody>
            <?php  
            if(@$bsp_rate){
              foreach($bsp_rate as $rs){
                $rates = json_decode($rs->rate,TRUE);
            ?>
            <tr>
              <td><?=date('Y-m-d', strtotime(@$rs->date_for))?></td>
              <?php foreach ($curr as $cc) { ?>
              <td align="right"><?=@$rates[$cc] ?></td> 
              <?php }?>
              <td>
               
                  <a href="<?php echo base_url('accounts/bsp_rate_edit/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> Edit </a>
               

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
function move_to_history(id){
  reset(); 

  alertify.confirm("Move P.O. Details to history?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>receiving/move_to_history/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script> 