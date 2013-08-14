<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
</head>
<body>

<div id="container">
	<form id="add-fields" method="post" action="<?php echo $base_url ?>form_build/save_fields">
		<h1>Step 1 - list all form fields</h1>
		<textarea id="txtarea" name="field_list" cols="40" rows="5" ><?php echo $field_list ?></textarea>
		<input type="submit" value="Submit form" />
	</form>

</div>

</body>
</html>