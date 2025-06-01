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
               <h2>Sales <small>Create New Quotation</small></h2>
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
                 <li><a href="<?=base_url('assets/downloadables/Quotation-Template.xlsx')?>" download><i class="fa fa-download"></i> Download Quotation Template</a>
                 <!-- <li><a href="<?=base_url('sales/legalization_fees/1')?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-table"></i> Legal Fees</a>
                 <li><a href="<?=base_url('sales/landed_cost_rate/1')?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" ><i class="fa fa-table"></i> L/C Rates</a>  -->
                 </li>
               </ul>
               <div class="clearfix"></div>
             </div>
             <div class="x_content">


               <!-- Smart Wizard -->
               <!-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> -->
               <div id="wizard" class="form_wizard wizard_horizontal">
                 <ul class="wizard_steps">
                   <li>
                     <a href="#step-1">
                       <span class="step_no">1</span>
                       <span class="step_descr">
                                         Step 1<br />
                                         <small>Quotation Details</small>
                                     </span>
                     </a>
                   </li>
                   <li>
                     <a href="#step-2">
                       <span class="step_no">2</span>
                       <span class="step_descr">
                                         Step 2<br />
                                         <small>Location Entry</small>
                                     </span>
                     </a>
                   </li>
                   <li>
                     <a href="#step-3">
                       <span class="step_no">3</span>
                       <span class="step_descr">
                                         Step 3<br />
                                         <small>Items Entry </small>
                                     </span>
                     </a>
                   </li>
                   <li>
                     <a href="#step-4">
                       <span class="step_no">4</span>
                       <span class="step_descr">
                                         Step 4<br />
                                         <small>Review & Saved Quotation</small>
                                     </span>
                     </a>
                   </li>
                
                 </ul>
                 <div id="step-1">

                    <h2 class="StepTitle">Step 1: Quotation Details</h2>

                       <form method="post" id="frm_q_head" name="frm_q_head" data-bs-toggle="validator" class="form-horizontal form-label-left"> 
                            
                            <input type="hidden" name="quotation_id" id="quotation_id" value="">

                            <?php if(!@$pid){ ?> 
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Select Client *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                

                                <table border="0" width="100%">
                                  <td width="100%">
                                    
                                    <select name="client_id" id="client_id" class="form-control col-md-7 col-xs-12 select2_x" onchange="load_client(this.value)">
                                      <option value="">Select</option>
                                      <!-- <option value="new">Enter New Client</optio -->n>
                                      <?php 
                                      if(@$clients){
                                        foreach ($clients as $rs) { 
                                      ?>
                                      <option value="<?=$rs->id?>"><?=$rs->name?></option>
                                      <?php }
                                    }?>
                                    </select>

                                  </td>
                                  <td valign="top" nowrap=""><i><a class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#newSuppModal">Add New Client &nbsp; </a></i></td>
                                </table>
                                
                                

                                
                              </div>
                            </div> 

                            <script type="text/javascript">
                              function load_client(c_id) {
                                $('#load_client_projects').load('<?=base_url("sales/load_client_projects")?>/'+c_id);
                              }
                            </script>

                            <?php }?> 

                            <!-- <div  class="form-group c_div" style="display: none;">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Code *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="client_code" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div> 

                            <div class="form-group c_div" style="display: none;">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Name *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"   name="client_name" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div> 

                            <script type="text/javascript">
                              function load_client(c_id) {
                                if(c_id == 'new'){
                                  $('.c_div').show();
                                }else{
                                  $('.c_div').hide();
                                }
                              }
                            </script> -->

                            <!-- <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Select Project *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  
                                <table border="0" width="100%">
                                  <td width="100%">
                                    
                                    <select name="project_id" id="project_id" class="form-control col-md-7 col-xs-12 select2_x" onchange="load_project(this.value)">
                                      <option value="">Select</option> 
                                      <?php 
                                      if(@$projects){
                                        foreach ($projects as $rs) { 
                                      ?>
                                      <option value="<?=$rs->id?>"><?=$rs->name?></option>
                                      <?php }
                                    }?>
                                    </select>

                                  </td>
                                  <td valign="top" nowrap=""><i><a class="btn btn-info" href="<?php echo base_url('projects/add_project_quotation');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New Project</a></i></td>
                                </table>
                                
                                

                                
                              </div>
                            </div>  --> 

                            <?php if(@$pid){?>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Name *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" name="client_id" id="client_id" value="<?=@$client->id?>">
                                <input type="text" <?php if(@$pid){echo 'disabled';}?> value="<?=@$client->name?>" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div> 
                            <?php }?>

                            <?php if(@$pid){?>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Name *
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="hidden" name="project_id" id="project_id" value="<?=@$pid?>">
                                  <input type="text" <?php if(@$pid){echo 'disabled';}?> name="project_name" id="project_name" value="<?=@$project->name?>" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div> 
                            <?php }else{?>
                              <div id="load_client_projects"></div>
                            <?php }?>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Work Descriptions
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" class="form-control col-md-7 col-xs-12"></textarea>
                              </div>
                            </div>  

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Attention To *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="att_to" id="att_to" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Vadility (Days)
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="validity" id="validity" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quotation Number * 
                                <font id="error_quote_no" color="red">Already Exist</font>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="Q<?=sprintf("%06d",($quote->quote_number)+1);?>" readonly onkeyup="check_q(this.value)" name="quotation_number" id="quotation_number" class="form-control col-md-7 col-xs-12 rid_only">
                              </div>
                            </div> 
                            <script type="text/javascript">

                              $('#error_quote_no').hide();

                              function check_q(v){
                                $.get( "<?=base_url('sales/check_quote_no')?>/"+v, function( data ) {
                                  if(data == 1){
                                    $('#error_quote_no').show();
                                  }else{
                                    $('#error_quote_no').hide();
                                  }
                                });
                              }
                            </script>
                            <!-- <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Margin (%) *
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="margin" id="margin" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  -->

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date 
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="quotation_date" id="quotation_date" value="<?php echo date('Y-m-d')?>" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Start Date 
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="start_date" id="start_date" value="<?php echo date('Y-m-d')?>" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Completion Date 
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="completion_date" id="completion_date" value="<?php echo date('Y-m-d')?>" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Terms & Conditions *<br/> 
                              <select onchange="load_template(this.value)">
                                <option value="">select tempalte</option>
                                <?php 
                                if(@$tnc){
                                  foreach ($tnc as $rs) {
                                ?>
                                <option value="<?=$rs->id?>"><?=$rs->title?></option>
                                <?php }}?>
                                </select>  
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">  
                               <div class="form-group">
                                  
                                     <div id="alerts"></div>
                                     <div class="btn-toolbar editor" data-role="editor-toolbar" data-bs-target="#editor-one">
                                       <div class="btn-group">
                                         <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                         <ul class="dropdown-menu">
                                         </ul>
                                       </div>

                                       <div class="btn-group">
                                         <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                         <ul class="dropdown-menu">
                                           <li>
                                             <a data-edit="fontSize 5">
                                               <p style="font-size:17px">Huge</p>
                                             </a>
                                           </li>
                                           <li>
                                             <a data-edit="fontSize 3">
                                               <p style="font-size:14px">Normal</p>
                                             </a>
                                           </li>
                                           <li>
                                             <a data-edit="fontSize 1">
                                               <p style="font-size:11px">Small</p>
                                             </a>
                                           </li>
                                         </ul>
                                       </div>

                                       <div class="btn-group">
                                         <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                         <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                         <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                         <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                       </div>

                                       <div class="btn-group">
                                         <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                         <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                         <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                         <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                       </div>

                                       <div class="btn-group">
                                         <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                         <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                         <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                         <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                       </div>

                                       <div class="btn-group">
                                         <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                         <div class="dropdown-menu input-append">
                                           <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                           <button class="btn" type="button">Add</button>
                                         </div>
                                         <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                       </div>

                                       <div class="btn-group">
                                           <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font Color"><i class="fa fa-paint-brush"></i></a>
                                           <ul class="dropdown-menu">
                                               <li>
                                                   <a data-edit="foreColor #000000" style="color: #000000;">Black</a>
                                               </li>
                                               <li>
                                                   <a data-edit="foreColor #FF0000" style="color: #FF0000;">Red</a>
                                               </li>
                                               <li>
                                                   <a data-edit="foreColor #2697de" style="color: #2697de;">Blue</a>
                                               </li>
                                               <!-- Add more color options as needed -->
                                           </ul>
                                       </div>

                                       <!-- <div class="btn-group">
                                         <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                         <input type="file" data-role="magic-overlay" data-bs-target="#pictureBtn" data-edit="insertImage" />
                                       </div>
                      -->
                                       <div class="btn-group">
                                         <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                         <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                       </div>
                                     </div>


                                     <div id="editor-one" class="editor-wrapper" onkeyup="repli()"></div>

                                     <textarea name="terms_and_conditions" id="terms_and_conditions" style="display:none;"></textarea>
                      
                                   </div>
                               </div>
                           </div>  

                           <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Copy From Existing Quotation 
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                               <select name="prev_quotation" id="prev_quotation" onchange="select_existing_quote(this.value)" class="form-control select2_ col-md-7 col-xs-12">
                                  <option value="0">no</option>
                                  <?php 
                                  if(@$clients){
                                    foreach ($clients as $rs) {
                                      $arr_clients[$rs->id] = $rs->name;
                                    }
                                  }

                                  if(@$projects){
                                    foreach ($projects as $rs) {
                                      $arr_projects[$rs->id] = $rs->name;
                                    }
                                  }

                                  if(@$quotations_nos){
                                    foreach($quotations_nos as $rs){?>
                                  <option value="<?=$rs->id?>"><?=$rs->quotation_number?> | <?=@$arr_clients[$rs->client_id]?> | <?=@$arr_projects[$rs->project_id]?></option>
                                  <?php }}?>
                               </select>
                             </div>
                           </div>

                           <div id="uplaod_section" class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Attach Template (optional) 
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="quotation_file" id="quotation_file" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>  

                            
                       </form>
 

                 </div>
                 <div id="step-2">

                   <h2 class="StepTitle">Step 2: Location Entry</h2>
                   
                   <div id="load_quote_loc"></div>

                 </div>
                 <div id="step-3">

                   <h2 class="StepTitle">Step 3: Item Entry</h2>
                   
                   <div id="load_quote_items"></div>

                 </div>
                 <div id="step-4">
                  
                   <h2 class="StepTitle">Review & Saved Quotation</h2>
                   
                   <div id="load_quote_final"></div>

                 </div>

            

               </div>
               <!-- End SmartWizard Content --> 
      </div>
    </div>
  </div> 
    

