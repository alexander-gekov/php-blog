<?php
require_once "../../config/connection.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = :username";

        if( $query= $pdo -> prepare($sql)){

            $param_username = trim($_POST["username"]);

            $query-> bindParam(':username', $param_username, PDO::PARAM_STR);

            if($query->execute()) {
                if ($query->rowCount() == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
            }
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        if($query = $pdo->prepare($sql)){

            $param_username = $username;
            $param_password = $password;

            $query-> bindParam(':username', $param_username, PDO::PARAM_STR);
            $query-> bindParam(':password', $param_password, PDO::PARAM_STR);

            if($query->execute()){
                header("location: login.php");
            } else{
                echo " <script> alert('Something went wrong. Please try again later.'); </script> ";
            }
        }
    }
}
?>

<?php include '../inc/header.php'?>
<body>
<?php include '../inc/nav.php' ?>
    <div class="wrapper">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
              <p>
                <b>Username</b>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
              </p>
            </div>
            <div>
              <p>
                <b>Password</b>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $password_err; ?></span>
              </p>
            </div>
            <div>
              <p>
                <b>Confirm Password</b>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span><?php echo $confirm_password_err; ?></span>
              </p>
            </div>
            <div>
                <input type="submit" class="button" value="Submit">
                <input type="reset" class="button" value="Clear">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
<?php include '../inc/footer.php' ?>
</body>
</html>
