<style>
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
        <h2>Quotation<small>Print Logs </small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
   
          <table id="datatable" class="table table-striped table-bordered table-hover">
             
            <thead>
              <tr style="font-size: 12px;">
                <th>Date</th>
                <th>User Info</th> 
              </tr>
            </thead>
            <tbody>
              <?php 
              if(@$users){
                foreach ($users as $rs) {
                  $arr_user[$rs->id] = $rs->name;
                }
              }

              if(@$q->print_logs){
                foreach (json_decode($q->print_logs) as $rs) { 
              ?>
              <tr>
                <td><?=date('M d, Y H:i',strtotime($rs->date))?></td>
                <td><?=@$arr_user[$rs->user_id]?></td>
              </tr>
              <?php }}else{?>
              <tr>
                <td colspan="2"><center><i>No printing history</i></center></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>  
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 