<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
       
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Users Roles : <?=$system_user->name?></h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                    
                        <button type="button" id="check_all" class="btn btn-success">
                          <i class="fa fa-check"></i> Check All</button>

                        <button type="button" id="update_roles"  class="btn btn-success">
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

        <div class="rows">
          <div class="col col-md-6">

            <form method="post" name="frm_access" action="<?= base_url('home/save_user_roles/' . $id) ?>">
              <div class="accordion" id="accordionRoles">
                <?php 
                  if ($user_roles) {
                    foreach ($user_roles as $rs) {
                      $arr_user_roles[$rs->sub_menu_id] = 1;
                      if (!empty($rs->access_features)) {
                          $decoded = json_decode($rs->access_features, true); // decode as array
                          if (is_array($decoded)) {
                              foreach ($decoded as $option) {
                                  $arr_user_roles_access[$rs->sub_menu_id][$option] = 1;
                              }
                          }
                      }
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
                        <?php if ($sub_menu): ?>
                          <?php foreach ($sub_menu as $rs_sub): ?>
                            <?php if ($rs_sub->main_menu_id == $rs->id): ?>
                              <div class="mb-3 p-2 bg-light border rounded">
                                <div class="form-check form-switch mb-2">
                                  <input type="checkbox"
                                         class="form-check-input"
                                         id="role_<?= $rs_sub->id ?>"
                                         name="user_role<?= $rs_sub->id ?>"
                                         value="<?= $rs->id ?>"
                                         <?= isset($arr_user_roles[$rs_sub->id]) ? 'checked' : '' ?>>
                                  <label class="form-check-label fw-bold" for="role_<?= $rs_sub->id ?>">
                                      <?= $rs_sub->title ?>
                                  </label>
                                </div>

                                <?php if (!empty($rs_sub->access_features)): ?>
                                  <div class="row ms-2 mt-2">
                                    <?php foreach (explode(',', $rs_sub->access_features) as $option): ?>
                                      <?php
                                        $checked = isset($arr_user_roles_access[$rs_sub->id][$option]) ? 'checked' : '';
                                        $option_id = $rs_sub->id;
                                        @$x+=1;
                                      ?>
                                      <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 mb-1">
                                        <div class="form-check form-check-inline">
                                          <input type="checkbox"
                                                 class="form-check-input"
                                                 id="feature_<?= $option_id ?>_<?=$x?>"
                                                 name="user_option<?= $option_id ?>[]"
                                                 value="<?= $option ?>"
                                                 <?= $checked ?>>
                                          <label class="form-check-label" for="feature_<?= $option_id ?>_<?=$x?>">
                                            <?= ucwords(trim($option)) ?>
                                          </label>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                  </div>
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
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
  </div>

  
</div>
<script>
$(document).ready(function() {
    // Check All / Uncheck All Logic
    $('#check_all').click(function() {
        var checkboxes = $('form input[type="checkbox"]');
        var allChecked = checkboxes.length === checkboxes.filter(':checked').length;

        if (allChecked) {
            checkboxes.prop('checked', false);
            $(this).html('<i class="fa fa-check"></i> Check All');
        } else {
            checkboxes.prop('checked', true);
            $(this).html('<i class="fa fa-times"></i> Uncheck All');
        }
    });

    // Update Roles Swal Confirmation
    $('#update_roles').click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will update the user's roles.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.frm_access.submit(); // Submit the form
            }
        });
    });

    // Auto-check main role checkbox if any of its sub-options are checked
    $('input[type="checkbox"]').on('change', function () {
        // Only apply for sub-option checkboxes (they have ids like 'feature_12_view' etc.)
        if ($(this).attr('id').startsWith('feature_')) {
            const parts = $(this).attr('id').split('_'); // ['feature', '12', 'view']
            const roleId = parts[1]; // e.g. '12'
            const mainCheckbox = $('#role_' + roleId);

            // If any related sub-option checkbox is checked, check main
            const relatedFeatures = $(`input[id^="feature_${roleId}_"]`);
            const anyChecked = relatedFeatures.is(':checked');

            if (anyChecked) {
                mainCheckbox.prop('checked', true);
            }
        }
    });

});
</script>

