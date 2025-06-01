<?php 
$progress_data_all = [];

if($users){
  foreach ($users as $rs) {
    $arr_user[$rs->id] = $rs->name;
    $arr_avatar[$rs->id] = $rs->avatar;
  }
}

if(@$progress_data){
  foreach ($progress_data as $rs) {
    $progress_data_all[] = [
      'id'=>$rs->id,
      'title'=>$rs->title,
      'description'=>$rs->description,
      'date_cover'=>$rs->date_cover ? $rs->date_cover : $rs->date_created,
      'attachments'=>$rs->attachments,
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
    ];
  }
}

if(@$quotation){
  foreach ($quotation as $rs) {

    $progress_data_all[] = [
      'id'=>$rs->id,
      'title'=>'Quotation Confirmed',
      'description'=>'Quotation was confimed<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
      'date_cover'=>$rs->confirmed_date,
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
    ];

    $progress_data_all[] = [
      'id'=>$rs->id,
      'title'=>'Created Quotation',
      'description'=>'New quoation was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
      'date_cover'=>$rs->date_created,
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
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
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
    ];

    $progress_data_all[] = [
      'id'=>0,
      'title'=>'Created Purchase Order',
      'description'=>'New P.O. was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_po/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->po_number.'</a>',
      'date_cover'=>$rs->date_confirmed,
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
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
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
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
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
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
      'attachments'=>'',
      'user'=>@$arr_user[$rs->user_id],
      'avatar'=>@$arr_avatar[$rs->user_id]
    ];  

  }
}

 
// Limit the array to 5 items in place
$progress_data_all = array_slice($progress_data_all, 0, 5);

usort($progress_data_all, function ($a, $b) {
    return strtotime($b['date_cover']) - strtotime($a['date_cover']);
});

function isImage($filename) {
    $imageExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp');
    
    $pathInfo = pathinfo($filename);
    $extension = strtolower($pathInfo['extension']);
    
    return in_array($extension, $imageExtensions);
} 
?> 
<!-- end of user messages -->
<ul class="messages">
  <?php 
  if($progress_data_all){
    foreach ($progress_data_all as $rs) { 
  ?>
  <li>
    <img src="<?php echo base_url(); if($rs['avatar']){echo 'assets/uploads/avatar/'.$rs['avatar'];}else{echo 'assets/images/img.png';}?>" class="avatar" alt="Avatar">
    <div class="message_date">
      <h3 class="date text-info"><?=date('d', strtotime($rs['date_cover']))?></h3>
      <p class="month"><?=date('M', strtotime($rs['date_cover']))?></p>
    </div>
    <div class="message_wrapper">
      <h4 class="heading"><?=$rs['user']?></h4>
      <blockquote class="message"><?=$rs['title']?></blockquote>
      <?=$rs['description']?>
      <br/>
      
      <?php if(is_array(json_decode(@$rs['attachments']))){ echo ' <br/>';
        foreach(json_decode($rs['attachments']) as $aa){
          if(isImage($aa)){?>
          <a target="_blank" href="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>"><img src="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>" style="height: 90px; margin: 10px;"></a>
        <?php }else{
          list($a,$b,$fna)=explode('_',$aa);?>
          <p class="url">
            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
            <a download="<?=$fna?>" href="<?=base_url('assets/uploads/projects/'.$pid.'/'.$aa)?>"><i class="fa fa-paperclip"></i> <?=$fna?> </a>
          </p>
      <?php }}}?>

      
    </div>
  </li>
   
  <?php }}else{?>

  <center>
    <p>
      <i>No Recent Data</i>
    </p>
  </center>
  <?php }?>
   
   
</ul>
<!-- end of user messages -->