</div>

 
<div id="newSuppModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>clients<small>Add New clients</small></h2>
            <ul class="nav navbar-right panel_toolbox">
               
               
              <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" id="frm_new_supp"  data-bs-toggle="validator" class="form-horizontal form-label-left">
 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Company Logo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="logo" id="logo" class="form-control col-md-7 col-xs-12">
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Code *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="code" id="code" onblur="chk_ccode(this.value)" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <script type="text/javascript">
                function chk_ccode(v){
                  var formData = new FormData();  
                    formData.append("ccode", v); 
                  
                  $.ajax({
                      url: base_url + 'sales/check_client_code',
                      type: "POST",
                      data: formData,
                      contentType: false, // Set to false for FormData
                      processData: false, // Set to false for FormData
                      success: function(res) {
                          if(res == 1){
                            alert('Client code alread exist!');
                            $('#code').val('');
                          }    
                      }
                  });
                }
              </script>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client Name *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="name" id="client_name"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="phone"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 1
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_person_1"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person 2
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_person_2"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 1
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_number_1" class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number 2
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_number_2"  class="form-control col-md-7 col-xs-12">
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" name="email"  class="form-control col-md-7 col-xs-12">
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="address"  class="form-control col-md-7 col-xs-12" row="3"></textarea>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fax Number
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="fax_no"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quotation Attension To
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="attension_to" class="form-control col-md-7 col-xs-12">
                </div>
              </div>  
            
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  
                   
                    <a href="Javascript:save_supp()" type="button" class="btn btn-success">Submit</a>

                     <button class="btn btn-warning" type="button" data-bs-dismiss="modal">Cancel</button> 
                   
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div> 

  </div>
