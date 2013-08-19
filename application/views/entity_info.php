<?php if($this->session->userdata('step') >= 3): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Entity Info</title>
	<script src="<?php echo $js_path ?>/vendor/bootstrap.min.js"></script>
	<link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>
	<div id="container">
		<form id="field-properties" method="post" action="<?php echo $base_url ?>form_build/save_entity_info">
            <div class="field">
                <label for="entityName"> Entity name </label>
                <input type="text" id="entityName">
            </div>
			<input class="btn btn-xs btn-success" type="submit" value="Submit form" />
		</form>
	</div>
</body>
</html>
<?php endif ?>