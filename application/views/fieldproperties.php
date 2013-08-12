<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
</head>
<body>

<div id="container">
	<form method="post">
		<h1>Step 2 - list all form fields</h1>
		<div class="fields_generated">
			<label for="input1Type"> name </label>
			<select id="input1Type">
				<option value="text">Text input</option>
				<option value="hidden">Hidden text input</option>
				<option value="password">Password</option>
				<option value="textarea">Text area</option>
				<option value="select">Select/drop-down list</option>
				<option value="checkbox">Checkbox</option><option value="radio">Radio buttons</option>
			</select>
			<span class="required">
				<input type="checkbox" class="chkboxReq" id="req_1" value="req">
				<label for="req_1">Required field?</label>
			</span>
		</div>
		<a href="http://qualitriform.localhost/index.php/formbuilder">Back to previous step</a>
		<input type="submit" value="Submit form" />
	</form>

</div>

</body>
</html>