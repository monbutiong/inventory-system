<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
 
  .datepicker{z-index:1151 !important;}
  #datatable 
  {    
    overflow-y:hidden; 
  }
  select, .text_input {
      border: 1px solid #fff;
      background-color: transparent;
  } 
  .vcc{
    border-bottom-color: #999;
  }
</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Project<small>Job Order - Clock In/Out</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/> 

            <table id="la_table" class="table table-striped table-bordered table-hover">
                       
              <thead>
                <tr style="font-size: 12px;"> 
                  <th>Date</th>   
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
  
                if(@$cio){
                  foreach($cio as $rs){
                ?>
                <tr> 
                  <td><?=date('M d, Y', strtotime($rs->date))?></td>  
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

  $('#la_table').DataTable();

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
   
  $('#la_table').DataTable();

  function update_la(id){

    if($('#chk'+id).is(":checked")){
      var status = 1;
    }else{
      var status = 0;
    } 

    var postData = { 
      qi_id: id,
      status: status,
      qty: $('#qty'+id).val(),
      remarks: $('#remarks'+id).val()
    };

    $.post('<?=base_url("projects/save_labor/".$jo->id)?>', postData, function (data, status) {
        
        if(data == 0){
          alertify.log("Please add quantity");
        }
        
    });

  }

 </script>