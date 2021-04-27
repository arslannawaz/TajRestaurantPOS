
<?php

include('connection.php');

if (isset($_GET['item'])) {
    $id = $_GET['item'];
    $sql = "delete from menu WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "menu item has been deleted successfully";
        header("location: ../view-menu.php");
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}