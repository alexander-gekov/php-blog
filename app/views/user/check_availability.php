<?php
require_once("../../config/connection.php");
// Code for checking username availabilty
if(!empty($_POST["username"])) {
    $uname= $_POST["username"];
    $sql ="SELECT username FROM  users WHERE username=:uname";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
        echo "<span style='color:red'> Username already exists.</span>";
    } else{
        echo "<span style='color:green'> Username available for Registration.</span>";
    }
}
?>