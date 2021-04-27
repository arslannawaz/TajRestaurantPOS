<?php
?>
<!-- Navigation
    ================================================== -->

<!-- Responsive Navigation Trigger -->
<a href="#" class="dashboard-responsive-nav-trigger "><i class="fa fa-reorder"></i> Dashboard Navigation</a>

<div class="dashboard-nav">
    <div class="dashboard-nav-inner">

        <ul data-submenu-title="Main">
            <li class="active"><a href="dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>

            <li>
                <a><i class="fa fa-clock-o"></i>Order</a>
                <ul>
                    <li><a href="add-order.php">Dine-in</a></li>
                    <li><a href="take-away.php">Take Away</a></li>
                    <li><a href="delivery.php">Delivery</a></li>
                    <li><a href="view-order.php">View Dine-in</a></li>
                    <li><a href="view-takeaway.php">View Takeaway</a></li>
                    <li><a href="view-delivery.php">View Delivery</a></li>

                </ul>
            </li>
            <li>
                <a><i class="fa fa-clock-o"></i>Reservation</a>
                <ul>
                    <li><a href="add_reservation.php">Add Reservation</a></li>
                    <li><a href="view-reservation.php">View Reservation</a></li>
                </ul>
            </li>
            <li>
                <a href="free-table.php"><i class="fa fa-clock-o"></i>Table in Use</a>
            </li>
            <li>
                <a href="report.php"><i class="fa fa-clock-o"></i>Reports</a>
            </li>
        </ul>


        <ul data-submenu-title="Account">
<!--            <li><a href="editprofile.php"><i class="sl sl-icon-user"></i>My Profile</a></li>-->
            <li><a href="logout.php"><i class="sl sl-icon-power"></i>Logout</a></li>
        </ul>

    </div>
</div>
<!-- Navigation / End -->


