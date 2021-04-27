<?php
ob_start();
session_start();
include('includes/connection.php');
include ('includes/app.php');

if(!$_SESSION["id"]){
    header("location: index.php");
}
else{
    $userid=$_SESSION["id"];
    $username=$_SESSION["name"];
}

?>


<!-- Dashboard -->
<div id="dashboard">

    <?php
    include ('includes/sidebar.php');
    ?>

    <!-- Content
    ================================================== -->
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>View Order</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Order</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>View Order</h4>
                    <ul>
                        <?php
                        $sql_payment = "SELECT * from payment where status=1 order by id desc";
                        $result1 = $conn->query($sql_payment);
                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                                $total = $row1['total_price'];
                                $price = $row1['price'];
                                $tax = $row1['tax'];

                                $notes = $row1['notes'];
                                $date = $row1['date'];
                                $p_id = $row1['id'];

                                $sql = "SELECT * from place_order where payment_id = '$p_id' ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $item_id=[];
                                    $qty=[];
                                    while ($row = $result->fetch_assoc()) {
                                         $t_able = $row['table_id'];
                                         $item_id[] = $row['item_id'];
                                         $qty[] = $row['qty'];
                                        $oo_id = $row['id'];
                                    }
                                }

                                $sql1 = "SELECT * from booking_table where id='$t_able'";
                                $result11 = $conn->query($sql1);
                                if ($result11->num_rows > 0) {
                                    while ($rows = $result11->fetch_assoc()) {
                                        $table='Table '.$rows['table_number'].' '.$rows['shape'].' Persons '.$rows['person'];
                                    }
                                }
                                ?>

                                <li>
                                    <div class="list-box-listing">
                                        <div class="list-box-listing-img"><a href="#"><img src="images/review-image-01.jpg" alt=""></a></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3><?php echo $table; ?>  </h3>

                                                <?php
                                                for($i=0;$i<count($item_id);$i++){
                                                    $sql2 = "SELECT * from menu where id='$item_id[$i]'";
                                                    $result2 = $conn->query($sql2);
                                                    if ($result2->num_rows > 0) {
                                                        while ($row = $result2->fetch_assoc()) {
                                                            $table_item=$row['item'];
                                                            ?>
                                                            <span> <?php echo $table_item  ?></span>&nbsp;&nbsp
                                                            <span > <?php echo $qty[$i]  ?></span><br>
                                                            <?php
                                                        }
                                                    }
                                                }

                                                ?>
                                                <span>Note: <?php echo $notes  ?></span><br>
                                                <span>Price: <?php echo $total  ?></span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-to-right">
                                        <a target="_blank" href="print-order.php?order_id=<?php echo $p_id ?>"  class="button gray reject"> View Receipt</a>
                                        <a href="edit-order.php?order_id=<?php echo $p_id ?>" class="button gray approve">Edit</a>

                                    </div>
                                </li>

                                <?php
                            }

                        }
                        ?>

                    </ul>
                </div>
            </div>



        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->