</div>


<div id="newProjModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Project<small>Add New Project</small></h2>
            <ul class="nav navbar-right panel_toolbox">
               
               
              <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" id="frm_new_proj"  data-bs-toggle="validator" class="form-horizontal form-label-left">
 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Name *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="name" id="project_name"  required  class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_person"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="contact_number"   class="form-control col-md-7 col-xs-12">
                </div>
              </div>    

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="email"   class="form-control col-md-7 col-xs-12">
                </div>
              </div>  

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Manager
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="project_manager"   class="form-control col-md-7 col-xs-12 select2_">
                    <option value="0">Select</option>
                    <?php 
                    if($emp){
                      foreach ($emp as $rs) {
                    ?>
                    <option value="<?=$rs->id?>"><?=$rs->first_name.' '.$rs->last_name?></option>
                    <?php }}?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea type="text" name="description"   class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>   

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Notes
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea type="text" name="notes"   class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Location
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="location"   class="form-control col-md-7 col-xs-12">
                </div>
              </div>  
            
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  
                   
                    <a href="Javascript:save_projectah()" type="button" class="btn btn-success">Submit</a>

                     <button class="btn btn-warning" type="button" data-bs-dismiss="modal">Cancel</button> 
                   
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div> 

  </div>
</div>

<script type="text/javascript">

  function select_existing_quote(qv){
    
    if(qv == 0){
      $('#uplaod_section').show();
    }else{
      $('#uplaod_section').hide();
    }
    
  }

