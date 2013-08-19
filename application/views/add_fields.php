<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bienvenido a Qualitri Form</title>
    <script src="<?php echo $js_path ?>/vendor/bootstrap.min.js"></script>
    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>

<div id="container">
    <form id="add-fields" method="post" action="<?php echo $base_url ?>form_build/save_fields">
        <textarea id="txtarea" name="field_list" cols="40" rows="5" ><?php echo $field_list ?></textarea>
        <input class="btn btn-xs btn-success" type="submit" value="Submit form" />
    </form>

</div>

</body>
</html>