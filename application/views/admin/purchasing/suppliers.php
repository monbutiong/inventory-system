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
                        <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('purchasing/add_supplier');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Vehicle</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Supplier ID</th>
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

            if(@$suppliers){
              foreach($suppliers as $rs){
            ?>
            <tr>
              <td><?=$rs->id?></td>
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
                  
                  <?php if (in_array('view', $access_features)) : ?>
                    <a href="<?= base_url('purchasing/view_supplier/' . $rs->id); ?>"
                       class="text-info load_modal_details"
                       data-bs-toggle="modal"
                       data-bs-target=".bs-example-modal-lg">
                      <i class="fa fa-file-text-o"></i> View
                    </a>
                  <?php endif; ?>

                  <?php if (in_array('edit', $access_features)) : ?>
                    <a href="<?= base_url('purchasing/edit_supplier/' . $rs->id); ?>"
                       class="text-primary load_modal_details"
                       data-bs-toggle="modal"
                       data-bs-target=".bs-example-modal-lg">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                  <?php endif; ?>

                  <?php if (in_array('delete', $access_features)) : ?>
                    <a href="javascript:void(0);"
                       onclick="ddel(<?= $rs->id ?>)"
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

<script type="text/javascript">
function ddel(id){
  reset(); 

  alertify.confirm("delete supplier? this will permanently delete selected supplier records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>purchasing/delete_supplier/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

