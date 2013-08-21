<!-- Jumbotron -->
<div class="jumbotron">
    <h1>{#title#}</h1>
    <p class="lead">{#subtitle#}</p>
    <a class="btn btn-large btn-success" href="<?php echo $base_url ?>admin/presentation/create">
        Create {#entity_name#}
    </a>
</div>

<hr>

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
    <thead>
    <th>{#id_name#}</th>
    <th>{#field_rep#}</th>
    </thead>
    <tbody>
    <?php foreach($list as ${#entity_name#}): ?>
    <tr>
        <td><?php echo ${#entity_name_lower#}->getId{#entity_name#}() ?></td>
        <td><?php echo ${#entity_name_lower#}->get{#field_rep_name#}() ?></td>
        <td>
            <form action="<?php echo $base_url.'admin/{#entity_name_lower#}/edit/'.${#entity_name_lower#}->getId{#entity_name#}() ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            <form action="<?php echo $base_url.'admin/{#entity_name_lower#}/remove/'.${#entity_name_lower#}->getId{#entity_name#}().'/confirm' ?>">
                <button type="submit" class="btn">Remove</button>
            </form>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>