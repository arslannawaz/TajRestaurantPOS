<?php
ob_start();
require_once("connection.php");

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];

if(isset($_POST["addtable"])){
    $shape = $_POST['shape'];
    $number_of_persons = $_POST['number'];
    $table_number = $_POST['table_number'];
    $sql = "INSERT INTO `booking_table` (shape,person,status,table_number) VALUES('$shape','$number_of_persons',0,'$table_number')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("location: ../view-table.php");
    ob_end_flush();
}


if(isset($_POST['updatetable'])) {

    $table_id = $_POST['table-id'];
    $table_shape = $_POST['shape'];
    $number_of_per = $_POST['number'];
    $table_number = $_POST['table_number'];

    $sql = "update booking_table set shape='$table_shape', person='$number_of_per', table_number='$table_number'  WHERE id = '$table_id'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("location: ../view-table.php");
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}