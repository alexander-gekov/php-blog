<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../pages/welcome.php");
    exit;
}

require_once "../../config/connection.php";

$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $uname=$_POST['username'];
        $password=$_POST['password'];
        // Fetch data from database on the basis of username/email and password
        $sql ="SELECT username, password FROM users WHERE (username=:usname) and (password=:usrpassword)";
        $query= $pdo -> prepare($sql);
        $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
        $query-> bindParam(':usrpassword', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$_POST['username'];
            header("location: ../pages/welcome.php");
        } else{
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>

<?php include '../inc/header.php' ?>
<body>
<?php include '../inc/nav.php' ?>
    <div class="wrapper">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
              <p>
                <b>Username</b>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
              </P>
            </div>
            <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
              <p>
                <b>Password</b>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
              </p>
            </div>
            <div>
                <input type="submit" class="button" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Register now</a>.</p>
        </form>
    </div>
    <?php include '../inc/footer.php'; ?>
</body>
</html>
