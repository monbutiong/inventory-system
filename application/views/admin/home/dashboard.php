<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>BIB Inventory <small>Masterlist</small></h2> 
           
          <!--
            <div class="input-group-btn pull-right" style="padding-right: 100px;">
            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select Actions <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
            
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>home/add_new_bib" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New BIB</a>
            </li>
            
            <li class="divider"></li>
 
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB Storage</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/1" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB Retrival</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/3" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB for PM</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/4" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Repair IN</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/5" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Repair OUT</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/6" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Engineering Evaluation</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/7" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Return BIB (Interval)</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/8" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Return BIB (Interval)</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/9" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Quality Alert IN</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/10" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Quality Alert OUT</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/11" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Scrap</a>
            </li>
           
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Sample</a>
            </li>
          -->

             
          </div>

   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>
         
        <table id="datatable_reg" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>BIB Name</th> 
              <th>Customer</th>
              <th>Pckage Type & Lead Count</th>
              <th>Device Number</th>
              <th>BIB Type</th>
              <th>Socket Density</th> 
              <th>Total BIB Qty.</th> 
              <th>Total Socket Density</th> 
              <th>Good Socket</th> 
              <th>Bad Socket</th> 
              <th>SKT Availability</th>
              <th>Prod'n</th>
              <th>Stored</th>
              <th>PM</th>
              <th>Repair</th>
              <th>Eng'g Eval'n</th>
              <th>Quality Alert</th>
              <th>Return To Customer</th>
              <th>Scrap</th>
            </tr>
            </thead>  
            <tbody>
            <?php
            if(@$inventory){
              foreach ($inventory as $row) { 
            }}

            if($inventory){
              foreach ($inventory as $rs) { 
                $inventory2[$rs->bib_name] = $rs;
                @$arr_count[$rs->bib_name]+= 1;

                @$arr_socket_good[$rs->bib_name]+= $rs->good_socket;
                @$arr_socket_bad[$rs->bib_name]+= $rs->defective_socket;
                
                @$arr_socket_density[$rs->bib_name]+= $rs->socket_density;
                @$arr_socket_availability[$rs->bib_name]+= round(($rs->good_socket/$rs->socket_density)*100,2);
                @$arr_bib_loc[$rs->bib_name.'-x-'.$rs->bib_location_id]+=1;
              }
            } 

            if($customer){
              foreach ($customer as $rs) { 
                $arr_customer[$rs->id] = $rs->title;
              }
            }

            if($bib_type){
              foreach ($bib_type as $rs) { 
                $arr_bib_type[$rs->id] = $rs->title;
              }
            }
            
            if(@$inventory2){
              foreach ($inventory2 as $row) { 
            ?>
            <tr>
              <td><?php echo $row->bib_name;?></td>
              <td><?php echo @$arr_customer[@$row->customer_id];?></td>
              <td><?php echo @$row->package_type?></td>
              <td><?php echo @$row->device_number?></td>
              <td><?php echo @$arr_bib_type[@$row->bib_type_id]?></td>
              <td><?php echo @$row->socket_density?></td> 
              <td><?php echo (@$arr_count[@$row->bib_name] ? $arr_count[$row->bib_name] : 0)?></td>
              <td><?php echo (@$arr_socket_density[@$row->bib_name] ? $arr_socket_density[$row->bib_name] : 0)?></td>
              <td><?php echo (@$arr_socket_good[@$row->bib_name] ? $arr_socket_good[$row->bib_name] : 0)?></td>
              <td><?php echo (@$arr_socket_bad[@$row->bib_name] ? $arr_socket_bad[$row->bib_name] : 0)?></td>
              <td><?php echo (@$arr_socket_availability[@$row->bib_name] ? round($arr_socket_availability[$row->bib_name]/$arr_count[$row->bib_name],2) : 0).'%'?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-6'] ? @$arr_bib_loc[$row->bib_name.'-x-6'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-5'] ? @$arr_bib_loc[$row->bib_name.'-x-5'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-7'] ? @$arr_bib_loc[$row->bib_name.'-x-7'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-8'] ? @$arr_bib_loc[$row->bib_name.'-x-8'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-9'] ? @$arr_bib_loc[$row->bib_name.'-x-9'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-11'] ? @$arr_bib_loc[$row->bib_name.'-x-11'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-10'] ? @$arr_bib_loc[$row->bib_name.'-x-10'] : 0)?></td>
              <td><?php echo (@$arr_bib_loc[$row->bib_name.'-x-12'] ? @$arr_bib_loc[$row->bib_name.'-x-12'] : 0)?></td>
             
            </tr>
          <?php }}?>
          
          </tbody>
        </table>
      </div>
    </div>
  </div> 
   
</div>
 

