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
                          <?php if (in_array('add', $access_features)) : ?>
                            <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('purchasing/add_supplier_po');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Supplier</a>
                          <?php endif;?>
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
              <td style="line-height: 1.5;">
                <div class="d-flex flex-wrap gap-2">

                  
                    <a href="<?= base_url('purchasing/view_supplier_po/' . $rs->id); ?>"
                       class="text-info load_modal_details"
                       data-bs-toggle="modal"
                       data-bs-target=".bs-example-modal-lg">
                      <i class="fa fa-eye"></i> View
                    </a> 

                  <?php if (in_array('edit', $access_features)) : ?>
                    <a href="<?= base_url('purchasing/edit_supplier_po/' . $rs->id); ?>"
                       class="text-primary load_modal_details"
                       data-bs-toggle="modal"
                       data-bs-target=".bs-example-modal-lg">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                  <?php endif; ?>

                  <?php if (in_array('delete', $access_features)) : ?>
                    <a href="javascript:void(0);"
                       onclick="prompt_delete('Delete', 'Delete <?= addslashes($rs->name) ?>?', '<?= base_url('purchasing/delete_supplier_po/' . $rs->id) ?>', 'tr<?= $rs->id ?>')"
                       class="text-danger">
                      <i class="fa fa-trash"></i> Delete
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
 
 

