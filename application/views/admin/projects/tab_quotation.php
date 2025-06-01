<table id="datatable" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>Date</th>
              <th>Quotation No.</th>
              <th>Revision</th> 
              <th>Att. To</th> 
              
              <th>Status</th>  
              <td>Last Update</td> 
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
  
            if(@$quotation){
              foreach($quotation as $rs){
            ?>
            <tr>
              <td data-order="-<?=$rs->id?>"><?=date('M d, Y',strtotime($rs->quotation_date))?></td>
              <td><?=@$rs->quotation_number?></td>
              <td><?=$rs->version?></td> 
              <td><?=$rs->att_to?></td>  
             
              <td><?=$rs->confirmed==1 ? 'Confirmed' : 'Draft'?></td> 
              <td><?=$rs->date_modified ? date('M d, Y',strtotime($rs->date_modified)) : ''?></td>
              <td><?=@$arr_user[$rs->user_id]?></td>
              <td nowrap>
         
                <a href="<?php echo base_url('vendor/print_quotation/'.$rs->id);?>" target="_blank"><i class="fa fa-print"></i> Print Preview</a>
                <!--  |   
                <a href="Javascript:delete_bib(<?=$rs->id?>)" class="load_modal_details"><i class="fa fa-remove"></i> Delete</a>
                  -->
                 
              </td>
            </tr>
            <?php }}?>
           </tbody>
       </table>