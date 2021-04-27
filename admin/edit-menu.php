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

if(isset($_GET['item'])) {
    $item_id = $_GET['item'];
}

$sql = "SELECT * from menu where id = '$item_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
        $item_name=$row['item'];
        $item_price=$row['price'];
    }
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
                    <h2>Edit Menu</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Edit Menu</li>
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

                        <form action="includes/add-menu.php" method="post">
                            <!-- Details -->
                            <div class="my-profile">
                                <input hidden name="item-id" value="<?php echo $item_id ?>" >
                                <label>Item</label>
                                <input disabled required name="menu-item" type="text" value="<?php echo $item_name?>">

                                <label>Price</label>
                                <input step=any required name="price" type="number" value="<?php echo $item_price?>">
                            </div>

                            <button name="updatemenu" type="submit" class="button margin-top-15">Update</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->
