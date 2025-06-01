<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
 
.datepicker{z-index:1151 !important;}
#datatable 
{    
  overflow-y:hidden; 
}
select, .text_input {
    border: 1px solid #fff;
    background-color: transparent;
} 
.vcc{
  border-bottom-color: #999;
}
</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Project<small>Job Order - Labor</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('projects/update_job_order_labor/'.$jo->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
  
            <table id="la_table" class="table table-striped table-bordered table-hover">
               
              <thead>
                <tr style="font-size: 12px;">
                  <th></th>  
                  <th>Description</th>
                  <th>Quantity in Quotation</th>
                  <th>Unit Cost Price</th>
                  <th>Quantity</th>  
                  <th>Remarks</th> 
                </tr>
                </thead>
                <tbody>
                  <?php 

                  if(@$labor){
                    foreach ($labor as $rs) {
                      $arr_labor[$rs->quotation_item_id] = $rs;
                    }
                  }

                  if(@$qi){
                    foreach ($qi as $rs) { 
                  ?>
                  <tr>
                    <td>
                      <input id="chk<?=$rs->id?>" <?php if(@$arr_labor[$rs->id]->id){echo 'checked';}?> onclick="update_la(<?=$rs->id?>)" type="checkbox" id="add_item_<?=$rs->id?>" value="<?=$rs->id?>" style="transform : scale(1.5);">
                    </td> 
                    <td><?=@$rs->item_name?></td>
                    <td><?=@$rs->qty?></td>
                    <td align="right"><?=number_format(@$rs->unit_cost,2)?></td>
                    <td><input type="number" id="qty<?=$rs->id?>" onkeyup="update_la(<?=$rs->id?>)" class="form-control" value="<?=@$arr_labor[$rs->id]->qty>0 ? $arr_labor[$rs->id]->qty : @$rs->qty?>"></td>
                    <td><input type="text" id="remarks<?=$rs->id?>" onkeyup="update_la(<?=$rs->id?>)" class="form-control" value="<?=@$arr_labor[$rs->id]->remarks?>"></td> 
                  </tr>
                  <?php }}?>
                </tbody> 

              </table>

        </form>
      </div>
    </div>
  </div>
</div> 
 <script type="text/javascript">
   
    $('#la_table').DataTable();

    function update_la(id){
 
      if($('#chk'+id).is(":checked")){
        var status = 1;
      }else{
        var status = 0;
      } 

      var postData = { 
        qi_id: id,
        status: status,
        qty: $('#qty'+id).val(),
        remarks: $('#remarks'+id).val()
      };
  
      $.post('<?=base_url("projects/save_labor/".$jo->id)?>', postData, function (data, status) {
          
          if(data == 0){
            alertify.log("Please add quantity");
          }
          
      });

    }

 </script>