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
                    <h2>Add Menu</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Add Menu</li>
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

                                <label>Menu Category</label>
                                <select required name="category">
                                    <?php
                                    $sql = "SELECT * from category";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <label>Item</label>
                                <input required name="menu-item" type="text">

                                <label>Price</label>
                                <input step="any" min="1" required name="price" type="number">
                            </div>

                            <button name="addmenu" type="submit" class="button margin-top-15">Add Menu</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->
