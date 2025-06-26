<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
         
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"> 
                        <h6 class="page-title">Vehicles Masterlist</h6>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-md btn-primary load_modal_details" href="<?php echo base_url('vehicles/add_vehicle');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Create New Vehicle</a>
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
              <th>Plate Number</th>
              <th>VIN</th>

              <th>Manufacturer</th>
              <th>Model</th>
              
              <th>Customer</th> 
              <th>Date Register</th>        
              <th>Last Transaction</th> 
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$models){
              foreach($models as $rs){
              $arr_model[$rs->id] = $rs->title.' - '.$rs->model_year;
            }}

            if(@$manufacturers){
              foreach($manufacturers as $rs){
              $arr_manufacturer[$rs->id] = $rs->title;
            }}

            if(@$customers){
              foreach($customers as $rs){
              $arr_c[$rs->id] = $rs->name;
            }}

            if(@$vehicles){
              foreach($vehicles as $rs){
            ?>
            <tr id="tr<?=$rs->id?>">
              <td><?=$rs->plate_no?></td> 
              <td><?=$rs->vin?></td>

              <td><?=@$arr_manufacturer[$rs->manufacturer_id]?></td>  
              <td><?=@$arr_model[$rs->vehicle_model_id]?></td> 
              
              <td><?=@$arr_c[$rs->customer_id]?></td> 
              <td><?=date('M d, Y H:i', strtotime($rs->date_created))?></td>
              <td><?=$rs->last_transactions ? date('M d, Y H:i', strtotime($rs->last_transactions)) : ''?></td>
              <td>
                
                
                <a href="<?php echo base_url('vehicles/edit_vehicle/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i> edit</a>
                 | 
                <a href="<?php echo base_url('vehicles/view_vehicle/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> view</a>
                 | 
                <a href="Javascript:prompt_delete('Delete','Delete Vehicle?','<?=base_url('vehicles/delete_vehicle/'.$rs->id)?>','tr<?=$rs->id?>')" ><i class="fa fa-trash"></i> Delete</a>
                  | 
                 <a href="<?php echo base_url('outgoing/purchase_history/vehicle/'.$rs->id);?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><i class="fa fa-archive"></i> Purchase History</a>
                 
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

 
 

