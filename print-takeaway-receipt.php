<?php
ob_start();
session_start();
include('includes/connection.php');


if(!$_SESSION["id"]){
    header("location: index.php");
}
else{
    $userid=$_SESSION["id"];
    $username=$_SESSION["name"];
}

if (isset($_GET['order_id'])) {
    $or_id = $_GET['order_id'];
}

$sql_payment = "SELECT * from payment where id='$or_id'";
$result1 = $conn->query($sql_payment);
if ($result1->num_rows > 0) {
while ($row1 = $result1->fetch_assoc()) {
    $total = $row1['total_price'];
    $price = $row1['price'];
    $total_tax = $row1['tax'];
    $notes = $row1['notes'];
    $date = $row1['date'];
    $p_id = $row1['id'];

    $order_query = "SELECT * from takeaway where payment_id = '$p_id' ";
    $result = $conn->query($order_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customer_name = $row['customer'];
        }
    }

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taj</title>
    <link rel="stylesheet" href="css/invoice.css">
</head>

<body>

<!-- Print Button -->
<a href="javascript:window.print()" class="print-button">Print this invoice</a>

<!-- Invoice -->
<div id="invoice">

    <!-- Header -->
    <div class="row">
        <div class="col-md-6">
            <div id="logo">
                <a  style="text-decoration: none"  href="#"><h4 style=" color: #F69322;font-weight: bold">Taj Indian Restaurant</h4></a>
            </div>
        </div>

        <div class="col-md-6">

            <p id="details">
                <strong>Order No:</strong> <?php echo $or_id?> <br>
                <strong>Customer:</strong> <?php echo $customer_name?> <br>
                <strong>Date:</strong> <?php echo $date?> <br>
                <strong>Order Type:</strong> Takeaway <br>
            </p>
        </div>
    </div>

    <!-- Client & Supplier -->
    <div class="row">
        <div class="col-md-12">
            <h2>Invoice</h2>
        </div>
    </div>

    <!-- Invoice -->
    <div class="row">
        <div class="col-md-12">
            <table class="margin-top-20">
                <tr>
                    <th>Menu and Tax</th>
                    <th>Menu Price</th>
                    <th>Tax</th>
                    <th>Total Price</th>
                </tr>
                <?php
                $sql = "SELECT * from takeaway where payment_id='$p_id' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item_id[]=$row['item_id'];
                        $item_qty[]=$row['qty'];
                    }
                }
                ?>
                <?php
                for($i=0;$i<count($item_id);$i++) { ?>
                <tr>
                    <td>
                        <?php
                            $sql2 = "SELECT * from menu where id='$item_id[$i]'";
                            $result2 = $conn->query($sql2);
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                                    echo $table_item=$item_qty[$i].' * '.$row['item'];
                                    $item_price=$row['price'];
                                }
                            }
                        ?>
                    </td>
                    <?php $price_of_item= $item_price*$item_qty[$i];?>
                    <td><?php echo $price_of_item; ?></td>
                    <?php $tax= $item_price*$item_qty[$i]*0.09;?>
                    <td><?php echo number_format($tax,2) ?></td>
                    <?php $final_total= $price_of_item+$tax;?>
                    <td><?php echo number_format($final_total,2) ?></td>
                </tr>
                <?php
                     }
                ?>
            </table>
        </div>

        <div class="col-md-4 col-md-offset-8">
            <table id="totals">
                <tr>
                    <th>Price</th>
                    <th><span>£ <?php echo $price?></span></th>
                </tr>
                <tr>
                    <th>Tax</th>
                    <th><span>£ <?php echo $total_tax?></span></th>
                </tr>
                <tr>
                    <th>Total Due</th>
                    <th><span>£ <?php echo $total?></span></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="row">
        <div class="col-md-12">
            <ul id="footer">
                <li><span>www.taj-indian-restaurant.nl</span></li>
                <li>info@taj-indian-restaurant.nl</li>
                <li>(020) 6797297/6793804</li>
            </ul>
        </div>
    </div>

</div>
</body>
</html>
