<form class="form-horizontal" action="<?php echo $base_url.'admin/auth/login/process' ?>" method="post">
    <legend>Login Form</legend>
    <div class="control-group <?php if(form_error('password')) echo 'error' ?>">
        <label class="control-label" for="inputName">Password</label>
        <div class="controls">
            <input type="password" id="inputName" name="password" class="input-xlarge"
               value="<?php echo set_value('password') ?>" placeholder="Password" style="height: auto">
            <span class="help-inline"><?php echo strip_tags(form_error('password')) ?></span>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
            <a class="btn" href="<?php echo $base_url ?>">Cancel</a>
        </div>
    </div>
</form>