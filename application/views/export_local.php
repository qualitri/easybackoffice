<?php if($this->session->userdata('step') >= 4): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Export localhost</title>
</head>
<body>
	<div id="container">
		<form id="field-properties" method="post" action="<?php echo $base_url ?>export/download">
			<h2>Save Files</h2>
			<input type="submit" value="Submit form" />
		</form>
	</div>
</body>
</html>
<?php endif ?>