 
 <div class=" pull-right">
    
</div>


<table id="datatable" class="table table-striped table-bordered table-hover"> 
<thead>
  <tr style="font-size: 12px;"> 
    <th>Document Type</th>  
    <th>Description</th>
    <th>Documents</th>  
    <th>Date</th>  
  </tr>
  </thead> 
  <tbody>
    <?php  
    if($document_type){
      foreach ($document_type as $rs) {
        $arr_dt[$rs->id] = $rs->title;
      }
    }

    if(@$documents_data){
      foreach ($documents_data as $rs) {
    ?>
    <tr>
      <td data-order="-<?=$rs->id?>"> <?=@$arr_dt[$rs->document_type_id]?> </td>	
      <td> <?=$rs->description?> </td> 
      <td> 
      	<?php if(@$rs->attachments){ 
      	  foreach(json_decode($rs->attachments) as $aa){ 
            if($aa){
            list($id,$rnd,$fna) = explode('_',$aa);
            ?>
      	    <a download="<?=$fna?>" href="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>"><div class="badge bg-suucess"><i class="fa fa-download"></i> <?=$fna?></div></a> 
      	<?php }} }?>
      </td>
      <td data-order="-<?=$rs->id?>"> <?=date('M d, Y', strtotime($rs->date_created))?> </td>
    </tr>
    <?php }}?>
  </tbody>
</table> 