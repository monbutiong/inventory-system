<style>
.datepicker{z-index:1151 !important;}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Edit Landed Cost Rate By Supplier  <small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

     
          <?php 
          if($lcr){
            foreach ($lcr as $rs) {
              $arr_lcr[$rs->id] = $rs;
            }
          }

          if($suppliers){
            foreach ($suppliers as $rs) {
              $arr_supp[$rs->id] = $rs->name;
            }
          }

          if($qitems){
            foreach ($qitems as $rs) {
              if($rs->is_local){ 
                $arr_items['LOCAL'][] = $rs;
              }elseif($rs->is_manpower){
                $arr_items['MANPOWER'][] = $rs;
              }elseif($rs->other){
                $arr_items['OTHER'][$rs->other] = $rs;
              }else{

                
                $discounted = ($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)));

                  $lcr_unit = (@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)); 

                  if(!@$sup_lcr[$rs->supplier]){
                    @$sup_lcr[$rs->supplier] = $rs->landed_cost_rate_id;
                  }
                  
                 
                if(@$arr_lcr[$rs->landed_cost_rate_id]->local_purchase != 1){
                  @$arr_sc[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=($lcr_unit * $rs->qty);
                }else{
                  @$arr_sc2[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=($lcr_unit * $rs->qty);
                }
              } 
            }
          }

          ?>  
           <style type="text/css">
             td{
              xfont-size: 10px;
             }
           </style>
                   
                 
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr> 
                        <th>Brand/Supplier</th> 
                        <th>L/C Rate</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      
                      ksort($arr_sc);

                      if(@$arr_sc){
                        foreach ($arr_sc as $key => $value) {
                          list($supp_name,$lcr_id,$s_id) = explode('-x-', $key);
                          if(@$arr_supp[$s_id]){
                      ?>
                      <tr>
                        <td data-order="<?=@$arr_supp[$s_id]?>"><?=@$arr_supp[$s_id]?> </td> 
                        <td>
                          <select onchange="update_item_lc(<?=$s_id?>,this.value)" name="landed_cost_rate_id" id="landed_rate" required class="form-control col-md-7 col-xs-12">
                            <option value="">select</option>
                            <?php 
                            if($lcr){
                              foreach ($lcr as $rs) {
                            ?>
                            <option <?php if(@$sup_lcr[$s_id]==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->landed_cost_rate?></option>
                            <?php }}?> 
                          </select>
                        </td>
                         
                      </tr>
                    <?php }}}?>

                      <?php 
                      if(@$arr_sc2){

                      ksort($arr_sc2);

                      if(@$arr_sc2){
                        foreach ($arr_sc2 as $key => $value) {
                          list($supp_name,$lcr_id,$s_id) = explode('-x-', $key);
                          if(@$arr_supp[$s_id]){
                      ?>
                      <tr>
                        <td data-order="<?=@$arr_supp[$s_id]?>"><?=@$arr_supp[$s_id]?> </td> 
                        <td>
                          <select onchange="update_item_lc(<?=$s_id?>,this.value)" name="landed_cost_rate_id" id="landed_rate" required class="form-control col-md-7 col-xs-12">
                            <option value="">select</option>
                            <?php 
                            if($lcr){
                              foreach ($lcr as $rs) {
                            ?>
                            <option <?php if(@$sup_lcr[$s_id]==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->landed_cost_rate?></option>
                            <?php }}?> 
                          </select>
                        </td>
                         
                      </tr>
                    <?php }}}?>

                     <?php }?>
                   
                    </tbody>
                  </table>
      
    </div>
  </div>
</div> 
<!-- end of accordion -->
<script type="text/javascript">
  
  function update_item_lc(sup_id, lc_id){

    console.log(sup_id, lc_id);

    $("#loadingOverlay").show();

    var postData = {
         sup_id: sup_id,
         lc_id: lc_id 
     };

     $.ajax({
         type: "POST",
         url: "<?=base_url('sales/save_lc_per_supplier/'.@$quotation_id)?>", // Replace with your API endpoint URL
         data: postData,
         success: function(response) {
              
             <?php if(@$edit){?>console.log("Edit POST request successful:", response);

              $('#load_quote_edit').load('<?=base_url("sales/reload_edit_quotation/".@$quotation_id)?>', function (){
                 $("#loadingOverlay").hide();
             });

             <?php }else{?>console.log("Final POST request successful:", response);

             $('#load_quote_final').load('<?=base_url("sales/load_quotation_final/".@$quotation_id)?>', function (){
                 $("#loadingOverlay").hide();
             });

            <?php }?>

         },
         error: function(error) {
             console.error("POST request failed:", error);
         }
     });
  }
</script>