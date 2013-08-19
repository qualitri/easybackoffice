<?php if($this->session->userdata('step') >= 4): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Export Download</title>
	<script src="<?php echo $js_path ?>/vendor/bootstrap.min.js"></script>
	<link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>
	<div id="container">
		<form id="field-properties" method="post" action="<?php echo $base_url ?>export/generate">
			<h2>Download Files</h2>
			<input class="btn btn-xs btn-success" type="submit" value="Submit form" />
		</form>
	</div>
</body>
</html>
<?php endif ?>