<form method="post" name="frm_receiving" action="<?=base_url('receiving/update_receiving/'.$rr->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receiving <small>Edit Receiving</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 110px;">
                  <a class="btn btn-sm btn-primary" href="Javascript:save_receiving()"> <i class="fa fa-save"></i> Save Changes</a>
              </div>
          
          <div class="input-group-btn pull-right" style="padding-right: 90px;">
                  <a class="btn btn-sm btn-warning" href="Javascript:cancel_edit()"> <i class="fa fa-close"></i> Cancel </a>
              </div>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">
            
            <div class="col-md-4 col-sm-12 ">
              <label >P.O. Details</label>
              <select name="po_id" id="po_id" class="form-control select2_" onchange="load_items(this.value)">
                <option value="">select</option> 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                    $arr_supp[$rs->id] = $rs->name;
                  }
                }

                if($po){
                  foreach ($po as $rs) {
                ?>
                <option <?php if($rr->po_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?='PO No: '.$rs->po_number.' | Ref. No: '.$rs->reference_no.' | Supplier: '.@$arr_supp[$rs->supplier_id]?></option>
              <?php }}?>
              </select>
              
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >DR Number</label>
              <input type="text" name="dr_number" id="dr_number" value="<?=$rr->dr_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Delivery Date</label>
              <input type="date" name="delivery_date" id="delivery_date" value="<?=$rr->delivery_date?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Number</label>
              <input type="text" name="invoice_number" id="invoice_number" value="<?=$rr->invoice_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Date</label>
              <input type="date" name="invoice_date" id="invoice_date" value="<?=$rr->invoice_date?>" class="form-control">
            </div>
             
            <div class="col-md-8 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"><?=$rr->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Rate</label>
              <select name="rate_id" id="rate_id" class="form-control" onchange="update_total()"> 
                <?php  
                if($rates){
                  foreach ($rates as $rs) {
                ?>
                <option <?php if($rs->id==$rr->currency_rate_id){echo 'selected';}?> value="<?=$rs->id.'-'.$rs->ds?>"><?=$rs->title.': '.$rs->ds?></option>
              <?php }}?>
              </select> 
            </div>


             

            <div class="col-md-2 col-sm-12 ">
              <label >Attachments</label>
              <input type="file" name="attach[]" multiple="" class="form-control">
            </div>

            <?php 
            if(@$rr->attachments){
            ?>
            <div class="col-md-12 col-sm-12" style="text-align: right;"> 
                    <?php 
                    foreach (json_decode($rr->attachments) as $f_name) {
                     list($n,$i,$fname) = explode('_',$f_name);
                    ?>
                     <span id="attch<?=$n.$i?>" class="badge bg-success">
                      <input type="hidden" name="fname[]" value="<?=$fname?>">
                      <a download="<?=$fname?>" title="download file" style="color: white;" href="<?=base_url('assets/uploads/receiving')?>"><?=$fname?> <i class="fa fa-download"></i> </a> | <a style="color: white;" href="Javascript:dela('<?=$n.$i?>')" title="delete file"><i class="fa fa-remove"></i></a>
                    </span>
                   <?php }?>
            </div>
            <?php }?>
 
          </div>

        </p>
 
        
        <div id="load_items"></div>

         
      </div>

      
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  
    $('#load_items').load('<?=base_url("receiving/load_items")?>/<?=$rr->po_id?>/<?=$rr->id?>');
  

  function save_receiving(){ 

    if($('#po_id').val() == ''){
      alertify.error("PO Number is required");
    }else if($('#dr_number').val() == ''){
      alertify.error("DR Number is required");
    }else if($('#invoice_number').val() == ''){
      alertify.error("Invoice Number is required");
    }else if(!$('.itm_chk').is(':checked')){
      alertify.error("Received atleast one item from the list");
    }else{

      reset(); 

      alertify.confirm("Save receiving details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_receiving.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

  }

  function cancel_edit(){
    reset(); 

    alertify.confirm("Cancel edit?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?=base_url('receiving/receiving_records')?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function dela(id){
    reset(); 

    alertify.confirm("Remove attachment?", function (e) {
          if (e) {  
              alertify.log("removed...");
              $('#attch'+id).remove();
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  
  function update_total(){

    var grand = 0;

    $('.itm_chk').each(function() {

        var id = $(this).val();

        if($(this).prop('checked')){

          console.log('id is chk',id);

          var ttl = Number($('#price'+id).val())*Number($('#qty'+id).val());

          $('#rttl'+id).html(ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

          grand+=ttl;

        }else{
          console.log('id is not',id);
          $('#rttl'+id).html('0.00');
        }

    });

    var rate = $('#rate_id').val();

    var rate_number = rate.split('-');

    grand = grand * Number(rate_number[1]);

    grand+=Number($('#fc_amt_ttl').val());
    grand+=Number($('#lc_amt_ttl').val());

    $('#fob_grand_ttl').html(grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#grand_ttl').html(grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

  }

</script>