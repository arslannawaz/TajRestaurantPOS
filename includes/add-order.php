<?php
ob_start();
require_once("connection.php");

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];


if(isset($_POST["addorder"])){
    $table = $_POST['table'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }

    $sql = "update booking_table set status=1  WHERE id = '$table'";
    if (mysqli_query($conn, $sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "INSERT INTO `payment` (price,tax,status,date,notes,total_price) VALUES('$round_total','$round_tax','1','$date','$notes','$round_total_price')";
    if (mysqli_query($conn, $sql)) {
        $sql1 = "SELECT * from `payment` order by id DESC LIMIT 1";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $payment_id = $row["id"];
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `place_order` (table_id,item_id,qty,payment_id) VALUES('$table','$item[$i]','$qty_array[$i]','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    header("location: ../view-order.php");
    ob_end_flush();
}


if(isset($_POST["freetable"])){
    $table = $_POST['table'];

    $sql = "update booking_table set status=0  WHERE id = '$table'";
    if (mysqli_query($conn, $sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("location: ../free-table.php");
    ob_end_flush();
}


if(isset($_POST["add-takeaway"])){
    $name = $_POST['name'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];

    //print_r($qty);

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }
    //print_r($qty_array);
    
    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "INSERT INTO `payment` (price,tax,status,date,notes,total_price) VALUES('$round_total','$round_tax','2','$date','$notes','$round_total_price')";
    if (mysqli_query($conn, $sql)) {
        $sql1 = "SELECT * from `payment` order by id DESC LIMIT 1";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $payment_id = $row["id"];
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `takeaway` (customer,item_id,qty,payment_id) VALUES('$name','$item[$i]','$qty_array[$i]','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    header("location: ../view-takeaway.php");
    ob_end_flush();
}


if(isset($_POST["add-delivery"])){
    $name = $_POST['name'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $address = $_POST['address'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];

    //print_r($qty);

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }
    //print_r($qty_array);
    
    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "INSERT INTO `payment` (price,tax,status,date,notes,total_price) VALUES('$round_total','$round_tax','3','$date','$notes','$round_total_price')";
    if (mysqli_query($conn, $sql)) {
        $sql1 = "SELECT * from `payment` order by id DESC LIMIT 1";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $payment_id = $row["id"];
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `delivery` (customer,item_id,qty,address,payment_id) VALUES('$name','$item[$i]','$qty_array[$i]','$address','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    //echo "<script >alert('Table has been assigned');document.location='../print-order.php?order_id=$order_id'</script>";
    header("location: ../view-delivery.php");
    ob_end_flush();
}


if(isset($_POST["editorder"])){
    $table = $_POST['table'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $payment_id= $_POST['payment_id'];

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }

    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "update `payment` set price='$round_total', tax='$round_tax', date='$date', notes='$notes', total_price='$round_total_price' where id='$payment_id'";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql_placeorder = "delete from `place_order` WHERE payment_id = '$payment_id'";
    if (mysqli_query($conn, $sql_placeorder)) {
        
    } else {
        echo "Error: " . $sql_placeorder . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `place_order` (table_id,item_id,qty,payment_id) VALUES('$table','$item[$i]','$qty_array[$i]','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    header("location: ../view-order.php");
    ob_end_flush();
}

if(isset($_POST["edittakeaway"])){
    $customer = $_POST['customer'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $payment_id= $_POST['payment_id'];

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }

    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "update `payment` set price='$round_total', tax='$round_tax', date='$date', notes='$notes', total_price='$round_total_price' where id='$payment_id'";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql_placeorder = "delete from `takeaway` WHERE payment_id = '$payment_id'";
    if (mysqli_query($conn, $sql_placeorder)) {
        
    } else {
        echo "Error: " . $sql_placeorder . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `takeaway` (customer,item_id,qty,payment_id) VALUES('$customer','$item[$i]','$qty_array[$i]','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    header("location: ../view-takeaway.php");
    ob_end_flush();
}


if(isset($_POST["editdelivery"])){
    $customer = $_POST['customer'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $notes = $_POST['note'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $payment_id= $_POST['payment_id'];

    $qty_array=[];
    for($i=0;$i<count($qty);$i++){
        if(!($qty[$i]=='0')){
            $qty_array[]=$qty[$i];
        }
    }

    $date=date('yy-m-d');
    $tax=$total*0.09;
    $total_price=$total+$tax;
    $round_tax=number_format($tax,2);
    $round_total=number_format($total,2);
    $round_total_price=number_format($total_price,2);

    $sql = "update `payment` set price='$round_total', tax='$round_tax', date='$date', notes='$notes', total_price='$round_total_price' where id='$payment_id'";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql_placeorder = "delete from `delivery` WHERE payment_id = '$payment_id'";
    if (mysqli_query($conn, $sql_placeorder)) {
        
    } else {
        echo "Error: " . $sql_placeorder . "<br>" . mysqli_error($conn);
    }

    for ($i=0;$i<count($item);$i++) {
        $sql = "INSERT INTO `delivery` (customer,item_id,qty,address,payment_id) VALUES('$customer','$item[$i]','$qty_array[$i]','$address','$payment_id')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    header("location: ../view-delivery.php");
    ob_end_flush();
}