
<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from users WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "User has been deleted successfully";
        header("location: ../view-user.php");
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}