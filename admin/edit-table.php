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


if(isset($_GET['id'])) {
    $table_id = $_GET['id'];
}

$sql = "SELECT * from booking_table where id = '$table_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table_shape=$row['shape'];
        $table_persons=$row['person'];
        $table_number=$row['table_number'];
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
                    <h2>Edit Table</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Edit Table</li>
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

                                <input hidden name="table-id" value="<?php echo $table_id ?>" >

                                <label>Table Shape</label>
                                <select required name="shape">
                                    <?php
                                    if($table_shape=='Square'){?>
                                        <option selected value="<?php echo $table_shape?>"><?php echo $table_shape?></option>
                                        <option value="Round">Round</option>
                                    <?php
                                    }
                                    else{?>
                                        <option selected <?php echo $table_shape?>><?php echo $table_shape?></option>
                                        <option value="Square">Square</option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <label>Table Number</label>
                                <input min="1" required name="table_number" value="<?php echo $table_number?>" type="number">

                                <label>Number of Persons</label>
                                <input min="1" required name="number" type="number" value="<?php echo $table_persons?>">
                            </div>

                            <button name="updatetable" type="submit" class="button margin-top-15">Update Table</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->
