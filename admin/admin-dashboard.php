<?php
ob_start();
session_start();
include('includes/connection.php');
include ('includes/app.php');

if(!$_SESSION["id"]){
    header("location: ../index.php");
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

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-1">
                    <?php
                    $total_item=0;
                    $sql = "SELECT * from menu";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $total_item = mysqli_num_rows($result);
                    }

                    $total_table=0;
                    $sql = "SELECT * from booking_table";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $total_table = mysqli_num_rows($result);
                    }

                    ?>
                    <div class="dashboard-stat-content"><h4><?php echo $total_item; ?></h4> <span>Active Menu Item</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <div class="dashboard-stat-content"><h4><?php echo $total_table; ?></h4> <span>Active Tables</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
                </div>
            </div>


            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4>9</h4> <span>Total Booking</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4>12</h4> <span>Total Waiters</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
