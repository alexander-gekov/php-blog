
<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
<div class="wrapper form-wrapper">
    <h2>Login</h2>
    <form name="loginForm" id="loginForm" action="<?php echo URLROOT . '/users/login'; ?>" method="post">
        <div>
            <p>
                <label for="email"><b>Email: </b></label>
                <input type="text" name="email" id="forgotEmail">
                <span><?php echo $data['email_err']; ?></span>
            </p>
        </div>
        <div>
            <input type="submit" class="button-black" id="btnSubmit" value="Send Me My New Password">
        </div>
    </form>
</div>
<?php include APPROOT . '/views/inc/footer.php'; ?>
</body>
</html>
