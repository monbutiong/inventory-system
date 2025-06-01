<style type="text/css">
  input, textarea{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_receiving" action="<?=base_url('receiving/save_receiving')?>" enctype="multipart/form-data">
<?php 
  if(@$po){
    foreach($po as $rs){
    $arr_po[$rs->id] = $rs->po_number;
  }}

?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receiving <small><?php if($confirm == 1){?>Confirm GRV<?php }else{?>View GRV<?php }?></small></h2> 
          
          <div class="input-group-btn pull-right" style="padding-right: 120px;">
            <?php if($confirm == 1){?>
            <a class="btn btn-sm btn-success" href="Javascript:confirm_rr()">Confirm</a>
            <?php }?>
                  <button class="btn btn-sm btn-danger" type="button" data-bs-dismiss="modal">Close</button>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">

            <div class="col-md-4 col-sm-12 ">
              <label >Supplier</label>
              <input type="text" readonly value="<?=$supplier->name?>" class="form-control">
              
            </div>
            
            <div class="col-md-8 col-sm-12 ">
              <label >P.O. Details</label>
              <input type="text" readonly value="<?php

              if(json_decode($rr->po_ids)){
                foreach (json_decode($rr->po_ids) as $po_id) {
                  if(!@$show_po_id){
                    $show_po_id = 1;
                    echo  @$arr_po[$po_id];
                  }else{
                    echo  ', '.@$arr_po[$po_id];
                  } 
                }
              }
              ?>" class="form-control">
              
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >DR Number</label>
              <input type="text" readonly value="<?=$rr->dr_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Delivery Date</label>
              <input type="date" readonly value="<?=$rr->delivery_date?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Number</label>
              <input type="text" readonly value="<?=$rr->invoice_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Date</label>
              <input type="date" readonly value="<?=$rr->invoice_date?>" class="form-control">
            </div>
 
            <div class="col-md-2 col-sm-12 ">
              <label >Exchange Rate</label>
              <input type="text" readonly value="<?=$rr->exchange_rate?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Currency</label>
              <input type="text" readonly value="<?=$rr->currency?>" class="form-control">
            </div>
 
            <div class="col-md-4 col-sm-12 ">
              <label >Remarks </label>
              <textarea readonly class="form-control"><?=$rr->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Transport</label>
              <input type="text" readonly class="form-control" value="<?php 
                if(@$grv_transport){
                  foreach ($grv_transport as $rs) { if($rr->grv_transport_id==$rs->id){
                echo $rs->title;  }}}?>">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >L/C Factor</label>
              <input type="text" readonly value="<?=$rr->lc_factor?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($rr->date_created))?>" class="form-control">
            </div>
            <?php if(@$confirm_user->name){?>
            <div class="col-md-2 col-sm-12 ">
              <label >Confirmed By</label>
              <input type="text" readonly value="<?=@$confirm_user->name.' - '.date('M d, Y',strtotime($rr->confirmed_date))?>" class="form-control">
            </div>
            <?php }?>


            <?php 
            if(@$rr->attachments){
            ?>
            <div class="col-md-2 col-sm-12"> 
                <label >Attacments</label>
                <br/>
                <div  >
                    <?php 
                    foreach (json_decode($rr->attachments) as $f_name) {
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
             
          </div>

        </p>
 
        
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>P.O. No.</th>
              <th>Part No.</th>
              <th>Description</th>
              <th>Received Qty</th>
              <th>Bad Qty</th>
              <th>Unit Price</th>
              <th width="10%">Total Price <?=$rr->currency?></th>
              <th width="10%">Total Price QAR</th> 
              <th>Remarks</th>  
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$lcr){
              foreach ($lcr as $rs) {
                $arr_lcr[$rs->id] = $rs->currency_symbol;
              }
            }


            if(@$poi){
              foreach ($poi as $rs) {
                $arr_poi[$rs->id] = $rs;
              }
            }

            $ttl_f = 0;
            $ttl = 0;

            if(@$rri){
              foreach ($rri as $rs) { 
            ?> 
            <tr>
              <td><?=@$arr_po[$rs->po_id]?> </td>
              <td><?=@$arr_poi[$rs->po_item_id]->item_code?> </td>
              <td><?=@$arr_poi[$rs->po_item_id]->item_name?></td>
              <td align="center"><?=$rs->qty?></td>
              <td align="center"><?=$rs->bad_qty?></td>
              <td align="right"><?=number_format($rs->price,2)?> </td>
              <td align="right"><?=number_format($rs->price * $rs->qty,2); $ttl_f+=($rs->price * $rs->qty)?></td>
              <td align="right"><?=number_format(($rs->price * $rr->exchange_rate) * $rs->qty,2); $ttl+=(($rs->price * $rr->exchange_rate) * $rs->qty)?></td> 
              <td><?=$rs->remarks?></td>
            </tr> 
            <?php }}?>
           </tbody>

        </table> 


        <div class="row">
           
          <div class="col-md-4 col-sm-12 ">
            <label >Foreign Charges</label>
            <table id="fc_section" class="table table-striped table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Remarks</th> 
                </tr>
                <?php 
                if(@$fc){
                  foreach ($fc as $rs) {
                    $arr_fc[$rs->id] = $rs->title;
                  }
                }

                $fc_ttl = 0;

                if(@$fc_used){
                  foreach($fc_used as $rs){?>
                <tr>
                  <td><?=@$arr_fc[$rs->fc_id]?></td>
                  <td align="right"><?=number_format($rs->amt,2); $fc_ttl+=$rs->amt?></td>
                  <td><?=$rs->remarks?></td>
                </tr>
                <?php }}else{?>
                <tr>
                  <td colspan="3"><center><i>no data</i></center></td>
                </tr>
                <?php }?> 
              </table>
          </div>

          <div class="col-md-4 col-sm-12 ">
            <label >Local Charges</label>
            <table id="lc_section" class="table table-striped table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Remarks</th> 
                </tr>
                <?php 
                if(@$lc){
                  foreach ($lc as $rs) {
                    $arr_lc[$rs->id] = $rs->title;
                  }
                }

                $lc_ttl = 0;

                if(@$lc_used){
                  foreach($lc_used as $rs){?>
                <tr>
                  <td><?=@$arr_lc[$rs->lc_id]?></td>
                  <td align="right"><?=number_format($rs->amt,2); $lc_ttl+=$rs->amt?></td>
                  <td><?=$rs->remarks?></td>
                </tr>
                <?php }}else{?>
                <tr>
                  <td colspan="3"><center><i>no data</i></center></td>
                </tr>
                <?php }?>  
              </table>
          </div>

          <div class="col-md-4 col-sm-12 ">
            <label >Totals</label>
            <table id="lc_section" class="table table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <td>Total FOB</td> 
                  <td align="right"><?=$rr->currency?> <span id="fob_grand_ttl"><?=number_format($ttl_f,2)?></span></td>
                  <td align="right">QAR <span id="fob_grand_ttl"><?=number_format($ttl,2)?></span></td>
                </tr>
                <tr style="font-size: 12px;"> 
                  <td>Total Foreign Charges </td> 
                  <td align="right"><?=$rr->currency?> <font id="fc_txt_ttl"><?=number_format($fc_ttl,2);?></font></td>
                  <td align="right">QAR <font id="fc_txt_ttl"><?=number_format($fc_ttl*$rr->exchange_rate,2);?></font></td>
                </tr>
                <tr style="font-size: 12px;"> 
                  <td>Total Local Charges </td> 
                  <td align="right" id="lc_ttl"><?=$rr->currency?> <font id="lc_txt_ttl"><?=number_format($lc_ttl,2);?></font></td>
                  <td align="right" id="lc_ttl">QAR <font id="lc_txt_ttl"><?=number_format($lc_ttl,2);?></font></td>
                </tr>
                <tr>
                  <td colspan="2"><b>Grand Total</b></td>  
                  <td align="right"><b>QAR <span id="grand_ttl"><?=number_format($ttl+($fc_ttl*$rr->exchange_rate)+$lc_ttl,2)?></span></b></td>
                </tr>
              </table>
          </div>

        </div>
  
      </div>

      
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function load_items(po_id){
    $('#load_items').load('<?=base_url("receiving/load_items")?>/'+po_id);
  }

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

  function confirm_rr(){
    reset(); 

    alertify.confirm("Confirm selected receiving records?", function (e) {
          if (e) {  
              alertify.log("saving...");
              location.href = "<?php echo base_url();?>receiving/confirm_receiving/<?=$rr->id?>";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  $('#gmodal').addClass('modal-lg-mod');

</script>