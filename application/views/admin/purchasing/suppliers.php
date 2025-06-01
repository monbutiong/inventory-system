<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales <small>Suppliers List</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 110px;">
                <a class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('purchasing/add_supplier');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New Supplier</a>
            </div>

            <!-- <div class="input-group-btn pull-right" style="padding-right: 90px;">
                <a class="btn btn-sm btn-success load_modal_details" href="<?php echo base_url('purchasing/upload_supplier');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Upload CSV</a>
            </div> -->
           
        <div class="clearfix"></div>
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
              <td>
                
                <a href="<?php echo base_url('purchasing/view_supplier/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-file-text-o"></i> view</a>
                 | 
                <a href="<?php echo base_url('purchasing/edit_supplier/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>

                 | 
                <a href="Javascript:ddel(<?=$rs->id?>)"  ><i class="fa fa-trash"></i> delete</a>
                <!--  | 
                <a href="<?php echo base_url('purchasing/create_po/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-cube"></i> Products </a> -->
                 
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
 

