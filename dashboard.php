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
                    <h2>Howdy, <?php echo $username; ?> !</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


        <!-- Content -->
        <div class="row">

                <?php
                    $total_reservation=0;
                    $sql = "SELECT * from reservation";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $total_reservation = mysqli_num_rows($result);
                    }
                    ?>

            <!-- Item -->
            <a href="view-reservation.php"><div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4><?php echo $total_reservation?></h4> <span>Reservation</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
                </div>
            </div>
            </a>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <div class="dashboard-stat-content"><h4>7</h4> <span>Total Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
                </div>
            </div>


            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4>95</h4> <span>Total Tables</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4>12</h4> <span>Total Menu Item</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                </div>
            </div>
        </div>



    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
