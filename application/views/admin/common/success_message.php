<!-- Jumbotron -->
<div class="jumbotron">
    <h1><?php //echo $this->lang->line('success_title') ?></h1>
    <p class="lead">
        <?php
        if($action_performed == 'save'){
            echo "<h3>{$entity_name} {$this->lang->line('success_add')}</h3>";
        }
        else if($action_performed == 'update') {
            echo "<h3>{$entity_name} {$this->lang->line('success_update')}</h3>";
        }
        else if($action_performed == 'remove') {
            echo "<h3>{$entity_name} {$this->lang->line('success_remove')}</h3>";
        }
        ?>
    </p>
    <a class="btn" href="<?php echo $list_url ?>"><?php echo $this->lang->line('back_to_list') ?></a>
</div>