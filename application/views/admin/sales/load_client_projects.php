<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project *
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  
  

  <table border="0" width="100%">
    <td width="100%">
      
      <select required name="project_id" id="project_id" class="form-control col-md-7 col-xs-12 select2_x" >
        <option value="">Select</option>
        <!-- <option value="new">Enter New Client</optio -->n>
        <?php 
        if(@$projects){
          foreach ($projects as $rs) { 
        ?>
        <option value="<?=$rs->id?>"><?=$rs->name?></option>
        <?php }
      }?>
      </select>

    </td>
    <td valign="top" nowrap=""><i><a class="btn btn-info" href="#" data-bs-toggle="modal" data-bs-target="#newProjModal">Add New Project </a></i></td>
  </table>
  
  

  
</div>
</div> 