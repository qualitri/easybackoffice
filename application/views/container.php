<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>

    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo $css_path ?>/style.css" rel="stylesheet">

    <script>
        HOST = "<?php echo $base_url ?>";
    </script>

    <script src="<?php echo $js_path ?>/vendor/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $js_path ?>/vendor/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
<h1>Backoffice Generator</h1>
    <div class="step-wrapper">
        <legend id="step-1" class="step-active">Step 1 - Add Fields</legend>
        <div id="first-step">
            <?php echo file_get_contents(base_url('form_build/add_fields')) ?>
        </div>
    </div>

    <div class="step-wrapper">
        <legend id="step-2">Step 2 - Detail Fields</legend>
        <div id="second-step">
            <?php echo file_get_contents(base_url('form_build/field_properties')) ?>
        </div>
    </div>

    <div class="step-wrapper">
        <legend id="step-3">Step 3 - Entity Info</legend>
        <div id="third-step">
            <?php echo file_get_contents(base_url('form_build/entity_info')) ?>
        </div>
    </div>

    <div class="step-wrapper">
        <legend id="step-4">Step 4 - Export</legend>
        <div id="fourth-step">
            <?php echo file_get_contents(base_url('export')) ?>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#first-step').on('submit', 'form', function(){
                step_one(this);
                return false;
            });

            $('#second-step').on('submit', 'form', function(){
                step_two(this);
                return false;
            });

            $('#third-step').on('submit', 'form', function(){
                step_three(this);
                return false;
            });

            $('#fourth-step').on('submit', 'form', function(){
                if(step_four(this))
                    return true;

                return false;
            });
        });

        function step_one(form)
        {
            save_step_one(form);
            document.getElementById("step-1").className = "";
            document.getElementById("step-2").className += " step-active";
            //load_step_two();
        }

        function step_two(form)
        {
            save_step_two(form);
            document.getElementById("step-2").className = "";
            document.getElementById("step-3").className += " step-active";
            //load_step_three();
        }

        function step_three(form)
        {
            save_step_three(form);
            document.getElementById("step-3").className = "";
            document.getElementById("step-4").className += " step-active";
            //load_step_four();
        }

        function step_four(form)
        {
            save_step_four(form);
        }

        function save_step_one(form)
        {
            $.post(
                "<?php echo $base_url ?>form_build/save_fields",
                $(form).serialize()
            ).done(function(data) {
                load_step_two();
            });
        }

        function save_step_two(form)
        {
            $.post(
                "<?php echo $base_url ?>form_build/save_properties",
                $(form).serialize()
            ).done(function(data) {
                load_step_three();
            });
        }

        function save_step_three(form)
        {
            $.post(
                "<?php echo $base_url ?>form_build/save_entity_info",
                $(form).serialize()
            ).done(function(data) {
                load_step_four();
            });
        }

        function save_step_four(form)
        {
            if($(form).attr('action') == "<?php echo $base_url ?>export/generate")
            {
                $.post(
                    "<?php echo $base_url ?>export/generate",
                    $(form).serialize()
                ).done(function(data) {
                    alert('Your files have been generated');
                });

                return false;
            }

            return true;
        }

        function load_step_two()
        {
            $.get(
                "<?php echo $base_url ?>form_build/field_properties"
            ).done(function(data){
                $('#second-step').html(data);
            });

            load_step_three();
        }

        function load_step_three()
        {
            $.get(
                "<?php echo $base_url ?>form_build/entity_info"
            ).done(function(data){
                $('#third-step').html(data);
            });

            load_step_four();
        }

        function load_step_four()
        {
            $.get(
                "<?php echo $base_url ?>export"
            ).done(function(data){
                $('#fourth-step').html(data);
            });
        }

    </script>

</div>

</body>
</html>