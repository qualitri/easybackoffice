<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
</head>
<body>
	<script type="text/javascript">
		function newfields () {
			document.getElementById('second-step').contentWindow.refresh_fields();

			//document.getElementById('second-step').src='form_build/field_properties'
		}
	</script>
	<iframe id="first-step" src="<?php echo $base_url ?>form_build/add_fields" onload="newfields()" frameborder="0" style="width:900px; height:290px;"></iframe>
	<iframe id="second-step" src="<?php echo $base_url ?>form_build/field_properties" frameborder="0" style="width:900px; height:290px;"></iframe>
</body>
</html>