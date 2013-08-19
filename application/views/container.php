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

    <div class="step-wrapper">
        <h1>Step 1 - Add Fields</h1>
        <iframe id="first-step" src="<?php echo $base_url ?>form_build/add_fields" onload="step_one()" frameborder="0" style="width:900px; height:290px;"></iframe>
    </div>

    <div class="step-wrapper">
        <h1>Step 2 - Detail Fields</h1>
        <iframe id="second-step" src="<?php echo $base_url ?>form_build/field_properties" onload="step_two()" frameborder="0" style="width:900px; height:290px;"></iframe>
    </div>

    <div class="step-wrapper">
        <h1>Step 3 - Entity Info</h1>
        <iframe id="third-step" src="<?php echo $base_url ?>form_build/entity_info" onload="step_third()" frameborder="0" style="width:900px; height:290px;"></iframe>
    </div>

    <div class="step-wrapper">
        <h1>Step 4 - Export</h1>
        <iframe id="fourth-step" src="<?php echo $base_url ?>export" frameborder="0" style="width:900px; height:290px;"></iframe>
    </div>

    <script type="text/javascript">

        function step_one()
        {
            document.getElementById('second-step').contentDocument.location.reload(true);
        }

        function step_two()
        {
            document.getElementById('third-step').contentDocument.location.reload(true);
        }

        function step_third()
        {
            document.getElementById('fourth-step').contentDocument.location.reload(true);
        }

    </script>

</body>
</html>