<div class="row">
  <div class="col-md-6 mb-12">
    <label>Terms and Conditions   
    </label>
    <textarea class="elm1" name="terms_and_conditions"><?=@$tnc->description?></textarea>
  </div>

  <div class="col-md-6 mb-12">
    <label>Arabic Terms and Conditions</label>
    <textarea class="elm1" name="terms_and_conditions_arabic"><?=@$tnc->arabic?></textarea>
  </div>
</div>

<script>
	tinymce.init({
	      selector: '.elm1' 
	    });
</script>