function load_template(id){
   
  $.ajax({
      url: '<?=base_url("sales/load_template")?>/'+id, // Replace with your API endpoint
      type: 'GET', 
      success: function(response) { 
          // Handle the successful response here
          $('#editor-one').html(response);
          $('#terms_and_conditions').val(response);
      } 
  });
 
}


function save_projectah() {
  if($('#project_name').val() == ''){

      alert('Enter a project name');

  }else{
 
      var formData = new FormData($("#frm_new_proj")[0]);

      var client_id = $('#client_id').val();
 
      $.ajax({
          url: base_url + 'projects/save_project/from_new_quote/'+client_id,
          type: "POST",
          data: formData,
          contentType: false, // Set to false for FormData
          processData: false, // Set to false for FormData
          success: function(res) {
              
                var selectBox = document.getElementById("project_id"); 
                var option = document.createElement("option"); 
                option.value = res;
                option.textContent = $('#project_name').val(); 
                selectBox.appendChild(option); 
                 option.setAttribute("selected", "selected");
      
                $('#newProjModal').modal('hide'); 

          }
      });
  }
}
 

function save_supp(){

  if($('#client_name').val() == ''){

      alert('Enter a client name');

  }else{
 
      var formData = new FormData($("#frm_new_supp")[0]); 
      var imageInput = document.getElementById("logo"); 
      if (imageInput.files.length > 0) { 
        formData.append("logo", imageInput.files[0]);
      }
 
      $.ajax({
          url: base_url + 'sales/save_clients/1',
          type: "POST",
          data: formData,
          contentType: false, // Set to false for FormData
          processData: false, // Set to false for FormData
          success: function(res) {
              
                var selectBox = document.getElementById("client_id"); 
                var option = document.createElement("option"); 
                option.value = res;
                option.textContent = $('#client_name').val(); 
                selectBox.appendChild(option); 
                 option.setAttribute("selected", "selected");
     
                $('#code').val('');
                $('#client_name').val(''); 

                $('#newSuppModal').modal('hide');

                $('#load_client_projects').load('<?=base_url("sales/load_client_projects")?>/'+selectBox);

                load_client(res);
          }
      });
  }

}


