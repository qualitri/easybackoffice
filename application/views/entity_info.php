<?php if($this->session->userdata('step') >= 3): ?>

<form class="form-horizontal" id="field-properties" method="post" action="<?php echo $base_url ?>form_build/save_entity_info">
    <div class="control-group">
        <div class="field">

            <label class="control-label" for="entityName">Entity name</label>
            <div class="controls">
                <input type="text" id="entityName" name="entity_name"
                    value="<?php echo isset($entity_info['name']) ? $entity_info['name'] : '' ?>">
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="field">

            <label class="control-label" for="entityName">Entity prefix</label>
            <div class="controls">
                <input type="text" id="entityPrefix" name="entity_prefix"
                    value="<?php echo isset($entity_info['prefix']) ? $entity_info['prefix'] : '' ?>">
            </div>             
        </div>
    </div>      
    <div class="controls">
        <input class="btn btn-xs btn-success" type="submit" value="Go to Export" />
    </div>
</form>

<?php endif ?>