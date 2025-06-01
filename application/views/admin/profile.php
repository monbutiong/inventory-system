<?php
if($department){
  foreach ($department as $rs) { 
    $arr_department[$rs->id] = $rs->title;
}}

if($designation){
  foreach ($designation as $rs) { 
    $arr_designation[$rs->id] = $rs->title; 
}}
?>
<div class="row">

<div class="col-md-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Home <small>My Profile</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
          
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

        <span id="change_img" class="row_1">
          <a href="<?php echo base_url();?>home/change_picture" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" class="load_modal_details change_picture">
              <span class="caption"> change picture</span>

          <img class="img-responsive avatar-view" src="
          <?php if($avatar){?>
          <?php echo base_url();?>assets/uploaded_files/user/<?php echo $avatar;?>
          <?php }else{?>
          <?php echo base_url();?>assets/images/img.png
          <?php }?>
          " alt="Avatar" title="Change the avatar">
          

              </a>
         </span>     

        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $employee->address;?>
            </li>

            <li>
              <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $arr_department[$employee->department_id];?>
            </li>

            <li>
              <i class="fa fa-star user-profile-icon"></i> <?php echo $arr_designation[$employee->designation_id];?>
            </li>

            <li class="m-top-xs">
              <i class="fa fa-google-plus user-profile-icon"></i> <?php echo $employee->email_address;?>
               
            </li>
          </ul>

        </div>
    </div>
  </div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Recent Activities <small>Sessions</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
         
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="dashboard-widget-content">

        <ul class="list-unstyled timeline widget">
          
        <?php 
        if($audit_trail){
          foreach ($audit_trail as $rs) { 
        ?>
          <li>
            <div class="block">
              <div class="block_content">
                <h2 class="title">
                                  <a><?php echo $rs->module;?></a>
                              </h2>
                <div class="byline">
                  <span><?php echo date(datetimeformatc,strtotime($rs->dc));?></span> <!--by <a>Jane Smith</a>-->
                </div>
                <p class="excerpt"><?php echo $rs->description;?><!--<a>Read&nbsp;More</a>-->
                </p>
              </div>
            </div>
          </li> 
        <?php }}?>   
        </ul>
      </div>
    </div>
  </div>
</div>


</div>