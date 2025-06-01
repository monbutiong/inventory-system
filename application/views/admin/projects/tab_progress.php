<?php 

if($users){
  foreach ($users as $rs) {
    $arr_user[$rs->id] = $rs->name;
  }
}


if(@$quotation){
  foreach ($quotation as $rs) {
  
    $progress_data_all[] = [
      'id'=>$rs->id,
      'title'=>'New Quotation Created (version '.$rs->version.')',
      'description'=>'New quoation was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
      'date_cover'=>$rs->date_created,
      'attachments'=>'',
      'date_cover'=>$rs->date_created
    ];

    if($rs->confirmed == 1){
      $progress_data_all[] = [
        'id'=>$rs->id,
        'title'=>'Quotation',
        'description'=>'Quotation was confimed<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
        'date_cover'=>$rs->confirmed_date,
        'attachments'=>'',
        'date_cover'=>$rs->date_created
      ];
    }

    
  }
}

if(@$progress_data){
  foreach ($progress_data as $rs) {
    $progress_data_all[] = [
      'id'=>$rs->id,
      'title'=>$rs->title,
      'activity_type_id'=>$rs->activity_type_id,
      'description'=>$rs->description,
      'date_cover'=>$rs->date_cover ? $rs->date_cover : $rs->date_created,
      'attachments'=>$rs->attachments
    ];
  }
}

if(@$po){
  foreach ($po as $rs) {

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'Purchase Order Confirmed',
      'description'=>'Purchase Order was confimed<br><a href="'.base_url('vendor/print_po/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->po_number.'</a>',
      'date_cover'=>$rs->date_confirmed,
      'attachments'=>''
    ];

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'Created Purchase Order',
      'description'=>'New P.O. was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_po/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->po_number.'</a>',
      'date_cover'=>$rs->date_confirmed,
      'attachments'=>''
    ];

    
  }
}

if(@$receiving){
  foreach ($receiving as $rs) {

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'Received Materials',
      'description'=>'Received by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('receiving/print_rr/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->dr_number.'</a>',
      'date_cover'=>$rs->confirmed_date,
      'attachments'=>''
    ]; 

    
  }
}

if(@$issuance){
  foreach ($issuance as $rs) {

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'Issued Materials',
      'description'=>'Issued by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('outgoing/print_ii/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.($rs->ref_no ? $rs->ref_no : 'Issuance').'</a>',
      'date_cover'=>$rs->confirmed_date,
      'attachments'=>''
    ]; 

    
  }
}

if(@$job_order){
  foreach ($job_order as $rs) {

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'New Job Order',
      'description'=>'Created by '.@$arr_user[$rs->user_id].'<br><a data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" href="'.base_url('projects/view_job_order/'.$rs->id).'" class="load_modal_details"><i class="fa fa-file-pdf-o"></i> '.$rs->job_order_number.'</a>',
      'date_cover'=>$rs->date_created,
      'attachments'=>''
    ]; 

    
  }
} 
 
?> 
 <div class=" pull-right">
        
   </div>

  
  <table id="datatable" class="table table-striped table-bordered table-hover"> 
    <thead>
      <tr style="font-size: 12px;">
         
        <th>Activity</th>  
      </tr>
      </thead> 
      <tbody>
        <?php 

        function isImage($filename) {
            $imageExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp');
            
            $pathInfo = pathinfo($filename);
            $extension = strtolower($pathInfo['extension']);
            
            return in_array($extension, $imageExtensions);
        }

        if(@$activity_type){
          foreach ($activity_type as $rs) {
            $arr_activity_type[$rs->id] = $rs->title;
        }}

        if(@$progress_data_all){
          foreach ($progress_data_all as $rs) {
        ?>
        <tr>
          <td data-order="-<?=strtotime($rs['date_cover'])?><?=@$rs['id']?>">
            <div class="pull-right"><i><?=date('M d, Y H:i', strtotime($rs['date_cover']))?></i></div>
          <b><?=$rs['title']?></b><br/> 
          <?php if(@$rs['activity_type_id']){?><small><?=@$arr_activity_type[$rs['activity_type_id']]?></small><br/><?php }?> 
          <?=nl2br($rs['description'])?>  
         
          <?php if(json_decode($rs['attachments'])){ echo ' <br/>';
            foreach(json_decode($rs['attachments']) as $aa){
              if(isImage($aa)){?>
              <a target="_blank" href="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>"><img src="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>" style="height: 90px; margin: 10px;"></a>
          <?php }}}?>
          <?php if(json_decode($rs['attachments'])){ echo ' <br/>';
            foreach(json_decode($rs['attachments']) as $aa){
              if(!isImage($aa)){ list($a,$b,$fna)=explode('_',$aa);?>
              <a download="<?=$fna?>" href="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>"><div class="badge bg-suucess"><i class="fa fa-download"></i> <?=$fna?></div></a> 

          <?php }}}?><br/><br/>
          </td>
        </tr>
        <?php }}?>
      </tbody>
    </table>   