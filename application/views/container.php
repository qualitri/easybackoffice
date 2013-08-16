<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
    <script>
        HOST = "<?php echo $base_url ?>";
    </script>
</head>
<body>
	<script type="text/javascript">
		function newfields () {
			document.getElementById('second-step').contentDocument.location.reload(true);
            document.getElementById('third-step').contentDocument.location.reload(true);
		}
		
	</script>
	<iframe id="first-step" src="<?php echo $base_url ?>form_build/add_fields" onload="newfields()" frameborder="0" style="width:900px; height:290px;"></iframe>
	<iframe id="second-step" src="<?php echo $base_url ?>form_build/field_properties" frameborder="0" style="width:900px; height:290px;"></iframe>
	<iframe id="third-step" src="<?php echo $base_url ?>form_build/entity_info" frameborder="0" style="width:900px; height:290px;"></iframe>
	<iframe id="fourth-step" src="<?php echo $base_url ?>export" frameborder="0" style="width:900px; height:290px;"></iframe>
</body>
</html>