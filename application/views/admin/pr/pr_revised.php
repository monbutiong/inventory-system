<?php 
if(@$users){
  foreach($users as $rs){
  $arr_user[$rs->id] = $rs->name;
}}

if(@$accounts){
  foreach($accounts as $rs){
  $arr_account[$rs->id] = $rs->title;
}}

if(@$uom_type){
  foreach($uom_type as $rs){
  $arr_uom_type[$rs->id] = $rs->title;
}}

if(@$projects){
  foreach($projects as $rs){
  $arr_project[$rs->id] = $rs;
}}

if(@$projects_control_number){
  foreach($projects_control_number as $rs){
  $arr_cn[$rs->id] = $rs->control_number;
}}

if(@$items){
  foreach($items as $rs){
  $arr_item[$rs->id] = $rs;
}}
?>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase Request<small>Revise PR</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" name="pr_form" action="<?php echo base_url('pr/save_revised_pr/'.$pr->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">

            <div class="row">
              <div class="col-md-8">
          
                <label for="remarks">Requestor </label> 
                <input type="text" disabled value="<?php echo @$arr_user[@$pr->user_id]?>" class="form-control"/> 

              </div>

              <div class="col-md-4">
          
                <label for="remarks">Date File </label> 
                <input type="text" disabled value="<?php echo date('M d, Y H:i', strtotime(@$pr->date_created))?>" class="form-control"/> 

              </div>
              <!-- <div class="col-md-4">

                <label for="request_type_id">Request Type </label> 
                <input type="text" disabled value="<?php echo @$arr_type[@$pr->request_type_id]?>" class="form-control"/>

              </div> -->

              <?php if($pr->control_number_type == 1){?>

                <div class="col-md-4">

                  <label for="request_type_id">Accounts</label> 
                  <input type="text" disabled value="<?php echo @$pr->inventory_accounts_id ? @$arr_account[@$pr->inventory_accounts_id] : '-'?>" class="form-control"/>

                </div>

                <div class="col-md-4">

                  <label for="request_type_id">Purchasing Control Number </label> 
                  <input type="text" disabled value="<?php echo @$pr->pur_control_number?>" class="form-control"/>

                </div>

              <?php }else{?>  
              <div class="col-md-4">

                <label for="request_type_id">Project Name</label> 
                <input type="text" disabled value="<?php echo @$pr->project_id ? @$arr_project[@$pr->project_id]->name : 'new stock'?>" class="form-control"/>

              </div>

              <div class="col-md-4">

                <label for="request_type_id">Control Number </label> 
                <input type="text" disabled value="<?php echo @$pr->project_id ? @$arr_project[@$pr->project_id]->control_number : 'new stock'?>" class="form-control"/>

              </div>

              <?php }?>

              <div class="col-md-4">
         
                <label for="remarks">Remaks </label> 
                <input type="text" disabled value="<?php echo @$pr->remarks?>" class="form-control"/>

            </div>
          </div>
          
         </div>

          <div class="form-group">

            <label for="last-name">Request Item(s)
            </label> 

            <table id="item_table" class="table table-striped table-bordered table-hover">
              <tr>
                <?php if(@$purchasing == 1){?>
                <th></th>  
                <?php }?>  
                <th>Item Code</th> 
                <th>Item Name</th> 
                <th>Item Description</th> 
                <th align="center"><center>Request Qty.</center></th> 
                <th align="center"><center>Option</center></th>
              </tr>
              <?php 
              if(@$po_item){
              foreach($po_item as $rs){
                $arr_po[$rs->purchase_request_items_id] = $rs;
              }}

              if(@$po){
              foreach($po as $rs){ 
                $arr_po_num[$rs->id] = $rs->po_number;
              }}

              if(@$suppliers){
              foreach($suppliers as $rs){
                $arr_supplier[$rs->id] = $rs->name;
              }}

              $existing = '';

              if(@$pr_item){
              foreach($pr_item as $rs){
              $ecount+=1;

              if($rs->inventory_id>0){
                $existing.='('.$rs->inventory_id.')-';
              }

              $new=0;
              ?>
              <tr id="tr<?=$ecount?>" <?php if($rs->cancel){?>style="color: red;"<?php }?>>
                   

                <td><?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->item_code : $rs->item_details.' <span class="badge badge bg-green">new</span>'?> </td> 


                <td> 
                <?php if(!@$arr_item[$rs->inventory_id]->name){ $new=1;?> 
                  <input type="text" name="item_name<?=$ecount?>" value="<?=$rs->item_name?>" placeholder="type item name" style="width: 100%; border: 0px;">
                <?php }else{?>
                  <?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->name : $rs->item_name?>
                <?php }?>

                <input type="hidden" name="existing_pr<?=$ecount?>" value="<?=$rs->id?>"/>
                <input type="hidden" name="new<?=$ecount?>" id="added<?=$rs->id?>" value="<?=$new?>"/>
                <input type="hidden" name="item<?=$ecount?>" value="<?=$rs->inventory_id?>">
                </td>

                <td>
                  
                    <?php if(!@$arr_item[$rs->inventory_id]->name){?> 
                      <input type="text" name="item_desc<?=$ecount?>" value="<?=$rs->item_desc?>" placeholder="type item description" style="width: 100%; border: 0px;">
                    <?php }else{?>
                      <?=@$arr_item[$rs->inventory_id]->name ? $arr_item[$rs->inventory_id]->short_description : $rs->item_desc?>
                    <?php }?>
                  </td>


                <td align="center">
                  <input type="number" name="qty<?=$ecount?>" value="<?=($rs->qty+0)?>" style="border: 0px; text-align: center; width: 65px;"> 

                  <?=(@$arr_item[$rs->inventory_id]->uom_type_id ? @$arr_uom_type[$arr_item[$rs->inventory_id]->uom_type_id] : 'pcs')?>
                    

                  </td> 
                
        
           

                <td align="center"><a href="Javascript:remove_item(<?=$ecount?>,<?=$rs->id?>)"><i title="remove" class="fa fa-close"></i></a></td>

              </tr>
              <?php }}?>

              <tr id="item_selector">
                <td colspan="5" class="add_item">
                  <div class="select2-ajax" style="width: 100%;"> 
                  </div>
                </td>  
              </tr>

             
            </table>
          </div>


          <?php 
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

          if(@$users){
            foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
          }}
          ?>
          
          <div class="row">
            <center>
            <?php if(@$arr_user[$pr->a1]){ if($pr->a1_status==0){$app=$pr->a1; $appc=1;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">1st Approver</label> 
                <p><strong><?=fstat_($pr->a1_status);?></strong></p>
                <p><i><?=$pr->a1_date ? date('M d Y H:i',strtotime($pr->a1_date)) : '--/--/----';?></i></p>
                <p><u><?=@$arr_user[$pr->a1]?></u></p> 
              </center>
            </div>
            <?php $max = 1; }?>
            <?php if(@$arr_user[$pr->a2]){ if(!@$app && $pr->a2_status==0){$app=$pr->a2; $appc=2;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">2nd Approver</label> 
                <p><strong><?=fstat_($pr->a2_status);?></strong></p>
                <p><i><?=$pr->a2_date ? date('M d Y H:i',strtotime($pr->a2_date)) : '--/--/----';?></i></p>
                <p><u><?=@$arr_user[$pr->a2]?></u></p> 
              </center>
            </div>
            <?php $max = 2; }?>
            <?php if(@$arr_user[$pr->a3]){ if(!@$app && $pr->a3_status==0){$app=$pr->a3; $appc=3;}?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">3rd Approver</label>
                <p><strong><?=fstat_($pr->a3_status);?></strong></p>
                <p><i><?=$pr->a3_date ? date('M d Y H:i',strtotime($pr->a3_date)) : '--/--/----';?></i></p> 
                <p><u><?=@$arr_user[$pr->a3]?></u></p> 
              </center>
            </div>
            <?php $max = 3; }?>
             </center>
          </div>
  
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="pull-right">

              <input type="hidden" name="row_counter" id="row_counter" value="<?=@$ecount?>">

              <input type="hidden" id="selected_ids" value="<?=$existing?>">

              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
           
              <button type="button" id="sbtn" class="btn btn-success" onclick="save_pr()">Save PR (Rev <?=$pr->rev+=1?>)</button>

            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
  function cancel(){
    reset(); 

    alertify.confirm("Cancel selected PR item(s)?", function (e) {
          if (e) {  
              alertify.log("saving...");
              document.pr_form.submit();
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function approve(){
    reset(); 

    alertify.confirm("Approve PR?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?php echo base_url();?>approval/pr_update/<?=$pr->id?>/1/<?=@$appc?>/<?=@$max?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function reject(){
    reset(); 

    alertify.confirm("Reject PR?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?php echo base_url();?>approval/pr_update/<?=$pr->id?>/2/<?=@$appc?>//<?=@$max?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  $('#gmodal').addClass('modal-lg-mod'); 


  $(".select2-ajax").select2({
   placeholder: "(+) Add Item", 
   ajax: { 
    url: "<?=base_url("inventory/search_item/new")?>",
    type: "post",
    dataType: 'json',
    delay: 250,
    dropdownAutoWidth : true,
    data: function (params) {
     return {
       searchTerm: params, // search term
       excluded_ids: $('#selected_ids').val()
     };
    },
    results: function (data, page) {
    return {
        results: $.map(data, function(obj) {  

  
             return { id: obj.id, text: obj.text, uom: obj.uom, code: obj.code, name: obj.name, desc: obj.desc };
  

        })
    };
    },
    cache: true
   }
  });
  
  var c = <?=$ecount?>;
  var all = <?=$ecount?>; 

  $(".select2-ajax").on("select2-selecting", function(e) {
      
      c+=1;
      
      // var select_cn = '<select name="cn'+c+'" required="required" class="selecta'+c+' form-control"> <option value="">select</option> <?php if(@$projects_control_number){ foreach($projects_control_number as $rs){?> <option value="<?php echo $rs->id;?>"><?php echo $rs->control_number;?></option> <?php }}?> </select> ';
  
      if(e.object.id == 0){ // ==== this is for new ITEM
        
        $('#item_selector').before('<tr id="tr'+c+'"><td>'+e.object.code+'<input type="hidden" name="item'+c+'" value="0"/><input type="hidden" name="new'+c+'" value="1"/></td><td><input type="text" name="item_name'+c+'" value="" placeholder="type new item name" style="width: 100%; border: 0px;"></td><td><input type="text" name="item_desc'+c+'" value="" placeholder="type new item description" style="width: 100%; border: 0px;"></td><td align="center"><input type="number" name="qty'+c+'" style="border: 0px; text-align: center; width: 65px;" value="1" min="1">'+e.object.uom+'</td> <td align="center"><a href="Javascript:remove_item('+c+',0)"><i title="remove" class="fa fa-close"></i></a></td></tr>');
  
      }else{ // === this is for existing item

      console.log('slected', e.object);

        if($('#added'+e.object.id).length == 0) {

          $('#selected_ids').val($('#selected_ids').val() + '(' + e.object.id + ')-');
      
          $('#item_selector').before('<tr id="tr'+c+'"><td>'+e.object.code+'<input type="hidden" name="new'+c+'" id="added'+e.object.id+'" value="0"/></td><td>'+e.object.name+'<input type="hidden" name="item'+c+'" value="'+e.object.id+'"></td><td>'+e.object.desc+'</td><td align="center"><input type="number" name="qty'+c+'" style="border: 0px; text-align: center; width: 65px;" value="1" min="1">'+e.object.uom+'</td> <td align="center"><a href="Javascript:remove_item('+c+','+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
        }
      }

      $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
      $('.selecta'+c).select2();
      all+=1;

      $('#row_counter').val(c);
  }); 

  $(".select2-ajax").val('').trigger('change');

  function remove_item(c, id){
    $('#qty'+c).val(0);
    $('#tr'+c).fadeOut();
    $('#tr'+c).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

  function save_pr(){

    if(all <= 0){
      alertify.alert('Please make sure to include at least one item in your purchase request.'); 
    }else{

      reset(); 

      alertify.confirm("save purchase request?", function (e) {
          if (e) {  
            $('#sbtn').prop('disabled', true);
            document.pr_form.submit();
          } 
        }, "Confirm");
    }
  }
  
</script>