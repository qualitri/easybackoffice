<?php if($this->session->userdata('step') >= 2): ?>

<form id="field-properties" class="form-horizontal" method="post" action="<?php echo $base_url ?>form_build/save_properties">

    <div class="fields_generated">

        <?php foreach ($fields as $field): ?>

        <div class="control-group field field-<?php echo $field['name'] ?>">

            <label class="control-label" for="<?php echo 'type'.$field['name'] ?>"> <?php echo $field['label'] ?> </label>
            <div class="controls">
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
                    <textarea id="options<?php echo $field['name'] ?>" rows="6" name="options<?php echo $field['name'] ?>"
                          placeholder="insert select options"><?php echo implode("\n", $field['options_raw']) ?></textarea>
                    <?php else: ?>
                    <textarea id="options<?php echo $field['name'] ?>" rows="6" name="options<?php echo $field['name'] ?>"
                          placeholder="insert options"></textarea>
                    <?php endif ?>
                </div>

                <span class="required">
                    <label class="checkbox inline" for="req_1">
                        <input type="checkbox" class="chkboxReq" id="req_1" name="<?php echo 'required'.$field['name'] ?>"
                            <?php if(isset($field['required'])) echo ($field['required']) ? 'checked' : ''  ?>>
                            Required field?
                    </label>
                </span>
            </div>    
        </div>

        <?php endforeach; ?>

    </div>
    <div class="controls">
        <input class="btn btn-xs btn-success" type="submit" value="Save Properties" />
    </div>

</form>


<script type="text/javascript">


    $('.field').each(function(key, element)
    {
        var type = $(element).find('.selectType').val();

        if (type != 'select' && type != 'checkbox_group' && type != 'radio')
        {
            $(element).find('.optionsField').hide();
        }
    });

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

	}

</script>

<?php endif ?>