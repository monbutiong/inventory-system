<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
       
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Users Roles</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                    
                        <button type="submit" class="btn btn-success">
                          <i class="fa fa-save"></i> Update Roles</button>

                        <a class="btn btn-md btn-warning  " href="<?= base_url('home/system_users') ?>">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
      <div class="card"> 
      <div class="card-body">
        <form method="post" action="<?= base_url('home/save_user_roles/' . $id) ?>">
          <div class="accordion" id="accordionRoles">
            <?php 
              if ($user_roles) {
                foreach ($user_roles as $rs) {
                  $arr_user_roles[$rs->sub_menu_id] = 1;
                }
              }

              foreach ($main_menu as $m => $rs) {
                $collapseId = "collapseMenu{$rs->id}";
            ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $rs->id ?>">
                  <button class="accordion-button <?= $m > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="<?= $m == 0 ? 'true' : 'false' ?>" aria-controls="<?= $collapseId ?>">
                    <?= $rs->title ?>
                  </button>
                </h2>
                <div id="<?= $collapseId ?>" class="accordion-collapse collapse <?= $m == 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $rs->id ?>" data-bs-parent="#accordionRoles">
                  <div class="accordion-body">
                    <?php
                      if ($sub_menu) {
                        foreach ($sub_menu as $rs_sub) {
                          if ($rs_sub->main_menu_id == $rs->id) {
                    ?>
                      <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="role_<?= $rs_sub->id ?>" name="user_role<?= $rs_sub->id ?>" value="<?= $rs->id ?>" <?= isset($arr_user_roles[$rs_sub->id]) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="role_<?= $rs_sub->id ?>"><?= $rs_sub->title ?></label>
                      </div>
                    <?php }}} ?>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>

         
        </form>
      </div>
    </div>
  </div>

  
</div>
