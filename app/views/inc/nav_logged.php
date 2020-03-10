<header class="header">
    <a href="../pages/index.php" class="logo">BLOG</a>
    <a class="greet">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the blog.</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
    <ul class="menu">
        <li><a href="../user/reset.php">Reset password</a></li>
        <li><a href="../user/logout.php">Logout</a></li>
    </ul>
</header>