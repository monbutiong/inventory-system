<?php 
// $module['quotation']   
// $module['po'] 
// $module['receiving'] 
// $module['issuance'] 
// $module['client']

if($users){
  foreach ($users as $rs) {
    $arr_user[$rs->id] = $rs->name;
  }
}
?> 
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Project Details</h2>
           
          <div class=" pull-right" > 


                <a id="add_item_link" class="btn  btn-sm btn-info load_modal_details" href="<?php echo base_url('projects/add_progress/'.$pid.'/'.$client_id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add By Activity</a> 

                <a id="add_item_link" class="btn  btn-sm btn-info load_modal_details" href="<?php echo base_url('projects/add_documents/'.$pid.'/'.$client_id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add By Documents</a> 

                <a id="add_item_link" class="btn  btn-sm btn-info" href="<?php echo base_url('sales/new_quotation/'.$pid.'/'.$client_id);?>" ><i class="fa fa-plus"></i> Add Quotation</a> 

                <a class="btn btn-sm btn-danger" href="<?=$client_id ? base_url('crm/manage_client/'.$client_id.'/project') : base_url('projects/masterlist');?>"  >Go Back</a>

              </div>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <div class="col-md-9 col-sm-8  ">

              

            <div>
 
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <!-- <li role="presentation" onclick="change_to('recent')" class="<?php if($tab=='recent'){echo 'active';}?>"><a href="#" id="recent-tab" role="tab" data-bs-toggle="tab" aria-expanded="true">Project Logs</a>
                </li> -->
                <li role="progress" onclick="change_to('progress')" class="<?php if(!$tab || $tab=='progress'){echo 'active';}?>"><a href="#" role="tab" id="progress-tab" data-bs-toggle="tab" aria-expanded="false">Activity</a>
                </li>
                <li role="documents" onclick="change_to('documents')" class="<?php if($tab=='documents'){echo 'active';}?>"><a href="#" role="tab" id="documents-tab" data-bs-toggle="tab" aria-expanded="false">Documents</a>
                </li>
                <li role="documents" onclick="change_to('quotation')" class="<?php if($tab=='quotation'){echo 'active';}?>"><a href="#" role="tab" id="quotation-tab" data-bs-toggle="tab" aria-expanded="false">Quotations</a>
                </li>
                <li role="documents" onclick="change_to('job_order')" class="<?php if($tab=='job_order'){echo 'active';}?>"><a href="#" role="tab" id="job_order-tab" data-bs-toggle="tab" aria-expanded="false">Job Order</a>
                </li>
                <!-- <li role="quotation" onclick="change_to('quotation')" class="<?php if($tab=='quotation'){echo 'active';}?>"><a href="#" role="tab" id="quotation-tab" data-bs-toggle="tab" aria-expanded="false">Quotation</a>
                </li>
                <li role="po" onclick="change_to('po')" class="<?php if($tab=='po'){echo 'active';}?>"><a href="#" role="tab" id="po-tab" data-bs-toggle="tab" aria-expanded="false">Purchase Order</a>
                </li>
                <li role="received" onclick="change_to('received')" class="<?php if($tab=='received'){echo 'active';}?>"><a href="#" role="tab" id="received-tab" data-bs-toggle="tab" aria-expanded="false">Received Items</a>
                </li>

                <li role="issued" onclick="change_to('issued')" class="<?php if($tab=='issued'){echo 'active';}?>"><a href="#" role="tab" id="issued-tab" data-bs-toggle="tab" aria-expanded="false">Issued inventory</a>
                </li> -->
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane active " id="tab_recent" aria-labelledby="recent-tab">
                  <?php $this->view("admin/projects/tab_".$tab);?>
                </div>
              </div>
 
            </div>
 
          </div>

          <!-- start project-detail sidebar -->
          <div class="col-md-3 col-sm-4  ">

            <section class="panel">

              <div class="x_title">
                <h2>Project Description</h2>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <h3 class="green"><i class="fa fa-building"></i> <?=$project->name?></h3>

                <p><?=nl2br($project->description)?></p>
                <br />

                <div class="project_detail">

                  <p class="title">Client</p>
                  <p><?=@$client->name?></p>
                  <p class="title">Date</p>
                  <p><?=date('d M, Y',strtotime($project->date_created))?></p>
                  <p class="title">Project Manager</p>
                  <p><?=@$emp->first_name ? @$emp->first_name.' '.@$emp->last_name : '--'?></p>
                  <br/>
                  <p class="title">Contact Person</p>
                  <p><?=$project->contact_person ?? '--'?></p>
                  <p class="title">Contact Number</p>
                  <p><?=$project->contact_number ?? '--'?></p>
                  <p class="title">Email</p>
                  <p><?=$project->email ?? '--'?></p>
                  <p class="title">Location</p>
                  <p><?=$project->location ?? '--'?></p> 
                  <p class="title">Description</p>
                  <p><?=$project->description ?? '--'?></p>
                  <p class="title">Notes</p>
                  <p><?=$project->notes ?? '--'?></p>
                  
                </div>

                <!-- <br />
                <h5>Project files</h5>
                <ul class="list-unstyled project_files">
                  <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                  </li>
                  <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                  </li>
                  <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                  </li>
                  <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                  </li>
                  <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                  </li>
                </ul>
                <br /> -->

                <!-- <div class="text-center mtop20">
                  <a href="#" class="btn btn-sm btn-primary">Add files</a>
                  <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                </div> -->
              </div>

            </section>

          </div>
          <!-- end project-detail sidebar -->

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function change_to(tab){
    location.href = "<?=base_url('projects/manage_project/'.$pid)?>/"+tab+'/<?=$client_id?>';
  }
</script>