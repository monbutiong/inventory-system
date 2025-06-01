<style type="text/css">
  input, textarea{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_issuance" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Project <small>View Job Order</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 120px;"> 
                  <button class="btn btn-sm btn-danger" type="button" data-bs-dismiss="modal">Close</button>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
             
          <div class="row">
            
            <div class="col-md-2 col-sm-12 ">
              <label >Job Order</label>
              <input type="text" id="job_order" value="<?=$jo->job_order_number?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Quotation</label>
              <input type="text" id="quotation" value="<?=$quotation->quotation_number?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Project</label>
              <input type="text" id="project" value="<?=$project->name?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Client</label>
              <input type="text" id="client" value="<?=$client->name?>" readonly class="form-control ridonly"> 
            </div> 
 
 
            <div class="col-md-8 col-sm-12 ">
              <label >Job Order Description </label>
              <textarea  readonly class="form-control"><?=$jo->description?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($jo->date_created))?>" class="form-control">
            </div>

            <?php if(@$confirm_user->name){?>
            <div class="col-md-2 col-sm-12 ">
              <label >Confirmed By</label>
              <input type="text" readonly value="<?=@$confirm_user->name.' - '.date('M d, Y',strtotime($jo->confirmed_date))?>" class="form-control">
            </div>
            <?php }?>
   
 
          </div>

        </p>

        <br/>

       

        <div>
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active">
                  <a href="#tab1" id="recent-tab" role="tab" data-bs-toggle="tab" aria-expanded="true">Issued Materials</a>
              </li>
              <li role="presentation">
                  <a href="#tab2" role="tab" id="progress-tab" data-bs-toggle="tab" aria-expanded="false">Labor</a>
              </li>
               
          </ul>
          <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-labelledby="recent-tab">
                  <table id="ii_table" class="table table-striped table-bordered table-hover">
                     
                    <thead>
                      <tr style="font-size: 12px;">
                        <th>Date Issued</th> 
                        <th>Part No.</th>
                        <th>Description</th>
                        <th>Unit Cost Price</th> 
                        <th>Issue Qty</th> 
                        <th>Remarks</th> 
                      </tr>
                      </thead> 
                      <tbody>
                        <?php 
                        $row_count=0;
                        $selected_ids='';
                        if(@$iii){
                          foreach ($iii as $rs) { 
                            $row_count+=1;
                            $selected_ids.='('.$rs->inventory_id.')-';
                        ?>
                        <tr id="tr<?=$rs->inventory_id?>">
                          <td><?=date('M d, Y',strtotime($rs->date_created))?> </td>
                          <td><?=$rs->item_code?> </td>
                          <td><?=$rs->item_name?></td>
                          <td align="right"> <?=number_format($rs->unit_cost_price,2)?></td> 
                          <td align="center"> <?=$rs->qty?>  </td>
                          <td> <?=$rs->remarks?> </td> 
                        </tr>
                        <?php 
                        }}
                        ?>
                       
                      </tbody>
                    </table>

              </div>
              <div role="tabpanel" class="tab-pane" id="tab2" aria-labelledby="progress-tab">
                  <!-- Content for the second tab -->
                  <table id="la_table" class="table table-striped table-bordered table-hover">
                     
                    <thead>
                      <tr style="font-size: 12px;">
                        <th>Date</th>  
                        <th>Description</th>
                        <th>Quantity</th>  
                        <th>Unit Cost Price</th>  
                        <th>Total</th>
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
                            if(@$arr_labor[$rs->id]->qty>0){
                        ?>
                        <tr> 
                          <td><?=@$arr_labor[$rs->id]->date_created?></td> 
                          <td><?=@$rs->item_name?></td> 
                          <td><?=@$arr_labor[$rs->id]->qty?></td>
                          <td align="right"><?=number_format(@$rs->unit_cost,2)?></td>
                          <td align="right"><?=number_format(@$rs->unit_cost * @$arr_labor[$rs->id]->qty,2)?></td>
                          <td><?=@$arr_labor[$rs->id]->remarks?></td> 
                        </tr>
                        <?php }}}?>
                      </tbody> 

                    </table>
              </div>
            
          </div>
      </div>

 
        
        
          
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  $('#ii_table').DataTable();
  $('#la_table').DataTable();

  var c = 0;
  var all = 0; 
    
  function load_client(id){
    
    $.get("<?=base_url('outgoing/load_client')?>/"+id, function(data) {
        // Handle the response data here
        console.log(data);
        var cli = data.split('-');

        $('#client_id').val(cli[0]);
        $('#client').val(cli[1]);
    })
  }

  function go_back(){
    reset(); 

    alertify.confirm("Leave view issuance?", function (e) {
          if (e) {  
              location.href = '<?=base_url("outgoing/issuance_records")?>';
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function save_issuance(){ 

    if($('#project_id').val() == ''){
      alertify.error("Project is required");
    }else if($('#issued_date').val() == ''){
      alertify.error("Issue date is required"); 
    }else{

      reset(); 

      alertify.confirm("Update receiving details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_issuance.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

  }


  function remove_item(c,id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

  $('#gmodal').addClass('modal-lg-mod'); 

</script>