<?php if($this->session->userdata('step') >= 4): ?>

<form class="form-horizontal" id="field-properties" method="post" action="<?php echo $base_url ?>export/download">
    <div class="controls">
    	<h3>You are a visitor</h3>
    	<input class="btn btn-xs btn-success" type="submit" value="Download" />
    </div>	
</form>

<?php endif ?>