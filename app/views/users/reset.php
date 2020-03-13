<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
<div class="wrapper">
    <h2>Reset Password</h2>
    <form action="<?php echo URLROOT . '/users/reset'; ?>" method="post">

        <?php flash('password_change_success'); ?>
        <div>
            <p>
                <label for="new_password"><b>New Password: </b><sup>*</sup></label>
                <input type="password" name="new_password" value="<?php echo $data['new_password']; ?>">
                <span><?php echo $data['new_password_err']; ?></span>
            </p>
        </div>
        <div>
            <p>
                <label for="confirm_password"><b>Confirm Password: </b><sup>*</sup></label>
                <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>">
                <span><?php echo $data['confirm_password_err']; ?></span>
            </p>
        </div>
        <div>
            <input type="submit" class="button" value="Reset">
            <a class="button" href="<?php URLROOT . '/pages/index' ?>">Cancel</a>
        </div>
    </form>
</div>
<?php include APPROOT . 'views/inc/footer.php' ?>

