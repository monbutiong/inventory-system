<style>
.datepicker{z-index:1151 !important;}
 
* {
  box-sizing: border-box;
}
 
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}
 
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>Edit BIB</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/update_bib/<?php echo $bib->id?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="customer_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($customer){
                    foreach($customer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->customer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>
           
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="myInput" name="bib_name" value="<?php echo $bib->bib_name;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB S/N <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="bib_sn" value="<?php echo $bib->bib_sn;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Device Number  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="device_number" value="<?php echo $bib->device_number;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Package Type and Lead Count 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="package_type" value="<?php echo $bib->package_type;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Type  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bib_type_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_type){
                    foreach($bib_type as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_type_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">PM date (WWMM) <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="pm_date"  value="<?php echo $bib->pm_date;?>" required="required" class="form-control col-md-7 col-xs-12" maxlength="4">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Part Number 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="socket_part_number"  value="<?php echo $bib->socket_part_number;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Manufacturer 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="socket_manufacturer_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($socket_manufacturer){
                    foreach($socket_manufacturer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->socket_manufacturer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Type  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="socket_type_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($socket_type){
                    foreach($socket_type as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->socket_type_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Manufacturer  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bib_manufacturer_id"  class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_manufacturer){
                    foreach($bib_manufacturer as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_manufacturer_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Socket Density 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               
              <div class="row">
                <div class="col-sm-4">
                  <input type="number" name="socket_density" min="1"  value="<?php echo $bib->socket_density;?>" class="form-control col-md-3">
                </div> 
                <div class="form-group col-sm-4 has-feedback">
                  <input type="number" name="socket_row" value="<?php echo $bib->socket_row;?>" class="form-control col-md-3" placeholder="row">
                  <span class="form-control-feedback right" aria-hidden="true">row</span>
                </div> 
                <div class="form-group col-sm-4 has-feedback">
                  <input type="number" name="socket_column" value="<?php echo $bib->socket_column;?>" class="form-control col-md-3" placeholder="column">
                  <span class="form-control-feedback right" aria-hidden="true">col</span>
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Good Socket <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="good_socket" value="<?php echo $bib->good_socket;?>" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Defective Socket <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="defective_socket" value="<?php echo $bib->defective_socket;?>" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Status <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bib_status_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_status){
                    foreach($bib_status as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_status_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">BIB Location <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bib_location_id" required="required" class="form-control col-md-7 col-xs-12">
                  <option value="">select</option>
                  <?php 
                  if($bib_location){
                    foreach($bib_location as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($bib->bib_location_id==$rs->id){echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="remarks"  value="<?php echo $bib->remarks;?>" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Uploaded <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="date" name="date_uploaded" value="<?php echo @$bib->date_uploaded ? $bib->date_uploaded : date('Y-m-d');?>" required="required" value="<?php echo date('Y-m-d')?>" class="form-control col-md-7 col-xs-12" >
            </div>
          </div>

 
          
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
              <button type="submit" class="btn btn-success">Save Information</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  

  $(function(){

      $('.datepicker').daterangepicker({
             format: 'mm/dd/yyyy',
             singleDatePicker: true
         });

    });


  function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

<?php
if(@$inventory){
  foreach ($inventory as $rs) {
    if(!@$arr_bn[$rs->bib_name]){
      $arr_bn[$rs->bib_name] = 1;
      @$bib_names.= '"'.$rs->bib_name.'",';
    }
  }
}
?>
/*An array containing all the country names in the world:*/
var countries = [<?php echo $x = substr(@$bib_names, 0, -1);?>];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
 

