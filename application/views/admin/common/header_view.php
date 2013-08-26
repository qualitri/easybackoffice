<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <div class="masthead">
        <div class="row-fluid">
            <h3 class="muted span4">Admin</h3>
            <div class="span4 offset4" style="text-align: right; margin-top: 15px">
                <?php if(!isset($logout)): ?>
                <a class="btn btn-danger" href="<?php echo $base_url ?>admin/auth/logout">Logout</a>
                <?php endif; ?>
            </div>
        </div>
        <?php if(!isset($logout)): ?>
        <div class="navbar">
            <div class="navbar-inner" style="padding: 0">
                <div class="container">
                    <ul class="nav">

                    </ul>
                </div>
            </div>
        </div><!-- /.navbar -->
        <?php endif; ?>
    </div>