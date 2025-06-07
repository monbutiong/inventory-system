<style type="text/css">
  .select2-search-choice{
    background-color: #e3efff; 
  }
  .select2-search-choice-close{
    color: #000 !important;
    content: 'x' !important; 
  }
  .select2-search-choice-close:hover::before {
      color: darkred;
  }
  .readonlyx{
    border: 1px dashed #999;
    background-color: #f9f9f9;
  }
</style>
<form method="post" name="frm_receiving" action="<?=base_url('receiving/save_receiving')?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
         

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Create GRV</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-md btn-primary" href="Javascript:save_receiving()"  >Save Receiving</a>
                    </div>
                </div>
            </div>
        </div>


      </div>
      <div class="x_content">

        <div class="card">
            <div class="card-body">

              <p class="text-muted font-13 m-b-30">
       
                <div class="row">
                  
                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control " onchange="load_supplier_po(this.value)">
                      <option value="">select</option> 
                      <?php 
                      if($suppliers){
                        foreach ($suppliers as $rs) { 
                      ?>
                      <option  value="<?=$rs->id?>"><?=$rs->name?></option>
                    <?php }}?>
                    </select>
                    
                  </div>

                  <div class="col-md-10 col-sm-12 mb-3">
                    <label >P.O. Details *</label>
                    <div id="pos">
                      <input type="text" disabled class="form-control">
                    </div>
                    
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >DR Number <font color="red">*</font></label>
                    <input type="text" required name="dr_number" id="dr_number" class="form-control">
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Delivery Date <font color="red">*</font></label>
                    <input type="date" required name="delivery_date" id="delivery_date" class="form-control">
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Invoice Number <font color="red">*</font></label>
                    <input type="text" required name="invoice_number" id="invoice_number" class="form-control">
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Invoice Date <font color="red">*</font></label>
                    <input type="date" required name="invoice_date" id="invoice_date" class="form-control">
                  </div>

                  <div class="col-md-4 col-sm-12 mb-3">
                    <label >Attachments</label>
                    <input type="file" name="attach[]" multiple="" class="form-control">
                  </div>
                   
                  <div class="col-md-4 col-sm-12 mb-3">
                    <label >Remarks </label>
                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Transport</label>
                    <select required id="grv_transport_id" name="grv_transport_id" class="form-control">
                      <option value="0">select</option>
                      <?php 
                      if(@$grv_transport){
                        foreach ($grv_transport as $rs) { 
                      ?>
                      <option value="<?=$rs->id?>"><?=$rs->title?></option>
                      <?php }}?>
                    </select>
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Exchange Rate</label>
                    <input type="text" readonly id="exchange_rate" name="exchange_rate" class="form-control readonlyx" value="0.00">
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >Currency</label>
                    <input type="text" readonly id="currency" name="currency" class="form-control readonlyx" >  
                  </div>

                  <div class="col-md-2 col-sm-12 mb-3">
                    <label >L/C Factor</label>
                    <input type="text" readonly id="lc_factor" name="lc_factor" value="0" class="form-control readonlyx" >  
                  </div>
                    
                </div> 

              </p>
       
              
              <!-- <div id="load_items"></div> -->

              <table id="pos_table" class="table table-striped table-bordered table-hover">
               
                <thead>
                  <tr style="font-size: 12px;"> 
                    <th>P.O. No.</th>
                    <th>Part No.</th>
                    <th>Description</th>
                    <th>Qty in P.O.</th>
                    <th>Unit Price</th>
                    <th width="10%">Total Price</th>
                    <th>Prev. Received Qty</th>  
                    <th>Receive Qty</th>
                    <th>Bad Qty</th>
                    <th>Receive Total <span class="fob_symbol">QAR</span></th>
                    <th colspan="2">Remarks</th>  
                  </tr>
                  </thead> 
                  <tbody>
                   

                  <tr id="recieve_section">
                    
                    <td colspan="12">
                      <a id="add_items_btn" class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('receiving/load_supplier_po_items');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl" > Add Receive Items </a>
                    </td>

                  </tr>

                 </tbody>

              </table> 


              <div class="row">
                 
                <div class="col-md-4 col-sm-12 mb-3">
                  <label >Foreign Charges</label>
                  <table id="fc_section" class="table table-striped table-bordered table-hover">  
                      <tr style="font-size: 12px;"> 
                        <th>Description</th>
                        <th>Amount</th>
                        <th colspan="2">Remarks</th> 
                      </tr>
                      <?php  
                      $fc_count = 0;
                      $fc_ttl = 0;
                      if(@$e_fc){
                        foreach ($e_fc as $rse) {
                          $fc_count+=1;
                      ?>
                      <tr id="fc_tr<?=$fc_count?>"> 
                        <td>
                          <select name="fc<?=$fc_count?>" style="width: 100%; border: 0;"> 
                            <option value="">select</option> 
                            <?php foreach($fc as $rs){?> 
                              <option <?php if($rse->fc_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option> 
                              <?php }?> 
                          </select>
                        </td>
                        <td><input type="number" class="all_fc" value="<?=$rse->amt; $fc_ttl+=$rse->amt?>" onkeyup="compute_fc()" name="fc_amt<?=$fc_count?>" style="width: 100%; border: 0;"></td>
                        <td><input type="text" name="fc_remarks<?=$fc_count?>" value="<?=$rse->remarks?>" style="width: 100%; border: 0;"></td>
                        <td><a href="Javascript:del_fc(<?=$fc_count?>)"><i class="fa fa-remove"></i></a></td>
                      </tr>
                      <?php }}?>
                      <tr>
                        <td colspan="4"><a href="Javascript:add_fc()"><i class="fa fa-plus"></i> Add Charges</a></td>
                      </tr>
                    </table>
                </div>

                <div class="col-md-4 col-sm-12 mb-3">
                  <label >Local Charges</label>
                  <table id="lc_section" class="table table-striped table-bordered table-hover">  
                      <tr style="font-size: 12px;"> 
                        <th>Description</th>
                        <th>Amount</th>
                        <th colspan="2">Remarks</th> 
                      </tr>
                      <?php  
                      $lc_ttl = 0;
                      $lc_count = 0;
                      if(@$e_lc){
                        foreach ($e_lc as $rse) {
                          $lc_count+=1;
                      ?>
                      <tr id="lc_tr<?=$lc_count?>"> 
                        <td>
                          <select name="lc<?=$lc_count?>" style="width: 100%; border: 0;"> 
                            <option value="">select</option> 
                            <?php foreach($lc as $rs){?> 
                              <option <?php if($rse->lc_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option> 
                              <?php }?> 
                          </select>
                        </td>
                        <td><input type="number" class="all_lc" value="<?=$rse->amt; $lc_ttl+=$rse->amt;?>" onkeyup="compute_lc()" name="lc_amt<?=$lc_count?>" style="width: 100%; border: 0;"></td>
                        <td><input type="text" name="lc_remarks<?=$lc_count?>" value="<?=$rse->remarks?>" style="width: 100%; border: 0;"></td>
                        <td><a href="Javascript:del_lc(<?=$lc_count?>)"><i class="fa fa-remove"></i></a></td>
                      </tr>
                      <?php }}?>
                      <tr>
                        <td colspan="4"><a href="Javascript:add_lc()"><i class="fa fa-plus"></i> Add Charges</a></td>
                      </tr>
                    </table>
                </div>

                <div class="col-md-4 col-sm-12 mb-3">
                  <label >Totals</label>
                  <table id="lc_section" class="table table-bordered table-hover">  
                      <tr style="font-size: 12px;"> 
                        <th></th> 
                        <th style="text-align: right;"><span class="fob_symbol">QAR</span></th>  
                        <th style="text-align: right;">QAR</th> 
                      </tr>
                      <tr style="font-size: 12px;"> 
                        <td>Total FOB  </td> 
                        <td align="right"><span class="fob_symbol">QAR</span> <span id="fob_grand_ttl">0.00</span></td>
                        <td align="right">QAR <span id="qar_fob_grand_ttl">0.00</span></td>
                      </tr>
                      <tr style="font-size: 12px;"> 
                        <td> Foreign Charges 
                          <input type="hidden" id="fc_amt_ttl" value="<?=$fc_ttl?>">
                          <input type="hidden" id="fc_count" name="fc_count" value="<?=$fc_count?>">
                        </td> 
                        <td align="right"><span class="fob_symbol">QAR</span> <font id="fc_txt_ttl"><?=number_format($fc_ttl,2)?></font></td>
                        <td align="right">QAR <font id="fc_txt_ttl2"><?=number_format($fc_ttl,2)?></font></td>
                      </tr>
                      <tr style="font-size: 12px;"> 
                        <td>  Local Charges
                          <input type="hidden" id="lc_amt_ttl" value="<?=$lc_ttl?>">
                          <input type="hidden" id="lc_count" name="lc_count" value="<?=$lc_count?>">
                        </td> 
                        <td align="right" id="lc_ttl"><?=@$arr_lcr_all[$lcr_selected]->currency_symbol?> <font id="lc_txt_ttl2"><?=number_format($lc_ttl,2)?></font></td>
                        <td align="right" id="lc_ttl">QAR <font id="lc_txt_ttl"><?=number_format($lc_ttl,2)?></font></td>
                      </tr>
                      <tr>
                        <td colspan="2"><b>Grand Total</b></td> 
                        <td align="right"><b>QAR <span id="grand_ttl">0.00</span></b></td>
                      </tr>
                    </table>

                    </div>
          </div>
          </div>

        </div>

        <script type="text/javascript">

          function comp(id){
            
            var prize = $('#price'+id).val();
            var qty = $('#qty'+id).val();
            var ttli = (Number(prize)*Number(qty));
            $('#ttl'+id).html(ttli.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            update_total();
          }
       
          function del_fc(id){
            $('#fc_tr'+id).remove();
            compute_fc();
          }

          function del_lc(id){
            $('#lc_tr'+id).remove();
            compute_lc();
          }

          var fc_count = <?=$fc_count?>;

          function add_fc(){
            fc_count+=1;
            $('#fc_section tr:last').before('<tr id="fc_tr9999999999'+fc_count+'"> <td style="width: 50%"> <select name="fc'+fc_count+'" onchange="enable_fc(this.value,'+fc_count+')" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($fc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_fc" onkeyup="compute_fc()" id="fc_amt'+fc_count+'" name="fc_amt'+fc_count+'" style="width: 100%; border: 0;" disabled></td> <td><input type="text" id="fc_remarks'+fc_count+'" name="fc_remarks'+fc_count+'" style="width: 100%; border: 0;" disabled></td><td><a href="Javascript:del_fc(9999999999'+fc_count+')"><i class="fa fa-remove"></i></a></td></tr>');
          }

          function enable_fc(v,id){
            if(v){
              $('#fc_amt'+id).prop('disabled', false);
              $('#fc_remarks'+id).prop('disabled', false);
            }else{
              $('#fc_amt'+id).prop('disabled', true);
              $('#fc_remarks'+id).prop('disabled', true);
            } 
          }

          function compute_fc(){

            var exchange_rate = $('#exchange_rate').val(); 

            var fc_ttl = 0;
            $('.all_fc').each(function() {
                fc_ttl+=Number($(this).val());
            });

            var fc_conv = fc_ttl * Number(exchange_rate);

            $('#fc_amt_ttl').val(fc_ttl);
            $('#fc_txt_ttl').html(fc_ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#fc_txt_ttl2').html(fc_conv.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#fc_count').val(fc_ttl);
            update_total();
          }

          var lc_count = <?=$lc_count?>;

          function add_lc(){
            lc_count+=1;
            $('#lc_section tr:last').before('<tr id="lc_tr9999999999'+lc_count+'"> <td style="width: 50%"> <select name="lc'+lc_count+'" onchange="enable_lc(this.value,'+lc_count+')" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($lc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_lc" onkeyup="compute_lc()" id="lc_amt'+lc_count+'" name="lc_amt'+lc_count+'" style="width: 100%; border: 0;" disabled></td> <td><input type="text" id="lc_remarks'+lc_count+'" name="lc_remarks'+lc_count+'" style="width: 100%; border: 0;" disabled></td><td><a href="Javascript:del_lc(9999999999'+lc_count+')"><i class="fa fa-remove"></i></a></td> </tr>');
          }

          function enable_lc(v,id){
            if(v){
              $('#lc_amt'+id).prop('disabled', false);
              $('#lc_remarks'+id).prop('disabled', false);
            }else{
              $('#lc_amt'+id).prop('disabled', true);
              $('#lc_remarks'+id).prop('disabled', true);
            } 
          }

          function compute_lc(){
            var lc_ttl = 0;
            $('.all_lc').each(function() {
                lc_ttl+=Number($(this).val());
            });
            $('#lc_amt_ttl').val(lc_ttl);
            $('#lc_txt_ttl').html(lc_ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#lc_txt_ttl2').html('0.00');
            $('#lc_count').val(lc_ttl);
            update_total();
          }

          <?php if(@$lcr_selected){?>
            $('#rate_id').val('<?=$lcr_selected?>-<?=@$arr_cr_rate[@$arr_lcr_all[$lcr_selected]->currency_symbol]?>');
            $('#rate').val('<?=@$arr_lcr_all[$lcr_selected]->landed_cost_rate?>');
            $('#lc_rates').val('<?=@$arr_cr_rate[@$arr_lcr_all[$lcr_selected]->currency_symbol]?>');
          <?php }?>

          <?php if(@$rr_id){?>
            update_total();
          <?php }?>

        </script>
         
      </div>

      
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function load_supplier_po(supplier_id){
    $('#pos').load('<?=base_url("receiving/load_supplier_po")?>/'+supplier_id, function(){

      $('.select2_po').select2(); 

    });
  }

  function load_items(){
    console.log('PO',$('#pos_id').val());

    var poList = $('#pos_id').val();
    var resultString = poList.join('-');

    var myLink = document.getElementById('add_items_btn');
 
    myLink.href = '<?=base_url("receiving/load_supplier_po_items")?>/' + resultString;

    //$('#load_items').load('<?=base_url("receiving/load_items")?>/');
  }

  function idel(id){
    $('#irow' + id).remove();

    update_total();

  }

  function save_receiving() {
      if ($('#pos_id').val() == '') {
          Swal.fire({
              icon: 'error',
              title: 'PO Number is required',
          });
      } else if ($('#dr_number').val() == '') {
          Swal.fire({
              icon: 'error',
              title: 'DR Number is required',
          });
      } else if ($('#invoice_number').val() == '') {
          Swal.fire({
              icon: 'error',
              title: 'Invoice Number is required',
          });
      } else if ($('.all_added_item_list').length == 0) {
          Swal.fire({
              icon: 'error',
              title: 'Received at least one item from the selected P.O.',
          });
      } else { 

          Swal.fire({
              title: 'Are you sure?',
              text: "Save receiving details?",
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, save it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  Swal.fire({
                      title: 'Saving...',
                      icon: 'info',
                      timer: 1000,
                      showConfirmButton: false,
                      didOpen: () => {
                          document.frm_receiving.submit();
                      }
                  });
              }
          });
      }
  }
 
  
  function update_total(){

    var grand = 0;
    var qar_grand = 0;

    $('.all_added_item_list').each(function() {

        var id = $(this).val();  

          var ttl = Number($('#price'+id).val())*Number($('#qty'+id).val()); 

          qar_grand+=ttl;
  
    });
 

    var fob_grand = qar_grand; 

    $('#fob_grand_ttl').html(fob_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var exchange_rate = $('#exchange_rate').val(); 

    qar_grand = qar_grand * Number(exchange_rate);

    $('#qar_fob_grand_ttl').html(qar_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    qar_grand+=Number($('#fc_amt_ttl').val()) * Number(exchange_rate);
    qar_grand+=Number($('#lc_amt_ttl').val());

    var lc_factor = qar_grand/fob_grand;

    $('#lc_factor').val(lc_factor.toFixed(6).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#grand_ttl').html(qar_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
 
  }

</script>