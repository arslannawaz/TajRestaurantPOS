
<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from booking_table WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Table has been deleted successfully";
        header("location: ../view-table.php");
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}