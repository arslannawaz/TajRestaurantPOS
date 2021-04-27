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
                    <h2>Add Table</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Add Table</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">

                        <form action="includes/add-table.php" method="post">
                            <!-- Details -->
                            <div class="my-profile">
                                <label>Table Shape</label>
                                <select required name="shape">
                                    <option>Square</option>
                                    <option>Round</option>
                                </select>

                                <label>Table Number</label>
                                <input min="1" required name="table_number" type="number">

                                <label>Number of Persons</label>
                                <input min="1" required name="number" type="number">
                            </div>

                            <button name="addtable" type="submit" class="button margin-top-15">Add Table</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->
