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
        <h2>Inventory <small>View Stock Adjustments</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 120px;">
            <?php if($confirm == 1){?>
            <a id="confirm_btn" class="btn btn-sm btn-success" href="Javascript:confirm_adjustment(<?=$ia->id?>)">Confirm</a>
            <?php }?>
                  <button class="btn btn-sm btn-danger" type="button" data-bs-dismiss="modal">Close</button>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
             
          <div class="row">

            <div class="col-md-2 col-sm-12 ">
              <label >Return Number</label>
              <input type="text" readonly class="form-control ridonly" value="RT<?=sprintf("%06d",$ia->id);?>">
            </div>
            
            <div class="col-md-2 col-sm-12 ">
              <label >Adjustment Type</label>
              <input type="text" id="job_order" value="<?=$adj_type->title?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Covered Date </label>
              <input type="text" required name="covered_date" id="covered_date" value="<?=date('M d, Y',strtotime($ia->covered_date))?>" readonly class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" value="<?=$ia->ref_no?>" readonly class="form-control">
            </div>

            <?php 
            if(@$ia->attachments){
            ?>
            <div class="col-md-2 col-sm-12"> 
                <label >Attacments</label>
                <br/>
                <div  >
                    <?php 
                    foreach (json_decode($ia->attachments) as $f_name) {
                     list($n,$i,$fname) = explode('_',$f_name);
                    ?>
                     <span id="attch<?=$n.$i?>" class="badge bg-success">
                      <input type="hidden" name="fname[]" value="<?=$fname?>">
                      <a download="<?=$fname?>" title="download file" style="color: white;" href="<?=base_url('assets/uploads/receiving')?>"><?=$fname?> <i class="fa fa-download"></i> </a> <!-- | <a style="color: white;" href="Javascript:dela('<?=$n.$i?>')" title="delete file"><i class="fa fa-remove"></i></a> -->
                    </span>
                   <?php }?>
                 </div>
            </div>
            <?php }?>

             
 
            <div class="col-md-8 col-sm-12 ">
              <label >Remarks </label>
              <textarea  readonly class="form-control"><?=$ia->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($ia->date_created))?>" class="form-control">
            </div>

            <?php if(@$confirm_user->name){?>
            <div class="col-md-2 col-sm-12 ">
              <label >Confirmed By</label>
              <input type="text" readonly value="<?=@$confirm_user->name.' - '.date('M d, Y',strtotime($ia->confirmed_date))?>" class="form-control">
            </div>
            <?php }?>
   
 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>#</th>
              <th>Part No.</th>
              <th>Description</th>  
              <th>Unit Cost Price</th> 
              <th>Stock Qty</th>
              <th>Adjustment</th>
              <th>New Qty</th> 
              <th>Remarks</th> 
            </tr>
            </thead> 
            <tbody>
              <?php 
              if(@$inv){
                foreach($inv as $rs){
                $arr_inv[$rs->id] = $rs;
              }}


              $row_count=0;
              $selected_ids='';
              if(@$ia_items){
                foreach ($ia_items as $rs) {  
              ?>
              <tr id="tr<?=$rs->inventory_id?>">
                <td><?=$row_count+=1;?></td>
                <td><?=@$arr_inv[$rs->inventory_id]->item_code?> </td>
                <td><?=@$arr_inv[$rs->inventory_id]->item_name?></td>
                <td align="right"> <?=number_format($rs->unit_cost_price,2)?></td> 
                <td align="center"> <?=$rs->qty_before?>  </td>
                <td align="center"> <?=$rs->adj_qty?>  </td>
                <td align="center"> <?=$rs->qty_after?>  </td>
                <td> <?=$rs->remarks?> </td> 
              </tr>
              <?php 
              }}
              ?>
             
            </tbody>
          </table>
          
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

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

  function confirm_adjustment(){
    reset(); 

    alertify.confirm("Confirm inventory adjustments?", function (e) {
          if (e) {  
              location.href = '<?=base_url("inventory/confirm_adjustment/".$ia->id)?>';
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