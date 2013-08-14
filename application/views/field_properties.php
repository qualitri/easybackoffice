<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
</head>
<body>
<script type="text/javascript">
	function refresh_fields() {
		document.forms['field-properties'].submit();
	}
	function especial_fields() {
		if (true) {};
	}
</script>
<div id="container">
	<form id="field-properties" method="post" action="<?php echo $base_url ?>form_build/save_properties">
		<h1>Step 2 - list all form fields</h1>
		<div class="fields_generated">
			<?php foreach ($fields as $field): ?>
                <div class="field field-<?php echo $field['name'] ?>">
                    <label for="input1Type"> <?php echo $field['label'] ?> </label>
                    <select id="input1Type" name="<?php echo 'type'.$field['name'] ?>">
                        <?php if(isset($field['type'])): ?>
                        <option <?php echo ($field['type'] == 'text') ? 'selected' : '' ?>
                            value="text">Text input</option>
                        <option <?php echo ($field['type'] == 'password') ? 'selected' : '' ?>
                            value="password">Password</option>
                        <option <?php echo ($field['type'] == 'textarea') ? 'selected' : '' ?>
                            value="textarea">Text area</option>
                        <option <?php echo ($field['type'] == 'select') ? 'selected' : '' ?>
                            value="select">Select/drop-down list</option>
                        <option <?php echo ($field['type'] == 'checkbox') ? 'selected' : '' ?>
                            value="checkbox">Checkbox</option>
                        <option <?php echo ($field['type'] == 'radio') ? 'selected' : '' ?>
                            value="radio">Radio buttons</option>
                        <?php else: ?>
                        <option value="text">Text input</option>
                        <option value="password">Password</option>
                        <option value="textarea">Text area</option>
                        <option value="select">Select/drop-down list</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio buttons</option>
                        <?php endif ?>
                    </select>
                    <span class="required">
                        <input type="checkbox" class="chkboxReq" id="req_1" name="<?php echo 'required'.$field['name'] ?>"
                            <?php if(isset($field['required'])) echo ($field['required']) ? 'checked' : ''  ?>>
                        <label for="req_1">Required field?</label>
                    </span>
                </div>
			<?php endforeach; ?>
		</div>
		<a href="<?php echo $base_url ?>/form_build">Back to previous step</a>
		<input type="submit" value="Submit form" />
	</form>
</div>
</body>
</html>