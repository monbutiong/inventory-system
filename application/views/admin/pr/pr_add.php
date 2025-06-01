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
        <h2>Purchase Request<small>New</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" name="pr_form" action="<?php echo base_url('pr/save_pr');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">

            <div class="row">
              <!-- <div class="col-md-4">

                  <label for="request_type_id">Request Type
                  </label> 
                       <select name="request_type_id" id="request_type_id" required="required" class="select2_ form-control">
                        <option value="">select</option>
                        <?php 
                        if(@$type){
                          foreach($type as $rs){?>
                        <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                        <?php }}?>
                    </select> 

              </div> -->
              <div class="col-md-3">

                    <label for="project_id">Control Number Type *
                    </label> 
                         <select onchange="show_cn(this.value)" name="control_number_type" id="control_number_type"  class="form-control">
                          <option value=""></option>
                          <option value="1">Purchasing Control Number</option>
                          <option value="2">Sales Control Number</option>
                      </select> 
              
              </div>

              <div class="col-md-3">

                    <span id="load_cn">
                      <label for="project_id">Control Number *
                    </label>
                      <input type="text" class="form-control" disabled value="--">
                    </span>
              
              </div>
              <div class="col-md-3">

                    <label id="name_label" for="project_id">
                      Project Name
                    </label> 
                         <input type="text" disabled id="project_name"   class="form-control"/>
              </div>
              <div class="col-md-3">
         
                  <label for="remarks">Remaks
                  </label> 
                    <input type="text" name="remarks" id="remarks" value="<?php echo @$inv->slot?>" class="form-control"/>
               </div>
            </div> 
         </div>
 

          <div class="form-group"> 
            <label for="last-name">Request Item(s)
            </label> 

            <table id="item_table" class="table table-striped table-bordered table-hover">
              <tr>
                <th>Item Code</th> 
                <th>Item Name</th>
                <th>Description</th> 
                <th align="center"><center>Quantity</center></th>
                <!-- <th align="center"><center>Control Number</center></th> -->
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

          <?php 
          if(@$users){
            foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
          }}
          ?>
          
          <div class="row">
            <center>
            <?php if(@$arr_user[$approver->pr1]){?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">1st Approver</label> 
                <p><u><?=@$arr_user[$approver->pr1]?></u></p> 
              </center>
            </div>
            <?php }?>
            <?php if(@$arr_user[$approver->pr2]){?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">2nd Approver</label> 
                <p><u><?=@$arr_user[$approver->pr2]?></u></p> 
              </center>
            </div>
            <?php }?>
            <?php if(@$arr_user[$approver->pr3]){?>
            <div class="col-md-4"> 
              <center>
                <label for="remarks">3rd Approver</label> 
                <p><u><?=@$arr_user[$approver->pr3]?></u></p> 
              </center>
            </div>
            <?php }?>
             </center>
          </div>

  
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="pull-right">
                  
                <input type="hidden" name="row_counter" id="row_counter">

                <input type="hidden" id="selected_ids">

                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
           
                <button type="button" id="sbtn" class="btn btn-success" onclick="save_pr()">Submit PR</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">

  function show_cn(type){ 
    $('#load_cn').load('<?=base_url("pr/load_cn")?>/'+type, function(){
       $('.select2x').select2();
    });
  }

  function enable_add_item(id,type){

    $('#project_name').val('');

    if(type == 1){

      $('#name_label').html('Inventory Accounts');

      $.get("<?=base_url('pr/load_account')?>/"+id, function(data, status){
          $('#project_name').val(data);
      });

    }else{

      $('#name_label').html('Project Name');

      $.get("<?=base_url('accounts/load_project')?>/"+id, function(data, status){
          $('#project_name').val(data);
      });

    }

  }

  $(".select2-ajax").select2({
   placeholder: "Select Item", 
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
  
  var c = 0;
  var all = 0; 

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
    }else if($('#control_number_type').val() == ''){
      alertify.alert('Please select control number type.');
    }else if($('#project_name').val() == ''){
      alertify.alert('Please select control number .');
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