<style type="text/css">
  #loadingOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 4px solid #fff;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.zform_wizard .zstepContainer {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    border: 0 solid #CCC;
    overflow-x: hidden;
    overflow-y: hidden; /* Add this line to prevent vertical scrolling */
  }
</style>
<div id="loadingOverlay" style="display: none;">
       <div class="spinner"></div>
</div>
 <div class="row">

         <div class="col-md-12 col-sm-12 ">
           <div class="x_panel">
             <div class="x_title">
               <h2>Sales <small>  Quotation</small></h2>
               <ul class="nav navbar-right panel_toolbox">
                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                 </li>
                 <!-- <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                   <ul class="dropdown-menu" role="menu">
                     <li><a href="#">Settings 1</a>
                     </li>
                     <li><a href="#">Settings 2</a>
                     </li>
                   </ul>
                 </li>
                 <li><a class="close-link"><i class="fa fa-close"></i></a>
                 </li> -->
                  
                 </li>
               </ul>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">


                <div class="alert alert-success" role="alert">
                    <h4>Your quotation has been saved successfully.</h4>
                  
                  </div> 
               <!-- End SmartWizard Content --> 
      </div>
    </div>
  </div> 
    

</div>

<script type="text/javascript">
var loc = 1; 
var loc_ttl = 1; 
function add_row(exist) {
  
  $('.stepContainer').css('height', '');

  var newRowHtml = '<tr id="lrow' + (loc + Number(exist)) + '"><td><input type="text" id="new_loc' + (loc + Number(exist)) + '" name="new_loc' + (loc + Number(exist)) + '" class="form-control" style="width: 100%;"></td><td><a href="javascript:ddel(' + (loc + Number(exist)) + ',0)"><i class="fa fa-trash"></i> delete</a></td></tr>';
  
  $('#add_row').prev('tr').after(newRowHtml);
  loc += 1;
  loc_ttl = (loc + Number(exist));
}


var itm = 1; 
var itm_ttl = 1; 

function add_item_row(l_id,exist) {
  
  $('.stepContainer').css('height', '');

  var newRowHtml = '<tr id="irow' + (itm + Number(exist)) + '"><td><input type="text" id="new_loc' + (itm + Number(exist)) + '" name="new_loc' + (itm + Number(exist)) + '" class="form-control" style="width: 100%;"></td><td><a href="javascript:idel(' + (itm + Number(exist)) + ',0)"><i class="fa fa-trash"></i> delete</a></td></tr>';
  
  $('#add_row').prev('tr').after(newRowHtml);
  itm += 1;
  itm_ttl = (itm + Number(exist));
}

function ddel(id,tp) {
  if(tp > 0){
    alertify.confirm("Confirm the deletion of the selected location. This action will permanently remove items associated with this location, and the deletion cannot be undone.", function (e) {
          if (e) { 
             $.get("<?=base_url('sales/delete_location')?>/"+tp, function(data) { 
                 alertify.log("Deleted successfuly.");
             });
             $('#lrow'+id).remove();
          }
    });
  }else{
    alertify.confirm("Delete selected location?", function (e) {
          if (e) { 
             $('#lrow'+id).remove();
          }
    });
  }
}

function repli() {
  var txtE = $('#editor-one').html();
  $('#terms_and_conditions').val(txtE);
}

function delete_bib(id){
  reset(); 

  alertify.confirm("delete quotation information? this will permanently delete selected client records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>sales/delete_quotations/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

// Function to handle the beforeunload event
function beforeUnloadHandler(e) {
    // Display a confirmation message
    if ($("#quotation_id").val()) {
        var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave this page?';

        // Set the message in some browsers
        e.returnValue = confirmationMessage;

        // Return the message (modern browsers)
        return confirmationMessage;
    }
}

// Add the beforeunload event listener to the window
window.addEventListener('beforeunload', beforeUnloadHandler);

//========== this function is needeed dont delete
function save_transaction (){
  alertify.confirm("Save quotation?", function (e) {
        if (e) {  
            window.removeEventListener('beforeunload', beforeUnloadHandler);
            alertify.log("saving..."); 
            location.href = "<?php echo base_url();?>sales/save_quotation/"+$("#quotation_id").val();
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

