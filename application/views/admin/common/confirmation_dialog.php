<!-- Jumbotron -->
<div class="jumbotron">
    <h1><?php echo $this->lang->line('confirmation_title') ?></h1>
    <p class="lead">
        <?php echo $this->lang->line('confirmation_message') ?> <?php echo $entity_name ?>?
    </p>
    <a class="btn btn-primary" href="<?php echo $remove_url ?>"><?php echo $this->lang->line('yes') ?></a>
    <a class="btn" href="<?php echo $list_url ?>"><?php echo $this->lang->line('no') ?></a>
</div>