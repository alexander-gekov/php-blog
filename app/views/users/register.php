<?php include APPROOT . '/views/inc/header.php'?>
<?php include APPROOT . '/views/inc/nav.php' ?>
    <div class="wrapper">
        <h2>Register</h2>
        <form action="<?php echo URLROOT . '/users/register'; ?>" method="post">
            <div>
              <p>
                <label for="username"><b>Username: </b><sup>*</sup></label>
                <input type="text" name="username" value="<?php echo $data['username']; ?>">
                <span><?php echo $data['username_err']; ?></span>
              </p>
            </div>
            <div>
              <p>
                 <label for="password"><b>Password: </b><sup>*</sup></label>
                <input type="password" name="password" value="<?php echo $data['password']; ?>">
                <span><?php echo $data['password_err']; ?></span>
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
                <input type="submit" class="button" value="Submit">
                <input type="reset" class="button" value="Clear">
            </div>
            <p>Already have an account? <a href="<?php echo URLROOT ?>/users/login">Login here</a>.</p>
        </form>
    </div>
<?php include APPROOT . '/views/inc/footer.php' ?>
</body>
</html>