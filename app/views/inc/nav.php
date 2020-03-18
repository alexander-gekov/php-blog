<header class="header">
    <a href="<?php echo URLROOT; ?>" class="logo">BLOG</a>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <a class="greet">Welcome, <?php echo $_SESSION['user_name']; ?></a>
    <?php endif; ?>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
    <ul class="menu">
        <?php if (!isset($_SESSION['user_id'])) : ?>
            <li><a href="<?php echo URLROOT; ?>/users/login">Login</a></li>
            <li><a href="<?php echo URLROOT; ?>/users/register">Register</a></li>
        <?php else : ?>
            <li><a href="<?php echo URLROOT; ?>/posts">Posts</a></li>
            <li><a href="<?php echo URLROOT; ?>/users/reset">Reset Password</a></li>
            <li><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
</header>
