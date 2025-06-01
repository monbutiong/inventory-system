<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Employee <small>Master List</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
          <a class="btn btn-sm btn-success" href="<?php echo base_url();?>employee/add_employee_content" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"  title="add new employee">Add Employee</a> 

          <a class="btn btn-sm btn-info" href="<?php echo base_url();?>employee/upload"   title="upload">Upload</a>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          List of all employee in the system.
        </p>
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Employee Number</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Middle Name</th>
              <th>Department</th>
              <th>Designation</th>
              <th>Email</th>
              <th>Contact Number</th>
              <!-- <th>Rate</th>
              <th>Basic Salary</th> -->
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php 

          if($department){
            foreach ($department as $rs) { 
              $arr_department[$rs->id] = $rs->title;
          }}

          if($designation){
            foreach ($designation as $rs) { 
              $arr_designation[$rs->id] = $rs->title; 
          }}

          if($employee){
          	foreach ($employee as $rs) { 
          ?>
            <tr>
              <td><?=$rs->employee_number; $en=$rs->id; //echo sprintf("%05d",$en=$rs->id);?></td>
              <td><?php echo $rs->last_name;?></td>
              <td><?php echo $rs->first_name;?></td>
              <td><?php echo $rs->middle_name;?></td>
              <td><?php if(isset($arr_department[$rs->department_id]) && $arr_department[$rs->department_id]){ echo $arr_department[$rs->department_id]; }?></td>
              <td><?php if(isset($arr_designation[$rs->designation_id]) && $arr_designation[$rs->designation_id]){ echo $arr_designation[$rs->designation_id]; }?></td>
              <td><?php echo $rs->email_address;?></td>
              <td><?php echo $rs->contact_no;?></td>
              <!-- <td><?php echo $rs->rate;?></td>
              <td align="right"><?php echo number_format($rs->basic_amount,2);?></td> -->
              <th>
                <a href="<?php echo base_url();?>employee/view_employee_content/<?php echo $rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-user"></i> view</a>
                | 
                <a href="<?php echo base_url();?>employee/edit_employee_content/<?php echo $rs->id;?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i> edit</a>
                | 
                <a href="Javascript:delete_employee(<?php echo $rs->id;?>,'<?php echo $en;?>');"><i class="fa fa-trash-o"></i> delete</a> 
              </th>
            </tr> 
           <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function delete_employee(id,eid){
  reset(); 

  alertify.confirm("delete employee "+eid+"?", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>employee/delete_employee/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

