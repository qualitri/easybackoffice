<!-- Jumbotron -->
<div class="jumbotron">
    <h1></h1>
    <p class="lead"></p>
    <a class="btn btn-large btn-success" href="<?php echo $base_url ?>admin/presentation/create">
        Create Test
    </a>
</div>

<hr>

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
    <thead>
    <th>ID Test</th>
    <th></th>
    </thead>
    <tbody>
    <?php foreach($list as $Test): ?>
    <tr>
        <td><?php echo $test->getIdTest() ?></td>
        <td><?php echo $test->get() ?></td>
        <td>
            <form action="<?php echo $base_url.'admin/test/edit/'.$test->getIdTest() ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            <form action="<?php echo $base_url.'admin/test/remove/'.$test->getIdTest().'/confirm' ?>">
                <button type="submit" class="btn">Remove</button>
            </form>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>