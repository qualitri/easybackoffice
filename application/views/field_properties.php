<?php if($this->session->userdata('step') >= 2): ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Bienvenido a Qualitri Form</title>
    <script src="<?php echo $js_path ?>/vendor/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $js_path ?>/vendor/bootstrap.min.js"></script>
    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
</head>

<body>
<div id="container">

	<form id="field-properties" method="post" action="<?php echo $base_url ?>form_build/save_properties">

		<div class="fields_generated">

			<?php foreach ($fields as $field): ?>

            <div class="field field-<?php echo $field['name'] ?>">

                <label for="<?php echo 'type'.$field['name'] ?>"> <?php echo $field['label'] ?> </label>

                <select class="selectType" onchange="special_fields(this)" name="<?php echo 'type'.$field['name'] ?>"  id="<?php echo 'type'.$field['name'] ?>">

                    <?php if(isset($field['type'])): ?>

                    <option <?php echo ($field['type'] == 'text') ? 'selected' : '' ?>
                        value="text">Text input</option>
                    <option <?php echo ($field['type'] == 'password') ? 'selected' : '' ?>
                        value="password">Password</option>
                    <option <?php echo ($field['type'] == 'textarea') ? 'selected' : '' ?>
                        value="textarea">Text area</option>
                    <option <?php echo ($field['type'] == 'checkbox') ? 'selected' : '' ?>
                        value="checkbox">Checkbox</option>
                    <option <?php echo ($field['type'] == 'select') ? 'selected' : '' ?>
                        value="select">Select/drop-down list</option>
                    <option <?php echo ($field['type'] == 'checkbox_group') ? 'selected' : '' ?>
                        value="checkbox_group">Checkbox Group</option>
                    <option <?php echo ($field['type'] == 'radio') ? 'selected' : '' ?>
                        value="radio">Radio buttons</option>

                    <?php else: ?>

                    <option value="text">Text input</option>
                    <option value="password">Password</option>
                    <option value="textarea">Text area</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="select">Select/drop-down list</option>
                    <option value="checkbox_group">Checkbox Group</option>
                    <option value="radio">Radio buttons</option>

                    <?php endif ?>

                </select>

                <div class="optionsField">
                    <?php if(!empty($field['options'])): ?>
                    <textarea id="options<?php echo $field['name'] ?>" name="options<?php echo $field['name'] ?>"
                          placeholder="insert select options"><?php echo implode("\n", $field['options_raw']) ?></textarea>
                    <?php else: ?>
                    <textarea id="options<?php echo $field['name'] ?>" name="options<?php echo $field['name'] ?>"
                          placeholder="insert options"></textarea>
                    <?php endif ?>
                </div>

                <span class="required">
                    <input type="checkbox" class="chkboxReq" id="req_1" name="<?php echo 'required'.$field['name'] ?>"
                        <?php if(isset($field['required'])) echo ($field['required']) ? 'checked' : ''  ?>>
                    <label for="req_1">Required field?</label>
                </span>

            </div>

			<?php endforeach; ?>

		</div>

		<input class="btn btn-xs btn-success" type="submit" value="Submit form" />

	</form>

</div>

<script type="text/javascript">

    $(document).ready(function()
    {
        $('.field').each(function(key, element)
        {
            var type = $(element).find('.selectType').val();

            if (type != 'select' && type != 'checkbox_group' && type != 'radio')
            {
                $(element).find('.optionsField').hide();
            }
        });
    });

	function refresh_fields() {
		document.forms['field-properties'].submit();
	}

	function special_fields(element)
    {
        var type = element.value;

        if (type == 'select' || type == 'checkbox_group' || type == 'radio')
        {
            $(element).parent().children('.optionsField').show();
        }
        else
        {
            $(element).parent().children('.optionsField').hide();
        }

		/*var val = element.value;
		var id = element.id.substring(4);
		var div = document.getElementById(id);
		var el = div.querySelector('.field-container');

		function add_textarea(target) {

			var frag = document.createDocumentFragment();

			var newdiv = document.createElement("div");
			newdiv.className = "field-container";

			var textarea = document.createElement("textarea");
			textarea.id = "special";
			textarea.setAttribute('placeholder', "insert "+val+" options")
			textarea.name = 'options'<?php //echo $field['name'] ?>;
			textarea.value = 'field-properties';

			newdiv.appendChild(textarea);
			frag.appendChild(newdiv);

			target.appendChild(frag);
		}

		if (el !== null) {
		    div.removeChild(el);
		    add_textarea(div);
		}
		else
		{
			if (val == 'select' || val == 'checkbox' || val == 'radio') {
				add_textarea(div);
			}
		};*/

	}

</script>
</body>
</html>
<?php endif ?>