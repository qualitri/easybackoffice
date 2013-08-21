<form class="form-horizontal" action="<?php echo $base_url.'admin/presentation/'.$form_action ?>" method="post" enctype="multipart/form-data">

    <legend><?php echo $this->lang->line('presentation_form') ?></legend>

    <?php if(isset($entity)): ?>

    {#entity_fields#}

    <input type="hidden" id="inputId{##}" name="id_presentation" value="<?php echo $entity->getIdPresentation() ?>">

    <?php else: ?>

    {#empty_fields#}

    <?php if(isset($id_presentation)): ?>
    <input type="hidden" name="id_presentation" value="<?php echo $id_presentation ?>">
    <?php endif; ?>

    <?php endif; ?>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">
                <?php echo $form_action == 'save' ? $this->lang->line('create') : $this->lang->line('update') ?>
            </button>
            <a class="btn" href="<?php echo $base_url.'admin/presentation' ?>"><?php echo $this->lang->line('cancel') ?></a>
        </div>
    </div>

</form>