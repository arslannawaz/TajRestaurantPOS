<?php
ob_start();
require_once("connection.php");

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];

if(isset($_POST["addmenu"])){
     $menu_item = $_POST['menu-item'];
     $price = $_POST['price'];
    $category_id = $_POST['category'];

    $sql = "INSERT INTO `menu` (item,price,category_id) VALUES('$menu_item','$price','$category_id')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("location: ../view-menu.php");
    ob_end_flush();
}



if(isset($_POST['updatemenu'])) {

    $menu_item_id = $_POST['item-id'];
    $menu_item_price = $_POST['price'];

    $sql = "update menu set price='$menu_item_price'  WHERE id = '$menu_item_id'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("location: ../view-menu.php");
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST["add-category"])){
    $category = $_POST['category'];
    $price = $_POST['price'];
    $sql = "INSERT INTO `category` (category) VALUES('$category')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("location: ../view-category.php");
    ob_end_flush();
}