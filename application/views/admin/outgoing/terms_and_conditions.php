 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
     

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Quotation Terms and Condition</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                      <?php if(!@$option){?>
                        <?php if (in_array('add', $access_features)) : ?>
                         <a class="btn btn-md btn-primary" href="<?php echo base_url('outgoing/terms_and_conditions/add');?>" >Add New</a>
                         <?php endif; ?>
                      <?php }?>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">

        <div class="card">
            <div class="card-body">

        <p class="text-muted font-13 m-b-30">
          
        </p>

        <style type="text/css">
          input {
            border: 0;
          }
        </style>
        
        <?php if(@$option == 'edit' || @$option == 'add'){?>

          <?php if(@$option == 'edit'){?>
          <form method="post" id="frm_validation" action="<?php echo base_url('outgoing/update_tnc/'.$id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
          <?php }else{?>
            <form method="post" id="frm_validation" action="<?php echo base_url('outgoing/save_tnc');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
          <?php }?>
          
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title"  value="<?=@$tnc->title?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>  

            <div class="form-group" >
                      <br/>
                      <br/>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="elm1" name="description"><?=@$tnc->description?></textarea>
             </div>
           </div>

           <div class="form-group" >
            <br/><br/>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Arabic Description
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="elm1" name="arabic"><?=@$tnc->arabic?></textarea>
             </div>
           </div>

             
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                
                  <br/>
                  <a href="<?=base_url('outgoing/terms_and_conditions')?>" class="btn btn-primary"  >Cancel</a> 
                  <button type="submit" class="btn btn-success">Save</button>
          
                 
              </div>
            </div>

          </form>


        <?php }else{?>

        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
     
              <th>Ttile</th> 
              <th>Template</th> 
              <th>Arabic Template</th>             
              <th>Options</th> 
            </tr>
            </thead> 
            <tbody>
            <?php 
  

            if(@$tnc){
              foreach($tnc as $rs){
            ?>
            <tr> 
              <td><?=$rs->title?></td>   
              <td><?=$rs->description?></td>  
              <td align="right"><?=$rs->arabic?></td>     
              <td style="white-space: nowrap; font-size: 13px;">
                <div class="d-flex flex-wrap gap-2">

                  <?php if (in_array('edit', $access_features)) : ?>
                    <a href="<?= base_url('outgoing/terms_and_conditions/edit/' . $rs->id); ?>" class="text-primary">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                  <?php endif; ?>

                  <?php if (in_array('delete', $access_features)) : ?>
                    <a href="javascript:delete_tnc(<?= $rs->id ?>);" class="text-danger">
                      <i class="fa fa-trash"></i> Delete
                    </a>
                  <?php endif; ?>

                </div>
              </td>

            </tr>
            <?php }}?>
           </tbody>

        </table>

       
      <?php }?>
      </div>

      </div>
    </div>

    </div>
  </div>  
</div> 

<script type="text/javascript">
  function delete_tnc(id) {
    Swal.fire({
      title: 'Delete Template?',
      text: "Are you sure you want to delete this template?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleting...',
          text: 'Please wait',
          icon: 'info',
          showConfirmButton: false,
          timer: 1000
        });

        // Redirect after short delay (for smoother UX)
        setTimeout(() => {
          window.location.href = "<?=base_url('outgoing/delete_tnc')?>/" + id;
        }, 1000);
      } else {
        Swal.fire('Cancelled', 'No changes were made.', 'info');
      }
    });
  }
</script>
 

