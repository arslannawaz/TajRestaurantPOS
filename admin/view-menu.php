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
                    <h2>View Menu</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Menu</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">


            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>View Menu Item</h4>
                    <ul>

                        <?php
                        $sql = "SELECT * from menu order by id desc";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $category_id=$row['category_id'];
                            $item=$row['item'];
                            $price=$row['price'];
                            $menu_item_id=$row['id'];
                            $sql1 = "SELECT * from category where id='$category_id'";
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    $category=$row['category'];
                                }
                            }
                                ?>

                                <li>
                                    <div class="list-box-listing">
                                        <div class="list-box-listing-img"><a href="#"><img src="images/listing-item-02.jpg" alt=""></a></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3><?php echo $item ?>  </h3>
                                                <span>Price: <?php echo $price ?></span><br>
                                                <span>Category: <?php echo $category; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-to-right">
                                        <a href="edit-menu.php?item=<?php echo $menu_item_id ?>" class="button gray"> Update Price</a>
                                        <a href="includes/delete-menu-item.php?item=<?php echo $menu_item_id ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="button gray reject"><i class="sl sl-icon-close"></i> Delete</a>
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
