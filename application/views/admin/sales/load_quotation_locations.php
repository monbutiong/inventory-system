<form method="post" id="frm_q_loc" name="frm_q_loc" data-bs-toggle="validator" class="form-horizontal form-label-left"> 
<input type="hidden" name="quotation_id" value="<?=@$quotation_id?>">
<input type="hidden" name="project_id" value="<?=@$project_id?>">
<table id="datatable" class="table table-striped table-bordered table-hover">                
 <thead>
   <tr style="font-size: 12px;">
     <th>Project Location / Section</th>     
     <th>Options</th>
   </tr>
   </thead> 
   <tbody>
    <?php 
    $exist = 0;
    if($qlocations){
      foreach ($qlocations as $rs) {
    ?>
    <tr id="lrow<?=$exist+=1;?>">
      <td><?=@$rs->location_name?></td>
      <td>
       
        <!-- <a href="<?php echo base_url('purchasing/edit_supplier/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>

         | 
 -->
        <a href="Javascript:ddel(<?=$exist?>,<?=$rs->id?>)"  ><i class="fa fa-trash"></i> delete</a>

      </td>
    </tr>
  <?php }}?>
  <tr id="add_row">
    <td colspan="2"><a href="Javascript:add_row(<?=$exist?>)"><i class="fa fa-plus"></i> Add New Location</a></td> 
  </tr>
  </tbody>
</table>
<br/>
<table id="datatable" class="table table-striped table-bordered table-hover">                
 <thead>
   <tr style="font-size: 12px;">
     <th>Packege Name</th>     
     <th>Options</th>
   </tr>
   </thead> 
   <tbody>
    <?php 
    $exist = 0;
    if($packages){
      foreach ($packages as $rs) {
    ?>
    <tr id="prow<?=$exist+=1;?>">
      <td><?=@$rs->package_name?></td>
      <td>
       
        
        <a href="Javascript:pdel(<?=$exist?>,<?=$rs->id?>)"  ><i class="fa fa-trash"></i> delete</a>

      </td>
    </tr>
  <?php }}?>
  <tr id="add_pak_row">
    <td colspan="2"><a href="Javascript:add_pak_row(<?=$exist?>)"><i class="fa fa-plus"></i> Add New Package</a></td> 
  </tr>
  </tbody>
</table>
</form>