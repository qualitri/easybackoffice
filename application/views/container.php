<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
</head>
<body>
	<script type="text/javascript">
		/*function change(){document.getElementById("browse").src = document.getElementById("addr").value;}
    	function update(){document.getElementById("addr").value = document.getElementById("browse").src}*/
	</script>
<iframe id="first-step" src="form_build/add_fields" frameborder="0" style="width:900px; height:290px;"></iframe>
<iframe id="second-step" src="form_build/field_properties" onload="document.getElementById('first-step').src='form_build/add_fields'" frameborder="0" style="width:900px; height:290px;"></iframe>
</body>
</html>