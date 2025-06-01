<style>
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
        <h2>Income Projection</h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('sales/save_tnc');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">
 
            <table class="table table-bordered table-hover ">
              <tr>
                <td><h4><b>Current Project Cost: </b></h4></td>
                <td align="right"><h4><b><font id="prjcost"></font></b></h4></td>
              </tr>
              <tr>
                <td><h4><b>Current Project Amount: </h4></b></td>
                <td width="25%" align="right"><h4><b><font id="pamount"></font></b></h4></td>
              </tr>
              <tr>
                <td><h4><b>Current Applied Average Margin: </h4></b></td>
                <td width="25%" align="right"><h4><b><font id="ave_margin_copy"></font>%</b></h4></td>
              </tr>
            </table>
            <script type="text/javascript">
              $('#ave_margin_copy').html($('#ave_margin').val());
            </script>
             
            <table class="table table-bordered table-striped table-hover ">
              <tr>
                <td><h4>Margin</h4></td>
                <td nowrap><input id="mrg1" onkeyup="update_mrgn()" onchange="update_mrgn()" type="number" style="width: 90%; border: 0; text-align: right; height: 30px; font-size: 14px;" value="20">%</td>
                <td nowrap><input id="mrg2" onkeyup="update_mrgn()" onchange="update_mrgn()" type="number" style="width: 90%; border: 0; text-align: right; height: 30px; font-size: 14px;" value="25">%</td>
                <td nowrap><input id="mrg3" onkeyup="update_mrgn()" onchange="update_mrgn()" type="number" style="width: 90%; border: 0; text-align: right; height: 30px; font-size: 14px;" value="30">%</td>
                <td nowrap><input id="mrg4" onkeyup="update_mrgn()" onchange="update_mrgn()" type="number" style="width: 90%; border: 0; text-align: right; height: 30px; font-size: 14px;" value="35">%</td> 
              </tr>
              <tr>
                <td nowrap><h5>Projected Amount</h5></td>
                <td align="right"><input id="prct1" class="mask-money" onkeyup="update_mrgn_price(1)" onchange="update_mrgn_price(1)" type="text" style="width: 100%; border: 0; text-align: right; height: 30px; font-size: 14px;" ></td>
                <td align="right"><input id="prct2" class="mask-money" onkeyup="update_mrgn_price(2)" onchange="update_mrgn_price(2)" type="text" style="width: 100%; border: 0; text-align: right; height: 30px; font-size: 14px;" ></td>
                <td align="right"><input id="prct3" class="mask-money" onkeyup="update_mrgn_price(3)" onchange="update_mrgn_price(3)" type="text" style="width: 100%; border: 0; text-align: right; height: 30px; font-size: 14px;" ></td>
                <td align="right"><input id="prct4" class="mask-money" onkeyup="update_mrgn_price(4)" onchange="update_mrgn_price(4)" type="text" style="width: 100%; border: 0; text-align: right; height: 30px; font-size: 14px;" ></td> 
              </tr>
              <tr>
                <td nowrap><h5><b>Projected Income</b></h5></td>
                <td align="right"><b><h4 id="xprct1" style="font-weight: bold;">0.00</h4></b></td>
                <td align="right"><b><h4 id="xprct2" style="font-weight: bold;">0.00</h4></b></td>
                <td align="right"><b><h4 id="xprct3" style="font-weight: bold;">0.00</h4></b></td>
                <td align="right"><b><h4 id="xprct4" style="font-weight: bold;">0.00</h4></b></td> 
              </tr>
            </table>

          </div>  

           
           
        

        </form>
      </div>
    </div>
  </div>
</div> 
 
 <script type="text/javascript">

  function numberFormat(number, decimals = 2, decimalSeparator = '.', thousandsSeparator = ',') {
      number = parseFloat(number);

      if (isNaN(number) || !isFinite(number)) {
          return 'Invalid number';
      }

      const fixedNumber = number.toFixed(decimals);
      const parts = fixedNumber.toString().split('.');
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);

      return parts.join(decimalSeparator);
  }

   var gtotal = $('#grand_total').val();

   var fgtotal = $('#f_grand_total').val();
   var project_cost_total = parseFloat(fgtotal.replace(/,/g, ''));
   var avemargin = $('#ave_margin').val();

   var fgtotala = $('#f_grand_proj_cost').val();
 
   $('#prjcost').html(fgtotal);
   $('#pamount').html(fgtotala);
   $('#amargn').html(avemargin); 

   // $rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost

   function comp_ttl_mrg(){
      var mrg1 = $('#mrg1').val(); 
      var projection1 = (gtotal/(1-(mrg1/100)))-gtotal;  
      projection1=Number(projection1)+Number(gtotal);
      $('#prct1').val(projection1.toFixed(2));
      $('#xprct1').html(numberFormat(projection1.toFixed(2) - project_cost_total));

      var mrg2 = $('#mrg2').val(); 
      var projection2 = (gtotal/(1-(mrg2/100)))-gtotal; 
      projection2=Number(projection2)+Number(gtotal);
      $('#prct2').val(projection2.toFixed(2));
      $('#xprct2').html(numberFormat(projection2.toFixed(2) - project_cost_total));

      var mrg3 = $('#mrg3').val(); 
      var projection3 = (gtotal/(1-(mrg3/100)))-gtotal; 
      projection3=Number(projection3)+Number(gtotal);
      $('#prct3').val(projection3.toFixed(2));
      $('#xprct3').html(numberFormat(projection3.toFixed(2) - project_cost_total));

      var mrg4 = $('#mrg4').val(); 
      var projection4 = (gtotal/(1-(mrg4/100)))-gtotal;  
      projection4=Number(projection4)+Number(gtotal);
      $('#prct4').val(projection4.toFixed(2));
      $('#xprct4').html(numberFormat(projection4.toFixed(2) - project_cost_total));
 
   }

   function update_mrgn_price(mi){

      var prct1 = $('#prct'+mi).val(); 
      var projection1 = (gtotal/prct1)*100;   
      $('#mrg'+mi).val(100-projection1.toFixed(2));
      $('#xprct'+mi).html(numberFormat(parseFloat(prct1.replace(/,/g, '')) - project_cost_total));

   }

   comp_ttl_mrg();

   function update_mrgn(){
      comp_ttl_mrg();
   }
   
   $('.mask-money').inputmask('currency', {
       prefix: '',        // Currency symbol (e.g., '$')
       suffix: '',        // Suffix (e.g., ' USD')
       thousandsSeparator: ',', // Thousands separator (e.g., ',')
       decimalSeparator: '.',   // Decimal separator (e.g., '.')
       allowMinus: false, // Allow negative values
       allowPlus: false,  // Allow positive values
       rightAlign: false, // Align to the left
       autoUnmask: true,  // Remove mask on focus
   });
 </script>
