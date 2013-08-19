<?php if($this->session->userdata('step') >= 4): ?>

<form id="field-properties" method="post" action="<?php echo $base_url ?>export/generate">
    <h2>You are in localhost</h2>
    <input type="submit" value="Save Files" />
</form>

<?php endif ?>