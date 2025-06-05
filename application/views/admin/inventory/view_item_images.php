<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      
      <div class="x_title">


        <div class="modal-header">
            <h5 class="modal-title" id="mySmallModalLabel">View Item Images</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <br />
           
          
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <ol class="carousel-indicators">
                        <?php if(@$item->picture_1){?>
                          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                        <?php }?>
                        <?php if(@$item->picture_2){?>
                          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                        <?php }?>
                        <?php if(@$item->picture_3){?>
                          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                        <?php }?>
                      </ol>
                      <center>
                      <div class="carousel-inner mb-3" role="listbox" style="width: 100% !important;">
                        <?php if(@$item->picture_1){?>
                          <div class="carousel-item active">
                              <img class="d-block img-fluid" src="<?= base_url('assets/uploads/inventory/' . $item->picture_1) ?>" alt="First slide" style="height: 600px;">
                          </div>
                        <?php }?>
                        <?php if(@$item->picture_2){?>
                          <div class="carousel-item ">
                              <img class="d-block img-fluid" src="<?= base_url('assets/uploads/inventory/' . $item->picture_2) ?>" alt="First slide" style="height: 600px;">
                          </div>
                        <?php }?>
                        <?php if(@$item->picture_3){?>
                          <div class="carousel-item ">
                              <img class="d-block img-fluid" src="<?= base_url('assets/uploads/inventory/' . $item->picture_3) ?>" alt="First slide" style="height: 600px;">
                          </div>
                        <?php }?>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
                  </div>
                  </center>
  
          
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> 
                 
          </div>

    
      </div>
    </div>
  </div>
</div> 
  