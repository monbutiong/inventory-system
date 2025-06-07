<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Unconfirmed Purchase Order</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>
 
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
              <td>Vehicle</td> 
              <td>Customer</td> 
              <th>P.O. Number</th>
              <th>Supplier</th>
              <th>Att. To</th>  
              <td>Reference No.</td>  
              <td>Created By</td>    
              <th>Options</th>
            </tr>
            </thead> 
            <tbody>
            <?php 
            if(@$users){
              foreach($users as $rs){
              $arr_user[$rs->id] = $rs->name;
            }}
 
            if(@$customers){
              foreach($customers as $rs){
                $arr_c[$rs->id] = $rs->name;
            }}

            if(@$manufacturers){
              foreach($manufacturers as $rs){
                $arr_m[$rs->id] = $rs->title;
            }}

            if(@$vehicles){
              foreach($vehicles as $rs){
                $arr_v[$rs->id] = $rs;
            }}

            if(@$suppliers){
              foreach($suppliers as $rs){
                $arr_s[$rs->id] = $rs->name;
            }}

            if(@$purchase_order){
              foreach($purchase_order as $rs){
            ?>
            <tr id="tr<?=$rs->id?>">
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->date_created))?></td>
              <td><?=@$arr_m[@$arr_v[$rs->vehicle_id]->manufacturer_id].' - '.@$arr_v[$rs->vehicle_id]->plate_no?></td>
              <td><?=@$arr_c[@$arr_v[$rs->vehicle_id]->customer_id]?></td> 
              <td><?=@$rs->po_number?></td>
              <td><?=@$arr_s[$rs->supplier_id]?></td> 
              <td><?=$rs->att_to?></td>  
              <td><?=$rs->reference_no?></td> 
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>
                  
                <a href="Javascript:confirm_po(<?=$rs->id?>)"  ><i class="fa fa-check"></i> Confirm</a>
                 | 
                <a href="<?php echo base_url('purchasing/edit_po/'.$rs->id);?>" ><i class="fa fa-edit"></i> Edit</a>
                 |
                <a href="<?php echo base_url('purchasing/view_po/'.$rs->id);?>"  ><i class="fa fa-eye"></i> View</a>
                 |  
                <a target="_blank" href="<?php echo base_url('vendor/print_po/'.$rs->id);?>" ><i class="fa fa-print"></i> Print</a>
                 |  
                <a href="javascript:prompt_delete('Delete', 'Delete P.O. Number <?=@$rs->po_number?>?','<?=base_url('purchasing/delete_po/' . $rs->id)?>', 'tr<?=$rs->id?>')" ><i class="fa fa-trash"></i> Delete</a>
                  
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
 

function confirm_po(id) {

     
      Swal.fire({
        title: 'Confirm Purchase Order?',
        text: "Are you sure you want to confirm this purchase order?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, save it',
        cancelButtonText: 'No, cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Swal.fire({
          //   icon: 'success',
          //   title: 'Saving...',
          //   text: 'Your purchase order is being saved.',
          //   showConfirmButton: false,
          //   timer: 1000
          // });
          location.href = "<?=base_url('purchasing/save_confirm_po')?>/"+id;
        }  
      });


}

function confirmq(id){
  reset(); 

  alertify.confirm("Confirm Selected Quotation?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>sales/confirm_quotation/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>