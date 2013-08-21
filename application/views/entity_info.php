<?php if($this->session->userdata('step') >= 3): ?>

<form id="field-properties" method="post" action="<?php echo $base_url ?>form_build/save_entity_info">

    <div class="field">

        <label for="entityName">Entity name</label>

        <input type="text" id="entityName" name="entity_name"
            value="<?php echo isset($entity_info['name']) ? $entity_info['name'] : '' ?>">

    </div>

    <div class="field">

        <label for="entityName">Entity prefix</label>

        <input type="text" id="entityPrefix" name="entity_prefix"
            value="<?php echo isset($entity_info['prefix']) ? $entity_info['prefix'] : '' ?>">

    </div>

    <input class="btn btn-xs btn-success" type="submit" value="Go to Export" />

</form>

<?php endif ?>