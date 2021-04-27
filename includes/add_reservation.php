<?php
ob_start();
require_once("connection.php");
session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];

if(isset($_POST["addreservation"])){
    $person = $_POST['person'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $table = $_POST['table'];

    $sql = "update booking_table set status=1  WHERE id = '$table'";
    if (mysqli_query($conn, $sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "INSERT INTO `reservation` (customer_name,date,time,table_id) VALUES('$person','$date','$time','$table')";
    if (mysqli_query($conn, $sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("location: ../view-reservation.php");
    ob_end_flush();
}
