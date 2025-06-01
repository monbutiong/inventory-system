<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?=$project->name?> <small>Control Number <?=$pcn->control_number?> | Overhead Cost</small></h2> 

          <div class="input-group-btn pull-right" style="padding-right: 190px;">

              <a class="btn btn-sm btn-warning" href="<?php echo base_url('admin/projects');?>" >Go Back</a>
 
              <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('admin/project_overhead_cost_add/'.$pcn->id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add Overhead Cost</a>

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
              <th>Overhead Cost</th>  
              <th>Total Cost (PHP)</th>
              <?php 
              if(@$currency_type){
                foreach ($currency_type as $rs) { 
                  if(strtolower($rs->title) != 'php'){
                    $ratez[] = $rs->id;
              ?>
              <th><?=$rs->title?> Rate</th>
              <th>Total Cost (<?=$rs->title?>)</th> 
              <?php }}}?>
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php  

            if(@$overhead_cost){
              foreach($overhead_cost as $rs){
                $arr_oc[$rs->id] = $rs->title;
              }
            }

            if(@$project_overhead_cost){
              foreach($project_overhead_cost as $rs){

                $rate = json_decode($rs->rate, true);
            ?>
            <tr>
              <td><?=$rs->overhead_cost_date?></td>
              <td><?=@$arr_oc[$rs->overhead_cost_id]?></td> 
              <td align="right"><?=@number_format($rs->amount, 2); ?></td>
              <?php 

              $oc_rate = json_decode($rs->rate, TRUE);

              foreach ($ratez as $r) {               ?>
              <td><?=$x_rate = @$oc_rate[$r]?></td>
              <td align="right"><?=$x_rate ? number_format($rs->amount / $x_rate, 2) : ''?></td> 
              <?php }?>
              <td>
                
                <a href="Javascript:del_m(<?=$rs->id?>)" ><i class="fa fa-trash"></i> delete</a>
                | 
                <a href="<?php echo base_url('admin/project_overhead_cost_edit/'.$cid.'/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
               
                 
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
function del_m(id){
  reset(); 

  alertify.confirm("delete overhead cost information? this will permanently delete selected records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>admin/project_overhead_cost_delete/<?=$cid?>/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