var loc = 1; 
var loc_ttl = 1; 
function add_row(exist) {
  
  $('.stepContainer').css('height', '');

  var newRowHtml = '<tr id="lrow' + (loc + Number(exist)) + '"><td><input type="text" id="new_loc' + (loc + Number(exist)) + '" name="new_loc' + (loc + Number(exist)) + '" class="form-control" style="width: 100%;"></td><td><a href="javascript:ddel(' + (loc + Number(exist)) + ',0)"><i class="fa fa-trash"></i> delete</a></td></tr>';
  
  $('#add_row').prev('tr').after(newRowHtml);
  loc += 1;
  loc_ttl = (loc + Number(exist));
}

var pak = 1; 
var pak_ttl = 1; 
function add_pak_row(exist) {
  
  $('.stepContainer').css('height', '');

  var newpRowHtml = '<tr id="prow' + (pak + Number(exist)) + '"><td><input type="text" id="new_pak' + (pak + Number(exist)) + '" name="new_pak' + (pak + Number(exist)) + '" class="form-control" style="width: 100%;"></td><td><a href="javascript:pdel(' + (pak + Number(exist)) + ',0)"><i class="fa fa-trash"></i> delete</a></td></tr>';
  
  $('#add_pak_row').prev('tr').after(newpRowHtml);
  pak += 1;
  pak_ttl = (pak + Number(exist));
}

var itm = 1; 
var itm_ttl = 1; 

function add_item_row(l_id,exist) { 

  var newRowHtml = '<tr id="irow' + (itm + Number(exist)) + '"><td><input type="text" id="new_loc' + (itm + Number(exist)) + '" name="new_loc' + (itm + Number(exist)) + '" class="form-control" style="width: 100%;"></td><td><a href="javascript:idel(' + (itm + Number(exist)) + ',0)"><i class="fa fa-trash"></i> delete</a></td></tr>';
  
  $('#add_row').prev('tr').after(newRowHtml);
  itm += 1;
  itm_ttl = (itm + Number(exist));

}

var ttp = '';

function idel(tp,id,counter) {

  ttp = tp;
 
    alertify.confirm("Confirm the deletion of the selected item?", function (e) {
          if (e) { 
             $.get("<?=base_url('sales/delete_new_item')?>/"+id, function(data) { 
                 
                 alertify.log("Deleted successfuly. ");

                 if(ttp == 'LOCAL'){
                    $('#local_row'+counter).remove();
                 }

                 if(ttp == 'MANPOWER'){
                    $('#manpower_row'+counter).remove();
                 }

                 if(ttp == 'ITEM'){
                    $('#irow'+counter).remove();
                 }

             });

             
             
          }
    });
  
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


function pdel(id,tp) {
  if(tp > 0){
    alertify.confirm("Confirm the deletion of the selected package. This action will permanently remove link to items associated with this package, and the deletion cannot be undone.", function (e) {
          if (e) { 
             $.get("<?=base_url('sales/delete_location_package')?>/"+tp, function(data) { 
                 alertify.log("Deleted successfuly.");
             });
             $('#prow'+id).remove();
          }
    });
  }else{
    alertify.confirm("Delete selected package?", function (e) {
          if (e) { 
             $('#prow'+id).remove();
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
 

