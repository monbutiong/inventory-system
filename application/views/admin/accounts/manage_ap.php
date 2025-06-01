<style>
 
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
        <h2>Account Payable<small>Records</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" name="ap_form" action="<?php echo base_url('accounts/save_ap/'.$rr->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">
 
            <table id="item_table" class="table table-striped table-bordered table-hover">
              <tr>
                <th>Cheque Number</th>  
                <th>Cheque Date</th>  
                <th>Collection Date</th>  
                <th>Description</th> 
                <th>Date</th> 
                <th align="center"><center>Credit</center></th>
                <th align="center"><center>Debit</center></th>
                
                <th width="5%">Option</th> 
              </tr>
              <?php
               
              $ttl_credit = 0;

              if(@$received_items){
              foreach ($received_items as $rs) { 
                $ttl_credit+=round(@$rs->qty * $rs->price, 2);
              }}
              ?>
              <tr>
                <td>-</td>
                <td>-</td> 
                <td>-</td> 
                <td nowrap>Received Inventory</td> 
                <td><?=date('Y-m-d',strtotime($rr->date_created))?></td>
                <td align="right"><?=number_format($ttl_credit, 2) ?></td>
                <td></td>
                <td></td> 
              </tr>
              <?php 
              

              $row_count = 0;
              $ttl_debit = 0;
              if(@$accounts_payable){
              foreach($accounts_payable as $rs){
              $row_count+=1;

              if($rr->closed_rr == 1){
              ?>
              <tr id="row_data<?=$row_count?>">
                <td><?=$rs->cheque_number?></td>
                <td><?=$rs->cheque_date?></td>
                <td><?=$rs->collection_date?></td>
                <td><?=$rs->description?></td>
                <td><?=$rs->date_created?></td>
                <td></td>
                <td align="right"><?=number_format($rs->amount,2)?></td>
                <td></td>
              </tr>
            <?php }else{?>
              <tr id="row_data<?=$row_count?>">
                <td>
                  <input type="text" name="cheque_number<?=$row_count?>" class="form-control text_input" value="<?=$rs->cheque_number?>" placeholder="Type Cheque Number">
                  <input type="hidden" id="id<?=$row_count?>" name="id<?=$row_count?>" value="<?=$rs->id?>">
                  <input type="hidden" id="del<?=$row_count?>" value="0">
                </td>
                <td><input type="date" name="cheque_date<?=$row_count?>" class="form-control text_input" value="<?=$rs->cheque_date?>" ></td>
                <td><input type="date" name="collection_date<?=$row_count?>" class="form-control text_input" value="<?=$rs->collection_date?>" ></td>
                <td><input type="text" name="description<?=$row_count?>" class="form-control text_input" value="<?=$rs->description?>" placeholder="Type Description"></td>
                <td><?=date('Y-m-d',strtotime($rs->date_created))?></td>
                <td></td>
                <td><input type="text" id="amount<?=$row_count?>" name="amount<?=$row_count?>" class="form-control text_input" value="<?=$rs->amount?>" style="text-align:right;"></td>
                <td><i class="fa fa-remove" onclick="remove_row(<?=$row_count?>)"></i></td>
              </tr>
              <?php 
            }

              $ttl_debit+=$rs->amount; }}
              ?> 
              <tr id="item_selector" >
                <td align="right" colspan="5"><b>Total</b></td>
                <td align="right"><b><span id="ttl_credit"><?=number_format($ttl_credit,2)?></span></b></td>
                <td align="right"><b><span id="ttl_debit"><?=number_format($ttl_debit,2)?></span></b></td>
                <td><input type="hidden" id="closed_po" name="closed_po" value="0"></td>
              </tr>

            </table>
            <?php if($rr->closed_rr == 0){?>
            <button class="btn btn-primary" type="button" onclick="add_row()">Add Entry</button>
            <?php }?>
          </div>

  
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="pull-right">
                
                <input type="hidden" id="counter" name="counter">

                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                <?php if($rr->closed_rr == 0){?>
                <button type="button" class="btn btn-success" onclick="save_ap()">Save</button>
                <?php }?>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
  var c = <?=$row_count?>;

  $('#counter').val(c);

  function add_row(){

    c = c + 1;

    $('#item_selector').before('<tr id="row_data'+c+'"> <td><input type="text" id="cheque_number'+c+'" name="cheque_number'+c+'" class="form-control text_input" placeholder="Type Cheque Number"><input type="hidden" id="del'+c+'" value="0"></td> <td><input type="date" id="cheque_date'+c+'" name="cheque_date'+c+'" class="form-control text_input"></td> <td><input type="date" id="collection_date'+c+'" name="collection_date'+c+'" class="form-control text_input"></td> <td><input type="text" id="description'+c+'" name="description'+c+'" class="form-control text_input" placeholder="Type Description"></td> <td><?=date("Y-m-d")?></td> <td></td> <td><input type="text" id="amount'+c+'" name="amount'+c+'" class="form-control text_input" style="text-align:right;" onkeyup="compute()"></td> <td width="5%"><i onclick="remove_row('+c+')" class="fa fa-remove"></i></td> </tr>');

    $('#counter').val(c);
  }



  function number_format(number, decimals, dec_point, thousands_point) {

      if (number == null || !isFinite(number)) {
          throw new TypeError("number is not valid");
      }

      if (!decimals) {
          var len = number.toString().split('.').length;
          decimals = len > 1 ? len : 0;
      }

      if (!dec_point) {
          dec_point = '.';
      }

      if (!thousands_point) {
          thousands_point = ',';
      }

      number = parseFloat(number).toFixed(decimals);

      number = number.replace(".", dec_point);

      var splitNum = number.split(dec_point);
      splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
      number = splitNum.join(dec_point);

      return number;
  }

  function compute(){
    var l = 0;
    var ttl = 0;
    while(c > l){
      l+=1;
      if($('#del'+l).val() == 0){
        ttl+=Number($('#amount'+l).val());
      }
    }
    ttl = number_format(ttl,2);
    $('#ttl_debit').html(ttl);
  }

  function save_ap(){
 
      reset(); 

      if($('#ttl_credit').html()==$('#ttl_debit').html()){

          alertify.confirm("Save and close P.O. status? this will disable the edit option.", function (e) {
              if (e) {  

                $('#closed_po').val(1);

                document.ap_form.submit();
              } 
            }, "Confirm");

      }else{

          alertify.confirm("save accounts payable?", function (e) {
              if (e) {  
                document.ap_form.submit();
              } 
            }, "Confirm");

      }
 
  }

  function remove_row(ci){

    $('#del'+ci).val(1);

    var id = $('#id'+ci).val();

    $('#amount'+ci).val('');

    if(id){
      var ans = confirm("Remove entry?");
      if(ans){
        $.get("<?=base_url('accounts/remove_ap')?>/"+id, function(data, status){
            $('#row_data'+ci).remove();
          });
      }
    }else{
      $('#row_data'+ci).remove();
    }
    compute()
  }

  $('#gmodal').addClass('modal-lg-mod'); 
</script>