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
        <h2>Sales<small>Add Terms and Conditions Template</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('purchasing/save_tnc');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="title"  value="<?php echo @$i->title?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                           <div class="form-group" onclick="repli()">
                              
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


                                 <div id="editor-one" class="editor-wrapper2" onkeyup="repli()"></div>

                                 <textarea name="terms_and_conditions" id="terms_and_conditions" style="display:none;"></textarea>
                  
                               </div>
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
