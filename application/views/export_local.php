<?php if($this->session->userdata('step') >= 4): ?>

<form class="form-horizontal" id="field-properties" method="post" action="<?php echo $base_url ?>export/generate">
    <div class="controls">
    	<h3>You are in localhost</h3>
    	<input class="btn btn-xs btn-success" type="submit" value="Save Files" />
    </div>
</form>

<?php endif ?>