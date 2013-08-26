<!DOCTYPE html><html lang='en'><head>	<meta charset='utf-8'>	<title>Bienvenido a Qualitri Form</title>	<link href='<?php echo $css_path ?>/bootstrap.min.css' rel='stylesheet' media='screen'>	<link href='<?php echo $css_path ?>/bootstrap-responsive.min.css' rel='stylesheet'>	<script src='<?php echo $js_path ?>/vendor/bootstrap.min.js'></script></head><body><form class='form-horizontal' method='post' action='' id='Test'> 
	<legend><?php echo $this->lang->line('presentation_form') ?></legend>
	<?php if(isset($entity)): ?>
	<div class='control-group'> 
		<label class='control-label'>hola</label>
		<div class='controls'> 
			<input type='text' placeholder='Insert Data' class='input-xlarge' name='hola' id='txt_hola_hola'>
		</div> 
	</div> 
	<div class='control-group'> 
		<label class='control-label'>chau</label>
		<div class='controls'> 
			<input type='text' placeholder='Insert Data' class='input-xlarge' name='chau' id='txt_chau_chau'>
		</div> 
	</div> 
	<div class='control-group'>
		<div class='controls'>
			<button type='submit' class='btn btn-primary'>
<?php echo $form_action == 'save' ? $this->lang->line('create') : $this->lang->line('update') ?>
			</button>
			<a class='btn' href='<?php echo $base_url.'admin/presentation' ?>'><?php echo $this->lang->line('cancel') ?></a>
		</div>
	</div>
</form> 
</body></html>