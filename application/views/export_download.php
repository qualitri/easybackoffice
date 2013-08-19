<?php if($this->session->userdata('step') >= 4): ?>

<form id="field-properties" method="post" action="<?php echo $base_url ?>export/download">
    <h2>You are a visitor</h2>
    <input type="submit" value="Download" />
</form>

<?php endif ?>