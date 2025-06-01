<style>
.datepicker{z-index:1151 !important;}
#datatable 
{    
  overflow-y:hidden; 
}
select, .text_input {
    border: 1px solid #fff;
    background-color: transparent;
    width: 100%;
} 
.vcc{
  border-bottom-color: #999;
}
</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales<small>New Quotation</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" name="pr_form" action="<?php echo base_url('sales/save_quotations');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">

            <div class="row">

              <div class="col-md-2">
         
                  <label for="remarks">Date </label> 
                  <input type="date" name="quotation_date" id="quotation_date" value="<?php echo @$qoutation->quotation_date ? $qoutation->quotation_date :  date('Y-m-d')?>" class="form-control" />

               </div>

              <div class="col-md-2">

                  <label for="request_type_id">Quotation Type
                  </label> 
                    <select name="quotation_type_id" id="quotation_type_id" required="required" class="select2_ form-control">
                        <option value="">select</option>
                        <?php 
                        if(@$quotation_type){
                          foreach($quotation_type as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                        <?php }}?>
                    </select> 

              </div>
              <div class="col-md-2">

                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo @$qoutation->title?>" class="form-control"/>
              
              </div>

              
              
               <div class="col-md-2">

                  <label for="quotation_type_id">Client
                  </label> 
                       <select name="client_id" id="client_id" required="required" class="select2_ form-control" onchange="load_client_info(this.value)">
                        <option value="">select</option>
                        <?php 
                        if(@$clients){
                          foreach($clients as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
                        <?php }}?>
                    </select> 

              </div>
              <div class="col-md-2">
         
                  <label for="remarks">Attention </label> 
                  <input type="text" name="attention_to" id="attention_to" value="<?php echo @$qoutation->remarks?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="quotation_to">To </label> 
                  <input type="text" name="quotation_to" id="quotation_to" value="<?php echo @$qoutation->quotation_to?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="fax">Fax </label> 
                  <input type="text" name="fax" id="fax" value="<?php echo @$qoutation->fax?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="phone">Phone </label> 
                  <input type="text" name="phone" id="phone" value="<?php echo @$qoutation->phone?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="address">Address </label> 
                  <input type="text" name="address" id="address" value="<?php echo @$qoutation->address?>" class="form-control"/>

               </div>

               

               <div class="col-md-2">
         
                  <label for="account_name">Account Name </label> 
                  <input type="text" name="account_name" id="account_name" value="<?php echo @$qoutation->account_name?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="bank_name">Bank Name </label> 
                  <input type="text" name="bank_name" id="bank_name" value="<?php echo @$qoutation->bank_name?>" class="form-control"/>

               </div>

               <div class="col-md-2">
         
                  <label for="account_no">Account No. </label> 
                  <input type="text" name="account_no" id="account_no" value="<?php echo @$qoutation->account_no?>" class="form-control"/>

               </div>
            </div> 
         </div>
 

          <div class="form-group">

            <label for="last-name">Project(s)
            </label> 

            <table id="item_table" class="table table-striped table-bordered table-hover">
              <tr> 
                <th><center>Item Name</center></th> 
                <th align="center"><center>Quantity</center></th>
                <th align="center"><center>Unit Price</center></th>
                <th align="center"><center>Sub Total</center></th>
                <th align="center"><center>Remarks</center></th>
                <th align="center"><center>Option</center></th>
              </tr>
              <tr id="item_selector">
                <td colspan="5" class="add_item">
                  <div class="select2-ajax" style="width: 100%;"> 
                  </div>
                </td>  
              </tr>
            </table>
          </div>

           <div class="form-group">

             <div class="row">
               
                <div class="col-md-2">

                  <label for="currency_type_id">Currncy Type
                  </label> 
                       <select name="currency_type_id" id="currency_type_id" required="required" class="select2_ form-control">
                        <option value="">select</option>
                        <?php 
                        if(@$currency_type){
                          foreach($currency_type as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                        <?php }}?>
                    </select> 

              </div>
               <div class="col-md-2">
          
                   <label for="expiry_date">Expiry Date</label> 
                   <input type="date" name="expiry_date" id="expiry_date" value="<?php echo @$qoutation->expiry_date?>" class="form-control"/>

                </div>
                <div class="col-md-2">
          
                   <label for="delivery">Delivery </label> 
                   <input type="text" name="delivery" id="delivery" value="<?php echo @$qoutation->delivery?>" class="form-control"/>

                </div>

                <div class="col-md-2">
          
                   <label for="payment">Payment </label> 
                   <input type="text" name="payment" id="payment" value="<?php echo @$qoutation->payment?>" class="form-control"/>

                </div>

                <div class="col-md-2">
          
                   <label for="warranty">Warranty </label> 
                   <input type="text" name="warranty" id="warranty" value="<?php echo @$qoutation->warranty?>" class="form-control"/>

                </div>

                <div class="col-md-2">
          
                   <label for="remarks">Remarks </label> 
                   <input type="text" name="remarks" id="remarks" value="<?php echo @$qoutation->remarks?>" class="form-control"/>

                </div>

                <div class="col-md-2">

                  <label for="person_in_charge">Person In Charge
                  </label> 
                       <select name="person_in_charge" id="person_in_charge" required="required" class="select2_ form-control">
                        <option value="">select</option>
                        <?php 
                        if(@$users){
                          foreach($users as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
                        <?php }}?>
                    </select> 

              </div>

              <div class="col-md-2">

                  <label for="approved_by">Approved By
                  </label> 
                       <select name="approved_by" id="approved_by" required="required" class="select2_ form-control">
                        <option value="">select</option>
                        <?php 
                        if(@$users){
                          foreach($users as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
                        <?php }}?>
                    </select> 

              </div>


             </div> 
          </div> 

  
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="pull-right">
                  
                <input type="hidden" name="row_counter" id="row_counter">

                <input type="hidden" id="selected_ids">

                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
           
                <button type="button" id="sbtn" class="btn btn-success" onclick="save_pr()">Save Quotation</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">

  function number_format(number,decimals,dec_point,thousands_sep) {
    number  = number*1;//makes sure `number` is numeric value
    var str = number.toFixed(decimals?decimals:0).toString().split('.');
    var parts = [];
    for ( var i=str[0].length; i>0; i-=3 ) {
        parts.unshift(str[0].substring(Math.max(0,i-3),i));
    }
    str[0] = parts.join(thousands_sep?thousands_sep:',');
    return str.join(dec_point?dec_point:'.');
  }

  function compute(id) {
      
      var q = Number($('#qty'+id).val());
      var p = Number($('#price'+id).val());

      var t = Number(q * p);

      $('#ttl'+id).html(number_format(t, 2,'.',','));
  
  }

  function load_client_info(id){
    $.get("<?=base_url('sales/find_client')?>/"+id, function(data, status){
        var r = JSON.parse(data);
        console.log('datas',r)
        $('#attention_to').val(r.attension_to);
        $('#fax').val(r.fax_no);
        $('#phone').val(r.phone);
        $('#address').val(r.address);
        enable_add_item()
      });
  }

  function enable_add_item(){

    $(".select2-ajax").select2({
     placeholder: "Select Item", 
     ajax: { 
      url: "<?=base_url("sales/search_project")?>",
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
               return { id: obj.id, text: obj.text };
          })
      };
      },
      cache: true
     }
    });

  }
 

  var c = 0;
  var all = 0; 

  $(".select2-ajax").on("select2-selecting", function(e) {
      
 

      console.log('slected', e.object);

        if($('#tr'+e.object.id).length == 0) {

          $('#selected_ids').val($('#selected_ids').val() + '(' + e.object.id + ')-');
      
          $('#item_selector').before('<tr id="tr'+e.object.id+'"><td>'+e.object.text+'<input type="hidden" name="qprojects['+e.object.id+'][id]" value="'+e.object.id+'"/></td> <td><input type="number" class="text_input" id="qty'+e.object.id+'" name="qprojects['+e.object.id+'][qty]" onkeyup="compute('+e.object.id+')"></td> <td><input type="number" id="price'+e.object.id+'" class="text_input" name="qprojects['+e.object.id+'][price]" onkeyup="compute('+e.object.id+')"></td> <td align="right"><span id="ttl'+e.object.id+'">0.00</span></td> <td><input type="text" class="text_input" name="qprojects['+e.object.id+'][remarks]"></td> <td align="center"><a href="Javascript:remove_item('+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
        }
 

      $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
      $('.selecta'+c).select2();
      all+=1;

      $('#row_counter').val(c);
  }); 

  $(".select2-ajax").val('').trigger('change');

  function remove_item(id){
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }
 

  function save_pr(){

    if($('#request_type_id').val() == ''){
      alertify.alert('purchase request type required.');
    }else if(all <= 0){
      alertify.alert('atleast add 1 item to purchase request.');
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

  $('#gmodal').addClass('modal-lg-mod'); 
</script>