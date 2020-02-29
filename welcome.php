<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog By Alexander & Dragos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <a href="/" class="logo">BLOG</a>
    <a class="greet">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the blog.</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
    <ul class="menu">
        <li><a href="reset.php">Reset password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</header>
</body>
</html>
