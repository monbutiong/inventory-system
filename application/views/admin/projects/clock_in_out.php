<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Projects <small>Clock In/Out</small></h2> 

        <div class="input-group-btn pull-right" style="padding-right: 120px;">
                <a class="btn btn-sm btn-primary" href="Javascript:download_data()">Download Data</a>
            </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Date</th>  
              <th>Project</th> 
              <th>Job Order Number</th> 
              <th>Employee Number</th>
              <th>Employee</th> 
              <th>Time In</th> 
              <th>Time Out</th>  
              <th>Comment</th>  
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$emp){
              foreach($emp as $rs){
              $arr_emp[$rs->id] = $rs;
            }}

            if(@$projects){
              foreach($projects as $rs){
              $arr_p[$rs->id] = $rs;
            }}

            if(@$jo){
              foreach($jo as $rs){
              $arr_jo[$rs->id] = $rs;
            }}

            if(@$cio){
              foreach($cio as $rs){
            ?>
            <tr> 
              <td><?=date('M d, Y', strtotime($rs->date))?></td> 
              <td><?=@$arr_p[@$arr_jo[$rs->job_order_id]->project_id]->name?></td> 
              <td><?=@$arr_jo[$rs->job_order_id]->job_order_number?></td> 
              <td><?=@$arr_emp[$rs->employee_id]->employee_number?></td>
              <td><?=@$arr_emp[$rs->employee_id]->first_name.' '.@$arr_emp[$rs->employee_id]->last_name?></td>
              <td><a href="Javascript:openMap(<?=$rs->loc_in?>)"><?=$rs->time_in?></a></td>
              <td><a href="Javascript:openMap(<?=$rs->loc_out?>)"><?=$rs->time_out?></a></td>
              <td><?=$rs->comment?></td>
            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
  function download_data(){
    reset(); 

    alertify.confirm("Download Data from Ventum web applicaton?", function (e) {
          if (e) {  
              alertify.log("downloading...");
              location.href = "<?php echo base_url();?>projects/download_clock_in_out_data";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }
 
  function openMap(lon, lat) {
    // Construct the URL with the specified longitude and latitude
    const mapUrl = `https://www.google.com/maps?q=${lat},${lon}&z=15`;

    // Specify the dimensions and features of the popup window
    const popupWidth = 600;
    const popupHeight = 400;
    const popupFeatures = `width=${popupWidth},height=${popupHeight},top=100,left=100,scrollbars=yes,resizable=yes`;

    // Open the map in a popup window
    window.open(mapUrl, 'Google Maps', popupFeatures);

    // Prevent the default behavior of the anchor tag
    return false;
  }
</script>