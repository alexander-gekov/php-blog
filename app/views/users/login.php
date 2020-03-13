
<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
    <div class="wrapper">
        <h2>Login</h2>
        <form action="<?php echo URLROOT . '/users/login'; ?>" method="post">
            <?php flash('register_success'); ?>
            <div>
                <p>
                    <label for="username"><b>Username: </b></label>
                    <input type="text" name="username" value="<?php echo $data['username']; ?>">
                    <span><?php echo $data['username_err']; ?></span>
                </p>
            </div>
            <div>
                <p>
                    <label for="password"><b>Password: </b></label>
                    <input type="password" name="password" value="<?php echo $data['password']; ?>">
                    <span><?php echo $data['password_err']; ?></span>
                </p>
            </div>
            <div>
                <input type="submit" class="button" value="Login">
            </div>
            <p>Don't have an account? <a href="<?php echo URLROOT . '/users/register'?>">Register now</a>.</p>
        </form>
    </div>
    <?php include APPROOT . '/views/inc/footer.php'; ?>
</body>
</html>