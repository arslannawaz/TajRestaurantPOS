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
                    <h2>View Reservation</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Reservation</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">


            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>View Reservation</h4>
                    <ul>

                        <?php
                        $sql = "SELECT * from reservation order by id desc ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $person=$row['customer_name'];
                                $date=$row['date'];
                                $time=$row['time'];
                                $re_id=$row['id'];
                                $table_id=$row['table_id'];

                                $sql1 = "SELECT * from booking_table where id='$table_id'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($rows = $result1->fetch_assoc()) {
                                        $table='Table '.$rows['id'].' '.$rows['shape'].' Persons '.$rows['person'];
                                    }
                                }

                                ?>

                                <li>
                                    <div class="list-box-listing">
                                        <div class="list-box-listing-img"><a href="#"><img src="images/listing-item-02.jpg" alt=""></a></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3>Customer Name: <?php echo $person; ?>  </h3>
                                                <span>Table: <?php echo $table  ?></span><br>
                                                <span>Date: <?php echo $date  ?></span><br>
                                                <span>Time: <?php echo $time  ?></span>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="buttons-to-right">-->
<!--                                        <a target="_blank" href="print-order.php?order_id=--><?php //echo $oo_id ?><!--"  class="button gray reject"> View Receipt</a>-->
<!--                                    </div>-->
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
