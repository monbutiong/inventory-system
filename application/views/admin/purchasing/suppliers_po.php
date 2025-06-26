<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
   

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"> 
                        <h6 class="page-title">Suppliers Masterlist</h6>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('purchasing/add_supplier_po');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Supplier</a>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
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

            if(@$suppliers_po){
              foreach($suppliers_po as $rs){
            ?>
            <tr id="tr<?=$rs->id?>"> 
              <td><?=$rs->name?></td>
              <td><?=$rs->address?><br/>
                
                <small>
                  <?=$rs->email?>
                </small>

              </td>
              <td>
                <small>
                  <?=$rs->contact_person_1.' | '.$rs->contact_number_1?><br/>
                  <?=$rs->contact_person_2.' | '.$rs->contact_number_2?>
                </small>
              </td> 
              <td>
                
                <a href="<?php echo base_url('purchasing/view_supplier_po/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> view</a>
                 | 
                <a href="<?php echo base_url('purchasing/edit_supplier_po/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>

                 | 
                <a href="javascript:prompt_delete('Delete', 'Delete <?=$rs->name?>?','<?=base_url('purchasing/delete_supplier_po/' . $rs->id)?>', 'tr<?=$rs->id?>')"  ><i class="fa fa-trash"></i> delete</a>
                
                 
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
 
 

