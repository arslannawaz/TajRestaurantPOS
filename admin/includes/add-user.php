<?php
ob_start();
require_once("connection.php");

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];

if(isset($_POST["adduser"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO `users` (name,email,password,role) VALUES('$name','$email','$password',2)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("location: ../view-user.php");
    ob_end_flush();
}
