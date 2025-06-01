 

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client Profile <small></small></h2>
                     
                    <div class="input-group-btn pull-right" style="padding-right: 250px;">
                            <a class="btn btn-sm btn-success load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" href="<?php echo base_url('projects/add_project/'.$client->id);?>" >Add Project</a>
                            <a class="btn btn-sm btn-success load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" href="<?php echo base_url('crm/add_documents/'.$client->id);?>" >Add Document</a>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url('crm/clients');?>" >Go back</a>
                        </div>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php 
                            if(file_exists('./assets/images/clients/logo-'.$client->id.'.png') || 1){
                              echo base_url('assets/images/clients/logo-'.$client->id.'.png?'.time());
                            }else{
                              echo base_url('assets/images/blank.png'); 
                            }?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?=$client->name?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?=$client->address?>
                        </li>

                        <li>
                          <i class="fa fa-phone user-profile-icon"></i> <?=$client->phone?>
                        </li>
                        <?php if($client->website){?>
                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="<?=$client->website?>" target="_blank"><?=$client->website?></a>
                        </li>
                      <?php }?>
                      </ul>
 

                    </div>
                    <div class="col-md-9 col-sm-9 ">

                     
                      

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="<?php if(!$active_tab){echo 'active';}?>"><a href="#tab_content1" id="home-tab" role="tab" data-bs-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class="<?php if($active_tab == 'project'){echo 'active';}?>"><a href="#tab_content2" role="tab" id="profile-tab" data-bs-toggle="tab" aria-expanded="false">Projects</a>
                          </li>
                          <li role="documents" class="<?php if($active_tab == 'documents'){echo 'active';}?>"><a href="#tab_content3" role="tab" id="profile-tab" data-bs-toggle="tab" aria-expanded="false">Documents</a>
                          </li> 
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane <?php if(!$active_tab){echo 'active';}?> " id="tab_content1" aria-labelledby="home-tab">

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
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
                                ];
                              }
                            }

                            if(@$quotations){
                              foreach ($quotations as $rs) {

                                $progress_data_all[] = [
                                  'id'=>$rs->id,
                                  'title'=>'Quotation Confirmed',
                                  'description'=>'Quotation was confimed<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
                                  'date_cover'=>$rs->confirmed_date,
                                  'attachments'=>'',
                                  'user'=>@$arr_user[$rs->user_id],
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id,
                                  'date_cover'=>$rs->date_created
                                ];

                                $progress_data_all[] = [
                                  'id'=>$rs->id,
                                  'title'=>'Created Quotation',
                                  'description'=>'New quoation was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_quotation/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->quotation_number.'</a>',
                                  'date_cover'=>$rs->date_created,
                                  'attachments'=>'',
                                  'user'=>@$arr_user[$rs->user_id],
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id,
                                  'date_cover'=>$rs->date_created
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
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
                                ];

                                $progress_data_all[] = [
                                  'id'=>0,
                                  'title'=>'Created Purchase Order',
                                  'description'=>'New P.O. was created by '.@$arr_user[$rs->user_id].'<br><a href="'.base_url('vendor/print_po/'.$rs->id).'" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$rs->po_number.'</a>',
                                  'date_cover'=>$rs->date_confirmed,
                                  'attachments'=>'',
                                  'user'=>@$arr_user[$rs->user_id],
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
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
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
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
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
                                ]; 
                             
                              }
                            }

                            if(@$jo){
                              foreach ($jo as $rs) {

                                $progress_data_all[] = [
                                  'id'=>0,
                                  'title'=>'New Job Order',
                                  'description'=>'Created by '.@$arr_user[$rs->user_id].'<br><a data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" href="'.base_url('projects/view_job_order/'.$rs->id).'" class="load_modal_details"><i class="fa fa-file-pdf-o"></i> '.$rs->job_order_number.'</a>',
                                  'date_cover'=>$rs->date_created,
                                  'attachments'=>'',
                                  'user'=>@$arr_user[$rs->user_id],
                                  'avatar'=>@$arr_avatar[$rs->user_id],
                                  'project_id'=>@$rs->project_id
                                ];  

                              }
                            }

                            if(@$activity_type){
                              foreach ($activity_type as $rs) {
                                $arr_activity_type[$rs->id] = $rs->title;
                            }}

                            if(@$projects){
                                  foreach ($projects as $rs) { 
                                    $arr_pro[$rs->id] = $rs->name;
                            }}
                             
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
                                <div title="<?=date('d M Y H:i', strtotime($rs['date_cover']))?>" class="message_date">
                                  <h3 class="date text-info"><?=date('d', strtotime($rs['date_cover']))?></h3>
                                  <p class="month"><?=date('M', strtotime($rs['date_cover']))?></p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading"><?=$rs['user']?></h4>
                                  <small>Project: <?=@$arr_pro[$rs['project_id']]?> <?php if(@$rs['activity_type_id']){?> | <?=@$arr_activity_type[$rs['activity_type_id']]?><br/><?php }?></small> 
                                  <blockquote class="message"><?=$rs['title']?></blockquote>
                                  <?=$rs['description']?>
                                  <br/>
                                  
                                  <?php if(is_array(json_decode(@$rs['attachments']))){ echo ' <br/>';
                                    foreach(json_decode($rs['attachments']) as $aa){
                                      if(isImage($aa)){  ?> 
                                      <a target="_blank" href="<?=base_url('assets/uploads/projects/'.@$rs['project_id'].'/'.$aa)?>"><img src="<?=base_url('assets/uploads/projects/'.@$rs['project_id'].'/'.$aa)?>" style="height: 90px; margin: 10px;"></a>
                                    <?php }else{
                                      list($a,$b,$fna)=explode('_',$aa);?>
                                      <p class="url">
                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                        <a download="<?=$fna?>" href="<?=base_url('assets/uploads/projects/'.@$rs['project_id'].'/'.$aa)?>"><i class="fa fa-paperclip"></i> <?=$fna?> </a>
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
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane <?php if($active_tab == 'project'){echo 'active';}?>" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>Project Name</th>
                                  <th>Date</th>
                                  <th>Project Manager</th>
                                  <th>Quotation</th> 
                                  <th>Job Order</th>  
                                  <th>Option</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                if($quotations){
                                  foreach ($quotations as $rs) {
                                    $arr_q[$rs->project_id] = $rs;
                                  }
                                }

                                if(@$jo){
                                  foreach ($jo as $rs) {
                                    @$arr_jo[$rs->project_id]+=1;
                                  }
                                }

                                if(@$projects){
                                  foreach ($projects as $rs) { 
                                ?>
                                <tr>
                                  <td><?=$rs->name?></td>
                                  <td></td>
                                  <td></td>
                                  <td><?php 
                                  echo @$arr_q[$rs->id] ? $arr_q[$rs->id]->quotation_number : '<i>none</i>';
                                  ?></td>
                                  <td><?=(@$arr_jo[$rs->id])?></td>  
                                  <td>
                                    <a href="<?=base_url('projects/manage_project/').$rs->id?>/progress/<?=$client->id?>">Manage</a>
                                  </td>
                                </tr>
                                <?php }}else{?>
                                  <tr>
                                    <td colspan="6"><center><i>No Project</i></center></td>
                                  </tr>
                                <?php }?> 
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div> 
                          <div role="tabpanel" class="tab-pane <?php if($active_tab == 'documents'){echo 'active';}?>" id="tab_content3" aria-labelledby="profile-tab">
                              
                              <table class="table table-striped table-bordered table-hover datatables"> 
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

                                  if(@$cd){
                                    foreach ($cd as $rs) {
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
                                          <a download="<?=$fna?>" href="<?=base_url('assets/uploads/clients/'.$client->id.'/'.$aa)?>"><div class="badge bg-suucess"><i class="fa fa-download"></i> <?=$fna?></div></a> 
                                      <?php }} }?>
                                    </td>
                                    <td data-order="-<?=$rs->id?>"> <?=date('M d, Y', strtotime($rs->date_created))?> </td>
                                  </tr>
                                  <?php }}else{?>
                                    <tr>
                                      <td colspan="4"><center><i>No Project</i></center></td>
                                    </tr>
                                  <?php }?>
                                </tbody>
                              </table> 

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       