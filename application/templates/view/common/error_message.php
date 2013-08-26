<!-- Jumbotron -->
<div class="jumbotron">
    <h1><?php echo $this->lang->line('error_title') ?>!</h1>
    <p class="lead">
        <?php
        if($action_performed == 'save'){
            echo "<h3>{$entity_name} {$this->lang->line('error_add')}</h3>";
        }
        else if($action_performed == 'update') {
            echo "<h3>{$entity_name} {$this->lang->line('error_update')}</h3>";
        }
        else if($action_performed == 'remove') {
            echo "<h3>{$entity_name} {$this->lang->line('error_remove')}</h3>";
        }
        ?>
    </p>
    <a class="btn" href="<?php echo $base_url.$list_url ?>"><?php echo $this->lang->line('back_to_list') ?></a>
</div>