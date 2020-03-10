<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../user/login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog By Alexander & Dragos</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
<?php include '../inc/nav_logged.php';
include '../inc/content.php';
include '../inc/footer.php'; ?>

</body>
</html>
