<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        
 

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"> 
                        <h6 class="page-title">Customer Masterlist</h6>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-md-block">
                          <?php if(in_array('add', $access_features)){?>
                            <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('crm/add_clients');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Customer</a>
                          <?php }?>
                        </div>
                    </div>
                </div>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">
        
        <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th width="5%">Logo</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contacts</th>        
              <th nowrap>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}

            if(@$clients){
              foreach($clients as $rs){
            ?>
            <tr id="tr<?=$rs->id?>">
              <td><img height="70" src="<?php 
              if(file_exists('./assets/images/clients/logo-'.$rs->id.'.png')){
                echo base_url('assets/images/clients/logo-'.$rs->id.'.png?'.time());
                }else{
                echo base_url('assets/images/img.png'); }?>"></td>
              <td>
                <?=$rs->name?>
                <br/>Customer Code: <?=$rs->code?>
                <br/>
                <?php if($rs->customer_type == 1){?>
                  Business Registration #: <?=$rs->business_registration_no?> 
                <?php }else{?>
                  QID: <?=$rs->qid?> 
                <?php }?>
              </td>
              <td><?=$rs->address?><br/>
                
                <small>
                  <?=$rs->email?>
                </small>

              </td>
              <td>
                <?=$rs->phone?><br/>
                <small> 
                  <?=$rs->contact_person_1 ? $rs->contact_person_1.' | '.$rs->contact_number_1 : ''?><br/>
                  <?=$rs->contact_person_2 ? $rs->contact_person_2.' | '.$rs->contact_number_2 : ''?>
                </small>
              </td>   
              <td style="line-height: 1.5; width: 140px;">
                <div class="d-flex flex-wrap gap-1">
                  <?php if(in_array('edit', $access_features)): ?>
                    <a href="<?= base_url('crm/edit_clients/'.$rs->id) ?>"
                       class="text-primary load_modal_details"
                       data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                       <i class="fa fa-edit"></i> Edit
                    </a>
                  <?php endif; ?>

                  <a href="<?= base_url('crm/view_clients/'.$rs->id) ?>"
                     class="text-info load_modal_details"
                     data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                     <i class="fa fa-eye"></i> View
                  </a>

                  <?php if(in_array('delete', $access_features)): ?>
                    <a href="javascript:void(0);"
                       onclick="prompt_delete('Delete','Delete Customer?','<?= base_url('crm/delete_clients/'.$rs->id) ?>','tr<?= $rs->id ?>')"
                       class="text-danger">
                       <i class="fa fa-trash"></i> Delete
                    </a>
                  <?php endif; ?>

                  <?php if(in_array('purchase-history', $access_features)): ?>
                    <a href="<?= base_url('outgoing/purchase_history/customer/'.$rs->id) ?>"
                       class="text-warning load_modal_details"
                       data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"
                       data-modal-size="xl">
                       <i class="fa fa-archive"></i> Purchase History
                    </a>
                  <?php endif; ?>
                </div>
              </td>



            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>

          </div>
        </div>
  
      </div>
    </div>
  </div> 
   
</div>

 
 

