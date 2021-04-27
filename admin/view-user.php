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
                    <h2>View Users</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Users</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">


            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>View User</h4>
                    <ul>

                        <?php
                        $sql = "SELECT * from users where role=2";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <li>
                                    <div class="list-box-listing">
                                        <div class="list-box-listing-img"><a href="#"><img src="images/user-avatar.jpg" alt=""></a></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3><?php echo $row['name']; ?>  </h3>
                                                <span>Email: <?php echo $row['email']; ?></span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-to-right">
                                        <a href="includes/delete-user.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="button gray reject"><i class="sl sl-icon-close"></i> Delete</a>
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
