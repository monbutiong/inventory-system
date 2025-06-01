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
        <h2>Issuance<small>Item List</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        
        <div class="row">
          <div class="col-md-6">
              
              <select id="search_project_id" onchange="load_item_list()" class="form-control select2_"> 
                <option value="0">Project: All</option>
                <?php 
                if(@$projects){
                  foreach ($projects as $rs) {
                ?>
                <option value="<?=$rs->id?>"><?=$rs->name?></option>
                <?php }}?>
              </select>

          </div>
          <div class="col-md-6">
            <select id="search_by_filter_by" onchange="load_item_list()" class="form-control select2_">
              <option value="0-0">Set Filter</option>
              <?php 
              if(@$suppliers){
                foreach($suppliers as $rs){
              ?>
              <option value="supp-<?=$rs->id?>">Supplier: <?=$rs->name?></option>
              <?php }}?>
              <?php 
              if(@$purchase_order){
                foreach($purchase_order as $rs){
              ?>
              <option value="po-<?=$rs->id?>">P.O.: <?=$rs->po_number?></option>
              <?php }}?> 
            </select>
          </div>
        </div>

        
        <br/>
        

        <div id="load_search_items"></div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>  
               
            </div>
          </div>

        
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">

   function load_item_list(){

      var proj = $("#search_project_id").val();
      var filter_by = $("#search_by_filter_by").val();
      var ex_id = $("#selected_ids").val();

      ex_id = ex_id.replaceAll('(', '');
      ex_id = ex_id.replaceAll(')', '');

      $("#load_search_items").load("<?=base_url('outgoing/load_search_items')?>/"+proj+"/"+filter_by+"/"+ex_id);

   }

   $('#gmodal').addClass('modal-lg-mod'); 
</script>