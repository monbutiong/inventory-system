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
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('crm/add_clients');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Customer</a>
                        </div>
                    </div>
                </div>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th width="5%">Logo</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contacts</th>        
              <th>Options</th>
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
            <tr>
              <td><img height="70" src="<?php 
              if(file_exists('./assets/images/clients/logo-'.$rs->id.'.png')){
                echo base_url('assets/images/clients/logo-'.$rs->id.'.png?'.time());
                }else{
                echo base_url('assets/images/img.png'); }?>"></td>
              <td>
                <?=$rs->name?>
                <br/>Customer Code: <?=$rs->code?>
                <?php if($rs->qid){?><br/>QID: <?=$rs->qid?><?php }?>
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
              <td>
                
                
                <a href="<?php echo base_url('crm/edit_clients/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="<?php echo base_url('crm/view_clients/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> view</a>
                 | 
                <a href="Javascript:prompt('Delete','Delete Customer?','<?=base_url('crm/delete_clients/'.$rs->id)?>')" class="load_modal_details"><i class="fa fa-trash"></i> Delete</a>
                 
                 
              </td>
            </tr>
            <?php }}?>
           </tbody>

        </table>

  
      </div>
    </div>
  </div> 
   
</div>

 
 

