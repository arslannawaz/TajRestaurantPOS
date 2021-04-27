<?php

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];
require_once("connection.php");

$data=explode(',',$_GET['q']);



$sql = "SELECT * from menu where id='$data[0]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       echo $price = $row["price"];

    }
}

?>

