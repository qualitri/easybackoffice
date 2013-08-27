<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Easybackoffice</title>
	<link href='<?php echo $css_path ?>/bootstrap.min.css' rel='stylesheet' media='screen'>
	<link href='<?php echo $css_path ?>/bootstrap-responsive.min.css' rel='stylesheet'>
	<script src='<?php echo $js_path ?>/vendor/bootstrap.min.js'></script>
</head>
<body>
<form class='form-horizontal' method='post' action='' id='Test'> 
	<legend> Form Test</legend>
	<?php if(isset($entity)): ?>
	<div class='control-group'> 
		<label class='control-label'>name</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getName(); ?>' placeholder='Insert Data' class='input-xlarge' name='name' id='txt_name_name'>
		</div> 
	</div> 
	<div class='control-group'> 
		<label class='control-label'>last</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getLast(); ?>' placeholder='Insert Data' class='input-xlarge' name='last' id='txt_last_last'>
		</div> 
	</div> 
	<?php else: ?>	<div class='control-group <?php if(form_error('topic')) echo 'error' ?>'> 
		<label class='control-label'>name</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getName(); ?>' placeholder='Insert Data' class='input-xlarge' name='name' id='txt_name_name'>
		</div> 
	</div> 
	<div class='control-group <?php if(form_error('topic')) echo 'error' ?>'> 
		<label class='control-label'>last</label>
		<div class='controls'> 
			<input type='text' value='<?php echo $entity->getLast(); ?>' placeholder='Insert Data' class='input-xlarge' name='last' id='txt_last_last'>
		</div> 
	</div> 
	<div class='control-group'>
		<div class='controls'>
			<button type='submit' class='btn btn-primary'>
<?php echo $form_action == 'save' ? 'create' : 'update' ?>
			</button>
			<a class='btn' href='<?php echo $base_url.'admin/' ?>'><?php echo 'cancel' ?></a>
		</div>
	</div>
</form> 
</body>
</html>
