<form class='form-horizontal' method='post' action='' id='test'> 
	<legend> Form test</legend>
	<?php if(isset($entity)): ?>
	<div class='control-group'> 
		<label class='control-label'>nombre</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getNombre(); ?>' placeholder='Insert Data' class='input-xlarge' name='nombre' id='txt_nombre'>
		</div> 
	</div> 
	<div class='control-group'> 
		<label class='control-label'>apellido</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getApellido(); ?>' placeholder='Insert Data' class='input-xlarge' name='apellido' id='txt_apellido'>
		</div> 
	</div> 
	<?php else: ?>	<div class='control-group <?php if(form_error('topic')) echo 'error' ?>'> 
		<label class='control-label'>nombre</label>
		<div class='controls'> 
			<input type='text' value='<?php echo set_value('Nombre'); ?>' placeholder='Insert Data' class='input-xlarge' name='nombre' id='txt_nombre'>
		</div> 
	</div> 
	<div class='control-group <?php if(form_error('topic')) echo 'error' ?>'> 
		<label class='control-label'>apellido</label>
		<div class='controls'> 
			<input type='text' value='<?php echo set_value('Apellido'); ?>' placeholder='Insert Data' class='input-xlarge' name='apellido' id='txt_apellido'>
		</div> 
	</div> 
<?php endif; ?>
<div class='control-group'>
<div class='controls'>
<button type='submit' class='btn btn-primary'>
<?php echo $form_action == 'save' ? $this->lang->line('create') : $this->lang->line('update') ?>
</button>
<a class='btn' href='<?php echo $base_url.'' ?>'><?php echo $this->lang->line('cancel') ?></a>
</div>
</div>
</form> 
