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
         

        <h2>Quotation<small>Add Terms and Conditions Template</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>

      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('purchasing/save_tnc');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="title"  value="<?php echo @$i->title?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                 <textarea class="elm1" name="description"></textarea>
            </div>
          </div>

          <div class="row mb-3" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Arabic Description
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                 <textarea class="elm1" name="arabic"></textarea>
            </div>
          </div>
 

           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save</button>
 
               
            </div>
          </div>

          

        </form>
      </div>
    </div>
  </div>
</div> 
 
 <script type="text/javascript">
   $('.editor-wrapper2').each(function(){
       var id = $(this).attr('id');   
       $(this).wysiwyg(); 
   });

   function repli() {
     var txtE = $('#editor-one').html();
     $('#terms_and_conditions').val(txtE);
   }
 </script>
