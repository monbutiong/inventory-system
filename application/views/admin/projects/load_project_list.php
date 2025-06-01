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
        <h2>Projects<small> Job Order Masterlist</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
     
          
        </p>
 
        <table id="datatable_modal2" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">  
              <th>Project Name</th>    
              <th>Account Code</th>
              <th>Client</th>   
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            
            if(@$clients){
              foreach($clients as $rs){
              $arr_c[$rs->id] = $rs;
            }} 
 
            if(@$projects){
              foreach($projects as $rs){
            ?>
            <tr>  
              <td><?=$rs->name?></td>
              <td><?=sprintf("%05d",$rs->client_id)?></td>
              <td><?=@$arr_c[$rs->client_id]->name?></td>  
              <td nowrap>
                 
                <a href="Javascript:select_proj(<?=$rs->id?>)"> Select</a>
                 
              </td>
            </tr>
            <?php }}?>
           </tbody>

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">

$('#datatable_modal2').DataTable();

function select_proj(id){
  location.href = "<?=base_url('receipt/create_crv');?>/"+id;
}
</script>
 

