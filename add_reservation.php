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

<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>User Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main-color.css" id="colors">

    <style>

        @media print {
            .donotprint{
                display: none;
            }
        }

    </style>
</head>
<body>

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
                    <h2>Add Reservation</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Add Reservation</li>
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

                        <form action="includes/add_reservation.php" method="post">
                            <!-- Details -->
                            <div class="my-profile">
                                <label>Person Name</label>
                                <input type="text" required name="person" >

                                <label>Date</label>
                                <?php $min= date('Y-m-d')?>
                                <input min="<?php echo $min ?>" type="date" required name="date" >

                                <label>Time</label>
                                <input type="time" required name="time" >

                                <label>Table</label>
                                <select required name="table">
                                    <?php
                                    $sql = "SELECT * from booking_table where status=0";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo 'Table '.$row['table_number'].' '.$row['shape'].' Persons '.$row['person'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <button name="addreservation" type="submit" class="button margin-top-15">Add Reservation</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->

<script>
    function dothis(id) {

        if(document.getElementById(id).checked===true){
            //alert(id);
            var str = new Array();
            str.push(id);

            var xhttp;
            if (!str) {
                document.getElementById("hide").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var value = this.responseText;
                    var t = document.getElementById("total").value;
                    var vv = parseFloat(value);
                    var tt = Number(vv) + Number(t);
                    document.getElementById("total").value = tt;
                }
            };
            xhttp.open("GET", "includes/caltotal.php?q=" + str, true);
            xhttp.send();
        }
        else{
            //alert(id);
            var str = new Array();
            str.push(id);

            var xhttp;
            if (!str) {
                document.getElementById("hide").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var value = this.responseText;
                    var t = document.getElementById("total").value;
                    var vv = parseFloat(value);
                    var tt = Number(t) - Number(vv);
                    document.getElementById("total").value = tt;
                }
            };
            xhttp.open("GET", "includes/caltotal.php?q=" + str, true);
            xhttp.send();
        }
    }
</script>